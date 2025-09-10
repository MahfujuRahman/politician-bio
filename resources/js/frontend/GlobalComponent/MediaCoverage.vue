<template>
  <div class="media-section style-01">
    <div class="bg_image">
      <img :src="`/${background_image}`" alt="background image" />
    </div>
    <div class="container">
      <div
        class="video-section style-02 text-center wow animate__animated animate__fadeInUp"
      >
        <a class="video-play style-01 style-05 mfp-iframe" :href="video_url">
          <i class="fas fa-play"></i>
        </a>
      </div>
      <div class="media-wrapper">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-10">
            <div class="section-title">
              <div class="subtitle wow animate__animated animate__fadeInUp">
                <div class="icon">
                  <span class="icon-star"></span>
                  <span class="icon-star"></span>
                  <span class="icon-star"></span>
                </div>
                <p>{{ short_title }}</p>
                <div class="icon">
                  <span class="icon-star"></span>
                  <span class="icon-star"></span>
                  <span class="icon-star"></span>
                </div>
              </div>
              <h2 class="title wow animate__animated animate__fadeInUp">
                {{ title }}
              </h2>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div
            class="col-lg-4 col-md-6"
            v-for="(item, index) in mediaItems"
            :key="index"
          >
            <div class="media-item wow animate__animated animate__fadeInUp">
              <div class="media-thumb">
                <img
                  :src="'/' + item?.thumbnail_image || '/uploads/default.jpg'"
                  :alt="item?.alt || 'media'"
                />
                <div class="media-thumb-video">
                  <a
                    class="video-play style-01 style-05 mfp-iframe"
                    :href="item.video_url || item.videoUrl"
                  >
                    <i class="fas fa-play"></i>
                  </a>
                </div>
              </div>
              <div class="media-content">
                <template v-if="item?.tag">
                  <span
                    class="category badge mr-2"
                    v-for="(tag, idx) in item.tag.split(',').slice(0, 3)"
                    :key="idx"
                  >
                    {{ tag.trim() }}
                  </span>
                </template>
                <h3 class="title">{{ item.title }}</h3>
                <span class="date"
                  ><i class="fas fa-calendar-alt"></i> {{ item.date }}</span
                >
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center mt-4">
          <div class="col-auto">
            <Link class="link_button" href="/pages/media"> See More </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    short_title: {
      type: String,
      default: "Media Coverage",
    },
    title: {
      type: String,
      default: "Stay updated with our latest media coverage.",
    },
    video_url: {
      type: String,
      default: "https://www.youtube.com/watch?v=-ZwQtICNbRc",
    },
    background_image: {
      type: String,
      default: "uploads/default.jpg",
    },

    mediaItems: {
      type: Array,
      default: () => [
        {
          thumbnail_image: "frontend/assets/img/elegant-director.png",
          alt: "elegant",
          video_url: "https://www.youtube.com/watch?v=-ZwQtICNbRc",
          tag: "technology",
          title: "Why are so many Canadian kids unvaccinated COVID-19",
          date: "JAN 14, 2022",
        },
        {
          img: "frontend/assets/img/patriotism.png",
          alt: "patriotism",
          video_url: "https://www.youtube.com/watch?v=-ZwQtICNbRc",
          tag: "technology",
          title: "Thursday’s analyst upgrades and downgrade",
          date: "JAN 14, 2022",
        },
        {
          img: "frontend/assets/img/portrait.png",
          alt: "portrait",
          video_url: "https://www.youtube.com/watch?v=-ZwQtICNbRc",
          tag: "technology",
          title: "Thursday’s analyst upgrades and downgrade",
          date: "JAN 14, 2022",
        },
      ],
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
<style>
.bg_image {
  width: 100%;
  position: absolute;
  z-index: -1;
  height: calc(100% - 158px);
  top: 0;
}
.bg_image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: top center;
}
.link_button {
  background-color: var(--main-color-one);
  color: #fff;
  padding: 12px 24px;
  border-radius: 4px;
  text-align: center;
  display: inline-block;
  transition: background-color 0.3s;
}

.link_button:hover {
  background-color: var(--secondary-color);
  color: #fff;
}
</style>
