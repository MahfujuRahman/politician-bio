<template>
  <div class="top-rated-section" v-if="news && news.length > 0">
    <div class="container">
      <div class="row">
        <div class="top-rated-title">
          <h4 class="title wow animate__animated animate__fadeInUp">
            {{ title }}
          </h4>
        </div>
        <div class="testimonial-carousel-six" :class="`carousel-${carouselId}`">
          <div
            v-for="(item, idx) in news"
            :key="idx"
            class="news-single-items wow animate__animated animate__fadeInUp"
            :class="{ [`animate__delay-${idx}s`]: idx > 0 }"
          >
            <div
              class="news-bg"
              :style="{
                backgroundImage: `url(/${
                  item.banner_image ?? 'uploads/default.jpg'
                })`,
              }"
            >
              <span class="even">{{ item.tags }}</span>
              <div class="content">
                <h4 class="title">
                  <Link :href="`/news/details?slug=${item.slug}`">{{
                    item?.title
                  }}</Link>
                </h4>
                <div class="author-meta">
                  <p class="author-name">By:{{ item?.author ?? "Admin" }}</p>
                  <p>{{ formatDate(item.date) }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "NewsSlider",
  props: {
    title: {
      type: String,
      default: "Top Related Post",
    },
    news: {
      type: Array,
      required: true,
      default: () => [],
    },
  },
  data: function () {
    return {
      carouselId: Math.random().toString(36).substr(2, 9),
    };
  },
  mounted() {
    this.initializeCarousel();
  },
  updated() {
    // Reinitialize when component updates
    this.$nextTick(() => {
      this.initializeCarousel();
    });
  },
  beforeUpdate() {
    // Destroy carousel before update to prevent conflicts
    this.destroyCarousel();
  },
  activated() {
    // For keep-alive components
    this.$nextTick(() => {
      this.initializeCarousel();
    });
  },
  watch: {
    news: {
      handler() {
        // Wait for DOM update then reinitialize carousel
        this.$nextTick(() => {
          this.initializeCarousel();
        });
      },
      deep: true,
      immediate: true,
    },
  },
  methods: {
    formatDate(dateString) {
      if (!dateString) return "";

      const date = new Date(dateString);

      // Get day with ordinal suffix
      const day = date.getDate();
      const ordinal = this.getOrdinal(day);

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
      const month = months[date.getMonth()];

      // Get year
      const year = date.getFullYear();

      return `${day}${ordinal} ${month}, ${year}`;
    },
    getOrdinal(n) {
      const s = ["th", "st", "nd", "rd"];
      const v = n % 100;
      return s[(v - 20) % 10] || s[v] || s[0];
    },
    destroyCarousel() {
      const carouselSelector = `.testimonial-carousel-six.carousel-${this.carouselId}`;
      if (window.jQuery && window.jQuery(carouselSelector).length > 0) {
        const $carousel = window.jQuery(carouselSelector);
        if ($carousel.hasClass("owl-loaded")) {
          $carousel.trigger("destroy.owl.carousel");
          $carousel.removeClass("owl-loaded owl-drag");
        }
      }
    },
    initializeCarousel() {
      const carouselSelector = `.testimonial-carousel-six.carousel-${this.carouselId}`;

      // First destroy any existing carousel
      this.destroyCarousel();

      if (
        window.jQuery &&
        window.jQuery(carouselSelector).length > 0 &&
        this.news &&
        this.news.length > 0
      ) {
        // Small delay to ensure DOM is ready
        setTimeout(() => {
          const $carousel = window.jQuery(carouselSelector);

          // Double check it's not already initialized
          if (!$carousel.hasClass("owl-loaded")) {
            // Initialize new carousel
            $carousel.owlCarousel({
              loop: this.news.length > 2, // Only loop if more than 2 items
              autoplay: false,
              autoPlayTimeout: 1500,
              margin: 30,
              dots: false,
              nav: true,
              navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>',
              ],
              animateOut: "fadeOut",
              animateIn: "fadeIn",
              responsive: {
                0: { items: 1 },
                460: { items: 1 },
                599: { items: 1 },
                768: { items: 2 },
                960: { items: 2 },
                1200: { items: 2 },
                1920: { items: 2 },
              },
            });
          }
        }, 150);
      }
    },
  },
};
</script>
