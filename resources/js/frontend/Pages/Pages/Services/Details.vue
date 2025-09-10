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
    :heading="'Services Details'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Services', url: '/pages/services' },
      { text: 'Services Details', url: '/pages/services/details' },
    ]"
    :marginClass="'margin-bottom-0'"
    key="services_details"
  />
  <!-- banner section End here -->

  <!-- ServiceDetailsSection Start here -->
  <service-details-section v-if="service_details" :service="service_details" />
  <!-- ServiceDetailsSection End here -->

  <!-- service-slider Section Start -->
  <service-slider v-if="services.length" :services="services" />
  <!-- service-slider section end -->

  <!-- Why Choose us secion Start here -->
  <WhyChoseUs
    :position="'right'"
    :main-bg="
      servicesDetailsWhyChooseUsSection?.background_image
        ? '/' + servicesDetailsWhyChooseUsSection.background_image
        : '/frontend/assets/img/group-activity-02.png'
    "
    :side-bg="
      servicesDetailsWhyChooseUsSection?.primary_image
        ? '/' + servicesDetailsWhyChooseUsSection.primary_image
        : '/frontend/assets/img/ceo.png'
    "
    :whyChooseItems="whyChoseUs"
    :short_title="servicesDetailsWhyChooseUsSection?.short_title"
    :long_title="servicesDetailsWhyChooseUsSection?.long_title"
  />
  <!-- Why Choose us secion End here -->

  <!-- Faq section Start here -->
  <mission-vision
    v-if="mission_vision"
    :mission_vision="mission_vision"
    :short_title="serviceDetailsMissionVisionSection?.short_title"
    :long_title="serviceDetailsMissionVisionSection?.long_title"
  />
  <!-- Faq section end here -->

  <!-- Counter Section Start -->
  <at-a-glance v-if="counters.length" :counters="counters" />
  <!-- Counter Section End -->
</template>

<script>
import { Head } from "@inertiajs/vue3";
import { mapActions, mapWritableState } from "pinia";
import { store as service_details_store } from "./Store/service_details_store.js";
import Header from "../../../Shared/Header.vue";
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../../CommonComponents/CommonBanner.vue";
import WhyChoseUs from "../../../GlobalComponent/WhyChoseUs.vue";
import MissionVision from "../../../GlobalComponent/MissionVision.vue";
import AtAGlance from "../../../GlobalComponent/AtAGlance.vue";
import ServiceSlider from "../../../GlobalComponent/ServiceSlider.vue";

import ServiceDetailsSection from "./components/ServiceDetailsSection.vue";

export default {
  props: {
    event: Object,
  },
  components: {
    NavbarArea,
    CommonBanner,
    WhyChoseUs,
    MissionVision,
    AtAGlance,
    ServiceSlider,
    ServiceDetailsSection,
    Header,
  },
  data() {
    return {
      slug: "",
    };
  },
  created: async function () {
    await this.fetchAllServiceDetailsPageData();
    const params = new URLSearchParams(window.location.search);
    this.slug = params.get("slug") || "";
    if (this.slug) {
      await this.fetch_service_details(this.slug);
      console.log("service_details after fetch:", this.service_details);
    }
  },
  methods: {
    ...mapActions(service_details_store, [
      "fetch_service_details",
      "fetchAllServiceDetailsPageData",
    ]),
    get_section_headings_data(section_type) {
      return this.section_headings?.find(
        (section) => section.section_type === section_type
      );
    },
  },
  computed: {
    ...mapWritableState(service_details_store, [
      "service_details",
      "whyChoseUs",
      "mission_vision",
      "counters",
      "services",
      "section_headings",
    ]),
    serviceDetailsMissionVisionSection() {
      return this.get_section_headings_data("services_details_mission_vision");
    },
    servicesDetailsWhyChooseUsSection() {
      return this.get_section_headings_data("services_details_why_choose_us");
    },
  },
};
</script>
