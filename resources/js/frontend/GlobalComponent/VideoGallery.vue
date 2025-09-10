<template>
  <div class="see-our-video-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ short_title || "See Our Video" }}
            </h4>
            <p
              class="description style-03 wow animate__animated animate__fadeInUp"
            >
              {{
                long_title ||
                "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently."
              }}
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="testimonial-carousel-five">
            <template v-for="(video, index) in videos.data" :key="index">
              <div
                class="video-bg"
                :style="`background-image: url(/${video.thumbnail_image});`"
              >
                <div class="btn-wrapper administration">
                  <a
                    class="video-play style-03 mfp-iframe"
                    :href="normalizeYouTubeUrl(video.video_url)"
                  >
                    <i class="fas fa-play"></i>
                  </a>
                </div>
              </div>
            </template>
            <div
              class="video-bg"
              style="
                background-image: url(/frontend/assets/img/celebration.png);
              "
            >
              <div class="btn-wrapper administration">
                <a
                  class="video-play style-03 mfp-iframe"
                  href="https://www.youtube.com/watch?v=-ZwQtICNbRc"
                >
                  <i class="fas fa-play"></i>
                </a>
              </div>
            </div>
            <div
              class="video-bg"
              style="
                background-image: url(/frontend/assets/img/celebration.png);
              "
            >
              <div class="btn-wrapper administration">
                <a
                  class="video-play style-03 mfp-iframe"
                  href="https://www.youtube.com/watch?v=-ZwQtICNbRc"
                >
                  <i class="fas fa-play"></i>
                </a>
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
  props: {
    videos: {
      type: Array,
      default: () => [],
    },
    short_title: {
      type: String,
      default: "See Our Video",
    },
    long_title: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
  },
  name: "VideoGallery",
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
    normalizeYouTubeUrl(url) {
      if (!url) return "";

      // Handle different YouTube URL formats
      let videoId = "";

      // Extract video ID from different YouTube URL formats
      if (url.includes("youtube.com/watch?v=")) {
        // https://www.youtube.com/watch?v=AaAa4pyfY84
        videoId = url.split("v=")[1]?.split("&")[0];
      } else if (url.includes("youtu.be/")) {
        // https://youtu.be/AaAa4pyfY84?si=MTLs8udHxZib6TSV
        videoId = url.split("youtu.be/")[1]?.split("?")[0];
      } else if (url.includes("youtube.com/embed/")) {
        // https://www.youtube.com/embed/AaAa4pyfY84
        videoId = url.split("embed/")[1]?.split("?")[0];
      } else {
        // If it's already a valid URL or different format, return as is
        return url;
      }

      // Return normalized YouTube URL
      return videoId ? `https://www.youtube.com/watch?v=${videoId}` : url;
    },
    initializeCarousel() {
      this.$nextTick(() => {
        if (typeof $ !== "undefined") {
          const $TestimonialCarousel = $(".testimonial-carousel-five");

          if ($TestimonialCarousel.length > 0) {
            // Always destroy existing carousel first
            this.destroyCarousel();

            // Small delay to ensure cleanup is complete
            setTimeout(() => {
              // Initialize new carousel
              $TestimonialCarousel.owlCarousel({
                loop: true,
                autoplay: false,
                autoPlayTimeout: 1000,
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
                  0: { items: 1 },
                  460: { items: 1 },
                  599: { items: 1 },
                  768: { items: 1 },
                  960: { items: 1 },
                  1200: { items: 1 },
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
          });
        }
      });
    },
    destroyCarousel() {
      if (typeof $ !== "undefined") {
        const $TestimonialCarousel = $(".testimonial-carousel-five");
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
