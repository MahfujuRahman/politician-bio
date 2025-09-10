<template>
  <!--Start sidebar-wrapper-->
  <div id="sidebar-wrapper">
    <div class="brand-logo">
      <router-link
        :to="{ name: `adminDashboard` }"
        class="d-flex align-items-center"
      >
        <img
          :src="`${get_setting_value('image') ?? 'avatar.png'} `"
          class="logo-icon"
          alt="logo icon"
        />
        <h5 class="logo-text">Super Admin Panel</h5>
      </router-link>
      <div class="close-btn">
        <i class="zmdi zmdi-close" @click="toggle_menu"></i>
      </div>
    </div>

    <div class="text-center mt-3">
      <img
        class="rounded-circle p-1"
        height="70"
        width="70"
        :src="`${auth_info.image ?? 'avatar.png'}`"
        alt=""
      />
      <p class="mt-2">Mr. {{ auth_info.name }}</p>
    </div>
    <hr />
    <ul class="metismenu" id="menu">
      <!-- <li class="menu-label">Management</li> -->
      <li>
        <router-link
          :to="{ name: `adminDashboard` }"
          class="border"
          href="javascript:void();"
        >
          <div class="parent-icon">
            <i class="zmdi zmdi-view-dashboard"></i>
          </div>
          <div class="menu-title">Dashboard</div>
        </router-link>
      </li>
      <!-- Management start -->

      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`BannerManagement`"
        :menus="[
          {
            route_name: `AllBanner`,
            title: `Banner`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`WhyChoseUsManagement`"
        :menus="[
          {
            route_name: `AllWhyChoseUs`,
            title: `WhyChoseUs`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`MediaCoverageManagement`"
        :menus="[
          {
            route_name: `AllMediaCoverage`,
            title: `MediaCoverage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`ContributeManagement`"
        :menus="[
          {
            route_name: `AllContribute`,
            title: `Contribute`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`PublicCommentManagement`"
        :menus="[
          {
            route_name: `AllPublicComment`,
            title: `PublicComment`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`MissionVisionManagement`"
        :menus="[
          {
            route_name: `AllMissionVision`,
            title: `MissionVision`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`DonationDetailsManagement`"
        :menus="[
          {
            route_name: `AllDonationDetails`,
            title: `DonationDetails`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`OurJourneyManagement`"
        :menus="[
          {
            route_name: `AllOurJourney`,
            title: `OurJourney`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`HistoryTimelineManagement`"
        :menus="[
          {
            route_name: `AllHistoryTimeline`,
            title: `HistoryTimeline`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`OurPrinciplesManagement`"
        :menus="[
          {
            route_name: `AllOurPrinciples`,
            title: `OurPrinciples`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`OurSpeechesManagement`"
        :menus="[
          {
            route_name: `AllOurSpeeches`,
            title: `OurSpeeches`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`VolunteerManagement`"
        :menus="[
          {
            route_name: `AllVolunteer`,
            title: `Volunteer`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllVolunteerApplication`,
            title: `VolunteerApplication`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`GalaryManagement`"
        :menus="[
          {
            route_name: `AllGalleryCategory`,
            title: `GalleryCategory`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllImage`,
            title: `Image`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllVideo`,
            title: `Video`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`IssuesManagement`"
        :menus="[
          {
            route_name: `AllIssues`,
            title: `Issues`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`GetInvolvedManagement`"
        :menus="[
          {
            route_name: `AllGetInvolved`,
            title: `GetInvolved`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`ServicesManagement`"
        :menus="[
          {
            route_name: `AllServices`,
            title: `Services`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`ProjectPlaningManagement`"
        :menus="[
          {
            route_name: `AllProjectPlaning`,
            title: `ProjectPlaning`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`FaqManagement`"
        :menus="[
          {
            route_name: `AllFaq`,
            title: `Faq`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`EventManagement`"
        :menus="[
          {
            route_name: `AllSpeakers`,
            title: `Speakers`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllEventFacilities`,
            title: `EventFacilities`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllJoinEvent`,
            title: `JoinEvent`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllEvent`,
            title: `Event`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`NewsManagement`"
        :menus="[
          {
            route_name: `AllNewsCategory`,
            title: `NewsCategory`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllNews`,
            title: `News`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`ContactUsManagement`"
        :menus="[
          {
            route_name: `AllContactAddress`,
            title: `ContactAddress`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllContactPeople`,
            title: `ContactPeople`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`AboutUsManagement`"
        :menus="[
          {
            route_name: `AllAboutUs`,
            title: `AboutUs`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`CounterManagement`"
        :menus="[
          {
            route_name: `AllCounter`,
            title: `Counter`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`PollManagement`"
        :menus="[
          {
            route_name: `AllPoll`,
            title: `Poll`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllPollOption`,
            title: `PollOption`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`SectionHeadingManagement`"
        :menus="[
          {
            route_name: `HomePageSectionHeading`,
            title: `HomePage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AboutUsPageSectionHeading`,
            title: `AboutUsPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `DonationPageSectionHeading`,
            title: `DonationPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `HistoryPageSectionHeading`,
            title: `HistoryPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `PrinciplesPageSectionHeading`,
            title: `PrinciplesPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `TeamPageSectionHeading`,
            title: `TeamPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `GalleryPageSectionHeading`,
            title: `GalleryPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `MediaPageSectionHeading`,
            title: `MediaPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `IssuesPageSectionHeading`,
            title: `IssuesPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `VolunteerPageSectionHeading`,
            title: `VolunteerPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `ServicesPageSectionHeading`,
            title: `ServicesPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `ServicesDetailsPageSectionHeading`,
            title: `ServicesDetailsPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `FaqPageSectionHeading`,
            title: `FaqPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `EventPageSectionHeading`,
            title: `EventPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `EventDetailsPageSectionHeading`,
            title: `EventDetailsPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `NewsPageSectionHeading`,
            title: `NewsPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `NewsDetailsPageSectionHeading`,
            title: `NewsDetailsPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `ContactUsPageSectionHeading`,
            title: `ContactUsPage`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <!-- Management end -->
    </ul>
  </div>
</template>

<script>
//auth_store
import { auth_store } from "../../../../../GlobalStore/auth_store";
import { site_settings_store } from "../../../../../GlobalStore/site_settings_store";
import { mapState, mapActions } from "pinia";
//components
import SideBarDropDownMenus from "./SideBarDropDownMenus.vue";
import SideBarSingleMenu from "./SideBarSingleMenu.vue";
export default {
  components: { SideBarDropDownMenus, SideBarSingleMenu },
  methods: {
    ...mapActions(site_settings_store, {
      get_setting_value: "get_setting_value",
    }),

    logout_submit: function () {
      let confirm = window.confirm("logout");
      if (confirm) {
        this.log_out();
      }
    },
    toggle_menu: function () {
      document.getElementById("wrapper").classList.toggle("toggled");
    },
  },
  computed: {
    ...mapState(auth_store, {
      auth_info: "auth_info",
    }),
  },
};
</script>

<style></style>
<!-- <side-bar-drop-down-menus :icon="`fa fa-plus`" :icon_image="`https://files.etek.com.bd/images/icon_sales.png`"
    :menu_title="`title Management`" :menus="[
                {
                    route_name: `AllUser`,
                    title: `title`,
                    icon: `zmdi zmdi-dot-circle-alt`,
                },
            ]" /> -->
