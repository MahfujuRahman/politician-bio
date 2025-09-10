<template>
  <div>
    <div class="media-item wow animate__animated animate__fadeInUp bg_gray">
      <div class="media-thumb">
        <img
          :src="'/' + thumbnail_image || '/uploads/default.jpg'"
          :alt="alt || 'media'"
        />
        <div class="media-thumb-video">
          <a
            class="video-play style-01 style-05 mfp-iframe"
            :href="video_url || videoUrl"
          >
            <i class="fas fa-play"></i>
          </a>
        </div>
      </div>
      <div class="media-content">
        
          <span
            class="category mr-2"
            v-for="(tagItem, idx) in tagList.slice(0, 2)"
            :key="idx"
          >
            {{ tagItem }}<br v-if="idx < Math.min(tagList.length, 3) - 1" />
          </span>
        <h3 class="title">{{ title }}</h3>
        <span class="date"
          ><i class="fas fa-calendar-alt"></i> {{ formattedDate }}</span
        >
      </div>
    </div>
  </div>
</template>
<script>
import { onMounted } from "vue";

function formatDate(dateStr) {
  if (!dateStr) return "";
  const d = new Date(dateStr);
  if (isNaN(d.getTime())) return dateStr;
  return d.toISOString().slice(0, 10);
}

export default {
  name: "MediaSingleItem",
  props: {
    thumbnail_image: {
      type: String,
      required: true,
      default: "uploads/default.jpg",
    },
    video_url: {
      type: String,
      required: true,
    },
    tag: {
      type: String,
      required: true,
      default: "",
    },
    title: {
      type: String,
      required: true,
    },
    date: {
      type: String,
      required: true,
    },
  },
  computed: {
    formattedDate() {
      return formatDate(this.date);
    },
    tagList() {
      if (Array.isArray(this.tag)) {
        return this.tag;
      }
      if (typeof this.tag === "string") {
        return this.tag
          .split(",")
          .map((t) => t.trim())
          .filter(Boolean);
      }
      return [];
    },
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
  mounted() {
    this.initMagnificPopup();
  },
};
</script>
<style scoped>
.media-item {
  border: 1px solid #eee;
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.3s;
}

.media-item:hover {
  transform: scale(1.05);
}

.media-thumb {
  position: relative;
}

.media-thumb img {
  width: 100%;
  height: auto;
}

.media-thumb-video {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.media-content {
  padding: 16px;
}

.media-content .category {
  font-size: 12px;
  color: #fff;
}

.media-content .title {
  font-size: 16px;
  font-weight: bold;
  margin: 8px 0;
}

.media-content .date {
  font-size: 12px;
  color: #999;
}
</style>
