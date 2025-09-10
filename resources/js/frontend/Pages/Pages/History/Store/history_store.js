import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("history_page", {
  state: () => ({
    section_headings: [],
    ourJourney: [],
    history_timelines: [],
    counters: [],

    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "history_page_cache_",
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
    async fetch_our_journey() {
      if (await this._isCacheValid("ourJourney")) {
        this.ourJourney = this._cache["ourJourney"].data;
        return;
      }
      try {
        const res = await axios.get("our-journeys/custom-data");
        this.ourJourney = res.data;
        await this._setCache("ourJourney", res.data);
      } catch (e) {
        this.error = e;
      }
    },

    // async fetch_history_timelines() {
    //   if (await this._isCacheValid("history_timelines")) {
    //     this.history_timelines = this._cache["history_timelines"].data;
    //     return;
    //   }
    //   try {
    //     const res = await axios.get("history-timelines/custom-data");
    //     this.history_timelines = res.data;
    //     await this._setCache("history_timelines", res.data);
    //   } catch (e) {
    //     this.error = e;
    //   }
    // },
    async fetch_history_timelines() {
      if (await this._isCacheValid("history_timelines")) {
        this.history_timelines = this._cache["history_timelines"].data;
        return;
      }
      try {
        const res = await axios.get("history-timelines", {
          params: {
            latest_by_month: true,
          },
        });
        this.history_timelines = res.data;
        await this._setCache("history_timelines", res.data);
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

    async fetchAllHistoryPageData() {
      this.loading = true;
      this.error = null;
      try {
        await Promise.all([
          this.fetch_our_journey(),
          this.fetch_history_timelines(),
          this.fetch_counters(),
          this.fetch_section_headings(),
        ]);
      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
