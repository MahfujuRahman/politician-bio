<template>
  <div
    class="testimonial-section-area people-say testimonial-bg-02 home-five"
    :style="{ backgroundImage: `url(${background_image})` }"
  >
    <div class="shapes political-shape">
      <img src="frontend/assets/img/shape-04.png" class="shape-01" alt="" />
      <img src="frontend/assets/img/shape-03.png" class="shape-02" alt="" />
      <div class="shape-03"></div>
      <div class="shape-04"></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-6">
          <div class="testimonial-carousel-area">
            <div class="testimonial-carousel-four">
              <div
                class="people-say-single-item"
                v-for="(item, index) in comments"
                :key="index"
              >
                <img
                  src="frontend/assets/img/quotes.png"
                  class="quotes"
                  alt=""
                />
                <div class="content">
                  <div class="subtitle wow animate__animated animate__fadeInUp">
                    <p>{{ short_title }}</p>
                    <div class="icon">
                      <i class="icon-star"></i>
                      <i class="icon-star"></i>
                      <i class="icon-star"></i>
                    </div>
                  </div>
                  <h4 class="title wow animate__animated animate__fadeInUp">
                    {{ title }}
                  </h4>
                  <p
                    class="description wow animate__animated animate__fadeInUp"
                    v-html="item?.comment"
                  ></p>
                  <div
                    class="author-meta wow animate__animated animate__fadeInUp"
                  >
                    <span class="author-name">{{ item.name }}</span>
                    <span class="line"></span>
                  </div>
                </div>
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
    short_title: {
      type: String,
      default: "Public Comments",
    },
    title: {
      type: String,
      default: "People's Say About us",
    },
    background_image: {
      type: String,
      default: "uploads/default.jpg",
    },
    comments: {
      type: Array,
      default: () => [
        {
          comment:
            "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Occaecat cupidatat non proident,sunt in culpa qui officia deserunt mollit anim id, sint occaecat cupidatat non proident, sunt in culpa qui",
          name: "William Smith 1",
        },
        {
          description:
            "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Occaecat cupidatat non proident,sunt in culpa qui officia deserunt mollit anim id, sint occaecat cupidatat non proident, sunt in culpa qui",
          name: "William Smith 2",
        },
        {
          description:
            "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Occaecat cupidatat non proident,sunt in culpa qui officia deserunt mollit anim id, sint occaecat cupidatat non proident, sunt in culpa qui",
          name: "William Smith 3",
        },
      ],
    },
  },

  mounted() {
    this.initCarousel();
  },
  updated() {
    this.initCarousel();
  },
  methods: {
    initCarousel() {
      // Ensure jQuery and OwlCarousel are loaded
      const $TestimonialCarousel = $(".testimonial-carousel-four");
      if ($TestimonialCarousel.length > 0) {
        // Destroy if already initialized
        if ($TestimonialCarousel.hasClass("owl-loaded")) {
          $TestimonialCarousel
            .trigger("destroy.owl.carousel")
            .removeClass("owl-loaded owl-carousel");
          $TestimonialCarousel.find(".owl-stage-outer").children().unwrap();
        }
        $TestimonialCarousel.owlCarousel({
          loop: true,
          autoplay: true,
          autoplayTimeout: 1000,
          autoplaySpeed: 2500,
          smartSpeed: 2500,
          margin: 30,
          items: 2,
          dots: false,
          nav: true,
          navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>',
          ],
          responsive: {
            0: { items: 1 },
            460: { items: 1 },
            599: { items: 1 },
            768: { items: 1 },
            960: { items: 1 },
            1200: { items: 1 },
          },
        });
      }
    },
  },
};
</script>
