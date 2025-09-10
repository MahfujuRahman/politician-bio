import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("service_details_page", {
  state: () => ({
    section_headings: [],
    service_details: null,
    whyChoseUs: [],
    mission_vision: [],
    counters: [],
    services: [],
    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "service_details_page_cache_",
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
    async fetch_service_details(slug) {
      const cacheKey = `service_details_${slug}`;
      if (await this._isCacheValid(cacheKey)) {
        this.service_details = this._cache[cacheKey].data;
        console.log("Using cached service details for:", slug);
        console.log("Cached service details:", this.service_details);
        return;
      }
      try {
        const res = await axios.get(`services/${slug}`);
        // Normalize response for both paginated and non-paginated
        let result = res.data;
        // Handle case when no data is found
        if (!result.data || (Array.isArray(result.data) && result.data.length === 0)) {
          this.service_details = null;
          this.error = "Service not found";
          return;
        }
        this.service_details = result;
        await this._setCache(cacheKey, this.service_details);
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
    async fetch_services() {
      if (await this._isCacheValid("services")) {
        this.services = this._cache["services"].data;
        return;
      }
      try {
        const res = await axios.get("services/custom-data");
        this.services = res.data;
        await this._setCache("services", res.data);
      } catch (e) {
        this.error = e;
      }
    },
    async fetch_section_headings() {
      if (await this._isCacheValid("section_headings")) {
        this.section_headings = this._cache["section_headings"].data;
        return;
      }
      try {
        const res = await axios.get("section-headings", {
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
    async fetchAllServiceDetailsPageData() {
      this.loading = true;
      this.error = null;
      try {
        await Promise.all([
          this.fetch_why_chose_us(),
          this.fetch_mission_vision(),
          this.fetch_counters(),
          this.fetch_services(),
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
