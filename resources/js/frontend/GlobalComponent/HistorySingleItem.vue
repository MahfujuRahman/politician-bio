<template>
  <div class="history-single-item">
    <span class="circle"></span>
    <div :class="['history-single-item-content', contentClass]">
      <div
        class="thumb"
        :style="{ backgroundImage: `url(/${item.image})` }"
      ></div>
      <div class="content">
        <h4 class="title">{{ item.title }}-{{ item.id }}</h4>
        <p>{{ item.description }}</p>
      </div>
    </div>
    <div :class="['history-year', yearClass]">
      <p class="month">{{ monthName }}</p>
      <h6 class="year">{{ year }}</h6>
    </div>
  </div>
</template>
<script>
export default {
  name: "HistorySingleItem",
  props: {
    item: { type: Object, required: true },
    contentClass: { type: String, default: "" },
    yearClass: { type: String, default: "" },
  },
  created() {
    if (!this.item || !this.item.month_year) {
      console.warn("Invalid item or missing month_year property");
    }
    console.log("HistorySingleItem created with item:", this.item);
    
  },
  computed: {
    monthName() {
      if (!this.item.month_year) return "";
      const date = new Date(this.item.month_year);
      if (isNaN(date)) return "";
      return date.toLocaleString("default", { month: "long" });
    },
    year() {
      if (!this.item.month_year) return "";
      const date = new Date(this.item.month_year);
      if (isNaN(date)) return "";
      return date.getFullYear();
    },
  },
};
</script>
