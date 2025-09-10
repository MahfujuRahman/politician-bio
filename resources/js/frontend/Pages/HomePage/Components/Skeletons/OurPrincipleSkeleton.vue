<template>
  <section class="our-principle-area our-principle-bg">
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
          <div class="principle-card-skeleton">
            <div class="skeleton-principle-icon"></div>
            <div class="skeleton-principle-content">
              <div class="skeleton-line skeleton-principle-title"></div>
              <div class="skeleton-line skeleton-principle-desc"></div>
              <div class="skeleton-line skeleton-principle-desc"></div>
              <div class="skeleton-line skeleton-principle-desc-short"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "OurPrincipleSkeleton",
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
  width: 60%;
  height: 36px;
  margin: 0 auto 16px;
}

.skeleton-subtitle {
  width: 80%;
  height: 20px;
  margin: 0 auto;
}

.principle-card-skeleton {
  background: rgba(255, 255, 255, 0.9);
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 15px;
  padding: 30px 25px;
  margin-bottom: 30px;
  text-align: center;
  backdrop-filter: blur(10px);
  box-shadow: 0 6px 30px rgba(0, 0, 0, 0.06);
  transition: transform 0.3s ease;
}

.principle-card-skeleton:hover {
  transform: translateY(-5px);
}

.skeleton-principle-icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  border: 2px solid rgba(0, 0, 0, 0.15);
  border-radius: 50%;
  margin: 0 auto 20px;
  position: relative;
  overflow: hidden;
}

.skeleton-principle-icon::before {
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

.skeleton-principle-title {
  width: 75%;
  height: 26px;
  margin: 0 auto 15px;
}

.skeleton-principle-desc {
  width: 100%;
  height: 18px;
  margin: 0 auto 8px;
}

.skeleton-principle-desc-short {
  width: 80%;
  height: 18px;
  margin: 0 auto;
}

@media (max-width: 768px) {
  .principle-card-skeleton {
    padding: 25px 20px;
    margin-bottom: 25px;
  }

  .skeleton-principle-icon {
    width: 60px;
    height: 60px;
  }
}
</style>
