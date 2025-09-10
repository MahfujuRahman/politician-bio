<template>
  <div class="contact_map">
    <div v-if="showUnsupportedMessage" class="unsupported-url-message">
      <div class="message-content">
        <h3>🗺️ URL Not Supported</h3>
        <p>Please provide a valid Google Maps embed URL or iframe code.</p>
        <small
          >Supported: Embed URLs or iframe HTML with Google Maps embed
          src</small
        >
      </div>
    </div>
    <iframe
      v-else-if="validLocation"
      :src="validLocation"
      style="border: 0; width: 100%; height: 100%"
      allowfullscreen=""
      aria-hidden="false"
      tabindex="0"
    ></iframe>
    <div v-else class="no-location-message">
      <div class="message-content">
        <h3>📍 No Location</h3>
        <p>No location URL provided</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "LocationMap",
  props: {
    location: {
      type: String,
      default:
        "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d233667.8223908687!2d90.27923710646989!3d23.780887457084543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1588510922243!5m2!1sen!2sbd",
    },
  },
  computed: {
    validLocation() {
      console.log("Validating location:", this.location);
      
      // Return empty if no location provided
      if (!this.location || this.location.trim() === "") {
        return null;
      }

      return this.convertToEmbedUrl(this.location);
    },

    showUnsupportedMessage() {
      return (
        this.location && this.location.trim() !== "" && !this.validLocation
      );
    },
  },

  methods: {
    convertToEmbedUrl(input) {
      try {
        // Check if input is an iframe HTML code
        if (input.includes("<iframe") && input.includes("src=")) {
          const srcMatch = input.match(/src=["']([^"']+)["']/);
          if (srcMatch && srcMatch[1]) {
            const extractedUrl = srcMatch[1];
            // Validate it's a Google Maps embed URL
            if (this.isValidEmbedUrl(extractedUrl)) {
              return extractedUrl;
            }
          }
          return null;
        }

        // Check if input is already a valid embed URL
        if (this.isValidEmbedUrl(input)) {
          return input;
        }

        return null;
      } catch (error) {
        console.warn("Invalid input format:", input);
        return null;
      }
    },

    isValidEmbedUrl(url) {
      try {
        const urlObj = new URL(url);
        return (
          urlObj.hostname.includes("google.com") &&
          urlObj.pathname.includes("/maps/embed")
        );
      } catch {
        return false;
      }
    },
  },
};
</script>

<style scoped>
.contact_map {
  width: 100%;
  height: 100%;
  position: relative;
}

.unsupported-url-message,
.no-location-message {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  background-color: #f8f9fa;
  border: 2px dashed #dee2e6;
  border-radius: 8px;
}

.message-content {
  text-align: center;
  padding: 2rem;
  color: #6c757d;
}

.message-content h3 {
  margin: 0 0 1rem 0;
  font-size: 1.5rem;
  color: #495057;
}

.message-content p {
  margin: 0 0 0.5rem 0;
  font-size: 1rem;
}

.message-content small {
  font-size: 0.875rem;
  color: #868e96;
}
</style>
