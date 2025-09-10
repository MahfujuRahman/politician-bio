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
    :heading="'Issues Details'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Issues', url: '/pages/issues' },
      { text: 'Issues Details', url: '/pages/issues/details' },
    ]"
    key="issues_details"
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
              :style="`background-image: url(/${issue_details?.data?.image || '/uploads/default.jpg'})`"
            ></div>
          </div>
          <div class="content">
            <h4 class="title my-3">{{ issue_details?.data?.title }}</h4>
            <h6 class="subtitle">Description</h6>
            <p class="description" v-html="issue_details?.data?.description"></p>

          </div>
          <numbered-list :subtitle="actionSubtitle" :items="issue_details?.data?.taking_action" />
        </div>
      </div>
    </div>
  </div>
  <!-- Issues Details Section End Here -->
</template>

<script>
import Header from "../../../Shared/Header.vue";
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../../CommonComponents/CommonBanner.vue";
import NumberedList from "../../../GlobalComponent/NumberedList.vue";
import { store as issue_details_store } from "./Store/issue_details_store.js";
import { mapActions, mapWritableState } from "pinia";

export default {
  props: {
    event: Object,
  },
  components: {
    NavbarArea,
    CommonBanner,
    NumberedList,
    Header,
  },
  data() {
    return {
      slug: "",
      actionSubtitle: "Taking action on this issue",
    };
  },
  created: async function () {
    const params = new URLSearchParams(window.location.search);
    this.slug = params.get("slug") || "";
    if (this.slug) {
      await this.fetch_issue_details(this.slug);
    }
  },
  methods: {
    ...mapActions(issue_details_store, ["fetch_issue_details"]),
  },
  computed: {
    ...mapWritableState(issue_details_store, [
      "issue_details",
    ]),
  },
};
</script>
