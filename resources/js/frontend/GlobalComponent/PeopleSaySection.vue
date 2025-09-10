<template>
  <div
    class="people-say-section people-say-bg"
    :style="{
      backgroundImage: `url(${
        background_image
          ? `/${background_image}`
          : '/frontend/assets/img/group-activity-02.png'
      })`,
    }"
  >
    <div class="shapes">
      <img src="/frontend/assets/img/shape-04.png" class="shape-01" alt="" />
      <img src="/frontend/assets/img/shape-03.png" class="shape-02" alt="" />
      <div class="shape-03"></div>
      <div class="shape-04"></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div
            class="people-say-single-item-02 margin-bottom-60 wow animate__animated animate__fadeInLeft"
          >
            <div class="testimonial-carousel-four">
              <div
                class="people-say-single-item style-01"
                style="background-image: url(/frontend/assets/img/line-03.png)"
                v-for="(item, index) in comments"
                :key="`comment-${index}`"
              >
                <img
                  src="/frontend/assets/img/quotes-02.png"
                  class="quotes style-02"
                  alt=""
                />
                <div class="content">
                  <div class="subtitle">
                    <p>{{ short_title || "People Say" }}</p>
                    <div class="icon">
                      <i class="icon-star"></i>
                      <i class="icon-star"></i>
                      <i class="icon-star"></i>
                    </div>
                  </div>
                  <h4 class="title">
                    {{ long_title || "What People Say About Us" }}
                  </h4>
                  <p
                    class="description"
                    v-html="item?.comment || item?.description"
                  ></p>
                  <div class="author-meta">
                    <div class="thumb">
                      <img
                        :src="
                          item?.thumb ? `/${item.thumb}` : '/uploads/avatar.jpg'
                        "
                        alt=""
                      />
                    </div>
                    <span class="author-name">{{ item?.name }}</span>
                    <span class="line"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div
            class="people-say-single-item-02 style-01 wow animate__animated animate__fadeInRight"
          >
            <div
              class="people-say-bg-02"
              :style="{
                backgroundImage: `url(${
                  primary_image
                    ? `/${primary_image}`
                    : '/frontend/assets/img/young-man-with-flag.png'
                })`,
              }"
            ></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "PeopleSaySection",
  props: {
    short_title: {
      type: String,
      default: "People's Say",
    },
    long_title: {
      type: String,
      default: "What People Say About Us",
    },
    primary_image: {
      type: String,
      default: 'frontend/assets/img/young-man-with-flag.png',
    },
    background_image: {
      type: String,
      default: "frontend/assets/img/group-activity-02.png",
    },
    comments: {
      type: Array,
      default: () => [
        {
          comment:
            "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Occaecat cupidatat non proident,sunt in culpa qui officia deserunt mollit anim id, sint occaecat cupidatat non proident, sunt in culpa qui",
          name: "William Smith 1",
        },
        {
          description:
            "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Occaecat cupidatat non proident,sunt in culpa qui officia deserunt mollit anim id, sint occaecat cupidatat non proident, sunt in culpa qui",
          name: "William Smith 2",
        },
        {
          description:
            "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Occaecat cupidatat non proident,sunt in culpa qui officia deserunt mollit anim id, sint occaecat cupidatat non proident, sunt in culpa qui",
          name: "William Smith 3",
        },
      ],
    },
  },
  created: function () {
    console.log("PeopleSaySection created with comments:", this.comments);
    console.log("Props received:", {
      short_title: this.short_title,
      long_title: this.long_title,
      primary_image: this.primary_image,
      background_image: this.background_image,
    });
  },
  mounted() {
    console.log("PeopleSaySection mounted");
    // Wait for DOM to be fully rendered
    this.$nextTick(() => {
      setTimeout(() => {
        this.initTestimonialCarousel();
      }, 500); // Increased timeout for better reliability
    });
  },
  updated() {
    console.log("PeopleSaySection updated");
    // Reinitialize carousel when component updates
    this.$nextTick(() => {
      setTimeout(() => {
        this.initTestimonialCarousel();
      }, 300);
    });
  },
  activated() {
    console.log("PeopleSaySection activated");
    // For keep-alive components
    this.$nextTick(() => {
      setTimeout(() => {
        this.initTestimonialCarousel();
      }, 200);
    });
  },
  beforeUnmount() {
    console.log("PeopleSaySection beforeUnmount - destroying carousel");
    this.destroyCarousel();
  },
  unmounted() {
    console.log("PeopleSaySection unmounted");
  },
  beforeDestroy() {
    console.log("PeopleSaySection beforeDestroy - destroying carousel");
    this.destroyCarousel();
  },
  destroyed() {
    console.log("PeopleSaySection destroyed");
  },
  deactivated() {
    console.log("PeopleSaySection deactivated");
    this.destroyCarousel();
  },
  watch: {
    comments: {
      handler(newComments, oldComments) {
        console.log("Comments changed:", {
          new: newComments?.length || 0,
          old: oldComments?.length || 0,
        });

        if (newComments && newComments.length > 0) {
          // Wait for DOM to update with new comments
          this.$nextTick(() => {
            setTimeout(() => {
              this.initTestimonialCarousel();
            }, 300);
          });
        }
      },
      immediate: false, // Don't trigger on initial load, let mounted handle it
    },

    // Watch for prop changes that might affect the carousel
    short_title() {
      this.$nextTick(() => {
        setTimeout(() => {
          this.initTestimonialCarousel();
        }, 200);
      });
    },

    long_title() {
      this.$nextTick(() => {
        setTimeout(() => {
          this.initTestimonialCarousel();
        }, 200);
      });
    },
  },
  methods: {
    destroyCarousel() {
      try {
        if (typeof window !== "undefined" && window.$) {
          const $carousel = window.$(".testimonial-carousel-four");
          if ($carousel.length > 0 && $carousel.hasClass("owl-loaded")) {
            console.log("Destroying existing carousel");
            $carousel.trigger("destroy.owl.carousel");
            $carousel.removeClass("owl-loaded owl-drag");
          }
        }
      } catch (error) {
        console.log("Error destroying carousel:", error);
      }
    },

    initTestimonialCarousel() {
      console.log("Attempting to initialize carousel...");

      // Check if we're in browser environment
      if (typeof window === "undefined") {
        console.log("Not in browser environment");
        return;
      }

      // Check if jQuery is available
      if (!window.$) {
        console.log("jQuery not available");
        return;
      }

      // Wait a bit more to ensure DOM is ready
      setTimeout(() => {
        const $carousel = window.$(".testimonial-carousel-four");
        console.log("Carousel elements found:", $carousel.length);

        if ($carousel.length === 0) {
          console.log("No carousel elements found");
          return;
        }

        // Destroy existing carousel if it exists
        this.destroyCarousel();

        // Check if owlCarousel function is available
        if (typeof $carousel.owlCarousel !== "function") {
          console.log("owlCarousel function not available");
          return;
        }

        try {
          console.log("Initializing OwlCarousel...");
          $carousel.owlCarousel({
            loop: this.comments && this.comments.length > 1, // Only loop if more than 1 item
            autoplay: this.comments && this.comments.length > 1,
            autoplayTimeout: 4000,
            autoplaySpeed: 1000,
            smartSpeed: 1000,
            margin: 30,
            items: 1,
            dots: false,
            nav: true,
            navText: [
              '<i class="fa fa-angle-left"></i>',
              '<i class="fa fa-angle-right"></i>',
            ],
            responsive: {
              0: { items: 1 },
              460: { items: 1 },
              599: { items: 1 },
              768: { items: 1 },
              960: { items: 1 },
              1200: { items: 1 },
            },
            onInitialized: function () {
              console.log("OwlCarousel initialized successfully");
            },
            onChanged: function () {
              console.log("OwlCarousel slide changed");
            },
          });
        } catch (error) {
          console.log("Error initializing carousel:", error);
        }
      }, 100); // Additional small delay
    },
  },
};
</script>
<style scoped></style>
