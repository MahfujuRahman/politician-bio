<template>
  <div
    class="services-single-section style-01"
    :style="{
      marginTop: serviceMarginTop,
      marginBottom: serviceMarginBottom,
    }"
  >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ sectionTitle }}
            </h4>
            <p class="description wow animate__animated animate__fadeInUp">
              {{ sectionDescription }}
            </p>
          </div>
        </div>
      </div>
      <div class="row d-flex gy-4 gx-4">
        <div
          v-for="(item, idx) in processedServiceItems"
          :key="idx"
          class="col-lg-4 col-md-6 d-flex my-3"
        >
          <div class="services-single-item style-01 w-100 d-flex flex-column">
            <div class="icon style-01">
              <i :class="item.icon"></i>
            </div>
            <div class="content flex-grow-1">
              <h4 class="title">
                <a :href="item.url">{{ item.title }}</a>
              </h4>
              <p class="description">
                {{
                  item.description.length > 150
                    ? item.description.substring(0, 150) + "..."
                    : item.description
                }}
              </p>
            </div>
            <div class="btn-wrapper mt-auto">
              <Link :href="item.url" class="boxed-btn event-btn"
                ><i class="fas fa-arrow-right"></i>Read More</Link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
  components: {
    Link,
  },
  props: {
    sectionTitle: {
      type: String,
      default: "Our Services",
    },
    sectionDescription: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
    serviceMarginTop: {
      type: String,
      default: "0px",
    },
    serviceMarginBottom: {
      type: String,
      default: "30px",
    },
    serviceItems: {
      type: Array,
      required: true,
    },
  },
  computed: {
    processedServiceItems() {
      return this.serviceItems.map((item) => ({
        ...item,
        description:
          item.description &&
          (() => {
            const txt = document.createElement("textarea");
            txt.innerHTML = item.description.replace(/<[^>]*>/g, "");
            return txt.value;
          })(),
        icon: item.icon || "icon-school",
        url: item.url || `/pages/services/details?slug=${item.slug}`,
      }));
    },
  },
};
</script>

<style scoped>
/* Ensure equal height cards in Bootstrap grid */
.services-single-item {
  min-height: 100%;
  height: 100%;
}

/* Make columns equal height */
.row.d-flex {
  display: flex;
  flex-wrap: wrap;
}

.col-lg-4.d-flex,
.col-md-6.d-flex {
  display: flex;
}

/* Remove default margin since we're using Bootstrap gap */
.services-single-item {
  margin-bottom: 0;
}

/* Add some internal spacing for better content distribution */
.services-single-item .icon {
  margin-bottom: 20px;
}

.services-single-item .content {
  margin-bottom: 20px;
}

/* Responsive gap adjustments */
/* @media (max-width: 991.98px) {
  .row.d-flex {
    gap: 1.5rem !important;
  }
} */

@media (max-width: 767.98px) {
  /* .row.d-flex {
    gap: 1rem !important;
  } */
}
</style>
