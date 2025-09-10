<template>
  <!-- <div class="our-journey-section style-01" > -->
  <div
    :class="
      contentPosition === 'middle'
        ? 'our-journey-section style-01'
        : 'our-journey-section'
    "
  >
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="history-slider">
            <div class="history-slider-one">
              <div v-for="item in journeyItems" :key="item.year" class="thumb">
                <div
                  class="journey-bg"
                  :style="{ backgroundImage: `url(/${item.image})` }"
                >
                  <div
                    :class="
                      contentPosition === 'middle'
                        ? 'content style-01'
                        : 'content'
                    "
                  >
                    <h4 class="title">{{ item.title }}</h4>
                    <p>{{ item.short_description }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="slick-slider-controls">
              <div class="slick-nav"></div>
            </div>
            <div class="history-slider-two history-number">
              <div
                v-for="item in journeyItems"
                :key="item.year"
                class="history-year"
              >
                <h3>{{ item.year }}</h3>
                <img src="/frontend/assets/icon/lines.svg" alt="" />
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
      default: "Our Journey",
    },
    long_title: {
      type: String,
      default:
        "From database A choice that makes the difference from others.",
    },
    contentPosition: {
      type: String,
      default: "middle",
    },
    journeyItems: {
      type: Array,
      default: () => [
        {
          image: "frontend/assets/img/Home-five/clining-city.png",
          title: "Clean City Program",
          short_description:
            "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
          year: 2005,
        },
        {
          image: "frontend/assets/img/Home-five/food-donation.png",
          title: "Food Donation Program",
          short_description:
            "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
          year: 2006,
        },
        {
          image: "frontend/assets/img/Home-five/blood-donation.jpg",
          title: "Blood Donation Program",
          short_description:
            "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
          year: 2007,
        },
        {
          image: "frontend/assets/img/Home-five/charity-program.jpg",
          title: "Charity Program",
          short_description:
            "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
          year: 2008,
        },
        {
          image: "frontend/assets/img/Home-five/clild-education.jpg",
          title: "Child Education Program",
          short_description:
            "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
          year: 2009,
        },
        {
          image: "frontend/assets/img/Home-five/profesonal.jpg",
          title: "Professional Training",
          short_description:
            "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
          year: 2010,
        },
        {
          image: "frontend/assets/img/Home-five/save-animal.jpg",
          title: "Save The animal Program",
          short_description:
            "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
          year: 2011,
        },
        // ...add more items as needed...
      ],
    },
  },
  data() {
    return {};
  },
  mounted() {
    this.$nextTick(() => {
      const $sliderOne = $(".history-slider-one");
      const $sliderTwo = $(".history-slider-two");

      if ($sliderOne.length && !$sliderOne.hasClass("slick-initialized")) {
        $sliderOne.slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          fade: true,
          asNavFor: ".history-slider-two",
          appendArrows: $(".slick-slider-controls .slick-nav"),
          prevArrow:
            '<span class="slick-prev"><i class="fas fa-chevron-left"></i></span>',
          nextArrow:
            '<span class="slick-next"><i class="fas fa-chevron-right"></i></span>',
        });
      }

      if ($sliderTwo.length && !$sliderTwo.hasClass("slick-initialized")) {
        $sliderTwo.slick({
          slidesToShow: 6,
          slidesToScroll: 1,
          asNavFor: ".history-slider-one",
          focusOnSelect: true,
          arrows: false,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 2,
              },
            },
          ],
        });
      }
    });
  },
};
</script>
