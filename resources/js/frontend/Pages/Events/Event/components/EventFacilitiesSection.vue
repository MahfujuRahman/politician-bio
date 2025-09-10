<template>
  <div
    class="event-facilities-section facility-bg"
    style="background-image: url(/frontend/assets/img/event-single-bg-02.png)"
  >
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5">
          <div class="facility-single-item">
            <div class="content">
              <h4 class="title wow animate__animated animate__fadeInUp">
                {{ sectionTitle || "Event facilities" }}
              </h4>
              <p class="wow animate__animated animate__fadeInUp">
                {{
                  sectionDescription ||
                  "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently."
                }}
              </p>
              <div class="btn-wrapper">
                <a
                  ref="videoPlayButton"
                  class="video-play style-04 mfp-iframe"
                  :href="normalizedVideoUrl"
                  @click.prevent="openVideoPopup"
                >
                  <i class="fas fa-play"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div
          v-for="(facility, index) in facilities?.facility"
          :key="index"
          class="col-lg-2 col-md-4 col-6"
          :class="{ 'offset-lg-1': index === 0 }"
        >
          <div
            class="facility-single-item style-01 wow animate__animated animate__fadeInUp"
            :class="`animate__delay-${index}s`"
          >
            <div class="icon">
              <i :class="facility.icon"></i>
            </div>
            <div class="content">
              <h4 class="title style-01">{{ facility.title }}</h4>
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
    facilities: {
      type: [Object, Array],
      default: () => ({}),
    },
    sectionTitle: {
      type: String,
      default: "Event facilities",
    },
    sectionDescription: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
  },

  name: "EventFacilitiesSection",

  data() {
    return {
      magnificPopup: null,
    };
  },

  computed: {
    normalizedVideoUrl() {
      const videoUrl =
        this.facilities?.video_url ||
        this.facilities?.video_link ||
        "https://www.youtube.com/watch?v=-ZwQtICNbRc";
      return this.normalizeYouTubeUrl(videoUrl);
    },
  },

  mounted() {
    this.initMagnificPopup();
  },

  updated() {
    this.initMagnificPopup();
  },

  activated() {
    // For keep-alive components
    this.initMagnificPopup();
  },

  beforeUnmount() {
    this.destroyMagnificPopup();
  },

  beforeDestroy() {
    // For Vue 2 compatibility
    this.destroyMagnificPopup();
  },

  methods: {
    normalizeYouTubeUrl(url) {
      if (!url) return "https://www.youtube.com/watch?v=-ZwQtICNbRc";

      try {
        // Handle different YouTube URL formats
        const urlObj = new URL(url);

        // Regular YouTube URLs
        if (urlObj.hostname.includes("youtube.com")) {
          const videoId = urlObj.searchParams.get("v");
          if (videoId) {
            return `https://www.youtube.com/watch?v=${videoId}`;
          }
        }

        // YouTube shortened URLs (youtu.be)
        if (urlObj.hostname === "youtu.be") {
          const videoId = urlObj.pathname.slice(1);
          if (videoId) {
            return `https://www.youtube.com/watch?v=${videoId}`;
          }
        }

        // YouTube embed URLs
        if (
          urlObj.hostname.includes("youtube.com") &&
          urlObj.pathname.includes("/embed/")
        ) {
          const videoId = urlObj.pathname.split("/embed/")[1];
          if (videoId) {
            return `https://www.youtube.com/watch?v=${videoId}`;
          }
        }

        // If already a valid format or other video platform, return as is
        return url;
      } catch (error) {
        console.warn("Invalid video URL, using default:", url);
        return "https://www.youtube.com/watch?v=-ZwQtICNbRc";
      }
    },

    initMagnificPopup() {
      // Destroy existing instance first
      this.destroyMagnificPopup();

      // Wait for next tick to ensure DOM is updated
      this.$nextTick(() => {
        if (this.$refs.videoPlayButton && window.$ && window.$.magnificPopup) {
          try {
            this.magnificPopup = window
              .$(this.$refs.videoPlayButton)
              .magnificPopup({
                type: "iframe",
                iframe: {
                  patterns: {
                    youtube: {
                      index: "youtube.com/",
                      id: "v=",
                      src: "https://www.youtube.com/embed/%id%?autoplay=1",
                    },
                    youtu_be: {
                      index: "youtu.be/",
                      id: "/",
                      src: "https://www.youtube.com/embed/%id%?autoplay=1",
                    },
                  },
                },
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                midClick: true,
                removalDelay: 300,
                preloader: false,
                callbacks: {
                  beforeOpen: function () {
                    this.st.iframe.markup = this.st.iframe.markup.replace(
                      "mfp-iframe-scaler",
                      "mfp-iframe-scaler mfp-with-anim"
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
      if (this.magnificPopup && window.$ && window.$.magnificPopup) {
        try {
          window.$.magnificPopup.close();
          if (this.$refs.videoPlayButton) {
            window.$(this.$refs.videoPlayButton).magnificPopup("destroy");
          }
        } catch (error) {
          console.warn("MagnificPopup destruction failed:", error);
        }
      }
      this.magnificPopup = null;
    },

    openVideoPopup(event) {
      event.preventDefault();

      if (this.magnificPopup) {
        // Use existing MagnificPopup instance
        window.$(this.$refs.videoPlayButton).magnificPopup("open");
      } else {
        // Fallback: initialize and open
        this.initMagnificPopup();
        this.$nextTick(() => {
          if (this.magnificPopup) {
            window.$(this.$refs.videoPlayButton).magnificPopup("open");
          } else {
            // Final fallback: open in new window
            window.open(this.normalizedVideoUrl, "_blank");
          }
        });
      }
    },
  },
};
</script>
