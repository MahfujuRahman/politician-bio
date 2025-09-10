<template>
  <div class="why-choose-us-section style-02 choose-bg" :style="mainBgStyle">
    <div :class="bgClass" :style="sideBgStyle"></div>
    <div class="container nav-container z_index_2">
      <div :class="rowClass">
        <div class="col-lg-5">
          <div class="section-title">
            <h4 class="title style-01">{{ short_title }}</h4>
            <p class="description style-01">
              {{ long_title }}
            </p>
          </div>
          <div class="single-items-wrapper">
            <div
              v-for="(item, idx) in whyChooseItems"
              :key="idx"
              class="why-choose-single-items wow animate__animated animate__fadeInUp"
              :class="
                idx === 1
                  ? 'animate__delay-1s'
                  : idx === 2
                  ? 'animate__delay-2s'
                  : ''
              "
            >
              <div class="icon">
                <i :class="item.icon"></i>
              </div>
              <div class="content">
                <h4 class="title">{{ item.title }}</h4>
                <p v-html="item.description.length > 80 ? item.description.substring(0, 80) + '...' : item.description"></p>
              </div>
              <img
                src="frontend/assets/img/setting-shape.png"
                class="shape"
                alt=""
              />
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
      default: "Why chose us",
    },
    long_title: {
      type: String,
      default:
        "A choice that makes the difference from others.",
    },
    position: {
      type: String,
      default: "right",
    },
    mainBg: {
      type: String,
      required: true,
    },
    sideBg: {
      type: String,
      required: true,
    },
    whyChooseItems: {
      type: Array,
      default: () => [
        {
          icon: "icon-tips-bulb",
          title: "Smart Thinking",
          description:
            "Every pleasures is to welcomed pain avoided owing to the dutythe obligations of business",
        },
        {
          icon: "icon-crown",
          title: "Quality Service",
          description:
            "We provide top-notch services that meet the highest standards.",
        },
        {
          icon: "icon-hand-shake",
          title: "Customer Satisfaction",
          description:
            "Our priority is to ensure that our customers are happy and satisfied with our services.",
        },
      ],
    },
  },
  computed: {
    bgClass() {
      return this.position === "left" ? "choose-bg-03" : "choose-bg-02";
    },
    rowClass() {
      return this.position === "left" ? "row justify-content-end" : "row";
    },
    mainBgStyle() {
      return {
        backgroundImage: `url(${this.mainBg})`,
      };
    },
    sideBgStyle() {
      return {
        backgroundImage: `url(${this.sideBg})`,
      };
    },
  },
};
</script>
<style scoped>
.z_index_2 {
  z-index: 2;
  position: relative;
}
</style>
