<template>
  <div class="history-timeline-section">
    <img
      src="/frontend/assets/img/shape-10.png"
      class="history-shape-02"
      alt=""
    />
    <img
      src="/frontend/assets/img/Ellipse-01.png"
      class="history-shape-03"
      alt=""
    />
    <img
      src="/frontend/assets/img/Ellipse-02.png"
      class="history-shape-04"
      alt=""
    />
    <img
      src="/frontend/assets/img/Ellipse-03.png"
      class="history-shape-05"
      alt=""
    />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ short_title }}
            </h4>
            <p class="description wow animate__animated animate__fadeInUp">
              {{ long_title }}
            </p>
          </div>
        </div>
      </div>
      <div class="history-item-wrap">
        <HistorySingleItem
          v-for="(item, index) in timelineItems?.data?.data"
          :key="index"
          :item="item"
          :contentClass="
            index % 2 === 0
              ? 'wow animate__animated animate__fadeInLeft'
              : 'wow animate__animated animate__fadeInRight'
          "
          :yearClass="
            index % 2 === 0
              ? 'wow animate__animated animate__fadeInRight'
              : 'wow animate__animated animate__fadeInLeft'
          "
        />
      </div>
    </div>
  </div>
</template>

<script>
import HistorySingleItem from "./HistorySingleItem.vue";

export default {
  name: "HistoryTimeline",
  components: { HistorySingleItem },
  props: {
    short_title: {
      type: String,
      default: "See History Timeline",
    },
    long_title: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
    timelineItems: {
      type: Array,
      required: true,
    },
  },
};
</script>
