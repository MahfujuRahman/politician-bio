<template>
  <div class="back-to-top">
    <span class="back-top" @click="scrollToTop"
      ><i class="fa fa-angle-up"></i
    ></span>
  </div>
</template>
<script>
export default {
  name: "BackToTop",
  methods: {
    scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    },
  },
};
</script>
