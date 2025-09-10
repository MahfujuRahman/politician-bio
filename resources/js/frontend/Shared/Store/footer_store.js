import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("footer_store", {
  state: () => ({
    events: [],
    website_settings: [],

    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "footer_cache_",
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
    
    
    async fetch_events() {
      if (await this._isCacheValid("footer_events")) {
        this.events = this._cache["footer_events"].data;
        return;
      }
      try {
        const res = await axios.get("events", {
          params: {
            get_all: 1,
            limit: 2
          },
        });
        this.events = res.data.data;
        await this._setCache("footer_events", res.data.data);
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
    
    

    async fetchAllFooterData() {
      this.loading = true;
      this.error = null;
      try {
        await Promise.all([
          this.fetch_events(),
          this.fetch_website_settings(),
        ]);
      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
