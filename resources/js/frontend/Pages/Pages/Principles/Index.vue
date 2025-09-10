<template>
  <Head :title="event.title" />

  <Header />
  <!-- Navbar area Start -->
  <template class="d-lg-block">
    <NavbarArea />
  </template>
  <!-- navbar area end -->
  <!-- banner section start here -->
  <common-banner
    :background-image="'/frontend/assets/img/about-bg.png'"
    :heading="'Our Principles'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Our Principles', url: '/pages/principles' },
    ]"
    key="principles"
  />
  <!-- banner section End here -->

  <!-- Our Principle Section Start here -->
  <OurPrinciple
    v-if="principles.length > 0"
    :principleItems="principles"
    :short_title="principlesSection?.short_title"
    :long_title="principlesSection?.long_title"
  />
  <!-- Our Principle Section End here -->

  <!-- People say section-02 start here -->
  <!-- People say section-02 start here -->
  <!-- <people-say-section
    v-if="comments.length > 0"
    :comments="comments"
    :short_title="publicCommentsSection?.short_title"
    :long_title="publicCommentsSection?.long_title"
    :primary_image="publicCommentsSection?.primary_image"
    :background_image="publicCommentsSection?.background_image"
  /> -->
  <people-say-section
    v-if="comments.length > 0"
    :comments="comments"
  />
  <!-- People say section-02 end here -->
  <!-- People say section-02 end here -->

  <!-- Our speeches section start here -->
  <our-speeches-section
    v-if="speeches.length > 0"
    :speeches="speeches"
    :short_title="speechesSection?.short_title"
    :long_title="speechesSection?.long_title"
  />
  <!-- Our speeches section start here -->
</template>

<script>
import { store as principles_store } from "./Store/principles_store.js";
import { mapActions, mapState } from "pinia";

import { Head } from "@inertiajs/vue3";
import Header from "../../../Shared/Header.vue";
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../../CommonComponents/CommonBanner.vue";
import OurPrinciple from "../../../GlobalComponent/OurPrinciple.vue";
import PeopleSaySection from "../../../GlobalComponent/PeopleSaySection.vue";
import OurSpeechesSection from "../../../GlobalComponent/OurSpeechesSection.vue";

export default {
  props: {
    event: Object,
  },
  components: {
    NavbarArea,
    CommonBanner,
    OurPrinciple,
    PeopleSaySection,
    OurSpeechesSection,
    Header,
  },
  created: function () {
    this.fetchAllPrinciplesPageData();
  },
  methods: {
    ...mapActions(principles_store, ["fetchAllPrinciplesPageData"]),

    // Get section data by section_type
    get_section_headings_data(sectionType) {
      return (
        this.section_headings?.find(
          (item) => item.section_type === sectionType
        ) || null
      );
    },
  },
  computed: {
    ...mapState(principles_store, [
      "section_headings",
      "principles",
      "comments",
      "speeches",
    ]),

    // Section heading data computed properties
    principlesSection() {
      return this.get_section_headings_data("principles_principles");
    },
    publicCommentsSection() {
      return this.get_section_headings_data("principles_public_comments");
    },
    speechesSection() {
      return this.get_section_headings_data("principles_our_speeches");
    },
  },
};
</script>
