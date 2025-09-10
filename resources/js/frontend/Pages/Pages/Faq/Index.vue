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
    :heading="'Help & FAQ\'s'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Help & FAQ\'s', url: '/pages/faq' },
    ]"
    key="history"
  />
  <!-- banner section End here -->

  <!-- Help And Faq Section Start Here -->
  <section class="help-and-faq-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="help-single-item">
            <div class="content">
              <h4 class="title">
                {{ faqSection?.short_title || "Frequently Asked Questions" }}
              </h4>
              <p>
                {{
                  faqSection?.long_title ||
                  "Proin rutrum sem at rutrum ultrirecies. Nunc felis neque, dictum ut porta a, ullamcorper vel ante. Quisque none consequat."
                }}
              </p>
            </div>
          </div>
          <div class="icon-box-item-02">
            <div class="icon">
              <i class="far fa-envelope"></i>
            </div>
            <div class="content">
              <span class="title">Email</span>
              <p>{{ getFirstSettingValueByTitle("emails") }}</p>
            </div>
          </div>
          <div class="icon-box-item-02">
            <div class="icon">
              <i class="fas fa-phone-alt"></i>
            </div>
            <div class="content">
              <span class="title">Phone</span>
              <p>
                {{
                  getFirstSettingValueByTitle("phone_numbers") ||
                  "+1009-215-5599"
                }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="accordion-wrapper-three">
            <div id="accordion">
              <FaqCard
                v-for="(faq, idx) in faqs?.data"
                :key="idx"
                :faq="faq"
                :index="idx"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Help And Faq Section End Here -->
</template>

<script>

import Header from "../../../Shared/Header.vue";
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../../CommonComponents/CommonBanner.vue";
import FaqCard from "./components/FaqCard.vue";
import { store as faqs_store } from "./Store/faq_store.js";
import { mapActions, mapState } from "pinia";
export default {
  props: {
    event: Object,
  },
  components: {
    NavbarArea,
    CommonBanner,
    FaqCard,
    Header,
  },
  data() {
    return {
      faqList: [
        {
          id: "collapseOne",
          headerId: "headingOne",
          question: "Is this policy applicable globally?",
          answer: `No, ads cannot reference past, current, or proposed referenda Yes, this policy, enacted end November 2019, political policies. We will iterate on this new Privacy Policy to include. People can report content in the Twitter timeline or through this Help Cen.`,
        },
        {
          id: "collapseTwo",
          headerId: "headingTwo",
          question: "Are ads related to legislation or regulations allowed?",
          answer: `No, ads cannot reference past, current, or proposed referenda Yes, this policy, enacted end November 2019, political policies. We will iterate on this new Privacy Policy to include. People can report content in the Twitter timeline or through this Help Cen.`,
        },
        {
          id: "collapseThree",
          headerId: "headingThree",
          question: "Which ones does this new policy apply to?",
          answer: `No, ads cannot reference past, current, or proposed referenda Yes, this policy, enacted end November 2019, political policies. We will iterate on this new Privacy Policy to include. People can report content in the Twitter timeline or through this Help Cen.`,
        },
        {
          id: "collapseFour",
          headerId: "headingFour",
          question: "What types of ads can PACs and SuperPACs run?",
          answer: `No, ads cannot reference past, current, or proposed referenda Yes, this policy, enacted end November 2019, political policies. We will iterate on this new Privacy Policy to include. People can report content in the Twitter timeline or through this Help Cen.`,
        },
        {
          id: "collapseFive",
          headerId: "headingFive",
          question:
            "Are salutations or forms of allegiance to royalties allowed?",
          answer: `No, ads cannot reference past, current, or proposed referenda Yes, this policy, enacted end November 2019, political policies. We will iterate on this new Privacy Policy to include. People can report content in the Twitter timeline or through this Help Cen.`,
        },
        {
          id: "collapseSix",
          headerId: "headingSix",
          question:
            "Are references to political events allowed under this policy?",
          answer: `No, ads cannot reference past, current, or proposed referenda Yes, this policy, enacted end November 2019, political policies. We will iterate on this new Privacy Policy to include. People can report content in the Twitter timeline or through this Help Cen.`,
        },
        {
          id: "collapseSeven",
          headerId: "headingSeven",
          question:
            "Are references to political events allowed under this policy?",
          answer: `No, ads cannot reference past, current, or proposed referenda Yes, this policy, enacted end November 2019, political policies. We will iterate on this new Privacy Policy to include. People can report content in the Twitter timeline or through this Help Cen.`,
        },
        {
          id: "collapseEight",
          headerId: "headingEight",
          question:
            "Are references to political events allowed under this policy?",
          answer: `No, ads cannot reference past, current, or proposed referenda Yes, this policy, enacted end November 2019, political policies. We will iterate on this new Privacy Policy to include. People can report content in the Twitter timeline or through this Help Cen.`,
        },
      ],
    };
  },
  methods: {
    ...mapActions(faqs_store, ["fetchAllFaqsPageData"]),
    get_section_headings_data(section_type) {
      return this.section_headings?.find(
        (section) => section.section_type === section_type
      );
    },
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
  created: async function () {
    await this.fetchAllFaqsPageData();
    console.log(
      "FAQ page created, fetching data...",
      this.faqs,
      this.website_settings
    );
  },
  computed: {
    ...mapState(faqs_store, ["faqs", "website_settings", "section_headings"]),
    faqSection() {
      return this.get_section_headings_data("faq_faq");
    },
  },
};
</script>
