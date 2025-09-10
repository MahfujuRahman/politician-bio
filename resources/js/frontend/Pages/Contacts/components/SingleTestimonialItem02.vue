<template>
  <div
    class="single-testimonial-item-02 wow animate__animated animate__fadeInUp"
    :class="delay"
  >
    <img :src="flagImg" class="shape-01 style-01" alt="" />
    <div class="icon style-01">
      <i :class="icon"></i>
    </div>
    <div class="content">
      <h4 class="title">{{ title }}</h4>
      <ul class="contact-info-list-02">
        <li class="single-info-item">
          <div class="icon"><i class="icon-location"></i></div>
          <div class="details">{{ address }}</div>
        </li>
        <li class="single-info-item">
          <div class="icon"><i class="icon-phone"></i></div>
          <div class="details">{{ phone }}</div>
        </li>
        <li class="single-info-item">
          <div class="icon"><i class="icon-envelope"></i></div>
          <div class="details">{{ email }}</div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleTestimonialItem02",
  props: {
    title: String,
    icon: String,
    flagImg: String,
    address: String,
    phone: String,
    email: String,
    delay: {
      type: String,
      default: "",
    },
  },
};
</script>

<style scoped>
/* Add your styles here if needed */
</style>
