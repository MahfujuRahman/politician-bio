<template>
  <div class="header-bottom-area margin-top-120">
    <div class="container">
      <div class="row">
        <div class="testimonial-carousel">
          <div
            class="single-testimonial-item wow animate__animated animate__fadeInUp"
            v-for="(service, index) in services"
            :key="index"
          >
          <!-- {{ service }} -->
            <img
              src="/frontend/assets/img/flag-shape.png"
              class="shape-01"
              alt=""
            />
            <div class="icon">
              <span :class="service.icon"></span>
            </div>
            <div class="content">
              <h4 class="title">{{ service.title }}</h4>
              <p class="description" v-html="service?.short_title?.slice(0, 150) + (service?.short_title?.length > 150 ? '...' : '')">
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    services: {
      type: Array,
      default: () => [],
    },
  },
  name: "ServiceSlider",
  mounted() {
    this.initializeCarousel();
  },
  updated() {
    this.initializeCarousel();
  },
  activated() {
    // For keep-alive components
    this.$nextTick(() => {
      this.initializeCarousel();
    });
  },
  beforeDestroy() {
    this.destroyCarousel();
  },
  deactivated() {
    // For keep-alive components
    this.destroyCarousel();
  },
  destroyed() {
    this.destroyCarousel();
  },
  beforeUnmount() {
    // Vue 3 compatibility
    this.destroyCarousel();
  },
  unmounted() {
    // Vue 3 compatibility
    this.destroyCarousel();
  },
  methods: {
    initializeCarousel() {
      // Wait for DOM to be ready and ensure jQuery is available
      this.$nextTick(() => {
        if (typeof $ !== "undefined") {
          const $TestimonialCarousel = $(".testimonial-carousel");

          if ($TestimonialCarousel.length > 0) {
            // Always destroy existing carousel first
            this.destroyCarousel();

            // Small delay to ensure cleanup is complete
            setTimeout(() => {
              // Initialize new carousel
              $TestimonialCarousel.owlCarousel({
                loop: true,
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
                  1200: { items: 3 },
                  1920: { items: 3 },
                },
              });
            }, 100);
          }
        }
      });
    },
    destroyCarousel() {
      if (typeof $ !== "undefined") {
        const $TestimonialCarousel = $(".testimonial-carousel");
        if (
          $TestimonialCarousel.length > 0 &&
          $TestimonialCarousel.hasClass("owl-carousel")
        ) {
          $TestimonialCarousel.trigger("destroy.owl.carousel");
          $TestimonialCarousel.removeClass("owl-carousel owl-loaded");
          $TestimonialCarousel.find(".owl-stage-outer").children().unwrap();
        }
      }
    },
  },
};
</script>
<!-- <style scoped>
.owl-carousel .owl-stage-outer {
  height: unset !important;
}
</style> -->
