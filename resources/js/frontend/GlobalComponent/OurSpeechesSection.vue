<template>
  <div class="our-speeches-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ short_title }}
            </h4>
            <p class="description wow animate__animated animate__fadeInUp">
              {{ long_title }}
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div
          class="col-lg-4 col-md-6"
          v-for="(speech, index) in speeches"
          :key="index"
        >
          <div
            class="news-single-items style-01 wow animate__animated animate__fadeInUp"
          >
          <a
                  class="mfp-iframe"
                  :href="
                    speech?.video_url ||
                    'https://www.youtube.com/watch?v=-ZwQtICNbRc'
                  "
                >
                
              <div
                class="news-bg speeches-bg"
                :style="{
                  backgroundImage: `url(/${
                    speech?.thumbnail_image || 'uploads/default.jpg'
                  })`,
                }"
              >
                <div class="tropics">
                  <span class="even">{{ speech?.tag }}</span>
                  <p class="date">{{ formatDate(speech?.date) }}</p>
                </div>
                <div class="content">
                  <h4 class="title">{{ speech?.title }}</h4>
                </div>
                <!-- Audio player control -->
                <div class="audio-player">
                  <div class="controls">
                    <div class="play-container">
                      <div class="toggle-play play"></div>
                    </div>
                    <div class="timeline">
                      <div class="progress"></div>
                    </div>
                    <div class="time">
                      <div class="current">0:00</div>
                      <div class="divider">/</div>
                      <div class="length"></div>
                    </div>
                    <div class="volume-container">
                      <div class="volume-button">
                        <i class="fas fa-volume-up"></i>
                      </div>

                      <div class="volume-slider">
                        <div class="volume-percentage"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Audio player control -->
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "OurSpeechesSection",
  props: {
    short_title: {
      type: String,
      default: "Our Speeches",
    },
    long_title: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
    speeches: {
      type: Array,
      required: true,
    },
  },
  mounted() {
    this.initMagnificPopup();
  },
  updated() {
    this.initMagnificPopup();
  },
  methods: {
    initMagnificPopup() {
      if (window.$ && window.$.fn.magnificPopup) {
        window.$(".mfp-iframe").magnificPopup({
          type: "iframe",
          mainClass: "mfp-fade",
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false,
          iframe: {
            markup:
              '<div class="mfp-iframe-scaler">' +
              '<div class="mfp-close"></div>' +
              '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
              "</div>",
            patterns: {
              youtube: {
                index: "youtube.com/",
                id: function (url) {
                  var m = url.match(/[\?&]v=([^&]+)/);
                  return m ? m[1] : null;
                },
                src: "https://www.youtube.com/embed/%id%?autoplay=1",
              },
              youtu_be: {
                index: "youtu.be/",
                id: function (url) {
                  var m = url.match(/youtu.be\/([^?&]+)/);
                  return m ? m[1] : null;
                },
                src: "https://www.youtube.com/embed/%id%?autoplay=1",
              },
            },
            srcAction: "iframe_src",
          },
        });
      }
    },

    formatDate(dateStr) {
      if (!dateStr) return "";
      const dateObj = new Date(dateStr);
      if (isNaN(dateObj)) return dateStr;
      const day = dateObj.getDate();
      const daySuffix = ((d) => {
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
      })(day);
      const month = dateObj.toLocaleString("default", { month: "long" });
      const year = dateObj.getFullYear();
      return `${day}${daySuffix} ${month}, ${year}`;
    },
  },
};
</script>
