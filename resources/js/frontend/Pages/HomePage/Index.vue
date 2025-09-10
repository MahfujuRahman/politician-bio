<template>
  <Head :title="event.title"> </Head>
  <!-- Header Single Section Start here -->
  <!-- Header Single Section Start here -->
  <div class="header-style-05">
    <!-- Mobile Supported Navbar Start -->
    <Header />
    <!-- Mobile Supported Navbar End -->
    <!-- Banner Section Area Start Here -->
    <!-- Banner Section Area Start Here -->
    <BannerSection :data="banner" :isLoading="bannerLoading" />
    <!-- Banner Section Area End Here -->
    <!-- Banner Section Area End Here -->
  </div>
  <!-- Header Single Section Start here -->
  <!-- Header Single Section Start here -->

  <!-- Services Single Section Start here -->
  <!-- Services Single Section Start here -->
  <div ref="servicesSection">
    <ServiceSectionSkeleton v-if="shouldShowServicesSkeleton" />
    <ServiceSection
      v-else-if="isServicesVisible && services && services.length > 0"
      :serviceMarginTop="'100px'"
      :serviceItems="services"
      :sectionTitle="serviceSection?.short_title"
      :sectionDescription="serviceSection?.long_title"
    />
  </div>
  <!-- Services Single Section Start here -->
  <!-- Services Single Section Start here -->

  <!-- Why Choose us secion Start here -->
  <!-- Why Choose us secion Start here -->
  <div ref="whyChooseSection">
    <WhyChoseUsSkeleton v-if="shouldShowWhyChooseSkeleton" />
    <WhyChoseUs
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
  <!-- Why Choose us secion End here -->

  <!-- Our Principle Section Start here -->
  <!-- Our Principle Section Start here -->
  <div ref="principlesSection">
    <OurPrincipleSkeleton v-if="shouldShowPrinciplesSkeleton" />
    <OurPrinciple
      v-else-if="isPrinciplesVisible && principles && principles.length > 0"
      :principleItems="principles"
      :short_title="principleSection?.short_title"
      :long_title="principleSection?.long_title"
    />
  </div>
  <!-- Our Principle Section End here -->
  <!-- Our Principle Section End here -->

  <!-- Our Journey Section Start Here -->
  <!-- Our Journey Section Start Here -->
  <div ref="journeySection">
    <OurJourneySkeleton v-if="shouldShowJourneySkeleton" />
    <OurJourney
      v-else-if="isJourneyVisible && ourJourney && ourJourney.length > 0"
      :journeyItems="ourJourney"
      :short_title="journeySection?.short_title"
      :long_title="journeySection?.long_title"
    />
  </div>
  <!-- Our Journey Section End Here -->
  <!-- Our Journey Section End Here -->

  <!-- Media section Start here -->
  <!-- Media section Start here -->
  <div ref="mediaSection">
    <MediaCoverageSkeleton v-if="shouldShowMediaSkeleton" />
    <MediaCoverage
      v-else-if="isMediaVisible && mediaCoverages"
      :mediaItems="mediaCoverages"
      :short_title="mediaSection?.short_title"
      :title="mediaSection?.title"
      :long_title="mediaSection?.long_title"
      :video_url="mediaSection?.video_url"
      :background_image="mediaSection?.background_image"
    />
  </div>
  <!-- Media section end here -->
  <!-- Media section end here -->

  <!-- Donation Section Start -->
  <!-- Donation Section Start -->
  <div ref="donationSection">
    <DonationSkeleton v-if="shouldShowDonationSkeleton" />
    <Donation v-else-if="isDonationVisible" 
    :short_title="donationSection?.short_title"
    :title="donationSection?.title"
    :short_description="donationSection?.short_description"
    :side_image="donationSection?.side_image"
    />
  </div>
  <!-- Donation Section End -->
  <!-- Donation Section End -->

  <!-- Testimonial Section-02 Start -->
  <!-- Testimonial Section-02 Start -->
  <div ref="testimonialSection">
    <TestimonialSkeleton v-if="shouldShowTestimonialSkeleton" />
    <Testimonial
      v-else-if="isTestimonialVisible && comments"
      :comments="comments"
      :short_title="testimonialSection?.short_title"
      :title="testimonialSection?.title"
      :background_image="testimonialSection?.background_image"
    />
  </div>
  <!-- Testimonial Secition-02 End -->
  <!-- Testimonial Secition-02 End -->

  <!-- News Section Start -->
  <!-- News Section Start -->
  <div ref="newsSection">
    <NewsSkeleton v-if="shouldShowNewsSkeleton" />
    <News
      v-else-if="isNewsVisible && news"
      :lead_news="news.lead_news"
      :side_news="news.side_news"
      :short_title="newsSection?.short_title"
      :title="newsSection?.title"
    />
  </div>
  <!-- News Section End  -->
  <!-- News Section End  -->

  <!-- back to top area start -->
  <!-- back to top area start -->
  <BackToTop />
  <!-- back to top area end -->
  <!-- back to top area end -->

  <!-- Vote poll start here -->
  <!-- Vote poll start here -->
  <VotePooll v-if="poll" :poll="poll" />
  <!-- Vote poll start here -->
  <!-- Vote poll start here -->
</template>

<script>
import { store as home_page_store } from "./Store/home_page_store.js";
import { Head } from "@inertiajs/vue3";
import { defineAsyncComponent } from "vue";

// Critical components loaded immediately
import Header from "../../Shared/Header.vue";
import BackToTop from "../../CommonComponents/BackToTop.vue";
import VotePooll from "../../CommonComponents/VotePooll.vue";
import BannerSection from "./Components/BannerSection.vue";

// Skeleton components
import ServiceSectionSkeleton from "./Components/Skeletons/ServiceSectionSkeleton.vue";
import WhyChoseUsSkeleton from "./Components/Skeletons/WhyChoseUsSkeleton.vue";
import OurPrincipleSkeleton from "./Components/Skeletons/OurPrincipleSkeleton.vue";
import OurJourneySkeleton from "./Components/Skeletons/OurJourneySkeleton.vue";
import MediaCoverageSkeleton from "./Components/Skeletons/MediaCoverageSkeleton.vue";
import DonationSkeleton from "./Components/Skeletons/DonationSkeleton.vue";
import TestimonialSkeleton from "./Components/Skeletons/TestimonialSkeleton.vue";
import NewsSkeleton from "./Components/Skeletons/NewsSkeleton.vue";

// Lazy loaded components
const ServiceSection = defineAsyncComponent(() =>
  import("../../GlobalComponent/ServiceSection.vue")
);
const Donation = defineAsyncComponent(() =>
  import("../../GlobalComponent/Donation.vue")
);
const MediaCoverage = defineAsyncComponent(() =>
  import("../../GlobalComponent/MediaCoverage.vue")
);
const News = defineAsyncComponent(() =>
  import("../../GlobalComponent/News.vue")
);
const OurJourney = defineAsyncComponent(() =>
  import("../../GlobalComponent/OurJourney.vue")
);
const OurPrinciple = defineAsyncComponent(() =>
  import("../../GlobalComponent/OurPrinciple.vue")
);
const Testimonial = defineAsyncComponent(() =>
  import("../../GlobalComponent/Testimonial.vue")
);
const WhyChoseUs = defineAsyncComponent(() =>
  import("../../GlobalComponent/WhyChoseUs.vue")
);

import { mapActions, mapState } from "pinia";

export default {
  props: {
    event: Object,
    data: Object,
  },

  components: {
    Head,
    Header,
    BannerSection,
    ServiceSection,
    Donation,
    OurPrinciple,
    OurJourney,
    MediaCoverage,
    Testimonial,
    WhyChoseUs,
    News,
    VotePooll,
    BackToTop,
    // Skeleton components
    ServiceSectionSkeleton,
    WhyChoseUsSkeleton,
    OurPrincipleSkeleton,
    OurJourneySkeleton,
    MediaCoverageSkeleton,
    DonationSkeleton,
    TestimonialSkeleton,
    NewsSkeleton,
  },
  data() {
    return {
      isServicesVisible: false,
      isWhyChooseVisible: false,
      isPrinciplesVisible: false,
      isJourneyVisible: false,
      isMediaVisible: false,
      isDonationVisible: false,
      isTestimonialVisible: false,
      isNewsVisible: false,
      observer: null,
      // Skeleton timing control
      sectionLoadingStates: {
        services: true,
        whyChoose: true,
        principles: true,
        journey: true,
        media: true,
        donation: true,
        testimonial: true,
        news: true,
      },
      skeletonMinTime: 2000, // 2 seconds
      // Scroll persistence helpers
      scrollSaveThrottle: 50, // reduced to save more frequently
      lastScrollSave: 0,
    };
  },
  methods: {
    ...mapActions(home_page_store, ["fetchAllHomePageData"]),

    // Get section data by section_type
    get_section_headings_data(sectionType) {
      return (
        this.section_headings?.find(
          (item) => item.section_type === sectionType
        ) || null
      );
    },

    setupIntersectionObserver() {
      const options = {
        root: null,
        rootMargin: "150px",
        threshold: 0.1,
      };

      const observerCallback = (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const target = entry.target;

            switch (target) {
              case this.$refs.servicesSection:
                this.isServicesVisible = true;
                this.startSectionTimer("services");
                break;
              case this.$refs.whyChooseSection:
                this.isWhyChooseVisible = true;
                this.startSectionTimer("whyChoose");
                break;
              case this.$refs.principlesSection:
                this.isPrinciplesVisible = true;
                this.startSectionTimer("principles");
                break;
              case this.$refs.journeySection:
                this.isJourneyVisible = true;
                this.startSectionTimer("journey");
                break;
              case this.$refs.mediaSection:
                this.isMediaVisible = true;
                this.startSectionTimer("media");
                break;
              case this.$refs.donationSection:
                this.isDonationVisible = true;
                this.startSectionTimer("donation");
                break;
              case this.$refs.testimonialSection:
                this.isTestimonialVisible = true;
                this.startSectionTimer("testimonial");
                break;
              case this.$refs.newsSection:
                this.isNewsVisible = true;
                this.startSectionTimer("news");
                break;
            }

            // Unobserve after triggering to save resources
            this.observer.unobserve(target);
          }
        });
      };

      this.observer = new IntersectionObserver(observerCallback, options);
    },

    startSectionTimer(sectionName) {
      console.log(
        `Starting ${sectionName} skeleton timer for ${this.skeletonMinTime}ms`
      );
      setTimeout(() => {
        console.log(`${sectionName} skeleton timer completed`);
        this.sectionLoadingStates[sectionName] = false;
      }, this.skeletonMinTime);
    },

    observeElements() {
      const sections = [
        this.$refs.servicesSection,
        this.$refs.whyChooseSection,
        this.$refs.principlesSection,
        this.$refs.journeySection,
        this.$refs.mediaSection,
        this.$refs.donationSection,
        this.$refs.testimonialSection,
        this.$refs.newsSection,
      ];

      sections.forEach((section) => {
        if (section) {
          this.observer.observe(section);
        }
      });
    },

    // Persist scroll position across page reloads for this page
    saveScrollPosition() {
      try {
        sessionStorage.setItem(
          "home_scroll_pos",
          String(window.scrollY || window.pageYOffset || 0)
        );
      } catch (e) {
        // ignore storage errors
      }
    },

    // Simple restore (kept for backwards compatibility)
    restoreScrollPosition() {
      try {
        const pos = sessionStorage.getItem("home_scroll_pos");
        if (pos !== null) {
          let y = parseInt(pos, 10);
          if (!Number.isNaN(y)) {
            const maxScroll = Math.max(
              0,
              document.documentElement.scrollHeight - window.innerHeight
            );
            if (y > maxScroll) y = maxScroll;
            window.scrollTo({ top: y, behavior: "auto" });
          }
        }
      } catch (e) {
        // ignore
      }
    },

    // Robust restore that retries until layout stabilizes or max attempts reached
    restoreScrollPositionWithRetries() {
      try {
        const pos = sessionStorage.getItem("home_scroll_pos");
        if (pos === null) return;
        const yDesired = parseInt(pos, 10);
        if (Number.isNaN(yDesired)) return; // Allow 0 position

        console.log(`Attempting to restore scroll position to: ${yDesired}px`);

        const maxAttempts = 15; // reduced attempts to avoid conflicts
        const intervalMs = 150; // increased interval
        let attempts = 0;
        let timer;

        const attempt = () => {
          attempts++;

          const maxScroll = Math.max(
            0,
            document.documentElement.scrollHeight - window.innerHeight
          );
          const target = Math.min(Math.max(0, yDesired), maxScroll);
          const currentScroll = window.scrollY || window.pageYOffset || 0;

          // Only scroll if we're not already at the target
          if (Math.abs(currentScroll - target) > 5) {
            console.log(
              `Attempt ${attempts}: scrolling to ${target}px (current: ${currentScroll}px, max: ${maxScroll}px)`
            );
            window.scrollTo({ top: target, behavior: "auto" });
          }

          // Check if we're close enough or reached max attempts
          const newScroll = window.scrollY || window.pageYOffset || 0;
          if (Math.abs(newScroll - target) <= 5 || attempts >= maxAttempts) {
            console.log(
              `Scroll restore complete. Final position: ${newScroll}px`
            );
            if (timer) clearInterval(timer);
            return;
          }
        };

        // Single immediate attempt
        attempt();

        // Continue with interval only if needed
        if (attempts < maxAttempts) {
          timer = setInterval(attempt, intervalMs);

          // Ensure cleanup after max time
          setTimeout(() => {
            if (timer) clearInterval(timer);
          }, maxAttempts * intervalMs + 100);
        }
      } catch (e) {
        console.error("Error restoring scroll position:", e);
      }
    },

    visibilityChangeHandler() {
      if (document.visibilityState === "hidden") {
        this.saveScrollPosition();
      }
    },

    onScrollSave() {
      // Throttled save while user scrolls
      try {
        const now = Date.now();
        if (now - this.lastScrollSave > this.scrollSaveThrottle) {
          this.lastScrollSave = now;
          this.saveScrollPosition();
        }
      } catch (e) {
        // ignore
      }
    },

    enableScrollPersistence() {
      // Prevent browser automatic scroll restoration so we control it
      if ("scrollRestoration" in history) {
        try {
          history.scrollRestoration = "manual";
        } catch (e) {
          // ignore
        }
      }

      window.addEventListener("beforeunload", this.saveScrollPosition);
      window.addEventListener("unload", this.saveScrollPosition);
      document.addEventListener(
        "visibilitychange",
        this.visibilityChangeHandler
      );
      // Save during scroll (throttled) to keep position up-to-date
      window.addEventListener("scroll", this.onScrollSave, { passive: true });
      // Also restore after all resources load using the robust retrier
      window.addEventListener("load", this.restoreScrollPositionWithRetries);

      // Single immediate restore attempt
      this.restoreScrollPositionWithRetries();
    },
  },

  async created() {
    // Load critical data immediately
    await this.fetchAllHomePageData();
  },

  mounted() {
    // Setup intersection observer for lazy loading
    this.setupIntersectionObserver();
    this.$nextTick(() => {
      this.observeElements();
    });

    // Enable scroll persistence so reload keeps the same scroll position
    this.enableScrollPersistence();

    // Additional restore attempt after everything is mounted
    setTimeout(() => this.restoreScrollPositionWithRetries(), 300);
  },

  beforeUnmount() {
    // Cleanup observers
    if (this.observer) {
      this.observer.disconnect();
    }

    // Remove scroll persistence listeners
    window.removeEventListener("beforeunload", this.saveScrollPosition);
    window.removeEventListener("unload", this.saveScrollPosition);
    document.removeEventListener(
      "visibilitychange",
      this.visibilityChangeHandler
    );
    window.removeEventListener("scroll", this.onScrollSave);
    window.removeEventListener("load", this.restoreScrollPositionWithRetries);

    // Restore default browser behavior
    if ("scrollRestoration" in history) {
      try {
        history.scrollRestoration = "auto";
      } catch (e) {
        // ignore
      }
    }
  },

  computed: {
    ...mapState(home_page_store, [
      "section_headings",
      "banner",
      "services",
      "whyChoseUs",
      "principles",
      "ourJourney",
      "mediaCoverages",
      "comments",
      "news",
      "poll",
      "loading",
      "error",
    ]),

    // Section heading data computed properties
    serviceSection() {
      return this.get_section_headings_data("home_service");
    },
    whyChooseSection() {
      return this.get_section_headings_data("home_why_chose_us");
    },
    principleSection() {
      return this.get_section_headings_data("home_principles");
    },
    journeySection() {
      return this.get_section_headings_data("home_journey");
    },
    mediaSection() {
      return this.get_section_headings_data("home_media_coverage");
    },
    donationSection() {
      return this.get_section_headings_data("home_donation");
    },
    testimonialSection() {
      return this.get_section_headings_data("home_public_comments");
    },
    newsSection() {
      return this.get_section_headings_data("home_news");
    },
    bannerLoading() {
      const isLoading = this.loading || !this.banner;
      console.log("Index banner loading state:", {
        storeLoading: this.loading,
        hasBanner: !!this.banner,
        finalLoading: isLoading,
      });
      return isLoading;
    },
    shouldShowServicesSkeleton() {
      return (
        this.isServicesVisible &&
        (this.loading ||
          !this.services ||
          this.services.length === 0 ||
          this.sectionLoadingStates.services)
      );
    },
    shouldShowWhyChooseSkeleton() {
      return (
        this.isWhyChooseVisible &&
        (this.loading ||
          !this.whyChoseUs ||
          this.whyChoseUs.length === 0 ||
          this.sectionLoadingStates.whyChoose)
      );
    },
    shouldShowPrinciplesSkeleton() {
      return (
        this.isPrinciplesVisible &&
        (this.loading ||
          !this.principles ||
          this.principles.length === 0 ||
          this.sectionLoadingStates.principles)
      );
    },
    shouldShowJourneySkeleton() {
      return (
        this.isJourneyVisible &&
        (this.loading ||
          !this.ourJourney ||
          this.ourJourney.length === 0 ||
          this.sectionLoadingStates.journey)
      );
    },
    shouldShowMediaSkeleton() {
      return (
        this.isMediaVisible &&
        (this.loading ||
          !this.mediaCoverages ||
          this.sectionLoadingStates.media)
      );
    },
    shouldShowDonationSkeleton() {
      return (
        this.isDonationVisible &&
        (this.loading || this.sectionLoadingStates.donation)
      );
    },
    shouldShowTestimonialSkeleton() {
      return (
        this.isTestimonialVisible &&
        (this.loading ||
          !this.comments ||
          this.sectionLoadingStates.testimonial)
      );
    },
    shouldShowNewsSkeleton() {
      return (
        this.isNewsVisible &&
        (this.loading || !this.news || this.sectionLoadingStates.news)
      );
    },
  },
};
</script>

<style scoped>
.banner-skeleton,
.section-skeleton {
  height: 200px;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-loading 1.5s infinite;
  border-radius: 8px;
  margin: 20px 0;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #999;
  font-size: 16px;
}

@keyframes skeleton-loading {
  0% {
    background-position: 200% 0;
  }
  100% {
    background-position: -200% 0;
  }
}

/* Global image optimization */
:deep(img) {
  content-visibility: auto;
  contain-intrinsic-size: 300px 200px;
  transition: opacity 0.3s ease;
}

/* Optimize image containers */
:deep(.image-container) {
  position: relative;
  overflow: hidden;
}

/* Add loading states for images */
:deep(.image-loading) {
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-loading 1.5s infinite;
}

/* Section visibility animation */
.section-enter-active {
  transition: all 0.3s ease-out;
}

.section-enter-from {
  opacity: 0;
  transform: translateY(30px);
}

.section-enter-to {
  opacity: 1;
  transform: translateY(0);
}
</style>
