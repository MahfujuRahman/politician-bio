import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("volunteer_page", {
  state: () => ({
    section_headings: [],
    volunteer_applications: [],
    form_data: {
      first_name: '',
      last_name: '',
      email: '',
      phone_number: '',
      help_types: [],
      time_slots: [],
      week_days: [],
      comment: ''
    },

    loading: false,
    error: null,
    errors: {},
    success_message: null,
    is_submitting: false,
  }),
  
  getters: {
    has_validation_errors: (state) => Object.keys(state.errors).length > 0,
    is_form_valid: (state) => {
      return state.form_data.first_name.trim() !== '' &&
             state.form_data.last_name.trim() !== '' &&
             state.form_data.email.trim() !== '' &&
             state.form_data.phone_number.trim() !== '' &&
             state.form_data.help_types.length > 0 &&
             state.form_data.time_slots.length > 0 &&
             state.form_data.week_days.length > 0;
    }
  },

  actions: {
    _cache: {},
    _cacheKeyPrefix: "volunteer_page_cache_",
    async _isCacheValid(key) {
      // Try memory first, then Cache Storage
      let entry = this._cache[key];
      if (!entry && "caches" in window) {
        try {
          const cache = await caches.open(this._cacheKeyPrefix);
          const match = await cache.match(key);
          if (match) {
            entry = await match.json();
            this._cache[key] = entry;
          }
        } catch (e) {}
      }
      if (!entry) return false;
      const now = Date.now();
      return now - entry.timestamp < 600000;
    },
    async _setCache(key, data) {
      const entry = { data, timestamp: Date.now() };
      this._cache[key] = entry;
      if ("caches" in window) {
        try {
          const cache = await caches.open(this._cacheKeyPrefix);
          const response = new Response(JSON.stringify(entry), {
            headers: { "Content-Type": "application/json" },
          });
          await cache.put(key, response);
        } catch (e) {}
      }
    },
    async fetch_section_headings() {
      if (await this._isCacheValid("section_headings")) {
        this.section_headings = this._cache["section_headings"].data;
        return;
      }
      try {
        const res = await axios.get("section-headings",{
          params: {
            get_all: 1,
            limit: 1000,
          },
        });
        this.section_headings = res.data.data;
        await this._setCache("section_headings", res.data.data);
      } catch (e) {
        this.error = e;
      }
    },

    validate_form() {
      this.errors = {};
      let is_valid = true;

      // Required field validation
      if (!this.form_data.first_name.trim()) {
        this.errors.first_name = ['First name is required'];
        is_valid = false;
      }

      if (!this.form_data.last_name.trim()) {
        this.errors.last_name = ['Last name is required'];
        is_valid = false;
      }

      if (!this.form_data.email.trim()) {
        this.errors.email = ['Email is required'];
        is_valid = false;
      } else if (!this.is_valid_email(this.form_data.email)) {
        this.errors.email = ['Please enter a valid email address'];
        is_valid = false;
      }

      if (!this.form_data.phone_number.trim()) {
        this.errors.phone_number = ['Phone number is required'];
        is_valid = false;
      }

      if (this.form_data.help_types.length === 0) {
        this.errors.help_types = ['Please select at least one way you would like to help'];
        is_valid = false;
      }

      if (this.form_data.time_slots.length === 0) {
        this.errors.time_slots = ['Please select at least one time slot'];
        is_valid = false;
      }

      if (this.form_data.week_days.length === 0) {
        this.errors.week_days = ['Please select at least one day of the week'];
        is_valid = false;
      }

      return is_valid;
    },

    is_valid_email(email) {
      const email_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return email_regex.test(email);
    },

    async submit_volunteer_application() {
      this.is_submitting = true;
      this.error = null;
      this.errors = {};
      this.success_message = null;
      
      try {
        // Client-side validation
        if (!this.validate_form()) {
          this.is_submitting = false;
          return;
        }

        const response = await axios.post("/volunteer-applications/store", this.form_data);
        
        if (response.data.status === 'success') {
          this.success_message = "Your volunteer application has been submitted successfully! We will contact you soon.";
          this.reset_form();
        }
        
        return response.data;
      } catch (error) {
        if (error.response && error.response.status === 422) {
          // Validation errors from server
          this.errors = error.response.data.errors;
        } else {
          this.error = "An error occurred while submitting your application. Please try again.";
        }
        throw error;
      } finally {
        this.is_submitting = false;
      }
    },

    reset_form() {
      this.form_data = {
        first_name: '',
        last_name: '',
        email: '',
        phone_number: '',
        help_types: [],
        time_slots: [],
        week_days: [],
        comment: ''
      };
      this.errors = {};
    },

    update_form_field(field, value) {
      this.form_data[field] = value;
      // Clear field-specific error when user starts typing
      if (this.errors[field]) {
        delete this.errors[field];
      }
    },

    toggle_help_type(type) {
      const index = this.form_data.help_types.indexOf(type);
      if (index > -1) {
        this.form_data.help_types.splice(index, 1);
      } else {
        this.form_data.help_types.push(type);
      }
      // Clear help_types error when user makes a selection
      if (this.errors.help_types && this.form_data.help_types.length > 0) {
        delete this.errors.help_types;
      }
    },

    toggle_time_slot(slot) {
      const index = this.form_data.time_slots.indexOf(slot);
      if (index > -1) {
        this.form_data.time_slots.splice(index, 1);
      } else {
        this.form_data.time_slots.push(slot);
      }
      // Clear time_slots error when user makes a selection
      if (this.errors.time_slots && this.form_data.time_slots.length > 0) {
        delete this.errors.time_slots;
      }
    },

    toggle_week_day(day) {
      const index = this.form_data.week_days.indexOf(day);
      if (index > -1) {
        this.form_data.week_days.splice(index, 1);
      } else {
        this.form_data.week_days.push(day);
      }
      // Clear week_days error when user makes a selection
      if (this.errors.week_days && this.form_data.week_days.length > 0) {
        delete this.errors.week_days;
      }
    },

    clear_messages() {
      this.error = null;
      this.success_message = null;
      this.errors = {};
    },
  },
});
