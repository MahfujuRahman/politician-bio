<template>
  <div class="party-member-section-area style-02">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title wow animate__animated animate__fadeInUp text-left">
              {{ title }}
            </h4>
            <p class="wow animate__animated animate__fadeInUp">
              {{ description }}
            </p>
          </div>
        </div>
      </div>
      <!-- {{ speakers }} -->
      <div class="row">
        <div class="col-lg-12">
          <div
            class="testimonial-carousel political-member"
            ref="speakerCarousel"
          >
            <div
              v-for="(speaker, idx) in speakers"
              :key="idx"
              class="single-party-member-item wow animate__animated animate__fadeInUp"
              :class="{ [`animate__delay-${idx}s`]: idx > 0 }"
            >
              <!-- {{ speaker }} -->
              <div class="thumb">
                <img :src="`/${speaker?.image}`" :alt="speaker?.name" />
              </div>
              <div class="content">
                <div class="author-meta">
                  <span class="author-name">{{ speaker?.name }}</span>
                  <p class="designation">{{ speaker?.designation }}</p>
                </div>
                <div class="social-links">
                  <ul>
                    <li
                      v-for="(item, lidx) in speaker?.social_link"
                      :key="lidx"
                    >
                      <a :href="item.link" target="_blank"
                        ><i :class="item.icon"></i
                      ></a>
                    </li>
                  </ul>
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
  name: "SpeakerSlider",
  props: {
    speakers: {
      type: Array,
      required: true,
    },
    title: {
      type: String,
      default: "Legend Speakers",
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
    };
  },

  methods: {
    initOwlCarousel() {
      this.destroyOwlCarousel();

      this.$nextTick(() => {
        if (this.$refs.speakerCarousel && window.jQuery) {
          try {
            this.owlCarousel = window
              .jQuery(this.$refs.speakerCarousel)
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
                  1200: { items: 3 },
                  1920: { items: 3 },
                },
              });
          } catch (error) {
            console.warn("Owl Carousel initialization failed:", error);
          }
        }
      });
    },

    destroyOwlCarousel() {
      if (this.owlCarousel && this.$refs.speakerCarousel && window.jQuery) {
        try {
          window
            .jQuery(this.$refs.speakerCarousel)
            .trigger("destroy.owl.carousel");
          window
            .jQuery(this.$refs.speakerCarousel)
            .removeClass("owl-carousel owl-loaded");
          window
            .jQuery(this.$refs.speakerCarousel)
            .find(".owl-stage-outer")
            .children()
            .unwrap();
        } catch (error) {
          console.warn("Owl Carousel destruction failed:", error);
        }
      }
      this.owlCarousel = null;
    },

    reinitializeCarousel() {
      this.initOwlCarousel();
    },
  },

  created() {
    if (!this.speakers || !Array.isArray(this.speakers)) {
      console.error("Speakers prop must be an array.", this.speakers);
    }
  },

  mounted() {
    this.reinitializeCarousel();
  },

  updated() {
    this.reinitializeCarousel();
  },

  activated() {
    // For keep-alive components
    this.reinitializeCarousel();
  },

  beforeUnmount() {
    this.destroyOwlCarousel();
  },

  beforeDestroy() {
    // For Vue 2 compatibility
    this.destroyOwlCarousel();
  },

  watch: {
    speakers: {
      handler() {
        // Reinitialize when speakers data changes
        this.$nextTick(() => {
          this.reinitializeCarousel();
        });
      },
      deep: true,
    },
  },
};
</script>
