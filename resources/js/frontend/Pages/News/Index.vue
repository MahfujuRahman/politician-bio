<template>
  <Head :title="event?.title" />

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
    :heading="'News'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'News', url: '/news' },
    ]"
    key="news"
  />
  <!-- banner section End here -->

  <!-- blog items Section Start Here -->
  <div ref="newsSection" data-section="news" class="issues-around-us-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title">
              {{ newsSection?.short_title || "Read Our Daily News" }}
            </h4>
            <p class="description wow animate__ animate__fadeInUp animated">
              {{
                newsSection?.title ||
                "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently."
              }}
            </p>
          </div>
        </div>
      </div>

      <!-- Skeleton or content -->
      <GenericSectionSkeleton
        v-if="shouldShowNewsSkeleton"
        layout="cards"
        :itemsCount="6"
        cardClass="col-lg-6 col-md-6 mb-4"
      />

      <div v-else-if="isNewsVisible" class="row">
        <div class="col-lg-8">
          <div class="row">
            <div
              class="col-lg-6 col-md-6"
              v-for="(item, idx) in news?.data?.data"
              :key="idx"
            >
              <NewsSingleItem :item="item" />
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="widget-area">
            <!-- Show current filter -->
            <div
              v-if="currentFilter.type === 'tag'"
              class="current-filter mb-3"
            >
              <span class="w-100 text-start current_filter_item">
                Filtered by tag:
                <span class="badge badge-danger text-white">{{
                  currentFilter.tag_name
                }}</span>
                <button
                  @click="clearFilter"
                  class="btn btn-outline-danger btn-sm p-1 ml-2 square-close-btn"
                >
                  ×
                </button>
              </span>
            </div>
            <!-- Search section -->
            <SearchSection />
            <!-- Search section -->
            <!-- Recent posts section -->
            <RecentPostSection v-if="recent_news" :news="recent_news" />
            <!-- Recent posts section -->

            <!-- Category section -->
            <CategorySection />
            <!-- Category section -->
            <!-- Tags section -->
            <TagsSection />
            <!-- Tags section -->
          </div>
        </div>
      </div>

      <div
        v-if="isNewsVisible && !shouldShowNewsSkeleton"
        class="row justify-content-center"
      >
        <div class="col-lg-8 col-md-10 col-12">
          <Pagination
            :currentPage="news?.data?.current_page || 1"
            :totalPages="news?.data?.last_page || 1"
            @prev="handlePageChange(news?.data?.current_page - 1)"
            @next="handlePageChange(news?.data?.current_page + 1)"
            @change="handlePageChange"
            :shape="'squer'"
          />
        </div>
      </div>
    </div>
  </div>
  <!-- blog Items Section Start Here -->
</template>
<script>
import { Link } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { usePageSkeleton } from "../../composables/usePageSkeleton.js";
import { ref, computed, onMounted, onUnmounted, nextTick } from "vue";

import Header from "../../Shared/Header.vue";
import NavbarArea from "../../CommonComponents/NavbarArea.vue";
import NewsSingleItem from "./components/NewsSingleItem.vue";
import RecentPostSection from "./components/RecentPostSection.vue";
import CommonBanner from "../../CommonComponents/CommonBanner.vue";
import CategorySection from "./components/CategorySection.vue";
import TagsSection from "./components/TagsSection.vue";
import SearchSection from "./components/SearchSection.vue";
import Pagination from "../../CommonComponents/Pagination.vue";

// Skeleton Components
import BannerSkeleton from "../../CommonComponents/Skeletons/BannerSkeleton.vue";
import GenericSectionSkeleton from "../../CommonComponents/Skeletons/GenericSectionSkeleton.vue";

import { mapActions, mapState } from "pinia";
import { store as news_store } from "./Store/news_store.js";

export default {
  props: {
    event: Object,
  },
  components: {
    NavbarArea,
    NewsSingleItem,
    RecentPostSection,
    CommonBanner,
    CategorySection,
    TagsSection,
    SearchSection,
    Pagination,
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
    const isNewsVisible = ref(false);

    // Section refs
    const newsSection = ref(null);

    // Initialize section states
    const sections = ["news"];
    initializeSectionStates(sections);

    let scrollCleanup = null;

    onMounted(async () => {
      // Setup intersection observer
      const sectionVisibility = {
        news: isNewsVisible,
      };

      setupIntersectionObserver(null, sectionVisibility);

      await nextTick();

      // Observe elements
      const elements = [newsSection.value];
      observeElements(elements);

      // Enable scroll persistence
      scrollCleanup = enableScrollPersistence("news");

      // Additional restore attempt after everything is mounted
      setTimeout(() => {
        if (scrollCleanup) {
          scrollCleanup();
          scrollCleanup = enableScrollPersistence("news");
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
      isNewsVisible,
      newsSection,
      shouldShowSkeleton,
    };
  },
  data() {
    return {
      current: 1,
    };
  },
  watched: {
    news: {
      handler(newVal) {
        console.log("newVal page updated to:", this.news);
        if (newVal && newVal.data && newVal.data.length > 0) {
          this.current = newVal.current_page || 1;
        }
      },
      immediate: true,
    },
  },
  methods: {
    ...mapActions(news_store, [
      "fetchAllNewsPageData",
      "goToPage",
      "filterByTag",
      "filterByCategory",
      "clearFilter",
    ]),
    get_section_headings_data(section_type) {
      return this.section_headings?.find(
        (section) => section.section_type === section_type
      );
    },
    handlePageChange(page) {
      console.log("Going to page:", page);
      if (page < 1 || page > (this.news.data.last_page || 1)) return;
      this.goToPage(page);
    },
  },
  async created() {
    this.loading = true;
    await this.fetchAllNewsPageData();
    this.loading = false;
  },
  computed: {
    ...mapState(news_store, [
      "news",
      "tags",
      "categories",
      "currentFilter",
      "recent_news",
      "section_headings",
    ]),
    newsSection() {
      return this.get_section_headings_data("news_news");
    },
    shouldShowBannerSkeleton() {
      return this.loading;
    },
    shouldShowNewsSkeleton() {
      return this.shouldShowSkeleton(
        this.isNewsVisible,
        computed(() => this.news?.data?.data),
        "news"
      ).value;
    },
  },
};
</script>

<style scoped>
.square-close-btn {
  width: 20px;
  height: 20px;
  border-radius: 0;
  font-size: 12px;
  line-height: 1;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 3px;
}
.current_filter_item {
  display: flex;
  justify-content: start;
  align-items: center;
  gap: 6px;
}
</style>
