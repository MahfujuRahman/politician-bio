<template>
  <div
    class="widget widget_tag_cloud wow animate__animated animate__fadeInRight animate__delay-3s"
  >
    <h2 class="widget-title style-02">Tags</h2>
    <div class="tagcloud">
      <!-- Show all tags button if currently filtered -->
      <a
        v-if="currentFilter.type === 'tag'"
        @click="clearFilter"
        class="tag-all"
        style="cursor: pointer; background-color: #f0f0f0; margin-right: 5px"
      >
        All News
      </a>
      <!-- Display dynamic tags from store -->
      <a
        v-for="(tag, idx) in tags"
        :key="idx"
        @click="handleTagClick(tag)"
        :class="{
          active:
            currentFilter.type === 'tag' && currentFilter.tag_name === tag,
        }"
        style="cursor: pointer"
      >
        {{ tag }}
      </a>
    </div>
  </div>
</template>
<script>
import { mapState, mapActions } from "pinia";
import { store as news_store } from "../Store/news_store.js";

export default {
  name: "TagsSection",
  computed: {
    ...mapState(news_store, ["tags", "currentFilter"]),
  },
  watch: {
    currentFilter: {
      handler(newFilter) {
        console.log("Filter changed in TagsSection:", newFilter);
      },
      deep: true,
      immediate: true,
    },
  },
  methods: {
    ...mapActions(news_store, ["filterByTag", "clearFilter"]),
    handleTagClick(tag) {
      console.log("Tag clicked:", tag, "Current filter:", this.currentFilter);
      this.filterByTag(tag);
    },
  },
};
</script>

<style scoped>
/* Show up to ~10 tags vertically, then allow scrolling */
.tagcloud {
  max-height: calc(10 * 36px); /* ~20 tags at 36px each */
  overflow-y: auto;
  padding: 8px;
  display: block;
}

/* Stack tags vertically so the max-height corresponds to number of tags shown */
.tagcloud a {
  display: inline-block;
  padding: 6px 10px;
  margin: 4px 4px 4px 0px;
  border-radius: 4px;
  color: inherit;
  text-decoration: none;
}

.tagcloud a.active {
  background-color: var(--main-color-one);
  color: white;
}
.tagcloud a:hover {
  background-color: var(--main-color-one);
  color: white;
}

/* Optional: thin scrollbar */
.tagcloud::-webkit-scrollbar {
  width: 8px;
}
.tagcloud::-webkit-scrollbar-thumb {
  background: rgba(0, 0, 0, 0.15);
  border-radius: 4px;
}
</style>
