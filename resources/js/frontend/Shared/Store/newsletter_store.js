import { defineStore } from "pinia";
import axios from "axios";

export const useNewsletterStore = defineStore("newsletter", {
  state: () => ({
    loading: false,
    errors: {},
    successMessage: "",
    email: "",
    successMessageTimer: null,
  }),
  
  actions: {
    // Clear all errors and messages
    clearMessages() {
      this.errors = {};
      this.successMessage = "";
      // Clear any existing timer
      if (this.successMessageTimer) {
        clearTimeout(this.successMessageTimer);
        this.successMessageTimer = null;
      }
    },

    // Auto-hide success message after specified seconds
    autoHideSuccessMessage(seconds = 5) {
      // Clear any existing timer first
      if (this.successMessageTimer) {
        clearTimeout(this.successMessageTimer);
      }
      
      // Set new timer to hide success message
      this.successMessageTimer = setTimeout(() => {
        this.successMessage = "";
        this.successMessageTimer = null;
      }, seconds * 1000);
    },

    // Validate email format
    validateEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    },

    // Client-side validation
    validateForm() {
      this.errors = {};
      
      // Check if email is required
      if (!this.email || this.email.trim() === "") {
        this.errors.email = ["Email is required"];
        return false;
      }
      
      // Check email format
      if (!this.validateEmail(this.email)) {
        this.errors.email = ["Please enter a valid email address"];
        return false;
      }
      
      return true;
    },

    // Subscribe to newsletter
    async subscribe() {
      this.clearMessages();
      
      // Client-side validation first
      if (!this.validateForm()) {
        return false;
      }
      
      this.loading = true;
      
      try {
        const response = await axios.post("/newsletters/store", {
          email: this.email,
          status: "active"
        });
        
        if (response.data.status === "success") {
          this.successMessage = "Thank you for subscribing to our newsletter. We’re delighted to keep you updated with our latest news and insights.";
          this.email = ""; // Clear the form
          
          // Auto-hide success message after 3 seconds
          this.autoHideSuccessMessage(3);
          
          return true;
        }
        
      } catch (error) {
        if (error.response && error.response.status === 422) {
          // Validation errors from server
          this.errors = error.response.data.errors || {};
        } else if (error.response && error.response.data && error.response.data.message) {
          // Other server errors
          this.errors.general = [error.response.data.message];
        } else {
          // Network or other errors
          this.errors.general = ["An error occurred while subscribing. Please try again."];
        }
        return false;
      } finally {
        this.loading = false;
      }
    }
  }
});
