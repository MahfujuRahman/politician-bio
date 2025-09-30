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
    this.$nextTick(() => {
      if (this.photos && this.photos.data && this.photos.data.length > 0) {
        setTimeout(() => this.initializeCarousel(), 1000);
      }
    });
  },
  updated() {
    this.$nextTick(() => {
      if (this.photos && this.photos.data && this.photos.data.length > 0) {
        this.destroyCarousel();
        setTimeout(() => this.initializeCarousel(), 500);
      }
    });
  },
  beforeDestroy() {
    this.destroyCarousel();
  },
  methods: {
    initializeCarousel() {
      this.$nextTick(() => {
        if (typeof $ === "undefined") return;
        
        const $carousel = $(".testimonial-carousel-seven");
        if (!$carousel.length) return;
        
        // Destroy existing
        if ($carousel.hasClass('owl-loaded')) {
          $carousel.trigger('destroy.owl.carousel').removeClass('owl-loaded owl-drag');
        }
        $carousel.removeData('owl.carousel');
        
        setTimeout(() => {
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
              0: { items: 1, margin: 0 },
              768: { items: 2, margin: 0 },
              992: { items: 3, margin: 0 },
              1200: { items: 4, margin: 0 }
            }
          });
          
          // Custom click handler for original images only
          setTimeout(() => {
            const photosData = this.photos && this.photos.data ? this.photos.data : [];
            const originalImages = photosData.map(image => ({
              src: '/' + image.image,
              type: 'image'
            }));
            
            // Remove any existing popup
            $('.testimonial-carousel-seven').off('click.magnificPopup');
            
            // Manual click handler that opens only original 6 images
            $('.testimonial-carousel-seven').on('click.magnificPopup', '.image-popup', function(e) {
              e.preventDefault();
              
              const clickedSrc = $(this).attr('href');
              const startIndex = originalImages.findIndex(img => img.src === clickedSrc);
              
              $.magnificPopup.open({
                items: originalImages,
                gallery: {
                  enabled: true,
                  tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
                },
                type: 'image'
              }, startIndex >= 0 ? startIndex : 0);
            });
          }, 300);
        }, 100);
      });
    },
    
    destroyCarousel() {
      if (typeof $ !== "undefined") {
        try {
          const $carousel = $(".testimonial-carousel-seven");
          if ($carousel.hasClass("owl-loaded")) {
            $carousel.trigger("destroy.owl.carousel").removeClass('owl-loaded owl-drag');
            $carousel.removeData('owl.carousel');
          }
          $('.testimonial-carousel-seven').magnificPopup('destroy');
        } catch (error) {
          console.error('Destroy error:', error);
        }
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
