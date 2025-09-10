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
    :heading="'Event details'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Events', url: '/events/event' },
      { text: 'Event details', url: '/events/event/details' },
    ]"
    key="event_details"
  />

  <!-- Event Content Section Start here -->
  <div ref="eventBannerSection">
    <GenericSectionSkeleton
      v-if="shouldShowEventBannerSkeleton"
      layout="default"
      :height="400"
      class="event-banner-skeleton"
    />
    <event-banner-section
      v-else-if="event_details"
      :event="event_details?.data"
      :joinEventTitle="eventDetailsJoinEventSection?.title"
    />
  </div>
  <!-- Event Content Section End here -->

  <!-- Speaker Section Start Here -->
  <div ref="speakerSection">
    <GenericSectionSkeleton
      v-if="shouldShowSpeakerSkeleton"
      layout="cards"
      :gridCols="4"
      :cardCount="4"
      class="speaker-skeleton"
    />
    <speaker-slider
      v-else-if="event_details"
      :speakers="event_details?.data?.event_speakers"
      :title="eventDetailsSpeakersSection?.short_title"
      :description="eventDetailsSpeakersSection?.long_title"
    />
  </div>
  <!-- Speaker Section End Here -->

  <!-- Event Facilities Section Start Here -->
  <div ref="facilitiesSection">
    <GenericSectionSkeleton
      v-if="shouldShowFacilitiesSkeleton"
      layout="list"
      :itemCount="6"
      class="facilities-skeleton"
    />
    <event-facilities-section
      v-else-if="event_details"
      :facilities="event_details?.data?.event_facilities"
      :sectionTitle="eventDetailsFacilitiesSection?.short_title"
      :sectionDescription="eventDetailsFacilitiesSection?.long_title"
    />
  </div>
  <!-- Event Facilities Section End Here -->

  <!-- More Event Section Start Here -->
  <div ref="moreEventsSection">
    <GenericSectionSkeleton
      v-if="shouldShowMoreEventsSkeleton"
      layout="cards"
      :gridCols="3"
      :cardCount="3"
      class="more-events-skeleton"
    />
    <event-slider
      v-else-if="latest_events"
      :events="latest_events?.data"
      :title="eventDetailsMoreEventSection?.short_title"
      :description="eventDetailsMoreEventSection?.long_title"
    />
  </div>
  <!-- More Event Section End Here -->
</template>
<script>
import { usePageSkeleton } from "../../../composables/usePageSkeleton.js";
import { ref, computed, onMounted, onUnmounted, nextTick } from "vue";

import Header from "../../../Shared/Header.vue";
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";
import MyCountdown from "./components/MyCountdown.vue";
import CommonBanner from "../../../CommonComponents/CommonBanner.vue";

// Skeleton Components
import BannerSkeleton from "../../../CommonComponents/Skeletons/BannerSkeleton.vue";
import GenericSectionSkeleton from "../../../CommonComponents/Skeletons/GenericSectionSkeleton.vue";

import EventBannerSection from "./components/EventBannerSection.vue";
import SpeakerSlider from "../../../GlobalComponent/SpeakerSlider.vue";
import EventFacilitiesSection from "./components/EventFacilitiesSection.vue";
import EventSlider from "../../../GlobalComponent/EventSlider.vue";

import { store as event_details_store } from "./Store/event_details_store.js";
import { mapActions, mapWritableState } from "pinia";

export default {
  components: {
    NavbarArea,
    MyCountdown,
    CommonBanner,
    BannerSkeleton,
    GenericSectionSkeleton,
    EventBannerSection,
    SpeakerSlider,
    EventFacilitiesSection,
    EventSlider,
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
    const isEventBannerVisible = ref(false);
    const isSpeakerVisible = ref(false);
    const isFacilitiesVisible = ref(false);
    const isMoreEventsVisible = ref(false);

    // Section refs
    const bannerSection = ref(null);
    const eventBannerSection = ref(null);
    const speakerSection = ref(null);
    const facilitiesSection = ref(null);
    const moreEventsSection = ref(null);

    // Initialize section states
    const sections = [
      "banner",
      "eventBanner",
      "speaker",
      "facilities",
      "moreEvents",
    ];
    initializeSectionStates(sections);

    let scrollCleanup = null;

    onMounted(async () => {
      // Setup intersection observer
      const sectionVisibility = {
        banner: isBannerVisible,
        eventBanner: isEventBannerVisible,
        speaker: isSpeakerVisible,
        facilities: isFacilitiesVisible,
        moreEvents: isMoreEventsVisible,
      };

      setupIntersectionObserver(null, sectionVisibility);

      await nextTick();

      // Observe elements
      const elements = [
        bannerSection.value,
        eventBannerSection.value,
        speakerSection.value,
        facilitiesSection.value,
        moreEventsSection.value,
      ];
      observeElements(elements);

      // Enable scroll persistence
      scrollCleanup = enableScrollPersistence("event-details");

      // Additional restore attempt after everything is mounted
      setTimeout(() => {
        if (scrollCleanup) {
          scrollCleanup();
          scrollCleanup = enableScrollPersistence("event-details");
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
      isEventBannerVisible,
      isSpeakerVisible,
      isFacilitiesVisible,
      isMoreEventsVisible,
      bannerSection,
      eventBannerSection,
      speakerSection,
      facilitiesSection,
      moreEventsSection,
      shouldShowSkeleton,
    };
  },
  data() {
    return {
      slug: "",
      speakers: [
        {
          img: "/frontend/assets/img/member-01.png",
          name: "Pier Goodman",
          designation: "PARTY SECRETERY",
          socials: [
            { icon: "fab fa-facebook-f", url: "#" },
            { icon: "fab fa-twitter", url: "#" },
            { icon: "fab fa-linkedin-in", url: "#" },
            { icon: "fab fa-youtube", url: "#" },
          ],
        },
        {
          img: "/frontend/assets/img/member-02.png",
          name: "Pier Goodman",
          designation: "PARTY SECRETERY",
          socials: [
            { icon: "fab fa-facebook-f", url: "#" },
            { icon: "fab fa-twitter", url: "#" },
            { icon: "fab fa-linkedin-in", url: "#" },
            { icon: "fab fa-youtube", url: "#" },
          ],
        },
        {
          img: "/frontend/assets/img/member-03.png",
          name: "Pier Goodman",
          designation: "PARTY SECRETERY",
          socials: [
            { icon: "fab fa-facebook-f", url: "#" },
            { icon: "fab fa-twitter", url: "#" },
            { icon: "fab fa-linkedin-in", url: "#" },
            { icon: "fab fa-youtube", url: "#" },
          ],
        },
      ],
    };
  },
  computed: {
    ...mapWritableState(event_details_store, [
      "event_details",
      "latest_events",
      "section_headings",
    ]),
    eventDetailsSpeakersSection() {
      return this.get_section_headings_data("event_details_speakers");
    },
    eventDetailsJoinEventSection() {
      return this.get_section_headings_data("event_details_join_event");
    },
    eventDetailsFacilitiesSection() {
      return this.get_section_headings_data("event_details_facilities");
    },
    eventDetailsMoreEventSection() {
      return this.get_section_headings_data("event_details_more_event");
    },
    shouldShowBannerSkeleton() {
      return this.loading;
    },
    shouldShowEventBannerSkeleton() {
      return this.shouldShowSkeleton(
        this.isEventBannerVisible,
        computed(() => this.event_details?.data),
        "eventBanner"
      ).value;
    },
    shouldShowSpeakerSkeleton() {
      return this.shouldShowSkeleton(
        this.isSpeakerVisible,
        computed(() => this.event_details?.data?.event_speakers),
        "speaker"
      ).value;
    },
    shouldShowFacilitiesSkeleton() {
      return this.shouldShowSkeleton(
        this.isFacilitiesVisible,
        computed(() => this.event_details?.data?.event_facilities),
        "facilities"
      ).value;
    },
    shouldShowMoreEventsSkeleton() {
      return this.shouldShowSkeleton(
        this.isMoreEventsVisible,
        computed(() => this.latest_events?.data),
        "moreEvents"
      ).value;
    },
  },
  async created() {
    this.loading = true;
    const params = new URLSearchParams(window.location.search);
    this.slug = params.get("slug") || "";
    if (this.slug) {
      await this.fetch_event_details(this.slug);
      console.log("event_details after fetch:", this.event_details);
    }
    await this.fetchAllEventDetailsPageData();
    console.log("latest_events after fetch:", this.latest_events);
    this.loading = false;
  },
  methods: {
    ...mapActions(event_details_store, [
      "fetch_event_details",
      "fetchAllEventDetailsPageData",
    ]),
    get_section_headings_data(section_type) {
      return this.section_headings?.find(
        (section) => section.section_type === section_type
      );
    },
  },
};
</script>
