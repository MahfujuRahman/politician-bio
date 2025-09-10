<template>
  <nav
    class="navbar navbar-area style-01 d-lg-none d-md-block navbar-expand-lg nav-style-02"
  >
    <div class="container nav-container">
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
          data-target="#senatory_main_menu"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="senatory_main_menu">
        <!-- <ul class="navbar-nav political">
          <li class="menu-item-has-children current-menu-item">
            <a href="#">Home</a>
            <ul class="sub-menu">
              <li><a href="index.html">Home 01</a></li>
              <li><a href="index-02.html">Home 02</a></li>
              <li><a href="index-03.html">Home 03</a></li>
              <li><a href="index-04.html">Home 04</a></li>
              <li><a href="index-05.html">Home 05</a></li>
              <li><a href="index-06.html">Home 06</a></li>
            </ul>
            <div class="line">
              <span class="dot"></span>
              <span class="dot"></span>
              <span class="dot style-02"></span>
            </div>
          </li>
          <li class="menu-item-has-children">
            <Link href="/about-us">About Us</Link>
          </li>
          <li class="menu-item-has-children">
            <Link href="/donation">Donation</Link>
          </li>
          <li class="menu-item-has-children">
            <a href="#">Pages</a>
            <ul class="sub-menu">
              <li><Link href="/pages/history">History</Link></li>
              <li><Link href="principle.html">Principles</Link></li>
              <li><Link href="team.html">Team</Link></li>
              <li><Link href="team-two.html">Team Two</Link></li>
              <li><Link href="media.html">Media</Link></li>
              <li><Link href="issues.html">Issues</Link></li>
              <li><Link href="issue-two.html">Issues Two</Link></li>
              <li><Link href="issues-three.html">Issues Three</Link></li>
              <li><Link href="issues-single.html">Issues Single</Link></li>
              <li><Link href="issues-single-two.html">Issues Single Two</Link></li>
              <li><Link href="volunteer.html">Volunteer</Link></li>
              <li><Link href="services.html">Services</Link></li>
              <li><Link href="services-two.html">Services Two</Link></li>
              <li><Link href="services-single.html">Services Single</Link></li>
              <li><Link href="faq.html">Help & Faq</Link></li>
              <li><Link href="error.html">Error</Link></li>
              <li><Link href="comming-soon.html">Comming Soon</Link></li>
            </ul>
            <div class="line">
              <span class="dot"></span>
              <span class="dot"></span>
              <span class="dot style-02"></span>
            </div>
          </li>
          <li class="menu-item-has-children">
            <a href="#">Events</a>
            <ul class="sub-menu">
              <li><Link href="/events/event">Event</Link></li>
              <li><Link href="event-two.html">Event Two</Link></li>
              <li><Link href="event-three.html">Event Three</Link></li>
              <li><Link href="event-four.html">Event Four</Link></li>
              <li><Link href="event-five.html">Event Five</Link></li>
              <li><Link href="event-single.html">Event Single</Link></li>
              <li><Link href="event-single-two.html">Event Single Two</Link></li>
            </ul>
            <div class="line">
              <span class="dot"></span>
              <span class="dot"></span>
              <span class="dot style-02"></span>
            </div>
          </li>
          <li class="menu-item-has-children">
            <a href="#">News</a>
            <ul class="sub-menu">
              <li><Link href="/news/political">Political</Link></li>
              <li><a href="news-two.html">News Two</a></li>
              <li><a href="news-three.html">News Three</a></li>
              <li><a href="news-four.html">News Four</a></li>
              <li><a href="news-single.html">News Single</a></li>
            </ul>
            <div class="line style-01">
              <span class="dot"></span>
              <span class="dot"></span>
              <span class="dot style-02"></span>
            </div>
          </li>
          <li class="menu-item-has-children">
            <Link href="/contact-us">Contact</Link>
          </li>
        </ul> -->
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
            <ul class="sub-menu">
              <li><Link href="/pages/history">History</Link></li>
              <li><Link href="/pages/principles">Principles</Link></li>
              <li><Link href="/pages/team">Team</Link></li>
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
          <a href="#" class="boxed-btn political-btn"
            >Donate <i class="icon-paper-plan"></i
          ></a>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import { store as footerStore } from "./Store/footer_store.js";
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
