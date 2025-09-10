<template>

  <Header />
  <!-- Navbar area Start -->
  <template class="d-lg-block">
    <NavbarArea />
  </template>
  <!-- navbar area end -->
  <!-- banner section start here -->
  <common-banner
    :background-image="'/frontend/assets/img/about-bg.png'"
    :heading="'Our Team'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Our Team', url: '/pages/team' },
    ]"
    key="team"
  />
  <!-- banner section End here -->

  <!-- Volunteer Team Section Start here -->
  <team-section-area
    v-if="volunteers"
    :volunteers="volunteers?.data"
    :short_title="teamVolunteerSection?.short_title"
    :long_title="teamVolunteerSection?.long_title"
  />
  <!-- Volunteer Team Section Start here -->

  <!-- Pagination -->
  <!-- Pagination -->
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-12">
      <Pagination
        :currentPage="volunteers?.data?.current_page || 1"
        :totalPages="volunteers?.data?.last_page || 1"
        @prev="goToPage(volunteers?.data?.current_page - 1)"
        @next="goToPage(volunteers?.data?.current_page + 1)"
        @change="goToPage"
      />
    </div>
  </div>
  <!-- Pagination -->
  <!-- Pagination -->

  <!-- Counter Section Start -->
  <at-a-glance v-if="counters" :counters="counters" />
  <!-- Counter Section End -->
</template>
<script>

import Header from "../../../Shared/Header.vue";
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../../CommonComponents/CommonBanner.vue";
import AtAGlance from "../../../GlobalComponent/AtAGlance.vue";
import TeamSectionArea from "./components/TeamSectionArea.vue";
import Pagination from "../../../CommonComponents/Pagination.vue";
import { Head } from "@inertiajs/vue3";

import { mapActions, mapState } from "pinia";
import { store as team_store } from "./Store/team_store.js";

export default {
  components: {
    NavbarArea,
    CommonBanner,
    AtAGlance,
    TeamSectionArea,
    Pagination,
    Head,
  },
  watched: {
    volunteers: {
      handler(newVal) {
        console.log("newVal page updated to:", this.volunteers);
        if (newVal && newVal.data && newVal.data.length > 0) {
          this.current = newVal.current_page || 1;
        }
      },
      immediate: true,
    },
  },
  methods: {
    ...mapActions(team_store, ["fetchAllTeamPageData"]),
    get_section_headings_data(section_type) {
      return this.section_headings?.find(
        (section) => section.section_type === section_type
      );
    },
    goToPage(page) {
      console.log("Going to page:", page);
      if (page < 1 || page > (this.volunteers.data.last_page || 1)) return;
      this.fetchAllTeamPageData({ page });
    },
  },
  created: async function () {
    await this.fetchAllTeamPageData();
  },
  computed: {
    ...mapState(team_store, ["volunteers", "counters", "section_headings"]),
    teamVolunteerSection() {
      return this.get_section_headings_data("team_volunteer");
    },
  },
};
</script>
