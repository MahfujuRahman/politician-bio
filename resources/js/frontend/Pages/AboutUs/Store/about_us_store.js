import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("about_us_page", {
  state: () => ({
    section_headings: [],
    about_us: null,
    whyChoseUs: [],
    volunteers: [],
    mission_vision: [],
    counters: [],

    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "about_us_page_cache_",
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
    async fetch_about_us() {
      if (await this._isCacheValid("about_us")) {
        this.about_us = this._cache["about_us"].data;
        return;
      }
      try {
        const res = await axios.get("about-uses/custom-data");
        this.about_us = res.data;
        await this._setCache("about_us", res.data);
      } catch (e) {
        this.error = e;
      }
    },
    async fetch_why_chose_us() {
      if (await this._isCacheValid("whyChoseUs")) {
        this.whyChoseUs = this._cache["whyChoseUs"].data;
        return;
      }
      try {
        const res = await axios.get("why-chose-uses/custom-data");
        this.whyChoseUs = res.data;
        await this._setCache("whyChoseUs", res.data);
      } catch (e) {
        this.error = e;
      }
    },

    async fetch_volunteers() {
      if (await this._isCacheValid("volunteers")) {
        this.volunteers = this._cache["volunteers"].data;
        return;
      }
      try {
        const res = await axios.get("volunteers/custom-data");
        this.volunteers = res.data;
        await this._setCache("volunteers", res.data);
      } catch (e) {
        this.error = e;
      }
    },
    async fetch_mission_vision() {
      if (await this._isCacheValid("mission_vision")) {
        this.mission_vision = this._cache["mission_vision"].data;
        return;
      }
      try {
        const res = await axios.get("mission-visions/custom-data");
        this.mission_vision = res.data;
        await this._setCache("mission_vision", res.data);
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

    async fetchAllAboutUsPageData() {
      this.loading = true;
      this.error = null;
      try {
        await Promise.all([
          this.fetch_section_headings(),
          this.fetch_about_us(),
          this.fetch_why_chose_us(),
          this.fetch_volunteers(),
          this.fetch_mission_vision(),
          this.fetch_counters(),
        ]);
      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
