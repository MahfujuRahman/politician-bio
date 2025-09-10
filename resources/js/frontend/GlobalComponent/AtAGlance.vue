<template>
  <div class="counter-section-area style-01">
    <div class="container">
      <div class="counter-section-inner">
        <img
          src="/frontend/assets/img/party-shape.png"
          class="counter-shape"
          alt="Shape"
        />
        <img
          src="/frontend/assets/img/party-shape.png"
          class="counter-shape-01"
          alt="Shape"
        />
        <img
          src="/frontend/assets/img/party-shape-02.png"
          class="counter-shape-02"
          alt="Shape"
        />
        <img
          src="/frontend/assets/img/party-shape-02.png"
          class="counter-shape-03"
          alt="Shape"
        />
        <div class="row justify-content-center">
          <div
            class="col-lg-3 col-md-6"
            v-for="(item, index) in counters"
            :key="index"
          >
            <div
              :class="[
                'single-counterup-01',
                'style-04',
                index === counters.length - 1 ? 'border-right-0' : '',
              ]"
            >
              <div class="content">
                <div class="count-wrap">
                  <span class="count-num">{{ item.number }}</span
                  >{{ item.unit }}
                </div>
                <h4 class="title px-2">{{ item.title }}</h4>
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-3 col-md-6">
            <div class="single-counterup-01 style-02">
              <div class="content">
                <div class="count-wrap">
                  <span class="count-num">23</span>k+
                </div>
                <h4 class="title">Campaigns</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="single-counterup-01 style-04">
              <div class="content">
                <div class="count-wrap">
                  <span class="count-num">35</span>k+
                </div>
                <h4 class="title">Vote Paper</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="single-counterup-01 style-01">
              <div class="content">
                <div class="count-wrap">
                  <span class="count-num">66</span>k+
                </div>
                <h4 class="title">Coverage Area</h4>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AtAGlance",
  props: {
    counters: {
      type: Array,
      required: true,
    },
  },
};
</script>
