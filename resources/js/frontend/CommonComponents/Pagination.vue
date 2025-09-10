<template>
  <div :class="['blog-pagination', shapeClass]">
    <div :class="['blog-pagination', marginClass, shapeClass]">
      <ul>
        <li><span @click="$emit('prev')">PREV</span></li>
        <li v-for="page in pages" :key="page">
          <span v-if="page === '...'" class="page-numbers dots">...</span>
          <a
            v-else
            class="page-numbers"
            :class="{ current: page === currentPage }"
            href="#"
            @click.prevent="$emit('change', page)"
            >{{ page < 10 ? "0" + page : page }}</a
          >
        </li>
        <li>
          <span class="next page-numbers" @click="$emit('next')">NEXT</span>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "Pagination",
  props: {
    currentPage: {
      type: Number,
      default: 1,
    },
    totalPages: {
      type: Number,
      default: 1,
    },
    shape: {
      type: String,
      default: "circle", // 'squer' or 'circle'
      validator: (v) => ["squer", "circle"].includes(v),
    },
  },
  computed: {
    pages() {
      const total = this.totalPages;
      const current = this.currentPage;
      const windowSize = 1; // pages before/after current
      const pages = [];
      if (total <= 7) {
        for (let i = 1; i <= total; i++) pages.push(i);
      } else {
        pages.push(1);
        let start = Math.max(2, current - windowSize);
        let end = Math.min(total - 1, current + windowSize);
        if (start > 2) pages.push("...");
        for (let i = start; i <= end; i++) pages.push(i);
        if (end < total - 1) pages.push("...");
        pages.push(total);
      }
      return pages;
    },
    shapeClass() {
      return this.shape === "squer" ? "style-01" : "";
    },
    marginClass() {
      return "margin-top-30";
    },
  },
};
</script>
<style scoped>
/* Add any custom styles if needed */
</style>
