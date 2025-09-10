<template>
  <div class="accoridion-section">
    <div class="container">
      <img src="/frontend/assets/img/shape-06.png" class="shape" alt="" />
      <img src="/frontend/assets/img/Ellipse-01.png" class="shape-01" alt="" />
      <img src="/frontend/assets/img/Ellipse-02.png" class="shape-02" alt="" />
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10">
          <div class="section-title">
            <h2 class="title wow animate__animated animate__fadeInUp">
              {{ short_title }}
            </h2>
            <p class="description wow animate__animated animate__fadeInUp">
              {{ long_title }}
            </p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="accordion-wrapper">
            <div id="accordion">
              <div class="card wow animate__animated animate__fadeInUp">
                <div class="card-header" id="headingOwo">
                  <h5 class="mb-0">
                    <a
                      class="collapsed"
                      role="button"
                      data-toggle="collapse"
                      data-target="#collapseOwo"
                      aria-expanded="false"
                      aria-controls="collapseOwo"
                    >
                      Our Vision?
                    </a>
                  </h5>
                </div>
                <div id="collapseOwo" class="collapse" data-parent="#accordion">
                  <div class="card-body" v-html="mission_vision?.vision?.description"></div>
                </div>
              </div>
              <div
                class="card wow animate__animated animate__fadeInUp animate__delay-1s"
              >
                <div class="card-header" id="headingTwo">
                  <h5 class="mb-0">
                    <a
                      class="collapsed"
                      role="button"
                      data-toggle="collapse"
                      data-target="#collapseTwo"
                      aria-expanded="false"
                      aria-controls="collapseOwo"
                    >
                      Our Mission?
                    </a>
                  </h5>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                  <div class="card-body" v-html="mission_vision?.mission?.description"></div>
                </div>
              </div>
              <div
                class="card wow animate__animated animate__fadeInUp animate__delay-2s"
              >
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <a
                      class="collapsed"
                      role="button"
                      data-toggle="collapse"
                      data-target="#collapseThree"
                      aria-expanded="false"
                      aria-controls="collapseOwo"
                    >
                      Our Future Plan?
                    </a>
                  </h5>
                </div>
                <div
                  id="collapseThree"
                  class="collapse"
                  data-parent="#accordion"
                >
                  <div class="card-body" v-html="mission_vision?.future_plan?.description"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "MissionVision",
  props: {
    short_title: {
      type: String,
      default: "Our Mission & Vision",
    },
    long_title: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
    mission_vision: {
      type: Array,
      required: true,
    },
  },
};
</script>
