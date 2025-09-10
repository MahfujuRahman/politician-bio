<template>
  <div class="comment-form-wrap margin-top-15">
    <!-- Comment Form Section -->
    <h3 class="reply-title">{{ short_title }}</h3>
    <p>
      {{ special_note }}
    </p>

    <!-- Success Message -->
    <div v-if="successMessage" class="alert alert-success" role="alert">
      {{ successMessage }}
    </div>

    <!-- Error Messages -->
    <div v-if="errorMessage" class="alert alert-danger" role="alert">
      {{ errorMessage }}
    </div>

    <form @submit.prevent="submitComment" class="comment-form padding-top-25">
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.name }"
              placeholder="Your Name*"
              v-model="form.name"
            />
            <div v-if="errors.name" class="invalid-feedback text-white">
              {{ errors.name[0] }}
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <input
              type="email"
              class="form-control"
              :class="{ 'is-invalid': errors.email }"
              placeholder="Your Email*"
              v-model="form.email"
            />
            <div v-if="errors.email" class="invalid-feedback text-white">
              {{ errors.email[0] }}
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <textarea
              name="message"
              id="message"
              class="form-control textarea"
              :class="{ 'is-invalid': errors.comment }"
              placeholder="Write message*"
              v-model="form.comment"
            ></textarea>
            <div v-if="errors.comment" class="invalid-feedback text-white">
              {{ errors.comment[0] }}
            </div>
          </div>
        </div>
      </div>
      <div class="btn-wrapper">
        <button
          type="submit"
          class="boxed-btn btn-sanatory volunteer"
          :disabled="loading"
        >
          {{ loading ? "Sending..." : "Send Now" }}
          <i class="icon-paper-plan"></i>
        </button>
      </div>
    </form>

    <!-- Comments Display Section -->
    <div
      class="comments-section margin-top-30"
      v-if="commentsLoaded && (comments.length > 0 || isRefreshing)"
    >
      <div
        style="
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 15px;
        "
      >
        <h3>
          Comments ({{ totalComments }})
          <span v-if="isRefreshing" style="font-size: 14px; color: #666">
            🔄 Refreshing...
          </span>
        </h3>
        <button
          @click="refreshComments"
          class="btn btn-sm btn-outline-secondary"
          style="font-size: 12px; padding: 5px 10px"
          :disabled="isRefreshing"
        >
          {{ isRefreshing ? "🔄 Loading..." : "🔄 Refresh" }}
        </button>
      </div>

      <div class="comments-list" v-if="comments.length > 0">
        <div
          v-for="comment in displayedComments"
          :key="comment.id"
          class="comment-item padding-15 margin-bottom-15"
          style="
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background: #f9f9f9;
          "
        >
          <div class="comment-header" style="margin-bottom: 10px">
            <strong>{{ comment.name }}</strong>
            <small class="text-muted" style="margin-left: 10px">
              {{ formatDate(comment.created_at) }}
            </small>
          </div>
          <div class="comment-body">
            <p>{{ comment.comment }}</p>
          </div>
        </div>
      </div>

      <!-- Loading message when refreshing -->
      <div
        v-if="isRefreshing && comments.length === 0"
        class="text-center padding-15"
      >
        <p class="text-muted">Loading comments...</p>
      </div>

      <!-- See More Button -->
      <div
        v-if="comments.length > 3 && !showAllComments"
        class="text-center margin-top-15"
      >
        <button @click="showAllComments = true" class="boxed-btn btn-sanatory">
          See More Comments ({{ comments.length - 3 }} more)
        </button>
      </div>

      <!-- Show Less Button -->
      <div
        v-if="showAllComments && comments.length > 3"
        class="text-center margin-top-15"
      >
        <button @click="showAllComments = false" class="boxed-btn btn-sanatory">
          Show Less
        </button>
      </div>
    </div>

    <div
      v-else-if="commentsLoaded && !isRefreshing"
      class="no-comments margin-top-30"
    >
      <p class="text-center text-muted">
        No comments yet. Be the first to comment!
      </p>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "CommentFormSection",
  props: {
    newsId: {
      type: [String, Number],
      required: true,
    },
    section: {
      type: Object,
      default: null,
    },
    replyTitle: {
      type: String,
      default: "Leave A Comments",
    },
    replyNote: {
      type: String,
      default:
        "Your email address will not be published. Required fields are marked *",
    },
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        comment: "",
        news_id: this.newsId,
        status: "active",
      },
      errors: {},
      loading: false,
      successMessage: "",
      errorMessage: "",
      comments: [],
      commentsLoaded: false,
      showAllComments: false,
      isRefreshing: false,
    };
  },
  watch: {
    newsId: {
      immediate: true,
      handler(newVal, oldVal) {
        // Only proceed if newVal is valid
        if (newVal && !isNaN(parseInt(newVal))) {
          this.form.news_id = parseInt(newVal);

          // Load comments when newsId becomes available or changes
          if (oldVal === undefined && newVal) {
            this.loadComments();
          } else if (newVal !== oldVal && oldVal !== undefined) {
            this.comments = []; // Clear existing comments
            this.commentsLoaded = false;
            this.loadComments();
          }
        }
      },
    },
  },
  computed: {
    displayedComments() {
      if (this.showAllComments) {
        return this.comments;
      }
      return this.comments.slice(0, 3);
    },
    totalComments() {
      return this.comments.length;
    },
    sectionTitle() {
      return this.section?.short_title || this.replyTitle;
    },
    sectionNote() {
      return this.section?.special_note || this.replyNote;
    },
  },
  created() {
    // Only set form.news_id if newsId is valid
    if (this.newsId && !isNaN(parseInt(this.newsId))) {
      this.form.news_id = parseInt(this.newsId);
    }
  },
  mounted() {
    // Only set form.news_id if newsId is valid
    if (this.newsId && !isNaN(parseInt(this.newsId))) {
      this.form.news_id = parseInt(this.newsId);

      // Load comments if newsId is already available
      this.$nextTick(async () => {
        await this.loadComments();
      });
    }
  },
  methods: {
    async submitComment() {
      this.loading = true;
      this.errors = {};
      this.successMessage = "";
      this.errorMessage = "";

      try {
        // Basic client-side validation
        if (!this.form.name.trim()) {
          this.errors.name = ["Name is required"];
        }
        if (!this.form.email.trim()) {
          this.errors.email = ["Email is required"];
        } else if (!this.isValidEmail(this.form.email)) {
          this.errors.email = ["Please enter a valid email address"];
        }
        if (!this.form.comment.trim()) {
          this.errors.comment = ["Comment is required"];
        }

        if (Object.keys(this.errors).length > 0) {
          this.loading = false;
          return;
        }

        const response = await axios.post("/news-comments/store", this.form);

        if (response.data.status === "success") {
          this.successMessage = "Comment submitted successfully!";
          this.resetForm();
          // Reload comments to show the new one
          await this.loadComments();
        }
      } catch (error) {
        if (error.response?.status === 422) {
          // Validation errors from server
          this.errors = error.response.data.errors || {};
        } else {
          this.errorMessage =
            error.response?.data?.message ||
            "Failed to submit comment. Please try again.";
        }
      } finally {
        this.loading = false;
      }
    },

    async loadComments() {
      try {
        // Check if we're ready to load comments
        if (!this.isReadyToLoadComments()) {
          this.commentsLoaded = true;
          this.isRefreshing = false;
          return;
        }

        const response = await axios.get(
          `/news-comments?news_id=${this.newsId}&status=active&get_all=1`
        );

        if (response.data && response.data.status === "success") {
          // Handle different response structures
          let commentsData = [];

          // For get_all=1, the response.data.data should be the direct array
          if (Array.isArray(response.data.data)) {
            commentsData = response.data.data;
          } else if (
            response.data.data &&
            Array.isArray(response.data.data.data)
          ) {
            commentsData = response.data.data.data;
          } else if (response.data.data && Array.isArray(response.data.data)) {
            commentsData = response.data.data;
          } else {
            commentsData = [];
          }

          this.comments = commentsData;
        } else {
          this.comments = [];
        }
      } catch (error) {
        this.comments = [];
      } finally {
        this.commentsLoaded = true;
        this.isRefreshing = false;
      }
    },

    resetForm() {
      this.form = {
        name: "",
        email: "",
        comment: "",
        news_id:
          this.newsId && !isNaN(parseInt(this.newsId))
            ? parseInt(this.newsId)
            : null,
        status: "active",
      };
    },

    // Method to manually refresh comments
    async refreshComments() {
      this.isRefreshing = true;
      await this.loadComments();
    },

    // Check if component is ready to load comments
    isReadyToLoadComments() {
      const ready = this.newsId && !isNaN(parseInt(this.newsId));
      return ready;
    },

    isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    },

    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
      });
    },
  },
};
</script>

<style scoped>
.comment-form-wrap {
  max-width: 800px;
}

.alert {
  padding: 12px 20px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 4px;
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

.form-control.is-invalid {
  border-color: #dc3545;
}

.invalid-feedback {
  width: 100%;
  margin-top: 0.25rem;
  font-size: 0.875em;
  color: #dc3545;
  display: block;
}

.comments-section {
  border-top: 2px solid #e0e0e0;
  padding-top: 30px;
}

.comment-item {
  transition: box-shadow 0.3s ease;
}

.comment-item:hover {
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.comment-header {
  border-bottom: 1px solid #e0e0e0;
  padding-bottom: 8px;
}

.comment-body p {
  margin: 0;
  line-height: 1.6;
}

.no-comments {
  text-align: center;
  padding: 40px 20px;
  border: 1px dashed #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
}

button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.text-center {
  text-align: center;
}

.text-muted {
  color: #6c757d;
}

.margin-top-15 {
  margin-top: 15px;
}

.margin-top-30 {
  margin-top: 30px;
}

.margin-bottom-15 {
  margin-bottom: 15px;
}

.padding-15 {
  padding: 15px;
}

.padding-top-25 {
  padding-top: 25px;
}
</style>
