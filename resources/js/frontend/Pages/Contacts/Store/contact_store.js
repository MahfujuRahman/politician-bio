import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("contact_page", {
  state: () => ({
    section_headings: [],
    addresses: [],
    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "contact_page_cache_",
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
    async fetch_addresses() {
      if (await this._isCacheValid("addresses")) {
        this.addresses = this._cache["addresses"].data;
        return;
      }
      try {
        const res = await axios.get("contact-addresses", {
          params: {
            get_latest: 1,
            latest_limit: 3,
          }
        });
        this.addresses = res.data;
        await this._setCache("addresses", res.data);
      } catch (e) {
        this.error = e;
      }
    },
    async fetchAllContactPageData() {
      this.loading = true;
      this.error = null;
      try {
        await Promise.all([
          this.fetch_addresses(),
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
