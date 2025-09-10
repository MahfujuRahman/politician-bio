<template>
  <div class="office-address-section">
    <div class="container">
      <img
        src="frontend/assets/img/shape-05.png"
        class="contact-shape"
        alt=""
      />
      <img
        src="frontend/assets/img/shape-08.png"
        class="contact-shape-02"
        alt=""
      />
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ title }}
            </h4>
            <p class="description wow animate__animated animate__fadeInUp">
              {{ description }}
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div
          class="col-lg-4 col-md-6"
          v-for="(address, idx) in addresses"
          :key="idx"
        >
          <single-testimonial-item-02
            :title="address.title"
            :icon="address.icon"
            flag-img="/frontend/assets/img/flag-shape.png"
            :address="address.address"
            :phone="address.phone_number"
            :email="address.email"
            :delay="address.delay"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SingleTestimonialItem02 from "./SingleTestimonialItem02.vue";
export default {
  name: "OfficeAddressSection",
  components: {
    SingleTestimonialItem02,
  },
  props: {
    title: {
      type: String,
      default: "Have to join with us?",
    },
    description: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
    addresses: {
      type: Array,
      default: () => [],
    },
  },
};
</script>

<style scoped>
/* Add your styles here if needed */
</style>
