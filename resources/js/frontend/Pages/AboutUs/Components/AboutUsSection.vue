<template>
  <div class="administration-section">
    <div class="container custom-container">
      <img src="/frontend/assets/img/shape-05.png" class="admin-shape" alt="" />
      <img src="/frontend/assets/img/about-shape.png" class="admin-shape-02" alt="" />
      <div class="about-content">
        <div class="image-section">
          <div class="administration-single-items wow animate__animated animate__fadeInLeft">
            <div class="administrative-bg" :style="{
              backgroundImage:
                'url(' +
                (about_us.image || '/frontend/assets/img/about-bg.png') +
                ')',
            }">
              <div class="btn-wrapper administration">
                <a class="video-popup mfp-iframe" :href="about_us.video_url ||
                  'https://www.youtube.com/watch?v=-ZwQtICNbRc'
                  ">
                  <i class="fas fa-play"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="administration-single-items style-01">
          <div class="content">
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ about_us.title }}
            </h4>
            <p class="wow animate__animated animate__fadeInUp">
              <span v-html="about_us.description"></span>
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
          <div class="feedback wow animate__animated animate__fadeInUp justify-between">
            <div class="feedback-single dashed-after" v-for="(item, index) in about_us.facts_figures" :key="index">
              <span>{{ item.number }} {{ item.unit }}</span>
              <p>{{ item.title }}</p>
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
<style scoped>
.about-content {
  position: relative;
}

.image-section {
  float: left;
  width: 28%;
  margin-right: 20px;
}

.about-content::after {
  content: "";
  display: block;
  clear: both;
}

.administration-single-items .administrative-bg {
    background-size: contain;
    background-position: top center;
    min-height: 500px;
}

.administration-single-items.style-01 {
     margin-left: 0px; 
}

@media (max-width: 991px) {
  .image-section {
    float: none;
    width: 100%;
    margin-right: 0;
  }
}

.administrative-bg {
  position: relative;
}

.btn-wrapper.administration {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.administration-single-items .content p {
  text-align: justify;
}

.list-items{
  overflow: hidden;
}
.administration-quotes{
  overflow: hidden;
}

.justify-between{
  justify-content: space-evenly;
}

.dashed-after {
    width: 100%;
}
</style>
