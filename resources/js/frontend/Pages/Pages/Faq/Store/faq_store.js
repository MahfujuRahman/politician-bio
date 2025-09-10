import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("faqs_page", {
  state: () => ({
    section_headings: [],
    faqs: [],
    website_settings: [],

    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "faqs_page_cache_",
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
    async fetch_faqs() {
      if (await this._isCacheValid("faqs")) {
        this.faqs = this._cache["faqs"].data;
        return;
      }
      try {
        const res = await axios.get("faqs", {
          params: {
            latest_data: true,
          },
        });
        this.faqs = res.data;
        await this._setCache("faqs", res.data);
      } catch (e) {
        this.error = e;
      }
    },
    async fetch_website_settings() {
      if (await this._isCacheValid("website_settings")) {
        this.website_settings = this._cache["website_settings"].data;
        return;
      }
      try {
        const res = await axios.get("website-settings", {
          params: {
            get_all: 1,
            limit: 1000,
          },
        });
        this.website_settings = res.data;
        await this._setCache("website_settings", res.data);
      } catch (e) {
        this.error = e;
      }
    },
    async fetchAllFaqsPageData() {
      this.loading = true;
      this.error = null;
      try {
        await this.fetch_faqs();
        await this.fetch_website_settings();
        await this.fetch_section_headings();
      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
