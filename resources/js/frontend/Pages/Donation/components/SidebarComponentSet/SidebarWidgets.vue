<template>
  <div class="widget-area">
    <!-- Search -->
    <!-- Search -->
    <SidebarSearchWidget />
    <!-- Search -->
    <!-- Search -->

    <!-- Upcoming Events -->
    <!-- Upcoming Events -->
    <SidebarRecentPostsWidget />
    <!-- Upcoming Events -->
    <!-- Upcoming Events -->

    <!-- category -->
    <!-- category -->
    <SidebarArchiveWidget />
    <!-- category -->
    <!-- category -->

    <!-- Tag Cloud -->
    <!-- Tag Cloud -->
    <SidebarTagCloudWidget />
    <!-- Tag Cloud -->
    <!-- Tag Cloud -->

    <!-- Media Image -->
    <!-- Media Image -->
    <SidebarMediaImageWidget />
    <!-- Media Image -->
    <!-- Media Image -->
  </div>
</template>

<script>
import SidebarMediaImageWidget from "./SidebarMediaImageWidget.vue";
import SidebarSearchWidget from "./SidebarSearchWidget.vue";
import SidebarRecentPostsWidget from "./SidebarRecentPostsWidget.vue";
import SidebarTagCloudWidget from "./SidebarTagCloudWidget.vue";
import SidebarArchiveWidget from "./SidebarArchiveWidget.vue";

export default {
  name: "SidebarWidgets",
  components: {
    SidebarMediaImageWidget,
    SidebarSearchWidget,
    SidebarRecentPostsWidget,
    SidebarTagCloudWidget,
    SidebarArchiveWidget,
  },
};
</script>

<style scoped>
/* Add any widget-specific styles here if needed */
</style>
