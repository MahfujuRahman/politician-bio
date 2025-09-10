<template>
  <div class="banner-skeleton">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <div class="skeleton-banner-content">
            <div class="skeleton-banner-title"></div>
            <div class="skeleton-banner-breadcrumb"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="skeleton-banner-overlay"></div>
  </div>
</template>

<script>
export default {
  name: "BannerSkeleton",
};
</script>

<style scoped>
.banner-skeleton {
  position: relative;
  height: 400px;
  background: linear-gradient(135deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 200%;
  animation: bannerShimmer 2s infinite;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.skeleton-banner-content {
  z-index: 2;
  position: relative;
}

.skeleton-banner-title {
  height: 50px;
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 12px;
  margin-bottom: 20px;
  max-width: 400px;
  width: 100%;
  position: relative;
  overflow: hidden;
}

.skeleton-banner-title::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.5),
    transparent
  );
  animation: slideShimmer 1.5s infinite;
}

.skeleton-banner-breadcrumb {
  height: 20px;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  max-width: 250px;
  width: 100%;
  margin: 0 auto;
  position: relative;
  overflow: hidden;
}

.skeleton-banner-breadcrumb::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.5),
    transparent
  );
  animation: slideShimmer 1.5s infinite 0.5s;
}

.skeleton-banner-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(
    45deg,
    rgba(0, 0, 0, 0.1) 25%,
    transparent 25%,
    transparent 50%,
    rgba(0, 0, 0, 0.1) 50%,
    rgba(0, 0, 0, 0.1) 75%,
    transparent 75%
  );
  background-size: 20px 20px;
  animation: patternMove 2s linear infinite;
  opacity: 0.3;
}

@keyframes bannerShimmer {
  0%,
  100% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
}

@keyframes slideShimmer {
  0% {
    left: -100%;
  }
  100% {
    left: 100%;
  }
}

@keyframes patternMove {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 20px 20px;
  }
}

/* Responsive */
@media (max-width: 768px) {
  .banner-skeleton {
    height: 300px;
  }

  .skeleton-banner-title {
    height: 40px;
    max-width: 300px;
  }

  .skeleton-banner-breadcrumb {
    height: 18px;
    max-width: 200px;
  }
}
</style>
