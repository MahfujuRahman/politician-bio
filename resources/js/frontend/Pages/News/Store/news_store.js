import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("news_page", {
  state: () => ({
    section_headings: [],
    news: [],
    tags: [],
    categories: [],
    recent_news: [],
    searchResults: [],
    searchTerm: '',
    isSearching: false,
    showSearchResults: false,
    currentFilter: {
      type: 'all', // 'all', 'tag', or 'category'
      tag_name: null,
      category_id: null,
    },

    loading: false,
    error: null,
  }),
  actions: {
    _cache: {},
    _cacheKeyPrefix: "news_page_cache_",
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
    async _clearCache(pattern = null) {
      // Clear memory cache
      if (pattern) {
        Object.keys(this._cache).forEach(key => {
          if (key.includes(pattern)) {
            delete this._cache[key];
          }
        });
      } else {
        this._cache = {};
      }
      
      // Clear browser cache
      if ("caches" in window) {
        try {
          const cache = await caches.open(this._cacheKeyPrefix);
          if (pattern) {
            const keys = await cache.keys();
            for (const request of keys) {
              if (request.url.includes(pattern)) {
                await cache.delete(request);
              }
            }
          } else {
            await caches.delete(this._cacheKeyPrefix);
          }
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
    async fetch_news({ page = 1 } = {}) {
      const cacheKey = `news_page_${page}`;
      if (await this._isCacheValid(cacheKey)) {
        this.news = this._cache[cacheKey].data;
        return;
      }
      try {
        const res = await axios.get("news", {
          params: {
            page,
            limit: 8,
          },
        });
        // Normalize response for both paginated and non-paginated
        let result = res.data;
        if (!result.data) {
          // If data is not present, fallback to array
          result = {
            data: Array.isArray(res.data) ? res.data : [],
            current_page: 1,
            last_page: 1,
            total: Array.isArray(res.data) ? res.data.length : 0,
            per_page: 8,
          };
        }
        this.news = result;
        this.currentFilter = { type: 'all', tag_name: null, category_id: null };
        await this._setCache(cacheKey, this.news);
      } catch (e) {
        this.error = e;
      }
    },
    
    async fetch_tags() {
      const cacheKey = `tags_all`;
      if (await this._isCacheValid(cacheKey)) {
        this.tags = this._cache[cacheKey].data;
        return;
      }
      try {
        const res = await axios.get("news", {
          params: {
            get_unique_tags: 1,
          },
        });
        this.tags = res.data.data || [];
        await this._setCache(cacheKey, this.tags);
      } catch (e) {
        this.error = e;
        this.tags = [];
      }
    },
    
    async fetch_categories() {
      const cacheKey = `categories_all`;
      if (await this._isCacheValid(cacheKey)) {
        this.categories = this._cache[cacheKey].data;
        return;
      }
      try {
        const res = await axios.get("news", {
          params: {
            get_categories: 1,
          },
        });
        this.categories = res.data.data || [];
        await this._setCache(cacheKey, this.categories);
      } catch (e) {
        this.error = e;
        this.categories = [];
      }
    },
    async fetch_news_by_tag({ tag_name, page = 1 } = {}) {
      // Set filter state first
      this.currentFilter = { type: 'tag', tag_name, category_id: null };
      
      const cacheKey = `news_tag_${tag_name}_page_${page}`;
      if (await this._isCacheValid(cacheKey)) {
        this.news = this._cache[cacheKey].data;
        return;
      }
      try {
        const res = await axios.get("news", {
          params: {
            tag_name,
            page,
            limit: 8,
          },
        });
        // Normalize response for both paginated and non-paginated
        let result = res.data;
        if (!result.data) {
          result = {
            data: Array.isArray(res.data) ? res.data : [],
            current_page: 1,
            last_page: 1,
            total: Array.isArray(res.data) ? res.data.length : 0,
            per_page: 8,
          };
        }
        this.news = result;
        await this._setCache(cacheKey, this.news);
      } catch (e) {
        this.error = e;
      }
    },
    
    async fetch_news_by_category({ category_id, page = 1 } = {}) {
      // Set filter state first
      this.currentFilter = { type: 'category', tag_name: null, category_id };
      
      const cacheKey = `news_category_${category_id}_page_${page}`;
      if (await this._isCacheValid(cacheKey)) {
        this.news = this._cache[cacheKey].data;
        return;
      }
      try {
        const res = await axios.get("news", {
          params: {
            category_id,
            page,
            limit: 8,
          },
        });
        // Normalize response for both paginated and non-paginated
        let result = res.data;
        if (!result.data) {
          result = {
            data: Array.isArray(res.data) ? res.data : [],
            current_page: 1,
            last_page: 1,
            total: Array.isArray(res.data) ? res.data.length : 0,
            per_page: 8,
          };
        }
        this.news = result;
        await this._setCache(cacheKey, this.news);
      } catch (e) {
        this.error = e;
      }
    },
    
    async goToPage(page) {
      if (this.currentFilter.type === 'category' && this.currentFilter.category_id) {
        await this.fetchAllNewsPageData({ page, category_id: this.currentFilter.category_id });
      } else if (this.currentFilter.type === 'tag' && this.currentFilter.tag_name) {
        await this.fetchAllNewsPageData({ page, tag_name: this.currentFilter.tag_name });
      } else {
        await this.fetchAllNewsPageData({ page });
      }
    },
    async filterByTag(tag_name) {
      // Clear any existing cached data to ensure fresh load
      await this._clearCache('news_');
      this.news = [];
      this.currentFilter = { type: 'tag', tag_name, category_id: null };
      await this.fetchAllNewsPageData({ page: 1, tag_name });
    },
    
    async filterByCategory(category_id) {
      // Clear any existing cached data to ensure fresh load
      await this._clearCache('news_');
      this.news = [];
      this.currentFilter = { type: 'category', tag_name: null, category_id };
      await this.fetchAllNewsPageData({ page: 1, category_id });
    },
    async clearFilter() {
      // Clear cache and reset state
      await this._clearCache('news_');
      this.news = [];
      this.currentFilter = { type: 'all', tag_name: null, category_id: null };
      await this.fetchAllNewsPageData({ page: 1 });
    },

    // Search functionality
    async searchNews(searchTerm) {
      console.log('searchNews called with:', searchTerm); // Debug log
      if (!searchTerm || searchTerm.length < 2) {
        this.searchResults = [];
        this.showSearchResults = false;
        return;
      }

      this.isSearching = true;
      this.searchTerm = searchTerm;
      
      try {
        console.log('Making API call to search news...'); // Debug log
        console.log('Search term:', searchTerm);
        console.log('Axios base URL:', axios.defaults.baseURL);
        console.log('Full URL will be:', axios.defaults.baseURL + 'news?search=' + encodeURIComponent(searchTerm) + '&limit=999');
        
        const res = await axios.get("news", {
          params: {
            search: searchTerm,
            limit: 999, // High limit to get all matching results
          },
        });
        
        console.log('Search API response:', res); // Debug log - full response
        console.log('Search API response data:', res.data); // Debug log - just data
        
        // Handle the API response structure: res.data.data.data contains the actual articles
        let results = res.data;
        if (results.data && results.data.data && Array.isArray(results.data.data)) {
          // Laravel API wrapped response: res.data.data.data
          this.searchResults = results.data.data;
          console.log('Using results.data.data (Laravel wrapped):', results.data.data);
        } else if (results.data && Array.isArray(results.data)) {
          // Direct data array: res.data.data
          this.searchResults = results.data;
          console.log('Using results.data:', results.data);
        } else if (Array.isArray(results)) {
          // Direct array: res.data
          this.searchResults = results;
          console.log('Using results directly:', results);
        } else {
          this.searchResults = [];
          console.log('No valid results found, setting empty array');
          console.log('Response structure:', results);
        }
        
        console.log('Final search results set to:', this.searchResults); // Debug log
        this.showSearchResults = true;
      } catch (e) {
        console.error('Search error:', e); // Debug log
        console.error('Error response:', e.response); // Debug log
        console.error('Error config:', e.config); // Debug log
        console.error('Error request:', e.request); // Debug log
        
        if (e.response) {
          console.error('Response status:', e.response.status);
          console.error('Response data:', e.response.data);
        } else if (e.request) {
          console.error('No response received:', e.request);
        } else {
          console.error('Error setting up request:', e.message);
        }
        
        this.error = e;
        this.searchResults = [];
      } finally {
        this.isSearching = false;
      }
    },

    async fetch_recent_news(limit = 5) {
      const cacheKey = `recent_news`;
      if (await this._isCacheValid(cacheKey)) {
        this.recent_news = this._cache[cacheKey].data;
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
        await this._setCache(cacheKey, this.recent_news);
      } catch (e) {
        this.error = e;
        this.recent_news = [];
      }
    },

    clearSearch() {
      this.searchTerm = '';
      this.searchResults = [];
      this.showSearchResults = false;
      this.isSearching = false;
    },

    async fetchAllNewsPageData({ page = 1, tag_name = null, category_id = null } = {}) {
      this.loading = true;
      this.error = null;
      try {
        if (category_id) {
          await this.fetch_news_by_category({ category_id, page });
        } else if (tag_name) {
          await this.fetch_news_by_tag({ tag_name, page });
        } else {
          await this.fetch_news({ page });
        }
        await this.fetch_tags();
        await this.fetch_categories();
        await this.fetch_recent_news();
        await this.fetch_section_headings();
      } catch (e) {
        this.error = e;
      } finally {
        this.loading = false;
      }
    },
  },
});
