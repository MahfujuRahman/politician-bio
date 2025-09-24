<template>
  <!-- <div class="our-journey-section style-01" > -->
  <div :class="contentPosition === 'middle'
      ? 'our-journey-section style-01'
      : 'our-journey-section'
    ">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="history-slider">
            <div class="history-slider-one">
              <div v-for="item in journeyItems" :key="item.year" class="thumb">
                <div class="journey-bg" :style="{ backgroundImage: `url(/${item.image})` }">
                  <div :class="contentPosition === 'middle'
                      ? 'content style-01'
                      : 'content'
                    ">
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
                v-for="(item, index) in journeyItems" 
                :key="item.year" 
                class="history-year"
                :class="{ 'is-active': currentSlide === index }"
                @click="goToSlide(index)"
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
    return {
      currentSlide: 0,
    };
  },
  mounted() {
    this.$nextTick(() => {
      this.initSliders();
    });
  },
  beforeDestroy() {
    this.destroySliders();
  },
  methods: {
    initSliders() {
      const $sliderOne = $(".history-slider-one");

      this.destroySliders();

      setTimeout(() => {
        // Initialize only the main content slider
        $sliderOne.slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          fade: true,
          appendArrows: $(".slick-slider-controls .slick-nav"),
          prevArrow: '<span class="slick-prev"><i class="fas fa-chevron-left"></i></span>',
          nextArrow: '<span class="slick-next"><i class="fas fa-chevron-right"></i></span>',
        });

        // When main slider changes (arrows), update current slide
        $sliderOne.on('afterChange', (event, slick, currentSlide) => {
          this.currentSlide = currentSlide;
        });

        // Set initial state
        this.currentSlide = 0;
        
      }, 150);
    },

    destroySliders() {
      const $sliderOne = $(".history-slider-one");

      if ($sliderOne.hasClass("slick-initialized")) {
        $sliderOne.slick("unslick");
      }
    },
    
    goToSlide(index) {
      const $sliderOne = $(".history-slider-one");
      
      this.currentSlide = index;
      $sliderOne.slick('slickGoTo', index);
    }
  },
};
</script>

<style scoped>
/* Active year styling - use the original design's active class selector */
.history-year.is-active h3 {
  color: var(--main-color-one) !important;
}

/* Make years clickable */
.history-year {
  cursor: pointer;
      width: 155px;
}

/* Restore original horizontal layout for year navigation */
.history-slider-two.history-number {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 0px;
  position: relative;
  left: 20px;
  bottom: 50px;
}

/* Individual year styling to match original */
.history-slider-two .history-year {
  position: relative;
  margin-right: 30px;
}

/* Keep the original border styling */
.history-slider-two .history-year::after {
  content: "";
  position: absolute;
  left: -14px;
  top: 10px;
  width: 100%;
  height: 40px;
  border-right: 3px solid rgba(255, 255, 255, 0.8);
}

/* Match original text styling */
.history-slider-two .history-year h3 {
  color: #FFF9FC;
  font-size: 20px;
  line-height: 28px;
  font-family: var(--body-font);
  font-weight: 400;
  margin-left: 10px;
  margin-bottom: 0;
}

/* Responsive behavior */
@media (max-width: 768px) {
  .history-slider-two .history-year {
    margin-right: 15px;
  }
  .history-slider-two .history-year h3 {
    font-size: 16px;
  }
}

@media (max-width: 480px) {
  .history-slider-two .history-year {
    margin-right: 10px;
  }
  .history-slider-two .history-year h3 {
    font-size: 14px;
  }
}
</style>
