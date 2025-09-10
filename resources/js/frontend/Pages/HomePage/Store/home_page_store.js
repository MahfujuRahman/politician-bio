import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("home_page", {
  state: () => ({
    section_headings: [],
    banner: null,
    services: [],
    whyChoseUs: [],
    principles: [],
    ourJourney: [],
    mediaCoverages: [],
    comments: [],
    news: [],
    poll: null,
    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "home_page_cache_",
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
    async fetch_banner() {
      if (await this._isCacheValid("banners")) {
        this.banner = this._cache["banners"].data;
        return;
      }
      try {
        const res = await axios.get("banners/custom-data");
        this.banner = res.data;
        await this._setCache("banners", res.data);
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
    async fetch_media_coverages() {
      if (await this._isCacheValid("mediaCoverages")) {
        this.mediaCoverages = this._cache["mediaCoverages"].data;
        return;
      }
      try {
        const res = await axios.get("media-coverages/custom-data");
        this.mediaCoverages = res.data;
        await this._setCache("mediaCoverages", res.data);
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
    async fetch_news() {
      if (await this._isCacheValid("news")) {
        this.news = this._cache["news"].data;
        return;
      }
      try {
        const res = await axios.get("news/custom-data");
        this.news = res.data;
        await this._setCache("news", res.data);
      } catch (e) {
        this.error = e;
      }
    },
    async fetch_poll() {
      if (await this._isCacheValid("poll")) {
        this.poll = this._cache["poll"].data;
        return;
      }
      try {
        const res = await axios.get("/polls", {
          params: {
            poll_is_voting: 1,
          },
        });
        // The API returns the poll data directly, not wrapped in a data property
        this.poll = res.data.data ? res.data : { data: res.data };
        await this._setCache("poll", this.poll);
      } catch (e) {
        this.error = e;
      }
    },
    async fetchAllHomePageData() {
      this.loading = true;
      this.error = null;
      try {
        await Promise.all([
          this.fetch_section_headings(),
          this.fetch_banner(),
          this.fetch_services(),
          this.fetch_why_chose_us(),
          this.fetch_principles(),
          this.fetch_our_journey(),
          this.fetch_media_coverages(),
          this.fetch_comments(),
          this.fetch_news(),
          this.fetch_poll(),
        ]);
      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
