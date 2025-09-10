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
    :heading="'Events'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Events', url: '/events/event' },
    ]"
    key="events"
  />

  <!-- Event items Section Start Here -->
  <div class="issues-around-us-section">
    <div class="container">
      <!-- Section Title -->
      <div class="row justify-content-center" v-if="eventsSection">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ eventsSection?.short_title || "Our Events" }}
            </h4>
            <p class="description wow animate__animated animate__fadeInUp">
              {{
                eventsSection?.long_title ||
                "Stay updated with our upcoming events and activities."
              }}
            </p>
          </div>
        </div>
      </div>

      <!-- Events Grid with Skeleton -->
      <div class="row" ref="eventsSection">
        <GenericSectionSkeleton
          v-if="shouldShowEventsSkeleton"
          layout="cards"
          :gridCols="3"
          :cardCount="6"
          class="events-skeleton"
        />
        <EventSingleItem
          v-else
          v-for="(event, idx) in events?.data?.data"
          :key="idx"
          :event="event"
        />
      </div>

      <!-- Pagination Section with Skeleton -->
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
            :currentPage="events?.data?.current_page || 1"
            :totalPages="events?.data?.last_page || 1"
            @prev="goToPage(events?.data?.current_page - 1)"
            @next="goToPage(events?.data?.current_page + 1)"
            @change="goToPage"
            :shape="'squer'"
          />
        </div>
      </div>
    </div>
  </div>
  <!-- Event Items Section End Here -->
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
import EventSingleItem from "./components/EventSingleItem.vue";

import { mapActions, mapState } from "pinia";
import { store as events_store } from "./Store/events_store.js";

export default {
  props: {
    event: Object,
  },
  components: {
    NavbarArea,
    EventSingleItem,
    Pagination,
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
    const isEventsVisible = ref(false);
    const isPaginationVisible = ref(false);

    // Section refs
    const bannerSection = ref(null);
    const eventsSection = ref(null);
    const paginationSection = ref(null);

    // Initialize section states
    const sections = ["banner", "events", "pagination"];
    initializeSectionStates(sections);

    let scrollCleanup = null;

    onMounted(async () => {
      // Setup intersection observer
      const sectionVisibility = {
        banner: isBannerVisible,
        events: isEventsVisible,
        pagination: isPaginationVisible,
      };

      setupIntersectionObserver(null, sectionVisibility);

      await nextTick();

      // Observe elements
      const elements = [
        bannerSection.value,
        eventsSection.value,
        paginationSection.value,
      ];
      observeElements(elements);

      // Enable scroll persistence
      scrollCleanup = enableScrollPersistence("events");

      // Additional restore attempt after everything is mounted
      setTimeout(() => {
        if (scrollCleanup) {
          scrollCleanup();
          scrollCleanup = enableScrollPersistence("events");
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
      isEventsVisible,
      isPaginationVisible,
      bannerSection,
      eventsSection,
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
    events: {
      handler(newVal) {
        console.log("newVal page updated to:", this.events);
        if (newVal && newVal.data && newVal.data.length > 0) {
          this.current = newVal.current_page || 1;
        }
      },
      immediate: true,
    },
  },
  methods: {
    ...mapActions(events_store, ["fetchAllEventsPageData"]),
    get_section_headings_data(section_type) {
      return this.section_headings?.find(
        (section) => section.section_type === section_type
      );
    },
    goToPage(page) {
      console.log("Going to page:", page);
      if (page < 1 || page > (this.events.data.last_page || 1)) return;
      this.fetchAllEventsPageData({ page });
    },
  },
  computed: {
    ...mapState(events_store, ["events", "section_headings"]),
    eventsSection() {
      return this.get_section_headings_data("events_events");
    },
    shouldShowBannerSkeleton() {
      return this.loading;
    },
    shouldShowEventsSkeleton() {
      return this.shouldShowSkeleton(
        this.isEventsVisible,
        computed(() => this.events?.data?.data),
        "events"
      ).value;
    },
    shouldShowPaginationSkeleton() {
      return this.shouldShowSkeleton(
        this.isPaginationVisible,
        computed(() => this.events?.data?.last_page),
        "pagination"
      ).value;
    },
  },
  async created() {
    this.loading = true;
    await this.fetchAllEventsPageData();
    this.loading = false;
  },
};
</script>
