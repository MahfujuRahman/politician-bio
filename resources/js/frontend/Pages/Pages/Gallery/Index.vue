<template>

  <Header />
  <!-- Navbar area Start -->
  <template class="d-lg-block">
    <NavbarArea />
  </template>
  <!-- navbar area end -->
  <!-- banner section start here -->
  <common-banner
    :background-image="'/frontend/assets/img/about-bg.png'"
    :heading="'Gallery'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Gallery', url: '/pages/gallery' },
    ]"
    key="gallery"
  />
  <!-- banner section End here -->

  <!-- Photo Gallery Section Start Here -->
  <photo-gallery
    v-if="photo_gallery"
    :photos="photo_gallery"
    :short_title="galleryImagesSection?.short_title"
    :long_title="galleryImagesSection?.long_title"
  />
  <!-- Photo Gallery Section End Here -->

  <!-- See Our Video Section Start Here -->
  <video-gallery
    v-if="video_gallery"
    :videos="video_gallery"
    :short_title="galleryVideoSection?.short_title"
    :long_title="galleryVideoSection?.long_title"
  />
  <!-- See Our Video Section End Here -->

  <!-- News Section Start -->
  <news
    v-if="news"
    :lead_news="news.lead_news"
    :side_news="news.side_news"
    :short_title="galleryNewsSection?.short_title"
    :title="galleryNewsSection?.title"
  />
  <!-- News Section End  -->
</template>

<script>
import Header from "../../../Shared/Header.vue";
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../../CommonComponents/CommonBanner.vue";
import PhotoGallery from "../../../GlobalComponent/PhotoGallery.vue";
import VideoGallery from "../../../GlobalComponent/VideoGallery.vue";
import News from "../../../GlobalComponent/News.vue";
import { store as gallery_store } from "./Store/gallery_store.js";
import { mapActions, mapWritableState } from "pinia";

export default {
  components: {
    NavbarArea,
    CommonBanner,
    PhotoGallery,
    VideoGallery,
    News,
    Header,
  },
  created: function () {
    this.fetchAllGalleryPageData();
  },
  methods: {
    ...mapActions(gallery_store, ["fetchAllGalleryPageData"]),
    get_section_headings_data(section_type) {
      return this.section_headings?.find(
        (section) => section.section_type === section_type
      );
    },
  },
  computed: {
    ...mapWritableState(gallery_store, [
      "photo_gallery",
      "video_gallery",
      "news",
      "section_headings",
    ]),
    galleryImagesSection() {
      return this.get_section_headings_data("gallery_images");
    },
    galleryVideoSection() {
      return this.get_section_headings_data("gallery_video");
    },
    galleryNewsSection() {
      return this.get_section_headings_data("gallery_news");
    },
  },
};
</script>
