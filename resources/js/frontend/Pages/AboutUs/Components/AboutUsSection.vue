<template>
  <div class="administration-section">
    <div class="container custom-container">
      <img src="/frontend/assets/img/shape-05.png" class="admin-shape" alt="" />
      <img
        src="/frontend/assets/img/about-shape.png"
        class="admin-shape-02"
        alt=""
      />
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10 col-sm-12">
          <div
            class="administration-single-items wow animate__animated animate__fadeInLeft"
          >
            <div
              class="administrative-bg"
              :style="{
                backgroundImage:
                  'url(' +
                  (about_us.image || '/frontend/assets/img/about-bg.png') +
                  ')',
              }"
            >
              <div class="btn-wrapper administration">
                <a
                  class="video-popup mfp-iframe"
                  :href="
                    about_us.video_url ||
                    'https://www.youtube.com/watch?v=-ZwQtICNbRc'
                  "
                >
                  <i class="fas fa-play"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-10 col-sm-12">
          <div class="administration-single-items style-01">
            <div class="content">
              <h4 class="title wow animate__animated animate__fadeInUp">
                {{ about_us.title }}
              </h4>
              <p class="wow animate__animated animate__fadeInUp">
                {{ about_us.description }}
              </p>
            </div>
            <div
              class="administration-quotes wow animate__animated animate__fadeInUp"
            >
              <h5 class="title">
                {{ about_us.quotation }}
              </h5>
              <div class="icon">
                <img src="/frontend/assets/icon/quotes-02.svg" alt="" />
              </div>
            </div>
            <div class="list-items wow animate__animated animate__fadeInUp">
              <ul>
                <li v-for="(item, index) in about_us.features" :key="index">
                  {{ item.title }}
                </li>
              </ul>
            </div>
            <div class="feedback wow animate__animated animate__fadeInUp">
              <div
                class="feedback-single"
                v-for="(item, index) in about_us.facts_figures"
                :key="index"
              >
                <span>{{ item.number }}{{ item.unit }}</span>
                <p>{{ item.title }}</p>
              </div>
              <!-- <div class="feedback-single">
                <span>103</span>
                <p>Board Member of Senatory</p>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "AboutUsSection",
  props: {
    about_us: {
      type: Object,
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
  },
};
</script>
