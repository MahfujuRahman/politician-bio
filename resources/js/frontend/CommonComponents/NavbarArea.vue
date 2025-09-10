<template>
  <nav class="navbar navbar-area navbar-expand-lg nav-style-03 ">
    <div class="container nav-container home-five">
      <div class="responsive-mobile-menu">
        <div class="logo-wrapper">
          <Link href="/" class="logo">
            <img
              :src="'/' + getFirstSettingValueByTitle('header_logo')"
              alt="header logo"
          /></Link>
        </div>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#bizcoxx_main_menu"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
        <ul class="navbar-nav">
          <li class="menu-item-has-children">
            <Link href="/">Home</Link>
          </li>
          <li class="menu-item-has-children">
            <Link href="/about-us">About Us</Link>
          </li>
          <li class="menu-item-has-children">
           <Link href="/donation">Donation</Link>
          </li>
          <li class="menu-item-has-children">
            <a href="#">Pages</a>
            <ul class="sub-menu ">
              <li><Link href="/pages/history">History</Link></li>
              <li><Link href="/pages/principles">Principles</Link></li>
              <li><Link href="/pages/team">Team</Link></li>
              <li><Link href="/pages/gallery">Gallery</Link></li>
              <li><Link href="/pages/media">Media</Link></li>
              <li><Link href="/pages/issues">Issues</Link></li>
              <!-- <li><Link href="/pages/issues/details">Issues details</Link></li> -->
              <li><Link href="/pages/volunteer">Volunteer</Link></li>
              <li><Link href="/pages/services">Services</Link></li>
              <!-- <li><Link href="/pages/services/details">Services Single</Link></li> -->
              <li><Link href="/pages/faq">Help & Faq</Link></li>
              <!-- <li><Link href="/pages/comming-soon">Comming Soon</Link></li> -->
            </ul>
          </li>
          <li class="menu-item-has-children">
            <Link href="/events/event">Events</Link>
          </li>
          <li class="menu-item-has-children">
            <Link href="/news">News</Link>
          </li>
          <li class="menu-item-has-children">
            <Link href="/contact-us">Contact</Link>
          </li>
        </ul>
      </div>
      <div class="nav-right-content style-01">
        <div class="btn-wrapper">
          <Link href="/pages/volunteer" class="boxed-btn btn-sanatory style-04"
            >join now<i class="icon-paper-plan"></i
          ></Link>
        </div>
      </div>
    </div>
  </nav>
</template>
<script>
import { store as footerStore } from "../Shared/Store/footer_store.js";
import { mapActions, mapState } from "pinia";
import { Link } from "@inertiajs/vue3";
export default {
  created: async function () {
    await this.fetchAllFooterData();
    console.log("Fetched events:", this.events);

  },
  methods: {
    ...mapActions(footerStore, [
      "fetchAllFooterData",
      "fetch_events",
      "fetch_website_settings"
    ]),
    getSettingValuesByTitle(title) {
      if (
        !this.website_settings?.data ||
        typeof this.website_settings.data !== "object"
      ) {
        return [];
      }
      console.log("2nd title:", title);
      // Find the setting item with matching title in the object
      const settingItem = Object.values(this.website_settings.data).find(
        (item) => item.title === title
      );
      if (
        !settingItem ||
        !settingItem.setting_values ||
        !Array.isArray(settingItem.setting_values)
      ) {
        return [];
      }

      // Extract all values from setting_values array
      return settingItem.setting_values.map((setting) => setting.value);
    },

    getFirstSettingValueByTitle(title) {
      const values = this.getSettingValuesByTitle(title);
      return values.length > 0 ? values[0] : "";
    },
  },
  computed: {
    ...mapState(footerStore, ["events", "website_settings"]),
  },


};
</script>

