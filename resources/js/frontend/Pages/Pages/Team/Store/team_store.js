import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("team_page", {
  state: () => ({
    section_headings: [],
    volunteers: {
      data: [],
      current_page: 1,
      last_page: 1,
      total: 0,
      per_page: 6,
    },
    counters: [],
    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "team_page_cache_",
    async _isCacheValid(key) {
      let entry = this._cache[key];
      if (!entry && "caches" in window) {
        try {
          const cache = await caches.open(this._cacheKeyPrefix);
          const match = await cache.match(key);
          if (match) {
            entry = await match.json();
            this._cache[key] = entry;
          }
        } catch (e) {}
      }
      if (!entry) return false;
      const now = Date.now();
      return now - entry.timestamp < 600000;
    },
    async _setCache(key, data) {
      const entry = { data, timestamp: Date.now() };
      this._cache[key] = entry;
      if ("caches" in window) {
        try {
          const cache = await caches.open(this._cacheKeyPrefix);
          const response = new Response(JSON.stringify(entry), {
            headers: { "Content-Type": "application/json" },
          });
          await cache.put(key, response);
        } catch (e) {}
      }
    },
    async fetch_section_headings() {
      if (await this._isCacheValid("section_headings")) {
        this.section_headings = this._cache["section_headings"].data;
        return;
      }
      try {
        const res = await axios.get("section-headings",{
          params: {
            get_all: 1,
            limit: 1000,
          },
        });
        this.section_headings = res.data.data;
        await this._setCache("section_headings", res.data.data);
      } catch (e) {
        this.error = e;
      }
    },
    async fetch_volunteers({ page = 1 } = {}) {
      const cacheKey = `team_page_${page}`;
      if (await this._isCacheValid(cacheKey)) {
        this.volunteers = this._cache[cacheKey].data;
        return;
      }
      try {
        const res = await axios.get("volunteers", {
          params: {
            page,
            limit: 9,
          },
        });
        // Normalize response for both paginated and non-paginated
        let result = res.data;
        if (!result.data) {
          // If data is not present, fallback to array
          result = {
            data: Array.isArray(res.data) ? res.data : [],
            current_page: 1,
            last_page: 1,
            total: Array.isArray(res.data) ? res.data.length : 0,
            per_page: 9,
          };
        }
        this.volunteers = result;
        await this._setCache(cacheKey, this.volunteers);
      } catch (e) {
        this.error = e;
      }
    },
    async fetch_counters() {
      if (await this._isCacheValid("counters")) {
        this.counters = this._cache["counters"].data;
        return;
      }
      try {
        const res = await axios.get("counters/custom-data");
        this.counters = res.data;
        await this._setCache("counters", res.data);
      } catch (e) {
        this.error = e;
      }
    },
    async fetchAllTeamPageData({ page = 1 } = {}) {
      this.loading = true;
      this.error = null;
      try {
        await this.fetch_volunteers({ page });
        await this.fetch_counters();
        await this.fetch_section_headings();
      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
