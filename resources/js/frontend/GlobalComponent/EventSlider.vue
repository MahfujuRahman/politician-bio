<template>
  <div class="more-issue-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title style-02 wow animate__animated animate__fadeInUp">
              {{ title }}
            </h4>
            <p
              class="description style-02 wow animate__animated animate__fadeInUp"
            >
              {{ description }}
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="testimonial-carousel-six" ref="eventCarousel">
          <div
            v-for="(event, idx) in events"
            :key="idx"
            class="event-single-items wow animate__animated animate__fadeInUp"
            :class="{ [`animate__delay-${idx}s`]: idx > 0 }"
          >
            <div
              class="event-img"
              :style="{ backgroundImage: `url(/${event?.banner_image})` }"
              @click="openImagePopup(event?.banner_image)"
              style="cursor: pointer"
            ></div>
            <div class="content">
              <div class="post-mate">
                <h2 class="post-date">{{ getDay(event?.date_time) }}</h2>
                <div class="post-month">{{ getMonth(event?.date_time) }}</div>
              </div>
              <div class="subtitle">
                <div class="location">
                  <div class="icon">
                    <i class="icon-location"></i>
                  </div>
                  <p>{{ event?.place_address }}</p>
                </div>
                <div class="time">
                  <div class="icon">
                    <i class="icon-clock"></i>
                  </div>
                  <p>{{ getTime(event?.date_time) }}</p>
                </div>
              </div>
              <h4 class="title">
                <Link :href="`/events/event/details?slug=${event.slug}`">{{
                  event.title
                }}</Link>
              </h4>
              <p class="description">{{ event?.short_description }}</p>
              <div class="btn-wrapper">
                <Link
                  :href="`/events/event/details?slug=${event?.slug}`"
                  class="boxed-btn event-btn"
                  ><i class="fas fa-arrow-right"></i>Read More</Link
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
  name: "EventSlider",
  props: {
    events: {
      type: Array,
      required: true,
    },
    title: {
      type: String,
      default: "More Event Programs",
    },
    description: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
  },
  data() {
    return {
      owlCarousel: null,
      magnificPopup: null,
    };
  },

  methods: {
    getDay(dateTime) {
      if (!dateTime) return "";
      const date = new Date(dateTime);
      return date.getDate().toString().padStart(2, "0");
    },
    getMonth(dateTime) {
      if (!dateTime) return "";
      const date = new Date(dateTime);
      const months = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ];
      return months[date.getMonth()];
    },
    getTime(dateTime) {
      if (!dateTime) return "";
      const date = new Date(dateTime);
      return date.toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
      });
    },

    initOwlCarousel() {
      this.destroyOwlCarousel();

      this.$nextTick(() => {
        if (this.$refs.eventCarousel && window.jQuery) {
          try {
            this.owlCarousel = window
              .jQuery(this.$refs.eventCarousel)
              .owlCarousel({
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
                  1200: { items: 2 },
                  1920: { items: 2 },
                },
              });
          } catch (error) {
            console.warn("Owl Carousel initialization failed:", error);
          }
        }
      });
    },

    destroyOwlCarousel() {
      if (this.owlCarousel && this.$refs.eventCarousel && window.jQuery) {
        try {
          window
            .jQuery(this.$refs.eventCarousel)
            .trigger("destroy.owl.carousel");
          window
            .jQuery(this.$refs.eventCarousel)
            .removeClass("owl-carousel owl-loaded");
          window
            .jQuery(this.$refs.eventCarousel)
            .find(".owl-stage-outer")
            .children()
            .unwrap();
        } catch (error) {
          console.warn("Owl Carousel destruction failed:", error);
        }
      }
      this.owlCarousel = null;
    },

    initMagnificPopup() {
      this.destroyMagnificPopup();

      this.$nextTick(() => {
        if (window.jQuery && window.jQuery.magnificPopup) {
          try {
            // Initialize magnific popup for image gallery
            this.magnificPopup = window.jQuery(".event-img").magnificPopup({
              type: "image",
              closeOnContentClick: true,
              closeBtnInside: false,
              fixedContentPos: true,
              mainClass: "mfp-img-mobile",
              image: {
                verticalFit: true,
              },
              callbacks: {
                beforeOpen: function () {
                  this.st.image.markup = this.st.image.markup.replace(
                    "mfp-figure",
                    "mfp-figure mfp-with-anim"
                  );
                  this.st.mainClass = "mfp-zoom-in";
                },
              },
            });
          } catch (error) {
            console.warn("MagnificPopup initialization failed:", error);
          }
        }
      });
    },

    destroyMagnificPopup() {
      if (this.magnificPopup && window.jQuery && window.jQuery.magnificPopup) {
        try {
          window.jQuery.magnificPopup.close();
          window.jQuery(".event-img").magnificPopup("destroy");
        } catch (error) {
          console.warn("MagnificPopup destruction failed:", error);
        }
      }
      this.magnificPopup = null;
    },

    openImagePopup(imageSrc) {
      if (!imageSrc) return;

      const fullImageSrc = `/${imageSrc}`;

      if (window.jQuery && window.jQuery.magnificPopup) {
        window.jQuery.magnificPopup.open({
          items: {
            src: fullImageSrc,
            type: "image",
          },
          closeOnContentClick: true,
          closeBtnInside: false,
          fixedContentPos: true,
          mainClass: "mfp-img-mobile mfp-zoom-in",
          image: {
            verticalFit: true,
          },
        });
      } else {
        // Fallback: open in new window
        window.open(fullImageSrc, "_blank");
      }
    },

    reinitializeComponents() {
      this.initOwlCarousel();
      this.initMagnificPopup();
    },
  },

  mounted() {
    this.reinitializeComponents();
  },

  updated() {
    this.reinitializeComponents();
  },

  activated() {
    // For keep-alive components
    this.reinitializeComponents();
  },

  beforeUnmount() {
    this.destroyOwlCarousel();
    this.destroyMagnificPopup();
  },

  beforeDestroy() {
    // For Vue 2 compatibility
    this.destroyOwlCarousel();
    this.destroyMagnificPopup();
  },

  watch: {
    events: {
      handler() {
        // Reinitialize when events data changes
        this.$nextTick(() => {
          this.reinitializeComponents();
        });
      },
      deep: true,
    },
  },
};
</script>
