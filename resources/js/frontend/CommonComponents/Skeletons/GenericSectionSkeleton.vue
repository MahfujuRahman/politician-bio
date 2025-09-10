<template>
  <div class="generic-section-skeleton">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Section header skeleton -->
          <div class="skeleton-header mb-4">
            <div class="skeleton-title"></div>
            <div class="skeleton-description"></div>
          </div>
        </div>
      </div>

      <!-- Content area based on layout type -->
      <div v-if="layout === 'cards'" class="row">
        <div v-for="n in itemsCount" :key="n" :class="cardClass">
          <div class="skeleton-card">
            <div class="skeleton-card-image"></div>
            <div class="skeleton-card-content">
              <div class="skeleton-card-title"></div>
              <div class="skeleton-card-text"></div>
              <div class="skeleton-card-meta"></div>
            </div>
          </div>
        </div>
      </div>

      <div v-else-if="layout === 'list'" class="row">
        <div class="col-12">
          <div v-for="n in itemsCount" :key="n" class="skeleton-list-item">
            <div class="skeleton-list-image"></div>
            <div class="skeleton-list-content">
              <div class="skeleton-list-title"></div>
              <div class="skeleton-list-text"></div>
              <div class="skeleton-list-meta"></div>
            </div>
          </div>
        </div>
      </div>

      <div v-else-if="layout === 'form'" class="row justify-content-center">
        <div class="col-lg-8">
          <div class="skeleton-form">
            <div v-for="n in 4" :key="n" class="skeleton-form-group">
              <div class="skeleton-form-label"></div>
              <div class="skeleton-form-input"></div>
            </div>
            <div class="skeleton-form-button"></div>
          </div>
        </div>
      </div>

      <div v-else class="row">
        <!-- Default content skeleton -->
        <div class="col-lg-8">
          <div class="skeleton-content">
            <div v-for="n in 3" :key="n" class="skeleton-paragraph"></div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="skeleton-sidebar">
            <div v-for="n in 2" :key="n" class="skeleton-widget">
              <div class="skeleton-widget-title"></div>
              <div class="skeleton-widget-content"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "GenericSectionSkeleton",
  props: {
    layout: {
      type: String,
      default: "default", // 'cards', 'list', 'form', 'default'
    },
    itemsCount: {
      type: Number,
      default: 6,
    },
    cardClass: {
      type: String,
      default: "col-lg-4 col-md-6 mb-4",
    },
  },
};
</script>

<style scoped>
.generic-section-skeleton {
  padding: 60px 0;
}

/* Header skeletons */
.skeleton-header {
  text-align: center;
}

.skeleton-title {
  height: 40px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 8px;
  margin: 0 auto 20px;
  max-width: 300px;
}

.skeleton-description {
  height: 20px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
  margin: 0 auto;
  max-width: 500px;
}

/* Card skeletons */
.skeleton-card {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.skeleton-card-image {
  height: 200px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 8px;
  margin-bottom: 15px;
}

.skeleton-card-title {
  height: 24px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
  margin-bottom: 10px;
  width: 80%;
}

.skeleton-card-text {
  height: 16px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
  margin-bottom: 8px;
}

.skeleton-card-text:last-of-type {
  width: 60%;
}

.skeleton-card-meta {
  height: 14px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
  width: 40%;
  margin-top: 10px;
}

/* List skeletons */
.skeleton-list-item {
  display: flex;
  padding: 20px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border-radius: 12px;
}

.skeleton-list-image {
  width: 120px;
  height: 80px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 8px;
  margin-right: 20px;
  flex-shrink: 0;
}

.skeleton-list-content {
  flex: 1;
}

.skeleton-list-title {
  height: 20px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
  margin-bottom: 10px;
  width: 70%;
}

.skeleton-list-text {
  height: 16px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
  margin-bottom: 8px;
}

.skeleton-list-meta {
  height: 14px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
  width: 30%;
}

/* Form skeletons */
.skeleton-form {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.skeleton-form-group {
  margin-bottom: 20px;
}

.skeleton-form-label {
  height: 18px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
  margin-bottom: 8px;
  width: 30%;
}

.skeleton-form-input {
  height: 45px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 6px;
}

.skeleton-form-button {
  height: 50px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 6px;
  width: 150px;
  margin-top: 20px;
}

/* Content skeletons */
.skeleton-content,
.skeleton-sidebar {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.skeleton-paragraph {
  height: 16px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
  margin-bottom: 12px;
}

.skeleton-paragraph:nth-child(3n) {
  width: 80%;
}

.skeleton-paragraph:nth-child(3n + 1) {
  width: 95%;
}

.skeleton-paragraph:nth-child(3n + 2) {
  width: 70%;
}

.skeleton-widget {
  margin-bottom: 30px;
  padding-bottom: 20px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.skeleton-widget:last-child {
  border-bottom: none;
}

.skeleton-widget-title {
  height: 20px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
  margin-bottom: 15px;
  width: 60%;
}

.skeleton-widget-content {
  height: 80px;
  background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 4px;
}

/* Animation */
@keyframes shimmer {
  0% {
    background-position: 200% 0;
  }
  100% {
    background-position: -200% 0;
  }
}

/* Responsive */
@media (max-width: 768px) {
  .skeleton-list-item {
    flex-direction: column;
  }

  .skeleton-list-image {
    width: 100%;
    height: 150px;
    margin-right: 0;
    margin-bottom: 15px;
  }

  .skeleton-card-image {
    height: 150px;
  }
}
</style>
