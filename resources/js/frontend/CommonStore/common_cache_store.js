// /resources/js/frontend/Store/common_cache_store.js
export const commonCacheStore = {
  _cache: {},
  async isCacheValid(key, cacheKeyPrefix = "global_cache_", maxAge = 600000) {
    let entry = this._cache[key];
    if (!entry && typeof window !== "undefined" && "caches" in window) {
      try {
        const cache = await caches.open(cacheKeyPrefix);
        const match = await cache.match(key);
        if (match) {
          entry = await match.json();
          this._cache[key] = entry;
        }
      } catch (e) {}
    }
    if (!entry) return false;
    const now = Date.now();
    return now - entry.timestamp < maxAge;
  },
  async setCache(key, data, cacheKeyPrefix = "global_cache_") {
    const entry = { data, timestamp: Date.now() };
    this._cache[key] = entry;
    if (typeof window !== "undefined" && "caches" in window) {
      try {
        const cache = await caches.open(cacheKeyPrefix);
        const response = new Response(JSON.stringify(entry), {
          headers: { "Content-Type": "application/json" },
        });
        await cache.put(key, response);
      } catch (e) {}
    }
  },
};
