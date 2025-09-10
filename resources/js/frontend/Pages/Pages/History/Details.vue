<template>

  <Header />
  <!-- Navbar area Start -->
  <template class="d-lg-block">
    <NavbarArea />
  </template>
  <!-- navbar area end -->
  <!-- banner section start here -->
  <common-banner
    :background-image="'/frontend/assets/img/about-bg.png'"
    :heading="'History Details'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'History', url: '/pages/history' },
      { text: 'History Details', url: '/pages/history/details' },
    ]"
    key="history_details"
  />
  <!-- banner section End here -->

  <!-- Issues Details Section Start Here -->
  <div class="issues-details-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="bg-wrapper">
            <div
              class="issue-details-bg"
              style="background-image: url(/frontend/assets/img/judges-bg.png)"
            ></div>
          </div>
          <div class="content">
            <h4 class="title">Criminal Justice</h4>
            <h6 class="subtitle">Description</h6>
            <p class="description">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
              in magna ac tellus fringilla eleifend. Mauris et velit risus.
              Phasellus nisi ipsum, fermentum eget consequat non, molestie at
              augue. Proin rutrum sem a rutrum ultricies. Nunc felis neque,
              dictum ut porta a, ullamcorper vel ante. Quisque non consequat
              ligula. Pellentesque porttitor eu nisi eu bibendum. In non
              faucibus justo, et viverra lectus. Fusce sodales mauris et velit
              accumsan vulputate.
            </p>
            <p class="description">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
              in magna ac tellus fringilla eleifend. Mauris et velit risus.
              Phasellus nisi ipsum, fermentum eget consequat non, molestie at
              augue. Proin rutrum sem a rutrum ultricies.
            </p>
            <p class="description">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
              in magna ac tellus fringilla eleifend. Mauris et velit risus.
              Phasellus nisi ipsum, fermentum eget consequat non, molestie at
              augue. Proin rutrum sem a rutrum ultricies. Nunc felis neque,
              dictum ut porta a, ullamcorper vel ante. Quisque non consequat
              ligula. Pellentesque porttitor eu nisi eu bibendum. In non
              faucibus justo, et viverra lectus. Fusce sodales mauris et velit
              accumsan vulputate.Lorem ipsum dolor sit amet, consectetur
              adipiscing elit. Vivamus in magna ac tellus fringilla eleifend.
              Mauris et velit risus. Phasellus nisi ipsum, fermentum eget
              consequat non, molestie at augue..
            </p>
          </div>
          <!-- <div class="taking-action-issue">
            <div class="subtitle">Taking action on this issue</div>
            <div class="action-single-items">
              <h4 class="title">The Politics of Selecting Decision Makers</h4>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
                in magna ac tellus fringilla eleifend. Mauris et velit risus.
                Phasellus nisi ipsum, fermentum eget consequat non, molestie at
                augue.
              </p>
              <div
                class="action-shape"
                style="background-image: url(/frontend/assets/img/shape-07.png)"
              >
                <p>01</p>
              </div>
            </div>
            <div class="action-single-items">
              <h4 class="title">The Politics of Law Making</h4>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
                in magna ac tellus fringilla eleifend. Mauris et velit risus.
                Phasellus nisi ipsum, fermentum eget consequat non, molestie at
                augue.
              </p>
              <div
                class="action-shape"
                style="background-image: url(/frontend/assets/img/shape-07.png)"
              >
                <p>02</p>
              </div>
            </div>
            <div class="action-single-items">
              <h4 class="title">The Politics of Policing</h4>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
                in magna ac tellus fringilla eleifend. Mauris et velit risus.
                Phasellus nisi ipsum, fermentum eget consequat non, molestie at
                augue.
              </p>
              <div
                class="action-shape"
                style="background-image: url(/frontend/assets/img/shape-07.png)"
              >
                <p>03</p>
              </div>
            </div>
            <div class="action-single-items">
              <h4 class="title">The Politics of Prosecution</h4>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
                in magna ac tellus fringilla eleifend. Mauris et velit risus.
                Phasellus nisi ipsum, fermentum eget consequat non, molestie at
                augue.
              </p>
              <div
                class="action-shape"
                style="background-image: url(/frontend/assets/img/shape-07.png)"
              >
                <p>04</p>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- Issues Details Section End Here -->

  <!-- More Issue Section Start Here -->
  <more-issue-section />
  <!-- <div class="more-issue-section margin-top-120">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title style-02 wow animate__animated animate__fadeInUp">
              Issues Around Us
            </h4>
            <p
              class="description style-02 wow animate__animated animate__fadeInUp"
            >
              Every pleasures is to welcomed pain avoided owing to the duty the
              obligations of business it will frequently.
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="testimonial-carousel-six">
          <div class="issues-single-items style-01">
            <div
              class="issue-img"
              style="
                background-image: url(/frontend/assets/img/modern-building.png);
              "
            >
              <div class="content">
                <h4 class="title">Jobs and Economy</h4>
                <p>
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s
                </p>
              </div>
            </div>
          </div>
          <div class="issues-single-items style-01">
            <div
              class="issue-img"
              style="
                background-image: url(/frontend/assets/img/doctors-check.png);
              "
            >
              <div class="content">
                <h4 class="title">Medcare and Social Security</h4>
                <p>
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <!-- More Issue Section Start Here -->
</template>
<script>
import Header from "../../../Shared/Header.vue";
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../../CommonComponents/CommonBanner.vue";
import MoreIssueSection from "../../../GlobalComponent/MoreIssueSection.vue";

export default {
  components: {
    NavbarArea,
    CommonBanner,
    MoreIssueSection,
    Header,
  },
};
</script>
