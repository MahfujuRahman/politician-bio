<template>
  <div class="why-choose-us-area why-choose-us-bg-02">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="skeleton-wrapper">
            <div class="skeleton-line skeleton-title-lg"></div>
            <div class="skeleton-line skeleton-title-md"></div>
            <div class="skeleton-description">
              <div class="skeleton-line skeleton-desc-line"></div>
              <div class="skeleton-line skeleton-desc-line"></div>
              <div class="skeleton-line skeleton-desc-short"></div>
            </div>
            <div class="skeleton-features">
              <div class="skeleton-feature-item" v-for="i in 4" :key="i">
                <div class="skeleton-feature-icon"></div>
                <div class="skeleton-feature-content">
                  <div class="skeleton-line skeleton-feature-title"></div>
                  <div class="skeleton-line skeleton-feature-desc"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="skeleton-image-container">
            <div class="skeleton-main-image"></div>
            <div class="skeleton-side-image"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "WhyChoseUsSkeleton",
};
</script>

<style scoped>
.skeleton-wrapper {
  animation: pulse 1.5s ease-in-out infinite;
  padding: 30px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 15px;
  backdrop-filter: blur(5px);
  border: 1px solid rgba(0, 0, 0, 0.08);
}

@keyframes pulse {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.7;
  }
  100% {
    opacity: 1;
  }
}

.skeleton-line {
  background: linear-gradient(
    90deg,
    rgba(0, 0, 0, 0.08) 25%,
    rgba(0, 0, 0, 0.15) 50%,
    rgba(0, 0, 0, 0.08) 75%
  );
  border-radius: 6px;
  margin-bottom: 12px;
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(0, 0, 0, 0.1);
}

.skeleton-line::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(0, 0, 0, 0.2),
    transparent
  );
  animation: shimmer 2s infinite;
}

@keyframes shimmer {
  0% {
    left: -100%;
  }
  100% {
    left: 100%;
  }
}

.skeleton-title-lg {
  width: 85%;
  height: 40px;
  margin-bottom: 16px;
}

.skeleton-title-md {
  width: 70%;
  height: 32px;
  margin-bottom: 20px;
}

.skeleton-description {
  margin-bottom: 30px;
}

.skeleton-desc-line {
  width: 100%;
  height: 18px;
  margin-bottom: 10px;
}

.skeleton-desc-short {
  width: 75%;
  height: 18px;
}

.skeleton-features {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.skeleton-feature-item {
  display: flex;
  align-items: center;
  gap: 15px;
}

.skeleton-feature-icon {
  width: 50px;
  height: 50px;
  background: rgba(0, 0, 0, 0.1);
  border-radius: 50%;
  flex-shrink: 0;
  position: relative;
  overflow: hidden;
}

.skeleton-feature-icon::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(0, 0, 0, 0.2),
    transparent
  );
  animation: shimmer 2s infinite;
}

.skeleton-feature-content {
  flex: 1;
}

.skeleton-feature-title {
  width: 60%;
  height: 20px;
  margin-bottom: 8px;
}

.skeleton-feature-desc {
  width: 90%;
  height: 16px;
}

.skeleton-image-container {
  position: relative;
  height: 500px;
}

.skeleton-main-image {
  width: 70%;
  height: 400px;
  background: linear-gradient(
    145deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  border: 2px solid rgba(0, 0, 0, 0.15);
  border-radius: 15px;
  position: absolute;
  top: 0;
  left: 0;
  overflow: hidden;
  backdrop-filter: blur(3px);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.skeleton-main-image::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(0, 0, 0, 0.25),
    transparent
  );
  animation: shimmer 2s infinite;
}

.skeleton-side-image {
  width: 50%;
  height: 250px;
  background: linear-gradient(
    145deg,
    rgba(0, 0, 0, 0.08) 0%,
    rgba(0, 0, 0, 0.18) 50%,
    rgba(0, 0, 0, 0.12) 100%
  );
  border: 2px solid rgba(0, 0, 0, 0.12);
  border-radius: 12px;
  position: absolute;
  bottom: 0;
  right: 0;
  overflow: hidden;
  backdrop-filter: blur(2px);
  box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
}

.skeleton-side-image::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(0, 0, 0, 0.2),
    transparent
  );
  animation: shimmer 2s infinite;
}

@media (max-width: 768px) {
  .skeleton-image-container {
    height: 300px;
    margin-top: 30px;
  }

  .skeleton-main-image {
    width: 100%;
    height: 250px;
  }

  .skeleton-side-image {
    display: none;
  }
}
</style>
