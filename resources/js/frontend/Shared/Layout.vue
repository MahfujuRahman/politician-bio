<template>
  <div>
    <!-- <Header /> -->
    <div class="main-wrapper">
      <slot />
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import { store as section_headings_store } from "./Store/section_headings_store";
import { site_settings_store } from "../../backend/GlobalStore/site_settings_store";
import { mapActions, mapState } from "pinia";

export default {
  name: "Layout",
  components: { Header, Footer },

  computed: {
    ...mapState(site_settings_store, ["website_settings_data"]),
  },

  methods: {
    ...mapActions(section_headings_store, ["fetch_section_headings"]),
    ...mapActions(site_settings_store, [
      "get_all_website_settings",
      "get_setting_value",
      "updateCSSVariables",
    ]),

    // Local method to update CSS variables
    updateThemeColors() {
      const root = document.documentElement;
      const mainColorOne =
        this.get_setting_value("main_color_one") || "#DD131A";
      const mainColorTwo =
        this.get_setting_value("main_color_two") || "#000565";
      const secondaryColor =
        this.get_setting_value("secondary_color") || "#0E115A";
      const headingColor =
        this.get_setting_value("heading_color") || "#000565";
      const paragraphColor =
        this.get_setting_value("paragraph_color") || "#0E115A";

      root.style.setProperty("--main-color-one", mainColorOne);
      root.style.setProperty("--main-color-two", mainColorTwo);
      root.style.setProperty("--secondary-color", secondaryColor);
      root.style.setProperty("--heading-color", headingColor);
      root.style.setProperty("--paragraph-color", paragraphColor);
    },
  },

  async created() {
    await this.get_all_website_settings();
    // Update theme colors after settings are loaded
    this.$nextTick(() => {
      this.updateThemeColors();
    });
    // await this.fetch_section_headings();
  },

  watch: {
    website_settings_data: {
      handler() {
        this.$nextTick(() => {
          this.updateThemeColors();
        });
      },
      deep: true,
    },
  },
};
</script>

<style></style>
