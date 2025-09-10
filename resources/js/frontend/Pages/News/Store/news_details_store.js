import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("news_details_page", {
  state: () => ({
    section_headings: [],
    news_details: null,
    recent_news: [],
    latest_news: [],
    related_news: [],
    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "news_details_page_cache_",
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
    async fetch_news_details(slug) {
      const cacheKey = `news_details_${slug}`;
      if (await this._isCacheValid(cacheKey)) {
        this.news_details = this._cache[cacheKey].data;
        console.log("Using cached news details for:", slug);
        console.log("Cached news details:", this.news_details);
        return;
      }
      try {
        const res = await axios.get(`news/${slug}`);
        // Handle the API response structure
        let result = res.data;
        if (result.data) {
          this.news_details = result.data;
        } else {
          this.news_details = result;
        }
        await this._setCache(cacheKey, this.news_details);
      } catch (e) {
        this.error = e;
      }
    },
    async fetch_recent_news(limit = 5) {
      const cacheKey = `recent_news`;
      if (await this._isCacheValid(cacheKey)) {
        this.recent_news = this._cache[cacheKey].data;
        console.log("cache recent news:", this.recent_news);
        return;
      }
      try {
        const res = await axios.get("news", {
          params: {
            get_recent: 1,
            recent_limit: limit,
          },
        });
        this.recent_news = res.data.data || [];
        console.log("Fetched recent news:", this.recent_news);
        await this._setCache(cacheKey, this.recent_news);
      } catch (e) {
        this.error = e;
        this.recent_news = [];
      }
    },

    async fetch_latest_news(limit = 10) {
      const cacheKey = `latest_news`;
      if (await this._isCacheValid(cacheKey)) {
        this.latest_news = this._cache[cacheKey].data;
        console.log("cache latest news:", this.latest_news);
        return;
      }
      try {
        const res = await axios.get("news", {
          params: {
            get_latest: 1,
            latest_limit: limit,
          },
        });
        this.latest_news = res.data.data || [];
        console.log("Fetched latest news:", this.latest_news);
        await this._setCache(cacheKey, this.latest_news);
      } catch (e) {
        this.error = e;
        this.latest_news = [];
      }
    },

    async fetch_prev_next_news(currentNewsId) {
      try {
        console.log('Fetching prev/next news for ID:', currentNewsId);
        const res = await axios.get("news", {
          params: {
            get_prev_next: 1,
            current_id: currentNewsId,
          },
        });
        
        // Handle the API response structure
        let results = res.data;
        if (results.data) {
          return {
            prev_news: results.data.prev_news || null,
            next_news: results.data.next_news || null,
          };
        } else {
          return {
            prev_news: null,
            next_news: null,
          };
        }
      } catch (e) {
        console.error('Prev/next news error:', e);
        return {
          prev_news: null,
          next_news: null,
        };
      }
    },

    async fetch_related_news(categoryId, currentNewsId, limit = 10) {
      const cacheKey = `related_news_${categoryId}_${currentNewsId}`;
      if (await this._isCacheValid(cacheKey)) {
        this.related_news = this._cache[cacheKey].data;
        return;
      }
      try {
        console.log('Fetching related news for category:', categoryId, 'excluding news ID:', currentNewsId);
        const res = await axios.get("news", {
          params: {
            category_id: categoryId,
            limit: limit,
          },
        });
        
        console.log('Related news API response:', res);
        console.log('Related news API response data:', res.data);
        
        // Handle the API response structure
        let results = res.data;
        if (results.data && results.data.data && Array.isArray(results.data.data)) {
          // Laravel API wrapped response: res.data.data.data
          console.log('Using results.data.data (Laravel wrapped):', results.data.data);
          this.related_news = results.data.data.filter(news => news.id !== currentNewsId);
        } else if (results.data && Array.isArray(results.data)) {
          // Direct data array: res.data.data
          console.log('Using results.data:', results.data);
          this.related_news = results.data.filter(news => news.id !== currentNewsId);
        } else if (Array.isArray(results)) {
          // Direct array: res.data
          console.log('Using results directly:', results);
          this.related_news = results.filter(news => news.id !== currentNewsId);
        } else {
          console.log('No valid results structure found:', results);
          this.related_news = [];
        }
        
        console.log('Final related news after filtering:', this.related_news);
        await this._setCache(cacheKey, this.related_news);
      } catch (e) {
        console.error('Related news error:', e);
        console.error('Error response:', e.response);
        this.error = e;
        this.related_news = [];
      }
    },

    async fetchAllNewsDetailsPageData(slug) {
      this.loading = true;
      this.error = null;
      try {
        await this.fetch_recent_news();
        await this.fetch_latest_news();
        await this.fetch_section_headings();

      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
