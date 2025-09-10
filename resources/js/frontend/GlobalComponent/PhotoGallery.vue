<template>
  <div class="political-gallery-item style-01">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title style-02 wow animate__animated animate__fadeInUp">
              {{ short_title || "Our Photo Gallery" }}
            </h4>
            <p
              class="description style-02 wow animate__animated animate__fadeInUp"
            >
              {{
                long_title ||
                "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently."
              }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="testimonial-carousel-seven">
          <div
            class="gallery-single-items wow animate__ animate__fadeInUp animated"
            style="visibility: visible; animation-name: fadeInUp"
            v-for="(image, index) in photos.data"
            :key="index"
          >
            <div class="thumb style-01">
              <img
                :src="'/' + image.image"
                :alt="image.title || 'Gallery image'"
              />
              <div class="cart-icon">
                <a class="image-popup" :href="'/' + image.image"
                  ><i class="fas fa-plus"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- <div
            class="gallery-single-items wow animate__ animate__fadeInUp animated"
            style="visibility: visible; animation-name: fadeInUp"
          >
            <div class="thumb style-01">
              <img
                src="/frontend/assets/img/photo-gallery-02.png"
                alt="our work image"
              />
              <div class="cart-icon">
                <a
                  class="image-popup"
                  href="/frontend/assets/img/photo-gallery-02.png"
                  ><i class="fas fa-plus"></i
                ></a>
              </div>
            </div>
          </div>
          <div
            class="gallery-single-items wow animate__ animate__fadeInUp animated"
            style="visibility: visible; animation-name: fadeInUp"
          >
            <div class="thumb style-01">
              <img
                src="/frontend/assets/img/photo-gallery-03.png"
                alt="our work image"
              />
              <div class="cart-icon">
                <a
                  class="image-popup"
                  href="/frontend/assets/img/photo-gallery-03.png"
                  ><i class="fas fa-plus"></i
                ></a>
              </div>
            </div>
          </div>
          <div
            class="gallery-single-items wow animate__ animate__fadeInUp animated"
            style="visibility: visible; animation-name: fadeInUp"
          >
            <div class="thumb style-01">
              <img
                src="/frontend/assets/img/photo-gallery-04.png"
                alt="our work image"
              />
              <div class="cart-icon">
                <a
                  class="image-popup"
                  href="/frontend/assets/img/photo-gallery-04.png"
                  ><i class="fas fa-plus"></i
                ></a>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    photos: {
      type: Array,
      default: () => [],
    },
    short_title: {
      type: String,
      default: "Our Photo Gallery",
    },
    long_title: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
  },
  name: "PhotoGallery",
  mounted() {
    this.initializeCarousel();
    this.initializeMagnificPopup();
  },
  updated() {
    this.initializeCarousel();
    this.initializeMagnificPopup();
  },
  activated() {
    // For keep-alive components
    this.$nextTick(() => {
      this.initializeCarousel();
      this.initializeMagnificPopup();
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
          const $TestimonialCarousel = $(".testimonial-carousel-seven");

          if ($TestimonialCarousel.length > 0) {
            // Always destroy existing carousel first
            this.destroyCarousel();

            // Small delay to ensure cleanup is complete
            setTimeout(() => {
              // Initialize new carousel
              $TestimonialCarousel.owlCarousel({
                loop: true,
                autoplay: true,
                autoPlayTimeout: 700,
                margin: 30,
                items: 2,
                center: false,
                dots: false,
                nav: true,
                navText: [
                  '<i class="fa fa-angle-left"></i>',
                  '<i class="fa fa-angle-right"></i>',
                ],
                animateOut: "fadeOut",
                animateIn: "fadeIn",
                responsive: {
                  0: {
                    items: 1,
                  },
                  460: {
                    items: 1,
                  },
                  599: {
                    items: 2,
                  },
                  768: {
                    items: 2,
                  },
                  960: {
                    items: 3,
                  },
                  1200: {
                    items: 4,
                  },
                },
              });
            }, 100);
          }
        }
      });
    },
    initializeMagnificPopup() {
      this.$nextTick(() => {
        if (typeof $ !== "undefined" && $.magnificPopup) {
          // Initialize video popup
          $(".video-play, .video-popup, .small-vide-play-btn").magnificPopup({
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
          });

          // Initialize image popup
          $(".image-popup").magnificPopup({
            type: "image",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            gallery: {
              enabled: true,
              navigateByImgClick: true,
              preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
            },
          });
        }
      });
    },
    destroyCarousel() {
      if (typeof $ !== "undefined") {
        const $TestimonialCarousel = $(".testimonial-carousel-seven");
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
