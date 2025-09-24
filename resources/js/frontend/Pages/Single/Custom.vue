<template>
    <div>
        <Header />
        <!-- Navbar area Start -->
        <template class="d-lg-block">
            <NavbarArea />
        </template>
        <!-- navbar area end -->

        <!-- banner section start here -->
        <BannerSkeleton v-if="shouldShowBannerSkeleton" />
        <common-banner v-else-if="customPageData" :background-image="customPageData?.image ? `/${customPageData.image}` : '/frontend/assets/img/about-bg.png'
            " :heading="customPageData?.title || 'Custom Page'" :breadcrumbs="[
        { text: 'Home', url: '/' },
        { text: customPageData?.title || 'Custom Page', url: `/pages/custom/${slug}` },
    ]" :key="slug" />
        <common-banner v-else :background-image="'/frontend/assets/img/about-bg.png'" :heading="'Custom Page'"
            :breadcrumbs="[
                { text: 'Home', url: '/' },
                { text: 'Custom Page', url: `/pages/custom/${slug}` },
            ]" :key="`fallback-${slug}`" />
        <!-- banner section End here -->

        <!-- Custom Page Content Section Start Here -->
        <div ref="contentSection" data-section="content">
            <GenericSectionSkeleton v-if="shouldShowContentSkeleton" layout="default" />
            <div v-else-if="isContentVisible && customPageData">
                <div v-html="customPageData.description"></div>
            </div>
        </div>
        <!-- Custom Page Content Section End Here -->

        <!-- Error State -->
        <section v-if="error && !loading" class="error-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto text-center">
                        <h2 class="mb-3">Page Not Found</h2>
                        <p class="lead">The custom page you're looking for doesn't exist.</p>
                        <a href="/" class="btn btn-primary">Go Back to Home</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { usePageSkeleton } from "../../composables/usePageSkeleton.js";
import { ref, computed, onMounted, onUnmounted, nextTick, watch } from "vue";

import Header from "../../Shared/Header.vue";
import NavbarArea from "../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../CommonComponents/CommonBanner.vue";

// Skeleton Components
import BannerSkeleton from "../../CommonComponents/Skeletons/BannerSkeleton.vue";
import GenericSectionSkeleton from "../../CommonComponents/Skeletons/GenericSectionSkeleton.vue";

import { mapActions, mapState } from "pinia";
import { store as custom_page_store } from "./Store/custom_page_store.js";

export default {
    props: {
        slug: {
            type: String,
            required: true,
        },
        event: Object,
    },
    components: {
        Header,
        NavbarArea,
        CommonBanner,
        BannerSkeleton,
        GenericSectionSkeleton,
    },
    setup(props) {
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
        const isContentVisible = ref(false);

        // Section refs
        const contentSection = ref(null);

        // Initialize section states
        const sections = ["content"];
        initializeSectionStates(sections);

        let scrollCleanup = null;

        onMounted(async () => {
            // Setup intersection observer
            const sectionVisibility = {
                content: isContentVisible,
            };

            setupIntersectionObserver(null, sectionVisibility);

            await nextTick();

            // Observe elements
            const elements = [contentSection.value];
            observeElements(elements);

            // Enable scroll persistence
            scrollCleanup = enableScrollPersistence(`custom-${props.slug}`);

            // Additional restore attempt after everything is mounted
            setTimeout(() => {
                if (scrollCleanup) {
                    scrollCleanup();
                    scrollCleanup = enableScrollPersistence(`custom-${props.slug}`);
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
            isContentVisible,
            contentSection,
            shouldShowSkeleton,
        };
    },
    methods: {
        ...mapActions(custom_page_store, ["fetchCustomPageBySlug", "clearCustomPageData"]),
    },
    computed: {
        ...mapState(custom_page_store, ["customPageData", "error"]),
        shouldShowBannerSkeleton() {
            return this.loading && !this.customPageData;
        },
        shouldShowContentSkeleton() {
            return this.shouldShowSkeleton(
                this.isContentVisible,
                computed(() => this.customPageData),
                "content"
            ).value;
        },
    },
    watch: {
        slug: {
            immediate: true,
            async handler(newSlug) {
                if (newSlug) {
                    this.clearCustomPageData();
                    this.loading = true;
                    await this.fetchCustomPageBySlug(newSlug);
                    this.loading = false;
                }
            },
        },
    },
    async created() {
        if (this.slug) {
            this.loading = true;
            await this.fetchCustomPageBySlug(this.slug);
            this.loading = false;
        }
    },
    beforeUnmount() {
        this.clearCustomPageData();
    },
};
</script>

<style scoped>
.custom-page-section h1 {
    font-size: 32px;
    font-weight: 700;
    color: #333;
}

.custom-page-image {
    text-align: center;
}

.custom-page-image img {
    max-height: 400px;
    object-fit: cover;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.custom-page-content {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
}

.custom-page-content :deep(h1),
.custom-page-content :deep(h2),
.custom-page-content :deep(h3),
.custom-page-content :deep(h4),
.custom-page-content :deep(h5),
.custom-page-content :deep(h6) {
    color: #333;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.custom-page-content :deep(p) {
    margin-bottom: 1rem;
}

.custom-page-content :deep(ul),
.custom-page-content :deep(ol) {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.custom-page-content :deep(li) {
    margin-bottom: 0.5rem;
}

.custom-page-content :deep(img) {
    max-width: 100%;
    height: auto;
    margin: 1rem 0;
    border-radius: 4px;
}

.custom-page-content :deep(blockquote) {
    border-left: 4px solid #007bff;
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 4px;
}

.error-section {
    background-color: #f8f9fa;
}

.error-section h2 {
    color: #dc3545;
}

.error-section .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.error-section .btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}
</style>
