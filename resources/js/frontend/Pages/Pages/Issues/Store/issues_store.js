import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("issues_page", {
  state: () => ({
    section_headings: [],
    issues: [],
    photo_gallery: [],
    video_gallery: [],
    news: [],

    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "issues_page_cache_",
    async _isCacheValid(key) {
      // Try memory first, then Cache Storage
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
    async fetch_issues({ page = 1 } = {}) {
      const cacheKey = `issues_page_${page}`;
      if (await this._isCacheValid(cacheKey)) {
        this.issues = this._cache[cacheKey].data;
        return;
      }
      try {
        const res = await axios.get("issues", {
          params: {
            page,
            limit: 8,
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
            per_page: 8,
          };
        }
        this.issues = result;
        await this._setCache(cacheKey, this.issues);
      } catch (e) {
        this.error = e;
      }
    },
    async fetchAllIssuesPageData({ page = 1 } = {}) {
      this.loading = true;
      this.error = null;
      try {
        await this.fetch_issues({ page });
        await this.fetch_section_headings();
      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
