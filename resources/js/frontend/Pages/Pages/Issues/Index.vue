<template>

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
    :heading="'Issues'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Issues', url: '/pages/issues' },
    ]"
    key="issues"
  />

  <!-- Issues Around Us Section Start Here -->
  <div class="issues-around-us-section margin-top-120">
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
              <a href="#">{{
                issuesSection?.short_title || "Issues Around Us"
              }}</a>
            </h4>
            <p class="description wow animate__animated animate__fadeInUp">
              {{
                issuesSection?.long_title ||
                "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently."
              }}
            </p>
          </div>
        </div>
      </div>

      <!-- Issues Grid with Skeleton -->
      <div class="row" ref="issuesSection">
        <GenericSectionSkeleton
          v-if="shouldShowIssuesSkeleton"
          layout="cards"
          :gridCols="2"
          :cardCount="6"
          class="issues-skeleton"
        />
        <div
          v-else
          class="col-md-6"
          v-for="(item, idx) in issues?.data?.data"
          :key="idx"
        >
          <IssueItem :item="item" />
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
            :currentPage="issues?.data?.current_page || 1"
            :totalPages="issues?.data?.last_page || 1"
            @prev="goToPage(issues?.data?.current_page - 1)"
            @next="goToPage(issues?.data?.current_page + 1)"
            @change="goToPage"
          />
        </div>
      </div>
    </div>
  </div>
  <!-- Issues Around Us Section End Here -->
</template>

<script>
import { Head } from "@inertiajs/vue3";
import { usePageSkeleton } from "../../../composables/usePageSkeleton.js";
import { ref, computed, onMounted, onUnmounted, nextTick } from "vue";

import Header from "../../../Shared/Header.vue";
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../../CommonComponents/CommonBanner.vue";

// Skeleton Components
import BannerSkeleton from "../../../CommonComponents/Skeletons/BannerSkeleton.vue";
import GenericSectionSkeleton from "../../../CommonComponents/Skeletons/GenericSectionSkeleton.vue";

import Pagination from "../../../CommonComponents/Pagination.vue";
import IssueItem from "./IssueItem.vue";

import { mapActions, mapState } from "pinia";
import { store as issues_store } from "./Store/issues_store.js";

export default {
  components: {
    NavbarArea,
    CommonBanner,
    BannerSkeleton,
    GenericSectionSkeleton,
    Pagination,
    IssueItem,
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
    const isIssuesVisible = ref(false);
    const isPaginationVisible = ref(false);

    // Section refs
    const bannerSection = ref(null);
    const titleSection = ref(null);
    const issuesSection = ref(null);
    const paginationSection = ref(null);

    // Initialize section states
    const sections = ["banner", "title", "issues", "pagination"];
    initializeSectionStates(sections);

    let scrollCleanup = null;

    onMounted(async () => {
      // Setup intersection observer
      const sectionVisibility = {
        banner: isBannerVisible,
        title: isTitleVisible,
        issues: isIssuesVisible,
        pagination: isPaginationVisible,
      };

      setupIntersectionObserver(null, sectionVisibility);

      await nextTick();

      // Observe elements
      const elements = [
        bannerSection.value,
        titleSection.value,
        issuesSection.value,
        paginationSection.value,
      ];
      observeElements(elements);

      // Enable scroll persistence
      scrollCleanup = enableScrollPersistence("issues");

      // Additional restore attempt after everything is mounted
      setTimeout(() => {
        if (scrollCleanup) {
          scrollCleanup();
          scrollCleanup = enableScrollPersistence("issues");
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
      isIssuesVisible,
      isPaginationVisible,
      bannerSection,
      titleSection,
      issuesSection,
      paginationSection,
      shouldShowSkeleton,
    };
  },
  data() {
    return {
      current: 1,
    };
  },
  watched: {
    issues: {
      handler(newVal) {
        console.log("newVal page updated to:", this.issues);
        if (newVal && newVal.data && newVal.data.length > 0) {
          this.current = newVal.current_page || 1;
        }
      },
      immediate: true,
    },
  },
  methods: {
    ...mapActions(issues_store, ["fetchAllIssuesPageData"]),
    get_section_headings_data(section_type) {
      return this.section_headings?.find(
        (section) => section.section_type === section_type
      );
    },
    goToPage(page) {
      console.log("Going to page:", page);
      if (page < 1 || page > (this.issues.data.last_page || 1)) return;
      this.fetchAllIssuesPageData({ page });
    },
  },
  computed: {
    ...mapState(issues_store, ["issues", "section_headings"]),
    issuesSection() {
      return this.get_section_headings_data("issues_issues");
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
    shouldShowIssuesSkeleton() {
      return this.shouldShowSkeleton(
        this.isIssuesVisible,
        computed(() => this.issues?.data?.data),
        "issues"
      ).value;
    },
    shouldShowPaginationSkeleton() {
      return this.shouldShowSkeleton(
        this.isPaginationVisible,
        computed(() => this.issues?.data?.last_page),
        "pagination"
      ).value;
    },
  },
  async created() {
    this.loading = true;
    await this.fetchAllIssuesPageData();
    this.loading = false;
  },
};
</script>
