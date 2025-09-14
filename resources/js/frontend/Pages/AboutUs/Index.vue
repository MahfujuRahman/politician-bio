<template>
  <Head :title="event.title" />

  <Header />

  <!-- Navbar area Start -->
  <template class="d-lg-block">
    <NavbarArea />
  </template>
  <!-- navbar area end -->

  <!-- Banner section start here -->
  <BannerSkeleton v-if="shouldShowBannerSkeleton" />
  <common-banner
    v-else-if="about_us_banner"
    :background-image="
        about_us_banner?.background_image ||
        '/frontend/assets/img/about-bg.png'
      "
    :heading="about_us_banner?.title || 'About Us'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'About Us', url: '/about-us' },
    ]"
    key="about-us"
  />

  <!-- Banner section End here -->

  <!-- AboutUs Section Start Here -->
  <div ref="aboutUsSection" data-section="aboutUs">
    <GenericSectionSkeleton v-if="shouldShowAboutUsSkeleton" layout="default" />
    <about-us-section
      v-else-if="isAboutUsVisible && about_us"
      :about_us="about_us"
    />
  </div>
  <!-- AboutUs Section End Here -->

  <!-- Why Choose us secion Start here -->
  <div ref="whyChooseSection" data-section="whyChoose">
    <GenericSectionSkeleton
      v-if="shouldShowWhyChooseSkeleton"
      layout="default"
    />
    <why-choose-us
      v-else-if="isWhyChooseVisible && whyChoseUs && whyChoseUs.length > 0"
      :position="'right'"
      :main-bg="
        whyChooseSection?.background_image ||
        '/frontend/assets/img/group-activity-02.png'
      "
      :side-bg="
        whyChooseSection?.primary_image || '/frontend/assets/img/ceo.png'
      "
      :whyChooseItems="whyChoseUs"
      :short_title="whyChooseSection?.short_title"
      :long_title="whyChooseSection?.long_title"
    />
  </div>
  <!-- Why Choose us secion End here -->

  <!-- Volunteer Section Start -->
  <div ref="volunteerSection" data-section="volunteer">
    <GenericSectionSkeleton
      v-if="shouldShowVolunteerSkeleton"
      layout="cards"
      :itemsCount="6"
      cardClass="col-lg-4 col-md-6 mb-4"
    />
    <volunteer-section
      v-else-if="isVolunteerVisible && volunteers.length"
      :volunteers="volunteers"
      :short_title="volunteerSection?.short_title"
      :title="volunteerSection?.title"
      :long_title="volunteerSection?.long_title"
    />
  </div>
  <!-- Volunteer Section End -->

  <!-- MissionVision section Start here -->
  <div ref="missionVisionSection" data-section="missionVision">
    <GenericSectionSkeleton
      v-if="shouldShowMissionVisionSkeleton"
      layout="default"
    />
    <mission-vision
      v-else-if="isMissionVisionVisible && mission_vision"
      :mission_vision="mission_vision"
      :short_title="missionVisionSection?.short_title"
      :long_title="missionVisionSection?.long_title"
    />
  </div>
  <!-- MissionVision section end here -->

  <!-- AtAGlance Section Start -->
  <div ref="atAGlanceSection" data-section="atAGlance">
    <GenericSectionSkeleton
      v-if="shouldShowAtAGlanceSkeleton"
      layout="cards"
      :itemsCount="4"
      cardClass="col-lg-3 col-md-6 mb-4"
    />
    <at-a-glance
      v-else-if="isAtAGlanceVisible && counters.length"
      :counters="counters"
    />
  </div>
  <!-- AtAGlance Section End -->
</template>
<script>
import { store as about_us_store } from "./Store/about_us_store.js";
import { usePageSkeleton } from "../../composables/usePageSkeleton.js";
import { ref, computed, onMounted, onUnmounted, nextTick } from "vue";

import { Head } from "@inertiajs/vue3";
import AboutUsSection from "./Components/AboutUsSection.vue";

// Common Components
import Header from "../../Shared/Header.vue"
import NavbarArea from "../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../CommonComponents/CommonBanner.vue";

// Skeleton Components
import BannerSkeleton from "../../CommonComponents/Skeletons/BannerSkeleton.vue";
import GenericSectionSkeleton from "../../CommonComponents/Skeletons/GenericSectionSkeleton.vue";

//Global Components
import WhyChooseUs from "../../GlobalComponent/WhyChoseUs.vue";
import AtAGlance from "../../GlobalComponent/AtAGlance.vue";
import MissionVision from "../../GlobalComponent/MissionVision.vue";
import VolunteerSection from "../../GlobalComponent/VolunteerSection.vue";
import { mapActions, mapState } from "pinia";

export default {
  props: {
    event: Object,
  },
  components: {
    NavbarArea,
    CommonBanner,
    AboutUsSection,
    AtAGlance,
    MissionVision,
    VolunteerSection,
    WhyChooseUs,
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
    const isAboutUsVisible = ref(false);
    const isWhyChooseVisible = ref(false);
    const isVolunteerVisible = ref(false);
    const isMissionVisionVisible = ref(false);
    const isAtAGlanceVisible = ref(false);

    // Section refs
    const aboutUsSection = ref(null);
    const whyChooseSection = ref(null);
    const volunteerSection = ref(null);
    const missionVisionSection = ref(null);
    const atAGlanceSection = ref(null);

    // Initialize section states
    const sections = [
      "aboutUs",
      "whyChoose",
      "volunteer",
      "missionVision",
      "atAGlance",
    ];
    initializeSectionStates(sections);

    let scrollCleanup = null;

    onMounted(async () => {
      // Setup intersection observer
      const sectionVisibility = {
        aboutUs: isAboutUsVisible,
        whyChoose: isWhyChooseVisible,
        volunteer: isVolunteerVisible,
        missionVision: isMissionVisionVisible,
        atAGlance: isAtAGlanceVisible,
      };

      setupIntersectionObserver(null, sectionVisibility);

      await nextTick();

      // Observe elements
      const elements = [
        aboutUsSection.value,
        whyChooseSection.value,
        volunteerSection.value,
        missionVisionSection.value,
        atAGlanceSection.value,
      ];
      observeElements(elements);

      // Enable scroll persistence
      scrollCleanup = enableScrollPersistence("about_us");

      // Additional restore attempt after everything is mounted
      setTimeout(() => {
        if (scrollCleanup) {
          scrollCleanup();
          scrollCleanup = enableScrollPersistence("about_us");
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
      isAboutUsVisible,
      isWhyChooseVisible,
      isVolunteerVisible,
      isMissionVisionVisible,
      isAtAGlanceVisible,
      aboutUsSection,
      whyChooseSection,
      volunteerSection,
      missionVisionSection,
      atAGlanceSection,
      shouldShowSkeleton,
    };
  },
  methods: {
    ...mapActions(about_us_store, ["fetchAllAboutUsPageData"]),

    // Get section data by section_type
    get_section_headings_data(sectionType) {
      return (
        this.section_headings?.find(
          (item) => item.section_type === sectionType
        ) || null
      );
    },
  },
  async created() {
    this.loading = true;
    await this.fetchAllAboutUsPageData();
    this.loading = false;
  },
  computed: {
    ...mapState(about_us_store, [
      "section_headings",
      "about_us",
      "whyChoseUs",
      "volunteers",
      "mission_vision",
      "counters",
      "error",
    ]),

    // Section heading data computed properties
    about_us_banner() {
      return this.get_section_headings_data("about_us_banner");
    },
    volunteerSection() {
      return this.get_section_headings_data("about_us_volunteer");
    },
    missionVisionSection() {
      return this.get_section_headings_data("about_us_mission_vision");
    },
    whyChooseSection() {
      return this.get_section_headings_data("about_us_why_chose_us");
    },
    shouldShowBannerSkeleton() {
      return this.loading;
    },
    shouldShowAboutUsSkeleton() {
      return this.shouldShowSkeleton(
        this.isAboutUsVisible,
        computed(() => this.about_us),
        "aboutUs"
      ).value;
    },
    shouldShowWhyChooseSkeleton() {
      return this.shouldShowSkeleton(
        this.isWhyChooseVisible,
        computed(() => this.whyChoseUs),
        "whyChoose"
      ).value;
    },
    shouldShowVolunteerSkeleton() {
      return this.shouldShowSkeleton(
        this.isVolunteerVisible,
        computed(() => this.volunteers),
        "volunteer"
      ).value;
    },
    shouldShowMissionVisionSkeleton() {
      return this.shouldShowSkeleton(
        this.isMissionVisionVisible,
        computed(() => this.mission_vision),
        "missionVision"
      ).value;
    },
    shouldShowAtAGlanceSkeleton() {
      return this.shouldShowSkeleton(
        this.isAtAGlanceVisible,
        computed(() => this.counters),
        "atAGlance"
      ).value;
    },
  },
};
</script>
