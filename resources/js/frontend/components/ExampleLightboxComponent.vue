<template>
  <div class="example-gallery">
    <!-- Single Image Lightbox -->
    <div class="single-image-section">
      <h3>Single Image Example</h3>
      <a href="/uploads/image1.jpg" class="my-lightbox">
        <img src="/uploads/image1.jpg" alt="Example Image" />
      </a>
    </div>

    <!-- Gallery Lightbox -->
    <div class="gallery-section">
      <h3>Gallery Example</h3>
      <div class="gallery-grid">
        <a href="/uploads/gallery1.jpg" class="gallery-lightbox">
          <img src="/uploads/gallery1.jpg" alt="Gallery Image 1" />
        </a>
        <a href="/uploads/gallery2.jpg" class="gallery-lightbox">
          <img src="/uploads/gallery2.jpg" alt="Gallery Image 2" />
        </a>
        <a href="/uploads/gallery3.jpg" class="gallery-lightbox">
          <img src="/uploads/gallery3.jpg" alt="Gallery Image 3" />
        </a>
      </div>
    </div>

    <!-- Dynamic Images with v-for -->
    <div class="dynamic-section">
      <h3>Dynamic Images Example</h3>
      <div class="image-list">
        <a
          v-for="(image, index) in images"
          :key="index"
          :href="image.full"
          class="dynamic-lightbox"
        >
          <img :src="image.thumb" :alt="image.alt" />
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import { lightboxMixin } from "@/mixins/lightboxMixin.js";

export default {
  name: "ExampleLightboxComponent",
  mixins: [lightboxMixin],
  data() {
    return {
      images: [
        {
          thumb: "/uploads/thumb1.jpg",
          full: "/uploads/full1.jpg",
          alt: "Image 1",
        },
        {
          thumb: "/uploads/thumb2.jpg",
          full: "/uploads/full2.jpg",
          alt: "Image 2",
        },
        {
          thumb: "/uploads/thumb3.jpg",
          full: "/uploads/full3.jpg",
          alt: "Image 3",
        },
      ],
    };
  },
  mounted() {
    // Single image lightbox
    this.initLightbox(".my-lightbox");

    // Gallery lightbox (with navigation between images)
    this.initGalleryLightbox(".gallery-lightbox");

    // Dynamic images lightbox
    this.initLightbox(".dynamic-lightbox");
  },
  updated() {
    // Re-initialize when component updates (important for dynamic content)
    this.initLightbox(".my-lightbox");
    this.initGalleryLightbox(".gallery-lightbox");
    this.initLightbox(".dynamic-lightbox");
  },
};
</script>

<style scoped>
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 15px;
}

.image-list {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.my-lightbox img,
.gallery-lightbox img,
.dynamic-lightbox img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  cursor: pointer;
  border-radius: 8px;
  transition: transform 0.3s ease;
}

.my-lightbox:hover img,
.gallery-lightbox:hover img,
.dynamic-lightbox:hover img {
  transform: scale(1.05);
}
</style>
