import axios from "axios";
import { defineStore } from "pinia";
export const site_settings_store = defineStore("site_settings_store", {
    state: () => ({
        website_settings_data: [],
        is_true: false,
    }),

    actions: {
        async get_all_website_settings() {
            if (this.is_true) {
                return ;
            }
            this.is_true = true; // Prevent multiple calls
            try {
                const response = await axios.get(
                    "/website-settings?get_all=1&limit=100"
                );
                this.website_settings_data = Array.isArray(response.data?.data)
                    ? response.data.data
                    : Object.values(response.data.data); // Ensure it's an array
                
                // Update CSS variables after loading settings
                this.updateCSSVariables();
            } catch (error) {
                console.error("Error fetching website settings:", error);
                this.website_settings_data = [];
            }
        },

        /**
         * Get a setting value by key from website_settings_data.
         * @param {string} key - The key to search for in the settings.
         * @param {boolean} multiple - Whether to return multiple values or a single value.
         * @returns {Array|string} - Returns an array of values if `multiple` is true; otherwise, returns a single value or an empty string.
         */
        get_setting_value(key, multiple = false) {
            if (!Array.isArray(this.website_settings_data)) {
                console.warn("Website settings data is not an array.");
                return multiple ? [] : "";
            }

            try {
                if (multiple) {
                    const values = this.website_settings_data.filter(
                        (item) => item.title === key
                    );
                    return values.length > 0 ? values[0].setting_values : [];
                } else {
                    const value = this.website_settings_data.find(
                        (item) => item.title === key
                    );
                    return value?.setting_values?.[0]?.value || "";
                }
            } catch (error) {
                console.error("Error fetching setting value:", error);
                return multiple ? [] : "";
            }
        },

        // Method to update CSS variables directly
        updateCSSVariables() {
            if (typeof document === 'undefined') return; // For SSR compatibility
            
            const root = document.documentElement;
            const mainColorOne = this.get_setting_value('main_color_one') || '#DD131A';
            const mainColorTwo = this.get_setting_value('main_color_two') || '#000565';
            const secondaryColor = this.get_setting_value('secondary_color') || '#0E115A';
            const headingColor = this.get_setting_value('heading_color') || '#04072E';
            const paragraphColor = this.get_setting_value('paragraph_color') || '#727777';

            root.style.setProperty('--main-color-one', mainColorOne);
            root.style.setProperty('--main-color-two', mainColorTwo);
            root.style.setProperty('--secondary-color', secondaryColor);
            root.style.setProperty('--heading-color', headingColor);
            root.style.setProperty('--paragraph-color', paragraphColor);
        },
    },
});
