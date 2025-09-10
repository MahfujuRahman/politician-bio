<template>
  <Head :title="event.title" />

  <Header />
  <!-- Navbar area Start -->
  <template class="d-lg-block">
    <NavbarArea />
  </template>
  <!-- navbar area end -->
  <!-- Donation Content Section Start here -->
  <div
    class="donation-content-section margin-top-20"
    v-if="donation_details?.data"
  >
    <div class="container">
      <!-- breadcrumbs start here -->
      <div class="breadcrumbs style-01">
        <ul>
          <li>
            <Link href="/"><i class="fas fa-home"></i>Home</Link>
          </li>
          <li><Link href="/donation">Donation</Link></li>
          <li>
            <Link href="/donation/details" class="active"
              >Donation Details</Link
            >
          </li>
        </ul>
      </div>
      <!-- breadcrumbs End here -->
      <div class="row">
        <div class="col-lg-12">
          <div class="donation-single-items home-six">
            <div class="bg-wrapper home-six">
              <a
                v-if="donation_details?.data?.banner_image"
                :href="
                  donation_details.data.banner_image.match(/^https?:\/\//)
                    ? donation_details.data.banner_image
                    : '/' +
                      donation_details.data.banner_image.replace(/^\/?/, '')
                "
                class="banner-lightbox"
              >
                <div
                  class="donation-bg"
                  :style="{
                    backgroundImage: donation_details?.data?.banner_image
                      ? `url(${
                          donation_details.data.banner_image.match(
                            /^https?:\/\//
                          )
                            ? donation_details.data.banner_image
                            : '/' +
                              donation_details.data.banner_image.replace(
                                /^\/?/,
                                ''
                              )
                        })`
                      : `url('/frontend/assets/img/home-six/donation-sinlge.png')`,
                  }"
                >
                  <div class="content">
                    <!-- <div class="progress-content">
                    <div class="progress-item">
                      <div class="single-progressbar">
                        <div class="html"></div>
                      </div>
                    </div>
                    <div class="goal">
                      <h4 class="raised">
                        <span>Target</span> ${{
                          donation_details?.data?.target
                        }}
                      </h4>
                      <h4 class="raised">
                        <span>Achived</span> ${{
                          donation_details?.data?.achived
                        }}
                      </h4>
                    </div>
                  </div> -->

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
                                :style="
                                  Object.assign(
                                    {
                                      backgroundColor: 'var(--main-color-one)',
                                      height: '5px',
                                      borderRadius: '8px',
                                    },
                                    percentStyle
                                  )
                                "
                              ></div>
                              <div
                                class="percentCount"
                                :style="percentCountStyle"
                              >
                                {{ percent }}%
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="goal">
                        <h4 class="raised">
                          Raised : {{ donation_details?.data?.achived }}
                          {{ donation_details?.data?.unit ?? "/=" }}
                        </h4>
                        <h4 class="raised">
                          Goal : {{ donation_details?.data?.target }}
                          {{ donation_details?.data?.unit ?? "/=" }}
                        </h4>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <!-- {{ donation_details?.data }} -->
            <div class="content">
              <div class="author-meta">
                <div class="thumb">
                  <template v-if="donation_details?.data?.author_image">
                    <a
                      :href="
                        donation_details.data.author_image.match(/^https?:\/\//)
                          ? donation_details.data.author_image
                          : '/' +
                            donation_details.data.author_image.replace(
                              /^\/?/,
                              ''
                            )
                      "
                      class="banner-lightbox"
                    >
                      <div class="image_container">
                        <img :src="donation_details.data.author_image" alt="" />
                      </div>
                      <span class="author-name">{{
                        donation_details?.data?.author
                      }}</span>
                    </a>
                  </template>
                  <template v-else>
                    <a href="/uploads/avatar.jpg" class="banner-lightbox">
                      <div class="image_container">
                        <img src="/uploads/avatar.jpg" alt="" />
                      </div>
                      <span class="author-name">{{
                        donation_details?.data?.author
                      }}</span>
                    </a>
                  </template>
                </div>
                <div class="date">
                  <i class="icon-calander"></i>
                  <span>{{ formattedDate }}</span>
                </div>
              </div>
              <h4 class="title">
                {{ donation_details?.data?.title }}
              </h4>
              <div
                class="description"
                v-html="donation_details?.data?.content"
              ></div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="volunteer-form style-01">
            <div class="donate-programm">
              <div class="content">
                <h6 class="subtitle">Thanks for Donating on this program</h6>
                <p class="description style-01">Every pleasures is to welcomed pain avoided owing to the duty the
                  obligations of business it will frequently.</p>
                <div class="notice">
                  <div class="icon">
                    <i class="icon-danger"></i>
                  </div>
                  <p><span>Notice:</span> Test mode is enable. While in test mode no live donations are processed</p>
                </div>
                <div class="amount">
                  <div class="btn-wrapper">
                    <span class="price-btn">$25</span>
                    <span class="price-btn">$50</span>
                    <span class="price-btn">$100</span>
                    <span class="price-btn">$200</span>
                  </div>
                  <div class="form-group">
                    <input type="number" name="fname" placeholder="Custom amount" class="form-control" required=""
                      aria-required="true">
                  </div>
                </div>
              </div>
            </div>
            <div class="contact-form style-01">
              <form action="https://themeim.com/demo/senatory/request.html" class="contact-page-form" novalidate="novalidate">
                <h6 class="title">Fill the following information for Donation.</h6>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="fname" placeholder="First Name" class="form-control" required=""
                        aria-required="true">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="lname" placeholder="Last Name" class="form-control" required=""
                        aria-required="true">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="email" class="form-control" placeholder="Email" required="" aria-required="true">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="telephone" placeholder="Phone Number" class="form-control" required=""
                        aria-required="true">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="fname" placeholder="Address line 1" class="form-control" required=""
                        aria-required="true">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="fname" placeholder="Address line 2" class="form-control" required=""
                        aria-required="true">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="fname" placeholder="City" class="form-control" required=""
                        aria-required="true">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="fname" placeholder="State*" class="form-control" required=""
                        aria-required="true">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="form-question">
              <h6 class="title">How would you like to help? </h6>
              <div class="check-box-wrapper">
                <div class="check-box">
                  <label class="container-box">
                    Paypal
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="check-box">
                  <label class="container-box">
                    Offline payment
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="btn-wrapper">
              <a href="#" class="boxed-btn btn-sanatory">Donation Now <span class="icon-paper-plan"></span></a>
            </div>
          </div>
        </div>
        <!-- <div class="col-lg-4">
          <SidebarWidgets />
        </div> -->
      </div>
    </div>
  </div>
  <!-- Donation Content Section Start here -->

  <!-- More Dontion Section Start Here -->
  <more-donation-programs-section />
  <!-- More Donation Section Start Here -->
</template>
<script>
import { Head } from "@inertiajs/vue3";
import { mapActions, mapWritableState } from "pinia";
import Header from "../../Shared/Header.vue";
import NavbarArea from "../../CommonComponents/NavbarArea.vue";
import SidebarWidgets from "./components/SidebarComponentSet/SidebarWidgets.vue";
import MoreDonationProgramsSection from "../../GlobalComponent/MoreDonationProgramsSection.vue";
import { store as donation_details_store } from "./Store/donation_details_store.js";

export default {
  props: {
    event: Object,
  },
  components: {
    NavbarArea,
    SidebarWidgets,
    MoreDonationProgramsSection,
    Header,
  },
  data() {
    return {
      slug: "",
      raised: 0,
      goal: 0,
    };
  },
  created: async function () {
    const params = new URLSearchParams(window.location.search);
    this.slug = params.get("slug") || "";
    console.log("slug from detail created:before condition", this.slug);

    if (this.slug) {
      console.log("slug from detail created:", this.slug);

      await this.fetch_donation_details(this.slug);
      console.log("donation_details after fetch:", this.donation_details);
      this.raised = this.donation_details?.data?.achived || 0;
      this.goal = this.donation_details?.data?.target || 0;
    }
  },
  methods: {
    ...mapActions(donation_details_store, ["fetch_donation_details"]),
  },
  computed: {
    ...mapWritableState(donation_details_store, [
      "donation_details",
      "loading",
    ]),

    percent() {
      // Remove commas and convert to number, handle undefined/null
      const raisedStr = (this.raised || "0").toString();
      const goalStr = (this.goal || "0").toString();
      const raisedNum = parseFloat(raisedStr.replace(/,/g, ""));
      const goalNum = parseFloat(goalStr.replace(/,/g, ""));
      if (!goalNum) return 0;
      return Math.min(100, Math.round((raisedNum / goalNum) * 100));
    },
    percentStyle() {
      return {
        width: this.percent + "%",
      };
    },
    percentCountStyle() {
      return {
        left: `calc(${this.percent}% - 20px)`,
      };
    },

    formattedDate() {
      const dateStr = this.donation_details?.data?.date;
      if (!dateStr) return "";
      const dateObj = new Date(dateStr.replace(/-/g, "/"));
      if (isNaN(dateObj)) return dateStr;
      const day = dateObj.getDate().toString().padStart(2, "0");
      const monthNames = [
        "JAN",
        "FEB",
        "MAR",
        "APR",
        "MAY",
        "JUN",
        "JUL",
        "AUG",
        "SEP",
        "OCT",
        "NOV",
        "DEC",
      ];
      const month = monthNames[dateObj.getMonth()];
      const year = dateObj.getFullYear();
      return `${day} ${month}, ${year}`;
    },
  },
  mounted() {
    this.initBannerLightbox();
  },
  watch: {
    "donation_details.data.banner_image": function () {
      this.$nextTick(() => {
        this.initBannerLightbox();
      });
    },
  },
  methods: {
    ...mapActions(donation_details_store, ["fetch_donation_details"]),
    initBannerLightbox() {
      if (window.$ && window.$.fn.magnificPopup) {
        window.$(".banner-lightbox").magnificPopup({
          type: "image",
          closeOnContentClick: true,
          closeBtnInside: true,
          image: {
            verticalFit: true,
          },
        });
      }
    },
  },
};
</script>
