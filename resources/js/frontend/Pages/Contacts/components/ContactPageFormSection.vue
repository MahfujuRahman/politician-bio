<template>
  <div
    class="contact-page-form-section contact-form-bg"
    :style="{ backgroundImage: 'url(' + bgImage + ')' }"
  >
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="contact-item-wrapper">
            <img :src="ellipse02" class="contact-shape" alt="" />
            <img :src="ellipse03" class="contact-shape-02" alt="" />
            <img :src="ellipse04" class="contact-shape-03" alt="" />
            <img :src="ellipse05" class="contact-shape-04" alt="" />
            <div class="row align-items-center">
              <div class="col-lg-5">
                <div class="contact-single-item">
                  <div class="content">
                    <h4 class="title wow animate__animated animate__fadeInUp">
                      <slot name="headline"
                        >Thanks for your interest in Senatory</slot
                      >
                    </h4>
                    <p class="wow animate__animated animate__fadeInUp">
                      <slot name="subtext"
                        >The circumstances get murkier with both sides trying
                        every trick to ensure their victory in upcoming.</slot
                      >
                    </p>
                  </div>
                  <div class="thumb">
                    <img :src="contactThumb" alt="" />
                  </div>
                </div>
              </div>
              <div class="col-lg-7">
                <div class="contact-page-wrapper style-03">
                  <div
                    class="contact-form contact-bg style-01"
                    :style="{ backgroundImage: 'url(' + formBg + ')' }"
                  >
                    <div class="content desktop-center">
                      <img
                        :src="circle02"
                        class="title-shape style-02"
                        alt=""
                      />
                      <h6 class="title">
                        <slot name="formTitle">Contact Now</slot>
                      </h6>
                    </div>
                    <form
                      @submit.prevent="onSubmit"
                      class="contact-page-form"
                      novalidate
                    >
                      <!-- Success Message -->
                      <div
                        v-if="successMessage"
                        class="alert alert-success mb-3"
                      >
                        {{ successMessage }}
                      </div>

                      <!-- General Error Message -->
                      <div
                        v-if="errors.general"
                        class="alert alert-danger mb-3"
                      >
                        {{ errors.general[0] }}
                      </div>

                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                            <input
                              type="text"
                              v-model="form.firstName"
                              placeholder="First Name*"
                              class="form-control"
                              :class="{ 'is-invalid': errors.first_name }"
                              required
                              aria-required="true"
                            />
                            <div
                              v-if="errors.first_name"
                              class="invalid-feedback text-white"
                            >
                              {{ getFieldError("first_name") }}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                            <input
                              type="text"
                              v-model="form.lastName"
                              placeholder="Last Name*"
                              class="form-control"
                              :class="{ 'is-invalid': errors.last_name }"
                              required
                              aria-required="true"
                            />
                            <div
                              v-if="errors.last_name"
                              class="invalid-feedback text-white"
                            >
                              {{ getFieldError("last_name") }}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                            <input
                              type="email"
                              v-model="form.email"
                              placeholder="Email*"
                              class="form-control"
                              :class="{ 'is-invalid': errors.email }"
                              required
                              aria-required="true"
                            />
                            <div v-if="errors.email" class="invalid-feedback text-white ">
                              {{ getFieldError("email") }}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                            <input
                              type="tel"
                              v-model="form.phone"
                              placeholder="Phone Number*"
                              class="form-control"
                              :class="{ 'is-invalid': errors.phone_number }"
                              required
                              aria-required="true"
                            />
                            <div
                              v-if="errors.phone_number"
                              class="invalid-feedback text-white"
                            >
                              {{ getFieldError("phone_number") }}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                            <input
                              type="text"
                              v-model="form.subject"
                              placeholder="Subject"
                              class="form-control"
                              :class="{ 'is-invalid': errors.subject }"
                              required
                              aria-required="true"
                            />
                            <div v-if="errors.subject" class="invalid-feedback text-white">
                              {{ getFieldError("subject") }}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group style-01">
                            <textarea
                              v-model="form.address"
                              placeholder="Address"
                              class="text-area"
                              :class="{ 'is-invalid': errors.address }"
                            ></textarea>
                            <div v-if="errors.address" class="invalid-feedback text-white">
                              {{ getFieldError("address") }}
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
                              <span v-if="isSubmitting">
                                <i class="fas fa-spinner fa-spin"></i>
                                Submitting...
                              </span>
                              <span v-else>
                                <slot name="buttonText">JOIN NOW</slot
                                ><i class="icon-paper-plan"></i>
                              </span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ContactPageFormSection",
  props: {
    bgImage: {
      type: String,
      default: "/frontend/assets/img/contact-bg-02.png",
    },
    ellipse02: {
      type: String,
      default: "frontend/assets/img/Ellipse-02.png",
    },
    ellipse03: {
      type: String,
      default: "/frontend/assets/img/Ellipse-03.png",
    },
    ellipse04: {
      type: String,
      default: "/frontend/assets/img/Ellipse-04.png",
    },
    ellipse05: {
      type: String,
      default: "/frontend/assets/img/Ellipse-05.png",
    },
    contactThumb: {
      type: String,
      default: "/frontend/assets/img/contact-01.png",
    },
    formBg: {
      type: String,
      default: "/frontend/assets/img/contact-02.png",
    },
    circle02: {
      type: String,
      default: "/frontend/assets/img/circle-02.png",
    },
  },
  data() {
    return {
      form: {
        firstName: "",
        lastName: "",
        email: "",
        phone: "",
        subject: "",
        address: "",
      },
      errors: {},
      isSubmitting: false,
      successMessage: "",
    };
  },
  methods: {
    async onSubmit() {
      this.clearErrors();
      this.isSubmitting = true;
      this.successMessage = "";

      try {
        // Prepare data according to backend validation rules
        const formData = {
          first_name: this.form.firstName,
          last_name: this.form.lastName,
          email: this.form.email,
          phone_number: this.form.phone,
          subject: this.form.subject,
          title: this.form.subject, // Use subject as title for slug generation
          address: this.form.address,
          status: "active",
        };

        const response = await axios.post("contact-peoples/store", formData);

        // Handle success
        if (response.data && response.data.status === "success") {
          this.successMessage =
            response.data.message || "Your message has been sent successfully!";
          this.resetForm();
          this.$emit("submit", { success: true, data: response.data });
        }
      } catch (error) {
        // Handle validation errors
        if (error.response && error.response.status === 422) {
          const validationErrors = error.response.data.errors;
          this.errors = validationErrors;
          console.log("Validation errors:", validationErrors);
        }
        // Handle other errors
        else if (
          error.response &&
          error.response.data &&
          error.response.data.message
        ) {
          this.errors = { general: [error.response.data.message] };
        }
        // Handle network or unknown errors
        else {
          this.errors = {
            general: ["An unexpected error occurred. Please try again."],
          };
        }

        this.$emit("submit", { success: false, errors: this.errors });
      } finally {
        this.isSubmitting = false;
      }
    },

    clearErrors() {
      this.errors = {};
    },

    resetForm() {
      this.form = {
        firstName: "",
        lastName: "",
        email: "",
        phone: "",
        subject: "",
        address: "",
      };
    },

    getFieldError(field) {
      return this.errors[field] ? this.errors[field][0] : "";
    },
  },
};
</script>

<style scoped>
/* Validation error styles */
.form-control.is-invalid,
.text-area.is-invalid {
  border-color: #dc3545;
  padding-right: calc(1.5em + 0.75rem);
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 4.6 1.4 1.4M7.2 6l-1.4 1.4'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right calc(0.375em + 0.1875rem) center;
  background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.invalid-feedback {
  width: 100%;
  margin-top: 0.25rem;
  font-size: 0.875rem;
  color: #dc3545;
  display: block;
}

.alert {
  padding: 0.75rem 1.25rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: 0.25rem;
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

/* Button disabled state */
.boxed-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* Loading spinner animation */
.fa-spin {
  animation: fa-spin 2s infinite linear;
}

@keyframes fa-spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
