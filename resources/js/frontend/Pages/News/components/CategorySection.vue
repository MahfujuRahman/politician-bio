<template>
  <div
    class="widget widget_archive wow animate__animated animate__fadeInRight animate__delay-2s"
  >
    <h3 class="widget-title style-02">category</h3>
    <ul class="categories-list">
      <li v-if="filteredCategories.length === 0">
        <span>No categories available</span>
      </li>
      <li v-for="(cat, idx) in filteredCategories" :key="idx">
        <a href="#" @click.prevent="filterByCategory(cat.id)"
          >{{ cat?.title }} <span>({{ cat?.news_count || 0 }})</span></a
        >
      </li>
    </ul>
  </div>
</template>
<script>
import { mapActions, mapState } from "pinia";
import { store as news_store } from "../Store/news_store.js";

export default {
  name: "CategorySection",
  computed: {
    ...mapState(news_store, ["categories"]),
    // only show categories that have at least one news
    filteredCategories() {
      const list = this.categories || [];
      return list.filter((c) => Number(c.news_count) > 0);
    },
  },
  methods: {
    ...mapActions(news_store, ["filterByCategory"]),
  },
};
</script>

<style scoped>
.categories-list {
  max-height: calc(
    10 * 40px
  ); /* ~10 items at 40px each; adjust if your item height differs */
  overflow-y: auto;
  padding-left: 0;
  margin: 0;
}
.categories-list li {
  list-style: none;
  padding: 6px 0;
}
/* Optional: nicer thin scrollbar for modern browsers */
.categories-list::-webkit-scrollbar {
  width: 5px;
}
.categories-list::-webkit-scrollbar-thumb {
  background: rgba(0, 0, 0, 0.2);
  border-radius: 4px;
}
</style>
