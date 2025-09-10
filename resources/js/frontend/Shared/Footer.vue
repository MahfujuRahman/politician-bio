<template>
  <footer
    class="footer-area line-bg"
    style="background-image: url(/frontend/assets/img/line.png)"
  >
    <div class="footer-top issue style-01">
      <div class="container">
        <div class="footer-top-border padding-bottom-60 padding-top-75">
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <div class="footer-widget widget">
                <div class="about_us_widget">
                  <Link href="/" class="footer-logo">
                    <img
                      :src="'/' + getFirstSettingValueByTitle('footer_logo')"
                      alt="footer logo"
                  /></Link>
                  <p>
                    {{ getFirstSettingValueByTitle('short_intro') }}
                  </p>
                  <div class="social-links">
                    <a :href="getFirstSettingValueByTitle('facebook')" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a :href="getFirstSettingValueByTitle('twitter')" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a :href="getFirstSettingValueByTitle('linkedin')" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    <a :href="getFirstSettingValueByTitle('youtube')" target="_blank"><i class="fab fa-youtube"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <ul class="contact_info_list">
                <li class="single-info-item">
                  <div class="icon">
                    <i class="icon-location"></i>
                  </div>
                  <div class="details style-01">
                    {{ getFirstSettingValueByTitle('address') || '1234 Street Name Demo, City, Demo' }}
                  </div>
                </li>
                <li class="single-info-item">
                  <div class="icon">
                    <i class="icon-envelope"></i>
                  </div>
                  <div class="details">{{ getFirstSettingValueByTitle('emails') || 'demo@yourmail.com' }}</div>
                </li>
                <li class="single-info-item">
                  <div class="icon">
                    <i class="icon-phone"></i>
                  </div>
                  <div class="details">{{ getFirstSettingValueByTitle('phone_numbers') || '009-215-5599' }}</div>
                </li>
              </ul>
            </div>
            <div class="col-lg-4 offset-lg-1 col-md-12">
              <div
                class="footer-widget widget widget_subscribe subscribe-bg"
                style="
                  background-image: url(/frontend/assets/img/Mask-flag.png);
                "
              >
                <div class="shape-01"></div>
                <div class="shape-02"></div>
                <div class="header-content">
                  <h4 class="title">Join Our Newsletter</h4>
                </div>

                <!-- Success Message with transition -->
                <transition name="fade">
                  <div
                    v-if="newsletterStore.successMessage"
                    class="alert alert-success mb-3"
                  >
                    {{ newsletterStore.successMessage }}
                  </div>
                </transition>

                <!-- General Error Message -->
                <div
                  v-if="newsletterStore.errors.general"
                  class="alert alert-danger mb-3"
                >
                  <div
                    v-for="error in newsletterStore.errors.general"
                    :key="error"
                  >
                    {{ error }}
                  </div>
                </div>

                <form class="subscribe-form" @submit.prevent="handleSubscribe">
                  <div class="form-group d-flex flex-column">
                    <input
                      v-model="newsletterStore.email"
                      type="email"
                      class="form-control"
                      :class="{ 'is-invalid': newsletterStore.errors.email }"
                      placeholder="Enter Email"
                      :disabled="newsletterStore.loading"
                    />
                    <!-- Email validation errors -->
                    <div
                      v-if="newsletterStore.errors.email"
                      class="invalid-feedback d-block text-white"
                    >
                      <div
                        v-for="error in newsletterStore.errors.email"
                        :key="error"
                      >
                        {{ error }}
                      </div>
                    </div>
                  </div>
                  <div class="btn-wrapper">
                    <button
                      type="submit"
                      class="boxed-btn btn-sanatory style-03"
                      :disabled="newsletterStore.loading"
                    >
                      <span v-if="newsletterStore.loading">
                        <i class="fas fa-spinner fa-spin"></i> Subscribing...
                      </span>
                      <span v-else>
                        Subscribe Now <i class="icon-paper-plan"></i>
                      </span>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-bottom-border">
          <div class="row">
            <div class="col-lg-2 col-md-6 col-sm-6 col-6">
              <div class="footer-widget widget widget_nav_menu">
                <h4 class="widget-title">
                  Explore
                  <span class="line">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot style-02"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                  </span>
                </h4>
                <ul>
                  <li><Link href="/pages/history">Our History</Link></li>
                  <li><Link href="/pages/team">Team</Link></li>
                  <li><Link href="/news">News</Link></li>
                  <li><Link href="/pages/principles">Principles</Link></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-6">
              <div class="footer-widget widget widget_nav_menu">
                <h4 class="widget-title">
                  Useful Links
                  <span class="line">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot style-02"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                  </span>
                </h4>
                <ul>
                  <li><Link href="/single/privacy-policy">Privacy Policy</Link></li>
                  <li><Link href="/single/terms-and-conditions">Terms and Conditions</Link></li>
                  <li><Link href="/pages/volunteer">Support</Link></li>
                  <li><Link href="/pages/faq">FAQ</Link></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-6">
              <div class="footer-widget widget widget_nav_menu">
                <h4 class="widget-title">
                  Quick Links
                  <span class="line">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot style-02"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                  </span>
                </h4>
                <ul>
                  <li><Link href="/about-us">About Us</Link></li>
                  <li><Link href="/pages/services">Services</Link></li>
                  <li><Link href="/contact-us">Contact</Link></li>
                  <li><Link href="/news">News</Link></li>
                </ul>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
              <div class="footer-widget widget widget_nav_menu">
                <h4 class="widget-title">
                  Events Campaigns
                  <span class="line">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot style-02"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                  </span>
                </h4>
                <FooterEventItem v-if="events && events.length" :events="events"  />
                
              </div>
            </div>
          </div>
        </div>
        <div class="copyright-area">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="copyright-area-inner">
                  Copyright © {{ getFirstSettingValueByTitle('copy_right') }}. All Rights Reserved .
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
import { useNewsletterStore } from "./Store/newsletter_store.js";
import { store as footerStore } from "./Store/footer_store.js";
import { mapActions, mapState } from "pinia";
import FooterEventItem from "./components/FooterEventItem.vue";
import { Link } from "@inertiajs/vue3";

export default {
  components: {
    FooterEventItem,
  },
  setup() {
    const newsletterStore = useNewsletterStore();

    const handleSubscribe = async () => {
      await newsletterStore.subscribe();
    };

    return {
      newsletterStore,
      handleSubscribe,
    };
  },
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

<style scoped>
.alert {
  padding: 10px 15px;
  margin-bottom: 15px;
  border: 1px solid transparent;
  border-radius: 4px;
  font-size: 14px;
  transition: opacity 0.5s ease-out, transform 0.5s ease-out;
}

.alert-success {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
}

.alert-danger {
  color: #721c24;
  background-color: #f8d7da;
  border-color: #f5c6cb;
}

/* Fade out animation for success message */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-enter-from {
  opacity: 0;
  transform: translateY(-10px);
}

.fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

.is-invalid {
  border-color: #dc3545 !important;
}

.invalid-feedback {
  display: block;
  width: 100%;
  margin-top: 5px;
  font-size: 12px;
  color: #dc3545;
}

.form-control:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.btn-sanatory:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  pointer-events: none;
}

.fa-spinner {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
</style>
