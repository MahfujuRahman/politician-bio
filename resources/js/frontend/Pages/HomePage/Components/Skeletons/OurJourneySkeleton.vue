<template>
  <section class="our-journey-area our-journey-bg">
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
        <div class="col-lg-12">
          <div class="timeline-skeleton">
            <div class="timeline-item-skeleton" v-for="i in 4" :key="i">
              <div class="timeline-date-skeleton">
                <div class="skeleton-line skeleton-year"></div>
              </div>
              <div class="timeline-content-skeleton">
                <div class="skeleton-line skeleton-journey-title"></div>
                <div class="skeleton-line skeleton-journey-desc"></div>
                <div class="skeleton-line skeleton-journey-desc"></div>
                <div class="skeleton-line skeleton-journey-desc-short"></div>
              </div>
              <div class="timeline-dot-skeleton"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "OurJourneySkeleton",
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
  width: 70%;
  height: 36px;
  margin: 0 auto 16px;
}

.skeleton-subtitle {
  width: 85%;
  height: 20px;
  margin: 0 auto;
}

.timeline-skeleton {
  position: relative;
  padding: 20px 0;
}

.timeline-skeleton::before {
  content: "";
  position: absolute;
  left: 50%;
  top: 0;
  bottom: 0;
  width: 4px;
  background: linear-gradient(
    180deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.1) 100%
  );
  transform: translateX(-50%);
  border-radius: 2px;
}

.timeline-item-skeleton {
  display: flex;
  align-items: center;
  margin-bottom: 50px;
  position: relative;
}

.timeline-item-skeleton:nth-child(even) {
  flex-direction: row-reverse;
}

.timeline-date-skeleton {
  width: 120px;
  text-align: center;
  flex-shrink: 0;
}

.skeleton-year {
  width: 80px;
  height: 30px;
  margin: 0 auto;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  border: 2px solid rgba(0, 0, 0, 0.15);
  border-radius: 8px;
}

.timeline-content-skeleton {
  flex: 1;
  max-width: 400px;
  background: rgba(255, 255, 255, 0.9);
  padding: 25px;
  border-radius: 15px;
  margin: 0 30px;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(0, 0, 0, 0.08);
  box-shadow: 0 6px 30px rgba(0, 0, 0, 0.06);
}

.timeline-item-skeleton:nth-child(even) .timeline-content-skeleton {
  text-align: right;
}

.skeleton-journey-title {
  width: 85%;
  height: 28px;
  margin-bottom: 15px;
}

.timeline-item-skeleton:nth-child(even) .skeleton-journey-title {
  margin-left: auto;
}

.skeleton-journey-desc {
  width: 100%;
  height: 18px;
  margin-bottom: 8px;
}

.timeline-item-skeleton:nth-child(even) .skeleton-journey-desc {
  margin-left: auto;
}

.skeleton-journey-desc-short {
  width: 75%;
  height: 18px;
}

.timeline-item-skeleton:nth-child(even) .skeleton-journey-desc-short {
  margin-left: auto;
}

.timeline-dot-skeleton {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  width: 20px;
  height: 20px;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.15) 0%,
    rgba(0, 0, 0, 0.25) 50%,
    rgba(0, 0, 0, 0.2) 100%
  );
  border: 3px solid rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  z-index: 2;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
  .timeline-skeleton::before {
    left: 30px;
  }

  .timeline-item-skeleton,
  .timeline-item-skeleton:nth-child(even) {
    flex-direction: row;
    text-align: left !important;
  }

  .timeline-date-skeleton {
    width: 60px;
  }

  .skeleton-year {
    width: 50px;
    height: 25px;
  }

  .timeline-content-skeleton {
    margin-left: 20px;
    margin-right: 0;
    text-align: left !important;
  }

  .timeline-item-skeleton:nth-child(even) .skeleton-journey-title,
  .timeline-item-skeleton:nth-child(even) .skeleton-journey-desc,
  .timeline-item-skeleton:nth-child(even) .skeleton-journey-desc-short {
    margin-left: 0;
  }

  .timeline-dot-skeleton {
    left: 30px;
  }
}
</style>
