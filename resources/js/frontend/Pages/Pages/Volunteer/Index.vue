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
    :heading="'Volunteer'"
    :breadcrumbs="[
      { text: 'Home', url: '/' },
      { text: 'Volunteer', url: '/pages/volunteer' },
    ]"
    key="volunteer"
  />
  <!-- banner section End here -->

  <!-- Volunteer Form Section Start Here -->
  <div class="volunteer-section-area style-03">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title volunteer wow animate__animated animate__fadeInUp">
              {{ volunteerGetInvolvedSection?.short_title || "Get Involved!" }}
            </h4>
            <p
              class="description style-03 wow animate__animated animate__fadeInUp"
            >
              {{
                volunteerGetInvolvedSection?.long_title ||
                "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently."
              }}
            </p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="volunteer-form">
            <!-- Success Message -->
            <div
              v-if="success_message"
              class="alert alert-success"
              role="alert"
            >
              {{ success_message }}
            </div>

            <!-- General Error Message -->
            <div v-if="error" class="alert alert-danger" role="alert">
              {{ error }}
            </div>

            <!-- Validation Error Messages -->
            <div
              v-if="has_validation_errors"
              class="alert alert-danger"
              role="alert"
            >
              <ul class="mb-0">
                <li v-for="(error, field) in errors" :key="field">
                  {{ error[0] }}
                </li>
              </ul>
            </div>

            <form @submit.prevent="submit_form" class="contact-page-form">
              <div class="contact-form style-01">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="text"
                        :value="form_data.first_name"
                        @input="
                          update_form_field('first_name', $event.target.value)
                        "
                        placeholder="First Name*"
                        class="form-control"
                        :class="{ 'is-invalid': errors.first_name }"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="text"
                        :value="form_data.last_name"
                        @input="
                          update_form_field('last_name', $event.target.value)
                        "
                        placeholder="Last Name*"
                        class="form-control"
                        :class="{ 'is-invalid': errors.last_name }"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="email"
                        :value="form_data.email"
                        @input="update_form_field('email', $event.target.value)"
                        placeholder="Email*"
                        class="form-control"
                        :class="{ 'is-invalid': errors.email }"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="text"
                        :value="form_data.phone_number"
                        @input="
                          update_form_field('phone_number', $event.target.value)
                        "
                        placeholder="Phone Number*"
                        class="form-control"
                        :class="{ 'is-invalid': errors.phone_number }"
                        required
                      />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-question">
                <h6 class="title">How would you like to help?</h6>
                <div class="check-box-wrapper">
                  <div class="check-box">
                    <label class="container-box">
                      Telephone Calls
                      <input
                        type="checkbox"
                        :checked="
                          form_data.help_types.includes('Telephone Calls')
                        "
                        @change="toggle_help_type('Telephone Calls')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box">
                    <label class="container-box">
                      Distribute Signs
                      <input
                        type="checkbox"
                        :checked="
                          form_data.help_types.includes('Distribute Signs')
                        "
                        @change="toggle_help_type('Distribute Signs')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box style-01">
                    <label class="container-box">
                      Voter Registration
                      <input
                        type="checkbox"
                        :checked="
                          form_data.help_types.includes('Voter Registration')
                        "
                        @change="toggle_help_type('Voter Registration')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box">
                    <label class="container-box">
                      Other
                      <input
                        type="checkbox"
                        :checked="form_data.help_types.includes('Other')"
                        @change="toggle_help_type('Other')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-question">
                <h6 class="title">What time slots work best for you?</h6>
                <div class="check-box-wrapper">
                  <div class="check-box">
                    <label class="container-box">
                      Morning
                      <input
                        type="checkbox"
                        :checked="form_data.time_slots.includes('Morning')"
                        @change="toggle_time_slot('Morning')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box">
                    <label class="container-box">
                      Afternoon
                      <input
                        type="checkbox"
                        :checked="form_data.time_slots.includes('Afternoon')"
                        @change="toggle_time_slot('Afternoon')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box">
                    <label class="container-box">
                      Evening
                      <input
                        type="checkbox"
                        :checked="form_data.time_slots.includes('Evening')"
                        @change="toggle_time_slot('Evening')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-question">
                <h6 class="title">Which days are you available?</h6>
                <div class="check-box-wrapper">
                  <div class="check-box">
                    <label class="container-box">
                      Sun
                      <input
                        type="checkbox"
                        :checked="form_data.week_days.includes('Sunday')"
                        @change="toggle_week_day('Sunday')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box">
                    <label class="container-box">
                      Mon
                      <input
                        type="checkbox"
                        :checked="form_data.week_days.includes('Monday')"
                        @change="toggle_week_day('Monday')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box">
                    <label class="container-box">
                      Tue
                      <input
                        type="checkbox"
                        :checked="form_data.week_days.includes('Tuesday')"
                        @change="toggle_week_day('Tuesday')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box">
                    <label class="container-box">
                      Wed
                      <input
                        type="checkbox"
                        :checked="form_data.week_days.includes('Wednesday')"
                        @change="toggle_week_day('Wednesday')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box">
                    <label class="container-box">
                      Thu
                      <input
                        type="checkbox"
                        :checked="form_data.week_days.includes('Thursday')"
                        @change="toggle_week_day('Thursday')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box">
                    <label class="container-box">
                      Fri
                      <input
                        type="checkbox"
                        :checked="form_data.week_days.includes('Friday')"
                        @change="toggle_week_day('Friday')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="check-box">
                    <label class="container-box">
                      Sat
                      <input
                        type="checkbox"
                        :checked="form_data.week_days.includes('Saturday')"
                        @change="toggle_week_day('Saturday')"
                      />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-question">
                <h6 class="title">Additional comments</h6>
                <div class="col-md-12 p-0">
                  <div class="form-group">
                    <textarea
                      :value="form_data.comment"
                      @input="update_form_field('comment', $event.target.value)"
                      class="form-control"
                      rows="3"
                      placeholder="type here...."
                    ></textarea>
                  </div>
                </div>
              </div>

              <div class="btn-wrapper">
                <button
                  type="submit"
                  class="boxed-btn btn-sanatory volunteer"
                  :disabled="is_submitting"
                >
                  <i class="fas fa-arrow-right"></i>
                  {{ is_submitting ? "Submitting..." : "Join Our Team" }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Volunteer Form Section End Here -->
</template>

<script>

import Header from "../../../Shared/Header.vue";
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../../CommonComponents/CommonBanner.vue";
import { mapActions, mapState } from "pinia";
import { store } from "./Store/volunteer_store.js";

export default {
  components: {
    NavbarArea,
    CommonBanner,
    Header,
  },

  computed: {
    ...mapState(store, [
      "form_data",
      "errors",
      "error",
      "success_message",
      "is_submitting",
      "has_validation_errors",
      "section_headings",
    ]),
    volunteerGetInvolvedSection() {
      return this.get_section_headings_data("volunteer_get_involved");
    },
  },

  methods: {
    ...mapActions(store, [
      "submit_volunteer_application",
      "update_form_field",
      "toggle_help_type",
      "toggle_time_slot",
      "toggle_week_day",
      "clear_messages",
      "fetch_section_headings",
    ]),
    get_section_headings_data(section_type) {
      return this.section_headings?.find(
        (section) => section.section_type === section_type
      );
    },
    async submit_form() {
      try {
        await this.submit_volunteer_application();
      } catch (error) {
        // Error handling is done in the store
        console.error("Form submission error:", error);
      }
    },
  },

  mounted() {
    // Clear any existing messages when component mounts
    this.clear_messages();
    // Fetch section headings for dynamic content
    this.fetch_section_headings();
  },
};
</script>
