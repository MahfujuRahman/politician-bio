<template>
  <section class="service-area service-bg-02" style="margin-top: 100px">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-title section-title-two text-center">
            <div class="skeleton-wrapper">
              <div class="skeleton-line skeleton-title-lg"></div>
              <div class="skeleton-line skeleton-title-md"></div>
              <div class="skeleton-line skeleton-subtitle"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6" v-for="i in 6" :key="i">
          <div class="single-service-item skeleton-service-card">
            <div class="skeleton-icon"></div>
            <div class="skeleton-content">
              <div class="skeleton-line skeleton-card-title"></div>
              <div class="skeleton-line skeleton-card-desc"></div>
              <div class="skeleton-line skeleton-card-desc-short"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "ServiceSectionSkeleton",
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
  width: 70%;
  height: 36px;
  margin: 0 auto 16px;
}

.skeleton-title-md {
  width: 50%;
  height: 28px;
  margin: 0 auto 12px;
}

.skeleton-subtitle {
  width: 80%;
  height: 20px;
  margin: 0 auto;
}

.skeleton-service-card {
  background: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 12px;
  padding: 30px 20px;
  margin-bottom: 30px;
  text-align: center;
  backdrop-filter: blur(10px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.skeleton-icon {
  width: 60px;
  height: 60px;
  background: rgba(0, 0, 0, 0.1);
  border-radius: 50%;
  margin: 0 auto 20px;
  position: relative;
  overflow: hidden;
}

.skeleton-icon::before {
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

.skeleton-card-title {
  width: 80%;
  height: 24px;
  margin: 0 auto 12px;
}

.skeleton-card-desc {
  width: 100%;
  height: 16px;
  margin: 0 auto 8px;
}

.skeleton-card-desc-short {
  width: 70%;
  height: 16px;
  margin: 0 auto;
}
</style>
