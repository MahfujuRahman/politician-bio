<template>

  <Header />
  <!-- Navbar area Start -->
  <template class="d-lg-block">
    <NavbarArea />
  </template>
  <!-- navbar area end -->
  <!-- banner section start here -->
  <BannerSkeleton v-if="shouldShowBannerSkeleton" />
  <common-banner
    v-else
    :background-image="'/frontend/assets/img/about-bg.png'"
    :heading="'Contact Us'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Contact Us', url: '/contact-us' },
    ]"
    key="contact-us"
  />
  <!-- banner section End here -->

  <!-- Office Address Section Start here -->
  <div ref="addressSection" data-section="address">
    <GenericSectionSkeleton
      v-if="shouldShowAddressSkeleton"
      layout="cards"
      :itemsCount="3"
      cardClass="col-lg-4 col-md-6 mb-4"
    />
    <office-address-section
      v-else-if="isAddressVisible && addresses?.data?.length > 0"
      :addresses="addresses.data"
      :title="contactUsAddressSection?.short_title || 'Have to join with us?'"
      :description="
        contactUsAddressSection?.long_title ||
        'Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.'
      "
    />
  </div>
  <!-- Office Address Section End here -->

  <!-- Contact Page Form Section Start Here -->
  <div ref="formSection" data-section="form">
    <GenericSectionSkeleton v-if="shouldShowFormSkeleton" layout="form" />
    <contact-page-form-section
      v-else-if="isFormVisible"
      @submit="handleFormSubmission"
    >
      <template #headline>{{
        contactUsPeopleSection?.short_title ||
        "Thanks for your interest in Senatory"
      }}</template>
      <template #subtext>{{
        contactUsPeopleSection?.long_title ||
        "The circumstances get murkier with both sides trying every trick to ensure their victory in upcoming."
      }}</template>
    </contact-page-form-section>
  </div>
  <!-- Contact Page Form Section End Here -->

  <!-- Map Section Start Here -->
  <div ref="mapSection" data-section="map">
    <GenericSectionSkeleton v-if="shouldShowMapSkeleton" layout="default" />
    <map-section
      v-else-if="isMapVisible && firstAddressMapLink"
      :mapSrc="firstAddressMapLink"
      :title="
        contactUsMapLocationSection?.short_title || 'Find Us on Google Maps'
      "
      :description="
        contactUsMapLocationSection?.long_title ||
        'Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.'
      "
    />
  </div>
  <!-- Map Section End Here -->
</template>
<script>
import { Head } from "@inertiajs/vue3";
import { usePageSkeleton } from "../../composables/usePageSkeleton.js";
import { ref, computed, onMounted, onUnmounted, nextTick } from "vue";

import Header from "../../Shared/Header.vue";
import NavbarArea from "../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../CommonComponents/CommonBanner.vue";

// Skeleton Components
import BannerSkeleton from "../../CommonComponents/Skeletons/BannerSkeleton.vue";
import GenericSectionSkeleton from "../../CommonComponents/Skeletons/GenericSectionSkeleton.vue";

import OfficeAddressSection from "./components/OfficeAddressSection.vue";
import ContactPageFormSection from "./components/ContactPageFormSection.vue";
import MapSection from "./components/MapSection.vue";

import { mapActions, mapState } from "pinia";
import { store as contact_store } from "./Store/contact_store.js";

export default {
  props: {
    event: Object,
  },
  components: {
    NavbarArea,
    CommonBanner,
    OfficeAddressSection,
    ContactPageFormSection,
    MapSection,
    BannerSkeleton,
    GenericSectionSkeleton,
    Header,
  },
  setup() {
    const {
      loading,
      sectionLoadingStates,
      initializeSectionStates,
      setupIntersectionObserver,
      observeElements,
      enableScrollPersistence,
      cleanup,
      shouldShowSkeleton,
    } = usePageSkeleton();

    // Section visibility states
    const isAddressVisible = ref(false);
    const isFormVisible = ref(false);
    const isMapVisible = ref(false);

    // Section refs
    const addressSection = ref(null);
    const formSection = ref(null);
    const mapSection = ref(null);

    // Initialize section states
    const sections = ["address", "form", "map"];
    initializeSectionStates(sections);

    let scrollCleanup = null;

    onMounted(async () => {
      // Setup intersection observer
      const sectionVisibility = {
        address: isAddressVisible,
        form: isFormVisible,
        map: isMapVisible,
      };

      setupIntersectionObserver(null, sectionVisibility);

      await nextTick();

      // Observe elements
      const elements = [
        addressSection.value,
        formSection.value,
        mapSection.value,
      ];
      observeElements(elements);

      // Enable scroll persistence
      scrollCleanup = enableScrollPersistence("contact");

      // Additional restore attempt after everything is mounted
      setTimeout(() => {
        if (scrollCleanup) {
          scrollCleanup();
          scrollCleanup = enableScrollPersistence("contact");
        }
      }, 300);
    });

    onUnmounted(() => {
      cleanup();
      if (scrollCleanup) {
        scrollCleanup();
      }
    });

    return {
      loading,
      sectionLoadingStates,
      isAddressVisible,
      isFormVisible,
      isMapVisible,
      addressSection,
      formSection,
      mapSection,
      shouldShowSkeleton,
    };
  },
  methods: {
    ...mapActions(contact_store, ["fetchAllContactPageData"]),

    get_section_headings_data(section_type) {
      if (!this.section_headings || this.section_headings.length === 0) {
        return null;
      }
      const data = this.section_headings.find(
        (item) => item.section_type === section_type
      );
      return data || null;
    },

    handleFormSubmission(result) {
      if (result.success) {
        console.log("Form submitted successfully:", result.data);
        // You can add additional success handling here (e.g., show notification)
      } else {
        console.log("Form submission failed:", result.errors);
        // You can add additional error handling here (e.g., show notification)
      }
    },
  },
  computed: {
    ...mapState(contact_store, ["addresses", "section_headings"]),
    contactUsAddressSection() {
      return this.get_section_headings_data("contact_us_contact_address");
    },
    contactUsPeopleSection() {
      return this.get_section_headings_data("contact_us_contact_people");
    },
    contactUsMapLocationSection() {
      return this.get_section_headings_data("contact_us_map_location");
    },
    shouldShowBannerSkeleton() {
      return this.loading;
    },
    shouldShowAddressSkeleton() {
      return this.shouldShowSkeleton(
        this.isAddressVisible,
        computed(() => this.addresses?.data),
        "address"
      ).value;
    },
    shouldShowFormSkeleton() {
      return this.shouldShowSkeleton(
        this.isFormVisible,
        computed(() => true), // Form is always available
        "form"
      ).value;
    },
    shouldShowMapSkeleton() {
      return this.shouldShowSkeleton(
        this.isMapVisible,
        computed(() => this.firstAddressMapLink),
        "map"
      ).value;
    },
    firstAddressMapLink() {
      return this.addresses?.data?.[0]?.map_link || null;
    },
  },
  async created() {
    this.loading = true;
    await this.fetchAllContactPageData();
    this.loading = false;
  },
};
</script>
