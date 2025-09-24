import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("custom_page", {
  state: () => ({
    customPageData: null,
    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "custom_page_cache_",
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
      return now - entry.timestamp < 24 * 60 * 60 * 1000; // 24 hours in milliseconds
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
    async fetchCustomPageBySlug(slug) {
      if (await this._isCacheValid(`custom_page_${slug}`)) {
        this.customPageData = this._cache[`custom_page_${slug}`].data;
        return;
      }
      try {
        this.loading = true;
        this.error = null;
        const res = await axios.get(`custom-pages/${slug}`);
        this.customPageData = res.data.data;
        await this._setCache(`custom_page_${slug}`, res.data.data);
      } catch (e) {
        this.error = e;
        console.error('Error fetching custom page:', e);
      } finally {
        this.loading = false;
      }
    },
    clearCustomPageData() {
      this.customPageData = null;
      this.error = null;
      this.loading = false;
    }
  },
});
