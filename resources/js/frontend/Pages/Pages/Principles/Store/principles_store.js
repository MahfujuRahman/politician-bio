import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("principles_page", {
  state: () => ({
    section_headings: [],
    principles: [],
    comments: [],
    speeches: [],

    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "principles_page_cache_",
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
        this.fetch_principles()
        this.fetch_comments()
        this.fetch_speeches()
        this.fetch_section_headings()
      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
