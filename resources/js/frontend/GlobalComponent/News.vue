<template>
  <div class="news-section-start">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-title">
            <div class="subtitle wow animate__animated animate__fadeInUp">
              <div class="icon">
                <span class="icon-star"></span>
                <span class="icon-star"></span>
                <span class="icon-star"></span>
              </div>
              <p>{{ short_title }}</p>
              <div class="icon">
                <span class="icon-star"></span>
                <span class="icon-star"></span>
                <span class="icon-star"></span>
              </div>
            </div>
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ title }}
            </h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <div
              class="col-md-6"
              v-for="(lead_news, index) in lead_news"
              :key="index"
            >
              <div
                class="news-single-items wow animate__animated animate__fadeInUp"
              >
                <div
                  class="news-bg"
                  :style="
                    'background-image: url(/' + lead_news?.banner_image + ');'
                  "
                >
                  <!-- loop tags (supports comma-separated string or array) -->
                  <div class="tag-list" v-if="lead_news?.tags">
                    <span
                      v-for="(tag, tIndex) in formatTags(lead_news?.tags)"
                      :key="tIndex"
                      class="tag-badge"
                    >
                      {{ tag }}
                    </span>
                  </div>
                  <div class="content">
                    <h4 class="title">
                      <a :href="`/news/details?slug=${lead_news?.slug}`">
                        {{ lead_news?.title }}</a
                      >
                    </h4>
                    <div class="author-meta">
                      <p class="author-name">
                        By: {{ lead_news?.author ?? "admin" }}
                      </p>
                      <p>{{ lead_news?.date }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="row">
            <div class="col-md-12">
              <ul
                class="news-single-list wow animate__animated animate__fadeInRight animate__delay-2s"
              >
                <li
                  class="news-single-list-items"
                  v-for="(news, index) in side_news"
                  :key="index"
                >
                  <div class="thumb">
                    <img :src="'/' + news.banner_image" alt="" />
                  </div>
                  <div class="content">
                    <span class="date">{{ formatDate(news.date) }}</span>
                    <h4 class="title">
                      <a :href="`/news/details?slug=${news.slug}`">
                        {{
                          news.title.length > 36
                            ? news.title.slice(0, 36) + "..."
                            : news.title
                        }}
                      </a>
                    </h4>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="text-center mt-4">
            <Link href="/news" class="btn-main-theme"> View All News </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    short_title: {
      type: String,
      default: "Our News",
    },
    title: {
      type: String,
      default: "Latest News & Articles",
    },
    lead_news: {
      type: Array,
      default: () => [
        // Example default data for news-single-items
        {
          title: "Default Lead News 1",
          url: "#",
          author: "Admin",
          date: "2025-08-06",
          bg: "/default-lead-bg1.jpg",
        },
        {
          title: "Default Lead News 2",
          url: "#",
          author: "Editor",
          date: "2025-08-05",
          bg: "/default-lead-bg2.jpg",
        },
      ],
    },
    side_news: {
      type: Array,
      default: () => [
        // Example default data for news-single-list-items
        {
          title: "Default Side News 1",
          url: "#",
          date: "2025-08-06",
          thumb: "/default-side-thumb1.jpg",
        },
        {
          title: "Default Side News 2",
          url: "#",
          date: "2025-08-05",
          thumb: "/default-side-thumb2.jpg",
        },
      ],
    },
  },
  methods: {
    // convert tags into an array (supports "a,b,c" string or array)
    formatTags(tags) {
      if (!tags) return [];
      if (Array.isArray(tags))
        return tags.map((t) => String(t).trim()).filter(Boolean);
      if (typeof tags === "string") {
        return tags
          .split(",")
          .map((t) => t.trim())
          .filter(Boolean);
      }
      return [];
    },
    formatDate(dateStr) {
      if (!dateStr) return "";
      const date = new Date(dateStr);
      if (isNaN(date)) return dateStr;
      const day = date.getDate();
      const daySuffix = (d) => {
        if (d > 3 && d < 21) return "th";
        switch (d % 10) {
          case 1:
            return "st";
          case 2:
            return "nd";
          case 3:
            return "rd";
          default:
            return "th";
        }
      };
      const month = date.toLocaleString("default", { month: "long" });
      const year = date.getFullYear();
      return `${day}${daySuffix(day)} ${month},${year}`;
    },
  },
};
</script>

<style scoped>
.news-section-start {
  padding: 60px 0;
}

.section-title {
  text-align: center;
  margin-bottom: 40px;
}

.subtitle {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
}

.icon {
  margin: 0 5px;
}

.icon-star {
  font-size: 18px;
  color: #f39c12;
}

.title {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 0;
}

.news-single-items {
  margin-bottom: 30px;
}

.news-bg {
  position: relative;
  background-size: cover;
  background-position: center;
  padding: 20px;
  border-radius: 8px;
  color: #fff;
}

/* Tag list container in top-left of the news-bg */
.tag-list {
  position: absolute;
  top: 20px;
  left: 20px;
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
}
.tag-badge {
  background-color: var(--main-color-one, #dd131a);
  padding: 10px 10px;
  border-radius: 3px;
  font-size: 16px;
  line-height: 16px;
  color: #fff;
  white-space: nowrap;
}

.author-meta {
  margin-top: 10px;
  font-size: 14px;
}

.author-name {
  margin-right: 10px;
}

.news-single-list {
  list-style: none;
  padding: 10;
  margin: 0;
}

.news-single-list-items {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
}

.news-single-list-items .thumb {
  margin-right: 10px;
}

.news-single-list-items .content {
  flex: 1;
}

.news-single-list-items .date {
  font-size: 12px;
  color: #999;
  margin-bottom: 5px;
}

.main_color_one {
  background-color: var(--main-color-one);
  border-color: var(--main-color-one);
  color: #fff;
}

/* View All News Button Styling */
.btn-main-theme {
  display: inline-block;
  padding: 12px 30px;
  background-color: var(--main-color-one, #dd131a);
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
  border: 2px solid var(--main-color-one, #dd131a);
}

.btn-main-theme:hover {
  background-color: var(--secondary-color, #0e115a);
  border-color: var(--secondary-color, #0e115a);
  color: #fff;
  text-decoration: none;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}
</style>
