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
    :heading="'Media'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Media', url: '/media' },
    ]"
    key="media"
  />

  <!-- Media items Section Start Here -->
  <div class="media-item-section">
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
              {{ mediaSection?.short_title || "Media Programs" }}
            </h4>
            <p class="description wow animate__animated animate__fadeInUp">
              {{
                mediaSection?.long_title ||
                "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently."
              }}
            </p>
          </div>
        </div>
      </div>

      <!-- Media Cards with Skeleton -->
      <div class="row" ref="mediaSection">
        <GenericSectionSkeleton
          v-if="shouldShowMediaSkeleton"
          layout="cards"
          :gridCols="2"
          :cardCount="4"
          class="media-skeleton"
        />
        <div
          v-else
          class="col-md-6 col-lg-4 mb-4"
          v-for="(mediaItem, index) in media?.data?.data || []"
          :key="index"
        >
          <media-single-item
            :thumbnail_image="mediaItem.thumbnail_image || 'uploads/default.jpg'"
            :video_url="mediaItem.video_url || '#'"
            :tag="mediaItem.tag || 'Media'"
            :title="mediaItem.title"
            :date="mediaItem.created_at || new Date().toLocaleDateString()"
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
            :currentPage="media?.data?.current_page || 1"
            :totalPages="media?.data?.last_page || 1"
            @prev="goToPage((media?.data?.current_page || 1) - 1)"
            @next="goToPage((media?.data?.current_page || 1) + 1)"
            @change="goToPage"
          />
        </div>
      </div>
    </div>
  </div>
  <!-- Media Items Section End Here -->
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
import MediaSingleItem from "./components/mediaSingleItem.vue";

import { mapActions, mapState } from "pinia";
import { store as media_store } from "./Store/media_store.js";

export default {
  props: {
    event: Object,
  },
  components: {
    Head,
    NavbarArea,
    Pagination,
    MediaSingleItem,
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
    const isMediaVisible = ref(false);
    const isPaginationVisible = ref(false);

    // Section refs
    const bannerSection = ref(null);
    const titleSection = ref(null);
    const mediaSection = ref(null);
    const paginationSection = ref(null);

    // Initialize section states
    const sections = ["banner", "title", "media", "pagination"];
    initializeSectionStates(sections);

    let scrollCleanup = null;

    onMounted(async () => {
      // Setup intersection observer
      const sectionVisibility = {
        banner: isBannerVisible,
        title: isTitleVisible,
        media: isMediaVisible,
        pagination: isPaginationVisible,
      };

      setupIntersectionObserver(null, sectionVisibility);

      await nextTick();

      // Observe elements
      const elements = [
        bannerSection.value,
        titleSection.value,
        mediaSection.value,
        paginationSection.value,
      ];
      observeElements(elements);

      // Enable scroll persistence
      scrollCleanup = enableScrollPersistence("media");

      // Additional restore attempt after everything is mounted
      setTimeout(() => {
        if (scrollCleanup) {
          scrollCleanup();
          scrollCleanup = enableScrollPersistence("media");
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
      isMediaVisible,
      isPaginationVisible,
      bannerSection,
      titleSection,
      mediaSection,
      paginationSection,
      shouldShowSkeleton,
    };
  },
  data() {
    return {
      // current: 1, // Not needed, handled by store
    };
  },
  watch: {
    media: {
      handler(newVal) {
        console.log("newVal page updated to:", this.media);
        if (
          newVal &&
          newVal.data &&
          newVal.data.data &&
          newVal.data.data.length > 0
        ) {
          // Handle media data update if needed
        }
      },
      immediate: true,
    },
  },
  methods: {
    ...mapActions(media_store, ["fetchAllMediaPageData"]),

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
      if (page < 1 || page > (this.media?.data?.last_page || 1)) return;
      this.fetchAllMediaPageData({ page });
    },
  },
  computed: {
    ...mapState(media_store, ["section_headings", "media", "loading", "error"]),

    // Section heading data computed properties
    mediaSection() {
      return this.get_section_headings_data("media_media_all");
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
    shouldShowMediaSkeleton() {
      return this.shouldShowSkeleton(
        this.isMediaVisible,
        computed(() => this.media?.data?.data),
        "media"
      ).value;
    },
    shouldShowPaginationSkeleton() {
      return this.shouldShowSkeleton(
        this.isPaginationVisible,
        computed(() => this.media?.data?.last_page),
        "pagination"
      ).value;
    },
  },
  async created() {
    this.loading = true;
    await this.fetchAllMediaPageData();
    this.loading = false;
  },
};
</script>
