<template>
  <div class="news-single-items wow animate__animated animate__fadeInUp">
    <div
      class="news-bg"
      :style="{ backgroundImage: `url(/${item?.banner_image})` }"
    >
      <!-- show tags as comma-separated list (supports "a,b,c" or array) -->
      <div v-if="tagsArray.length" class="tag-list">
        <span class="tag-item" v-for="(tag, tIndex) in tagsArray" :key="tIndex">
          {{ tag }}
        </span>
      </div>
      <div class="content">
        <h4 class="title">
          <Link :href="`/news/details?slug=${item.slug}`">{{
            item?.title
          }}</Link>
        </h4>
        <div class="author-meta">
          <p class="author-name">
            By: {{ item?.author ? item?.author : "Admin" }}
          </p>
          <p>{{ formatDate(item?.date) }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "NewsSingleItem",
  props: {
    item: Object,
  },
  computed: {
    // normalized tags array for template
    tagsArray() {
      return this.formatTags(this.item?.tags);
    },
  },
  methods: {
    // support both comma-separated string and array
    formatTags(tags) {
      if (!tags) return [];
      if (Array.isArray(tags))
        return tags.map((t) => String(t).trim()).filter(Boolean);
      if (typeof tags === "string")
        return tags
          .split(",")
          .map((t) => t.trim())
          .filter(Boolean);
      return [];
    },
    formatDate(date) {
      if (!date) return "";

      try {
        const dateObj = new Date(date);

        // Get day with suffix (1st, 2nd, 3rd, 4th, etc.)
        const day = dateObj.getDate();
        const dayWithSuffix = this.getDayWithSuffix(day);

        // Get month name
        const months = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];
        const month = months[dateObj.getMonth()];

        // Get full year
        const year = dateObj.getFullYear();

        return `${dayWithSuffix} ${month}, ${year}`;
      } catch (error) {
        console.warn("Invalid date format:", date);
        return date; // Return original if parsing fails
      }
    },

    getDayWithSuffix(day) {
      if (day >= 11 && day <= 13) {
        return day + "th";
      }
      switch (day % 10) {
        case 1:
          return day + "st";
        case 2:
          return day + "nd";
        case 3:
          return day + "rd";
        default:
          return day + "th";
      }
    },
  },
};
</script>

<style scoped>
.tag-list {
  position: absolute;
  top: 16px;
  left: 16px;
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
}
.tag-item {
  background: var(--main-color-one);
  color: #fff;
  padding: 8px 8px;
  border-radius: 4px;
  font-size: 16px;
  line-height: 16px;
}
</style>
