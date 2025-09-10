<template>
  <section class="testimonial-area testimonial-bg">
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
        <div class="col-lg-8 offset-lg-2">
          <div class="testimonial-carousel-skeleton">
            <div class="testimonial-card-skeleton" v-for="i in 3" :key="i">
              <div class="skeleton-testimonial-content">
                <div class="skeleton-quote-icon"></div>
                <div class="skeleton-line skeleton-testimonial-text"></div>
                <div class="skeleton-line skeleton-testimonial-text"></div>
                <div
                  class="skeleton-line skeleton-testimonial-text-short"
                ></div>
              </div>
              <div class="skeleton-testimonial-author">
                <div class="skeleton-author-image"></div>
                <div class="skeleton-author-info">
                  <div class="skeleton-line skeleton-author-name"></div>
                  <div class="skeleton-line skeleton-author-position"></div>
                </div>
              </div>
              <div class="skeleton-rating">
                <div class="skeleton-star" v-for="j in 5" :key="j"></div>
              </div>
            </div>
          </div>
          <div class="skeleton-carousel-controls">
            <div class="skeleton-control-dot" v-for="i in 3" :key="i"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "TestimonialSkeleton",
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
  width: 60%;
  height: 36px;
  margin: 0 auto 16px;
}

.skeleton-subtitle {
  width: 80%;
  height: 20px;
  margin: 0 auto;
}

.testimonial-carousel-skeleton {
  display: flex;
  gap: 20px;
  overflow: hidden;
}

.testimonial-card-skeleton {
  min-width: 100%;
  background: rgba(255, 255, 255, 0.95);
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 20px;
  padding: 40px 30px;
  text-align: center;
  backdrop-filter: blur(10px);
  box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
  margin-bottom: 30px;
}

.skeleton-testimonial-content {
  margin-bottom: 30px;
  position: relative;
}

.skeleton-quote-icon {
  width: 40px;
  height: 40px;
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

.skeleton-quote-icon::before {
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

.skeleton-testimonial-text {
  width: 100%;
  height: 20px;
  margin: 0 auto 10px;
}

.skeleton-testimonial-text-short {
  width: 75%;
  height: 20px;
  margin: 0 auto;
}

.skeleton-testimonial-author {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  margin-bottom: 20px;
}

.skeleton-author-image {
  width: 60px;
  height: 60px;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  border: 3px solid rgba(0, 0, 0, 0.15);
  border-radius: 50%;
  flex-shrink: 0;
  position: relative;
  overflow: hidden;
}

.skeleton-author-image::before {
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

.skeleton-author-info {
  text-align: left;
}

.skeleton-author-name {
  width: 120px;
  height: 22px;
  margin-bottom: 8px;
}

.skeleton-author-position {
  width: 100px;
  height: 18px;
}

.skeleton-rating {
  display: flex;
  justify-content: center;
  gap: 5px;
}

.skeleton-star {
  width: 16px;
  height: 16px;
  background: rgba(0, 0, 0, 0.15);
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 2px;
  position: relative;
  overflow: hidden;
}

.skeleton-star::before {
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

.skeleton-carousel-controls {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-top: 20px;
}

.skeleton-control-dot {
  width: 12px;
  height: 12px;
  background: rgba(0, 0, 0, 0.2);
  border: 2px solid rgba(0, 0, 0, 0.25);
  border-radius: 50%;
  position: relative;
  overflow: hidden;
}

.skeleton-control-dot::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(0, 0, 0, 0.4),
    transparent
  );
  animation: shimmer 2s infinite;
}

@media (max-width: 768px) {
  .testimonial-card-skeleton {
    padding: 30px 20px;
  }

  .skeleton-testimonial-author {
    flex-direction: column;
    text-align: center;
  }

  .skeleton-author-info {
    text-align: center;
  }

  .skeleton-author-image {
    width: 50px;
    height: 50px;
  }
}
</style>
