<template>
  <section class="donation-area donation-bg">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <div class="skeleton-wrapper">
            <div class="skeleton-line skeleton-donation-title"></div>
            <div class="skeleton-line skeleton-donation-subtitle"></div>
            <div class="skeleton-description">
              <div class="skeleton-line skeleton-desc-line"></div>
              <div class="skeleton-line skeleton-desc-line"></div>
              <div class="skeleton-line skeleton-desc-short"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="skeleton-donation-button"></div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "DonationSkeleton",
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

.skeleton-donation-title {
  width: 80%;
  height: 40px;
  margin-bottom: 16px;
}

.skeleton-donation-subtitle {
  width: 90%;
  height: 32px;
  margin-bottom: 20px;
}

.skeleton-description {
  margin-bottom: 20px;
}

.skeleton-desc-line {
  width: 100%;
  height: 18px;
  margin-bottom: 10px;
}

.skeleton-desc-short {
  width: 85%;
  height: 18px;
}

.skeleton-donation-button {
  width: 200px;
  height: 60px;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.15) 0%,
    rgba(0, 0, 0, 0.25) 50%,
    rgba(0, 0, 0, 0.2) 100%
  );
  border: 3px solid rgba(0, 0, 0, 0.2);
  border-radius: 12px;
  position: relative;
  overflow: hidden;
  backdrop-filter: blur(3px);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  margin: 0 auto;
}

.skeleton-donation-button::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(0, 0, 0, 0.3),
    transparent
  );
  animation: shimmer 2s infinite;
}

@media (max-width: 768px) {
  .skeleton-wrapper {
    padding: 20px;
    margin-bottom: 20px;
  }

  .skeleton-donation-button {
    width: 100%;
    max-width: 250px;
  }
}
</style>
