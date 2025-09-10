<template>
  <div
    class="about-us-section-area about-bg"
    :class="marginClass"
    :style="{ backgroundImage: `url(${backgroundImage})` }"
  >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-8">
          <div class="about-inner">
            <h1 class="title wow animate__animated animate__fadeInUp">
              {{ heading }}
            </h1>
          </div>
          <div
            class="breadcrumbs wow animate__animated animate__fadeInUp animate__delay-1s"
          >
            <ul>
              <li v-for="(item, idx) in breadcrumbs" :key="idx">
                <Link :href="item.url">{{ item.text }}</Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CommonBanner",
  props: {
    backgroundImage: {
      type: String,
      default: "/frontend/assets/img/about-bg.png",
    },
    heading: {
      type: String,
      required: true,
    },
    breadcrumbs: {
      type: Array,
      required: true,
    },
    marginClass: {
      type: String,
      default: "margin-bottom-120",
    },
  },
  computed: {
    imageUrl() {
      // For dynamic images in Vite
      return new URL(this.backgroundImage, import.meta.url).href;
    },
  },
};
</script>

<style scoped>
.margin-bottom-0{
  margin-bottom: 0px !important;
}
.margin-bottom-80{
  margin-bottom: 80px !important;
}
.margin-bottom-100{
  margin-bottom: 100px !important;
}
</style>
