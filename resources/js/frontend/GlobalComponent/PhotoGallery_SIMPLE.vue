<template>
  <div class="political-gallery-item style-01">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title style-02 wow animate__animated animate__fadeInUp">
              {{ short_title || "Our Photo Gallery" }}
            </h4>
            <p class="description style-02 wow animate__animated animate__fadeInUp">
              {{
                long_title ||
                "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently."
              }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="testimonial-carousel-seven">
          <div
            class="gallery-single-items"
            v-for="(image, index) in photos && photos.data ? photos.data : []"
            :key="`gallery-${index}-${image.id || index}`"
          >
            <div class="thumb style-01">
              <img :src="'/' + image.image" :alt="image.title || 'Gallery image'" />
              <div class="cart-icon">
                <a class="image-popup" :href="'/' + image.image">
                  <i class="fas fa-plus"></i>
                </a>
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
  props: {
    photos: { type: Object, default: () => ({ data: [] }) },
    short_title: { type: String, default: "Our Photo Gallery" },
    long_title: { type: String, default: "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently." }
  },
  name: "PhotoGallery",
  mounted() {
    if (this.photos && this.photos.data && this.photos.data.length > 0) {
      setTimeout(() => this.initializeCarousel(), 500);
    }
  },
  updated() {
    if (this.photos && this.photos.data && this.photos.data.length > 0) {
      this.destroyCarousel();
      setTimeout(() => this.initializeCarousel(), 300);
    }
  },
  beforeDestroy() {
    this.destroyCarousel();
  },
  methods: {
    initializeCarousel() {
      if (typeof $ === "undefined") return;
      
      const $carousel = $(".testimonial-carousel-seven");
      if (!$carousel.length) return;
      
      // Destroy existing
      if ($carousel.hasClass('owl-loaded')) {
        $carousel.trigger('destroy.owl.carousel').removeClass('owl-loaded owl-drag');
      }
      
      // Initialize with loop
      $carousel.owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        margin: 0,
        nav: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        items: 4,
        responsive: {
          0: { items: 1 },
          768: { items: 2 },
          992: { items: 3 },
          1200: { items: 4 }
        }
      });
      
      // Simple popup - works with loop
      setTimeout(() => {
        $('.image-popup').magnificPopup({
          type: 'image',
          gallery: { enabled: true }
        });
      }, 200);
    },
    
    destroyCarousel() {
      if (typeof $ !== "undefined") {
        const $carousel = $(".testimonial-carousel-seven");
        if ($carousel.hasClass("owl-loaded")) {
          $carousel.trigger("destroy.owl.carousel").removeClass('owl-loaded owl-drag');
        }
        $('.image-popup').magnificPopup('destroy');
      }
    }
  }
};
</script>

<style scoped>
.testimonial-carousel-seven .owl-item { margin: 0 !important; }
.gallery-single-items { width: 100%; }
.gallery-single-items .thumb { width: 100%; }
.gallery-single-items .thumb img { width: 100%; height: 250px; object-fit: cover; }
</style>

<style>
.mfp-img { max-width: 90vw !important; max-height: 90vh !important; }
</style>
