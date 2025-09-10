import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("gallery_page", {
  state: () => ({
    section_headings: [],
    photo_gallery: [],
    video_gallery: [],
    news: [],

    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "gallery_page_cache_",
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
    async fetch_photo_gallery() {
      if (await this._isCacheValid("photo_gallery")) {
        this.photo_gallery = this._cache["photo_gallery"].data;
        return;
      }
      try {
        const res = await axios.get("images", {
          params: {
            get_all: 1,
            limit: 1000,
          },
        });
        this.photo_gallery = res.data;
        await this._setCache("photo_gallery", res.data);
      } catch (e) {
        this.error = e;
      }
    },
    async fetch_video_gallery() {
      if (await this._isCacheValid("video_gallery")) {
        this.video_gallery = this._cache["video_gallery"].data;
        return;
      }
      try {
        const res = await axios.get("videos", {
          params: {
            get_all: 1,
            limit: 1000,
          },
        });
        this.video_gallery = res.data;
        await this._setCache("video_gallery", res.data);
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

    async fetchAllGalleryPageData() {
      this.loading = true;
      this.error = null;
      try {
        await Promise.all([
          this.fetch_photo_gallery(),
          this.fetch_video_gallery(),
          this.fetch_news(),
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
