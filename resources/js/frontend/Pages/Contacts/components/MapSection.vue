<template>
  <div class="map-section">
    <div class="container">
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
        <div class="col-lg-12">
          <p>First Address location</p>
          <location-map :location="mapSrc" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LocationMap from "../../../GlobalComponent/LocationMap.vue";
export default {
  name: "MapSection",
  components: {
    LocationMap,
  },
  props: {
    title: {
      type: String,
      default: "Find Us on Google Maps",
    },
    description: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
    mapSrc: {
      type: String,
      default:
        "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d233667.8223908687!2d90.27923710646989!3d23.780887457084543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1588510922243!5m2!1sen!2sbd",
    },
  },
};
</script>

<style scoped>
/* Add your styles here if needed */
</style>
