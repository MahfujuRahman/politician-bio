<template>
  <div class="donation-section-area style-01">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="party-single-item margin-bottom-50">
            <div class="content">
              <div class="subtitle wow animate__animated animate__fadeInUp">
                <p>{{ short_title }}</p>
                <div class="icon">
                  <i class="icon-star"></i>
                  <i class="icon-star"></i>
                  <i class="icon-star"></i>
                </div>
              </div>
              <h4
                class="title style-01 wow animate__animated animate__fadeInUp"
              >
                {{ title }}
              </h4>
              <p
                class="description style-01 wow animate__animated animate__fadeInUp"
              >
                {{ short_description }}
              </p>
            </div>
            <div
              class="btn-wrapper margin-top-35 wow animate__animated animate__fadeInUp"
            >
              <!-- <a href="#" class="price-btn">$25</a>
              <a href="#" class="price-btn">$50</a>
              <a href="#" class="price-btn">$100</a> -->
              <a href="/donation" class="boxed-btn donate-btn btn-sanatory"
                >Donation Now <i class="fas fa-paper-plane"></i
              ></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="thumbnail">
            <img
              :src="side_image ? '/' + side_image : '/frontend/assets/img/Home-five/donation-five.png'"
              alt=""
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    short_title: {
      type: String,
      default: "Contribute For Us",
    },
    title: {
      type: String,
      default: "Make A Donation For Your Country",
    },
    short_description: {
      type: String,
      default: `Every pleasures is to welcomed pain avoided owing to the duty
                the obligations of business it will frequently occur that
                pleasures have to be repudiated.`
    },
    side_image: {
      type: String,
      default: "frontend/assets/img/Home-five/donation-five.png",
    },
  }
};
</script>
