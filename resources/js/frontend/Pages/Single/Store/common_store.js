import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("common_page", {
  state: () => ({
    principles: [],

    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "common_page_cache_",
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
    async fetch_principles() {
      if (await this._isCacheValid("principles")) {
        this.principles = this._cache["principles"].data;
        return;
      }
      try {
        const res = await axios.get("our-principles/custom-data");
        this.principles = res.data;
        await this._setCache("principles", res.data);
      } catch (e) {
        this.error = e;
      }
    },

    async fetch_comments() {
      if (await this._isCacheValid("comments")) {
        this.comments = this._cache["comments"].data;
        return;
      }
      try {
        const res = await axios.get("public-comments/custom-data");
        this.comments = res.data;
        await this._setCache("comments", res.data);
      } catch (e) {
        this.error = e;
      }
    },

    async fetch_speeches() {
      if (await this._isCacheValid("speeches")) {
        this.speeches = this._cache["speeches"].data;
        return;
      }
      try {
        const res = await axios.get("our-speeches/custom-data");
        this.speeches = res.data;
        await this._setCache("speeches", res.data);
      } catch (e) {
        this.error = e;
      }
    },

    async fetchAllPrinciplesPageData() {
      this.loading = true;
      this.error = null;
      try {
        await Promise.all([
          this.fetch_principles(),
          this.fetch_comments(),
          this.fetch_speeches(),
        ]);
      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
