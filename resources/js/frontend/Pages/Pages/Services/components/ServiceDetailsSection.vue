<template>
  <div
    class="trafic-section-area trafic-bg"
    style="background-image: url(/frontend/assets/img/tranfic-bg.png)"
  >
    <!-- <div
      class="trafic-bg-02"
      :style="`background-image: url(/${service?.data?.image || '/uploads/default.jpg'})`"
    ></div> -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 order-2 order-lg-1 section_padding">
          <div class="inner-section-title">
            <h4 class="title">{{ service?.data?.title }}</h4>
          </div>
          <div class="content">
            <div class="description" v-html="service?.data?.description"></div>
          </div>
          <div class="percentage-of-trafic">
            <div
              class="content"
              v-for="(item, index) in service?.data?.statistics"
              :key="index"
            >
              <div class="title">{{ item.title }}</div>
              <div class="progress-content">
                <div class="progress-item">
                  <div class="single-progressbar">
                    <div class="html">
                      <div
                        class="progressbar"
                        style="
                          width: 100%;
                          background-color: transparent;
                          border-radius: 8px;
                        "
                      >
                        <div
                          class="proggress"
                          :style="{
                            backgroundColor: 'var(--main-color-one)',
                            height: '5px',
                            borderRadius: '8px',
                            width: getPercent(item?.percent) + '%',
                          }"
                        ></div>
                        <div
                          class="percentCount"
                          :style="{
                            left: `calc(${getPercent(item?.percent)}% - 20px)`,
                          }"
                        >
                          {{ getPercent(item?.percent) }}%
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 order-1 order-lg-2">
          <div
            class="h-100 service-bg-image"
            :style="`background-image: url(/${
              service?.data?.image || '/uploads/default.jpg'
            })`"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    service: {
      type: Object,
      required: true,
    },
  },
  data: function () {
    return {};
  },
  name: "ServiceSection2",
  methods: {
    getPercent(number) {
      // Convert to number if it's a string
      const num = parseFloat(number);

      // Check if it's a valid number
      if (isNaN(num)) {
        return 0;
      }

      // Ensure it's within 0-100 range
      if (num < 0) {
        return 0;
      }

      if (num > 100) {
        return 100;
      }
      
      return Math.round(num);
    },
  },
};
</script>
<style scoped>
.section_padding {
  padding-top: 109px;
  padding-bottom: 120px;
}

.service-bg-image {
  min-height: 500px;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: left;
}
@media (max-width: 992px) {
  .section_padding {
    padding-top: 60px;
    padding-bottom: 70px;
  }
}
@media (max-width: 768px) {
  .section_padding {
    padding-top: 60px;
    padding-bottom: 70px;
  }
}

@media (max-width: 576px) {
  .section_padding {
    padding-top: 40px;
    padding-bottom: 50px;
  }
}
</style>
