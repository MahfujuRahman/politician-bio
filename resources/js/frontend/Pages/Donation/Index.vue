<template>
  <Head :title="event.title" />

  <Header />
  <!-- Navbar area Start -->
  <template class="d-lg-block">
    <NavbarArea />
  </template>
  <!-- navbar area end -->

  <!-- Banner Section with Skeleton -->
  <BannerSkeleton v-if="shouldShowBannerSkeleton" />
  <common-banner
    v-else
    ref="bannerSection"
    :background-image="'/frontend/assets/img/about-bg.png'"
    :heading="'Donations'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Donations', url: '/donation' },
    ]"
    key="donation"
  />

  <!-- Donation items Section Start Here -->
  <div class="issues-around-us-section">
    <div class="container">
      <!-- Section Title with Skeleton -->
      <div class="row justify-content-center" ref="titleSection">
        <div class="col-lg-6">
          <GenericSectionSkeleton
            v-if="shouldShowTitleSkeleton"
            layout="default"
            :height="120"
            class="title-skeleton"
          />
          <div v-else class="section-title">
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ donationSection?.short_title || "Donation Programs" }}
            </h4>
            <p class="description wow animate__animated animate__fadeInUp">
              {{
                donationSection?.long_title ||
                "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently."
              }}
            </p>
          </div>
        </div>
      </div>

      <!-- Donation Cards with Skeleton -->
      <div class="row" ref="donationsSection">
        <GenericSectionSkeleton
          v-if="shouldShowDonationsSkeleton"
          layout="cards"
          :gridCols="2"
          :cardCount="4"
          class="donations-skeleton"
        />
        <div
          v-else
          class="col-lg-6"
          v-for="(donation, index) in donations.data.data"
          :key="index"
        >
          <donation-single-item
            :img="donation.banner_image || 'uploads/default.jpg'"
            :title="donation.title"
            :slug="donation.slug"
            :raised="donation.achived"
            :goal="donation.target"
            :unit="donation.unit || '/='"
          />
        </div>
      </div>

      <!-- Pagination with Skeleton -->
      <div class="row justify-content-center" ref="paginationSection">
        <div class="col-lg-8 col-md-10 col-12">
          <GenericSectionSkeleton
            v-if="shouldShowPaginationSkeleton"
            layout="default"
            :height="60"
            class="pagination-skeleton"
          />
          <Pagination
            v-else
            :currentPage="donations.data.current_page || 1"
            :totalPages="donations.data.last_page || 1"
            @prev="goToPage(donations.data.current_page - 1)"
            @next="goToPage(donations.data.current_page + 1)"
            @change="goToPage"
          />
        </div>
      </div>
    </div>
  </div>
  <!-- Donation Items Section End Here -->
</template>
<script>
import { Head } from "@inertiajs/vue3";
import { usePageSkeleton } from "../../composables/usePageSkeleton.js";
import { ref, computed, onMounted, onUnmounted, nextTick } from "vue";

import Header from "../../Shared/Header.vue"
import NavbarArea from "../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../CommonComponents/CommonBanner.vue";

// Skeleton Components
import BannerSkeleton from "../../CommonComponents/Skeletons/BannerSkeleton.vue";
import GenericSectionSkeleton from "../../CommonComponents/Skeletons/GenericSectionSkeleton.vue";

import Pagination from "../../CommonComponents/Pagination.vue";
import Donation from "../../GlobalComponent/Donation.vue";
import DonationSingleItem from "./components/DonationSingleItem.vue";

import { mapActions, mapState } from "pinia";
import { store as donation_store } from "./Store/donation_store.js";

export default {
  props: {
    event: Object,
  },
  components: {
    NavbarArea,
    Pagination,
    DonationSingleItem,
    Donation,
    CommonBanner,
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
    const isBannerVisible = ref(false);
    const isTitleVisible = ref(false);
    const isDonationsVisible = ref(false);
    const isPaginationVisible = ref(false);

    // Section refs
    const bannerSection = ref(null);
    const titleSection = ref(null);
    const donationsSection = ref(null);
    const paginationSection = ref(null);

    // Initialize section states
    const sections = ["banner", "title", "donations", "pagination"];
    initializeSectionStates(sections);

    let scrollCleanup = null;

    onMounted(async () => {
      // Setup intersection observer
      const sectionVisibility = {
        banner: isBannerVisible,
        title: isTitleVisible,
        donations: isDonationsVisible,
        pagination: isPaginationVisible,
      };

      setupIntersectionObserver(null, sectionVisibility);

      await nextTick();

      // Observe elements
      const elements = [
        bannerSection.value,
        titleSection.value,
        donationsSection.value,
        paginationSection.value,
      ];
      observeElements(elements);

      // Enable scroll persistence
      scrollCleanup = enableScrollPersistence("donations");

      // Additional restore attempt after everything is mounted
      setTimeout(() => {
        if (scrollCleanup) {
          scrollCleanup();
          scrollCleanup = enableScrollPersistence("donations");
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
      isBannerVisible,
      isTitleVisible,
      isDonationsVisible,
      isPaginationVisible,
      bannerSection,
      titleSection,
      donationsSection,
      paginationSection,
      shouldShowSkeleton,
    };
  },
  data() {
    return {
      // current: 1, // Not needed, handled by store
    };
  },
  watched: {
    donations: {
      handler(newVal) {
        console.log("newVal page updated to:", this.donations);
        if (newVal && newVal.data && newVal.data.length > 0) {
          this.current = newVal.current_page || 1;
        }
      },
      immediate: true,
    },
  },
  methods: {
    ...mapActions(donation_store, ["fetchAllDonationPageData"]),

    // Get section data by section_type
    get_section_headings_data(sectionType) {
      return (
        this.section_headings?.find(
          (item) => item.section_type === sectionType
        ) || null
      );
    },

    goToPage(page) {
      console.log("Going to page:", page);
      if (page < 1 || page > (this.donations.data.last_page || 1)) return;
      this.fetchAllDonationPageData({ page });
    },
  },
  computed: {
    ...mapState(donation_store, [
      "section_headings",
      "donations",
      "loading",
      "error",
    ]),

    // Section heading data computed properties
    donationSection() {
      return this.get_section_headings_data("donation_donation_all");
    },
    shouldShowBannerSkeleton() {
      return this.loading;
    },
    shouldShowTitleSkeleton() {
      return this.shouldShowSkeleton(
        this.isTitleVisible,
        computed(() => true), // Title is always available
        "title"
      ).value;
    },
    shouldShowDonationsSkeleton() {
      return this.shouldShowSkeleton(
        this.isDonationsVisible,
        computed(() => this.donations?.data?.data),
        "donations"
      ).value;
    },
    shouldShowPaginationSkeleton() {
      return this.shouldShowSkeleton(
        this.isPaginationVisible,
        computed(() => this.donations?.data?.last_page),
        "pagination"
      ).value;
    },
  },
  async created() {
    this.loading = true;
    await this.fetchAllDonationPageData();
    this.loading = false;
  },
};
</script>
