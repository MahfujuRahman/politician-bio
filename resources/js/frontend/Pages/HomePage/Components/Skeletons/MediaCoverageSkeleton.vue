<template>
  <section class="media-coverage-area media-coverage-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-title text-center">
            <div class="skeleton-wrapper">
              <div class="skeleton-line skeleton-title-lg"></div>
              <div class="skeleton-line skeleton-subtitle"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6" v-for="i in 6" :key="i">
          <div class="media-card-skeleton">
            <div class="skeleton-media-image"></div>
            <div class="skeleton-media-content">
              <div class="skeleton-media-meta">
                <div class="skeleton-line skeleton-date"></div>
                <div class="skeleton-line skeleton-source"></div>
              </div>
              <div class="skeleton-line skeleton-media-title"></div>
              <div class="skeleton-line skeleton-media-title-short"></div>
              <div class="skeleton-line skeleton-media-desc"></div>
              <div class="skeleton-line skeleton-media-desc"></div>
              <div class="skeleton-line skeleton-media-desc-short"></div>
              <div class="skeleton-read-more"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "MediaCoverageSkeleton",
};
</script>

<style scoped>
.skeleton-wrapper {
  animation: pulse 1.5s ease-in-out infinite;
  padding: 20px;
  background: rgba(0, 0, 0, 0.02);
  border-radius: 12px;
  backdrop-filter: blur(5px);
  border: 1px solid rgba(0, 0, 0, 0.05);
  margin-bottom: 50px;
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
  width: 65%;
  height: 36px;
  margin: 0 auto 16px;
}

.skeleton-subtitle {
  width: 80%;
  height: 20px;
  margin: 0 auto;
}

.media-card-skeleton {
  background: rgba(255, 255, 255, 0.95);
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 15px;
  margin-bottom: 30px;
  overflow: hidden;
  backdrop-filter: blur(10px);
  box-shadow: 0 6px 30px rgba(0, 0, 0, 0.06);
  transition: transform 0.3s ease;
}

.media-card-skeleton:hover {
  transform: translateY(-5px);
}

.skeleton-media-image {
  width: 100%;
  height: 200px;
  background: linear-gradient(
    145deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  position: relative;
  overflow: hidden;
}

.skeleton-media-image::before {
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

.skeleton-media-content {
  padding: 20px;
}

.skeleton-media-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.skeleton-date {
  width: 80px;
  height: 16px;
  margin-bottom: 0;
}

.skeleton-source {
  width: 100px;
  height: 16px;
  margin-bottom: 0;
}

.skeleton-media-title {
  width: 90%;
  height: 24px;
  margin-bottom: 8px;
}

.skeleton-media-title-short {
  width: 70%;
  height: 24px;
  margin-bottom: 15px;
}

.skeleton-media-desc {
  width: 100%;
  height: 16px;
  margin-bottom: 8px;
}

.skeleton-media-desc-short {
  width: 80%;
  height: 16px;
  margin-bottom: 20px;
}

.skeleton-read-more {
  width: 100px;
  height: 35px;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  border: 2px solid rgba(0, 0, 0, 0.15);
  border-radius: 8px;
  position: relative;
  overflow: hidden;
}

.skeleton-read-more::before {
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

@media (max-width: 768px) {
  .skeleton-media-image {
    height: 180px;
  }

  .skeleton-media-content {
    padding: 15px;
  }

  .skeleton-media-meta {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }
}
</style>
