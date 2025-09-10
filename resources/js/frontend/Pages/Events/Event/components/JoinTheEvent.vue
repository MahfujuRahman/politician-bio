<template>
  <div
    class="contact-page-wrapper style-01 wow animate__ animate__fadeInRight animated"
    style="visibility: visible; animation-name: fadeInRight"
  >
    <div
      class="contact-form contact-bg"
      style="background-image: url(/frontend/assets/img/contact-bg.png)"
    >
      <div class="content desktop-center">
        <img
          src="/frontend/assets/img/circle-02.png"
          class="title-shape style-01"
          alt=""
        />
        <h6 class="title">{{ title || "Join the event" }}</h6>
      </div>
      <form
        @submit.prevent="submitForm"
        class="contact-page-form"
        novalidate="novalidate"
      >
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <input
                type="text"
                name="fname"
                v-model="formData.name"
                placeholder="Name"
                class="form-control"
                :class="{ 'is-invalid': errors.name }"
                required
                aria-required="true"
              />
              <div v-if="errors.name" class="invalid-feedback text-white">
                {{ errors.name[0] }}
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <input
                type="email"
                name="lname"
                v-model="formData.email"
                placeholder="Email"
                class="form-control"
                :class="{ 'is-invalid': errors.email }"
                required
                aria-required="true"
              />
              <div v-if="errors.email" class="invalid-feedback text-white">
                {{ errors.email[0] }}
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <input
                type="tel"
                name="phone"
                v-model="formData.mobile_number"
                placeholder="Mobile No"
                class="form-control"
                :class="{ 'is-invalid': errors.mobile_number }"
                required
                aria-required="true"
              />
              <div
                v-if="errors.mobile_number"
                class="invalid-feedback text-white"
              >
                {{ errors.mobile_number[0] }}
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <textarea
                name="comment"
                v-model="formData.comment"
                placeholder="comment"
                class="form-control w-100"
                :class="{ 'is-invalid': errors.comment }"
                aria-required="true"
              ></textarea>
              <div v-if="errors.comment" class="invalid-feedback text-white">
                {{ errors.comment[0] }}
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="btn-wrapper desktop-center">
              <button
                type="submit"
                class="boxed-btn political-btn style-01"
                :disabled="isSubmitting"
              >
                {{ isSubmitting ? "JOINING..." : "JOIN NOW" }}
                <i class="icon-paper-plan"></i>
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  props: {
    event_id: {
      type: Number,
      required: true,
    },
    title: {
      type: String,
      default: "Join the event",
    },
  },
  name: "JoinTheEvent",
  data() {
    return {
      formData: {
        event_id: this.event_id,
        name: "",
        email: "",
        mobile_number: "",
        comment: "",
      },
      isSubmitting: false,
      errors: {},
    };
  },
  methods: {
    async submitForm() {
      try {
        this.isSubmitting = true;
        this.errors = {}; // Clear previous errors

        const response = await axios.post("join-events/store", this.formData);

        if (response.data.status === "success") {
          // Show success message
          alert("Successfully joined the event!");
          // Reset form
          this.resetForm();
        } else {
          alert("Error joining event. Please try again.");
        }
      } catch (error) {
        console.error("Error submitting form:", error);

        if (error.response && error.response.status === 422) {
          // Handle validation errors
          this.errors = error.response.data.errors || {};
        } else {
          alert("Error joining event. Please try again.");
        }
      } finally {
        this.isSubmitting = false;
      }
    },
    resetForm() {
      this.formData = {
        event_id: this.event_id,
        name: "",
        email: "",
        mobile_number: "",
        comment: "",
      };
      this.errors = {};
    },
  },
};
</script>
