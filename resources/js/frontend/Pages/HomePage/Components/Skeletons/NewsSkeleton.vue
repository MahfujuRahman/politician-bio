<template>
  <section class="news-area news-bg">
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
        <!-- Lead News Skeleton -->
        <div class="col-lg-8">
          <div class="lead-news-skeleton">
            <div class="skeleton-news-image-large"></div>
            <div class="skeleton-news-content-large">
              <div class="skeleton-news-meta">
                <div class="skeleton-line skeleton-date"></div>
                <div class="skeleton-line skeleton-category"></div>
              </div>
              <div class="skeleton-line skeleton-news-title-large"></div>
              <div class="skeleton-line skeleton-news-title-large-short"></div>
              <div class="skeleton-line skeleton-news-desc"></div>
              <div class="skeleton-line skeleton-news-desc"></div>
              <div class="skeleton-line skeleton-news-desc-short"></div>
              <div class="skeleton-read-more-large"></div>
            </div>
          </div>
        </div>

        <!-- Side News Skeleton -->
        <div class="col-lg-4">
          <div class="side-news-skeleton">
            <div class="side-news-item-skeleton" v-for="i in 4" :key="i">
              <div class="skeleton-news-image-small"></div>
              <div class="skeleton-news-content-small">
                <div class="skeleton-line skeleton-date-small"></div>
                <div class="skeleton-line skeleton-news-title-small"></div>
                <div
                  class="skeleton-line skeleton-news-title-small-short"
                ></div>
                <div class="skeleton-line skeleton-news-excerpt"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "NewsSkeleton",
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

.lead-news-skeleton {
  background: rgba(255, 255, 255, 0.95);
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 20px;
  overflow: hidden;
  backdrop-filter: blur(10px);
  box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
  margin-bottom: 30px;
}

.skeleton-news-image-large {
  width: 100%;
  height: 300px;
  background: linear-gradient(
    145deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  position: relative;
  overflow: hidden;
}

.skeleton-news-image-large::before {
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

.skeleton-news-content-large {
  padding: 30px;
}

.skeleton-news-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.skeleton-date {
  width: 100px;
  height: 16px;
  margin-bottom: 0;
}

.skeleton-category {
  width: 80px;
  height: 16px;
  margin-bottom: 0;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 12px;
}

.skeleton-news-title-large {
  width: 95%;
  height: 32px;
  margin-bottom: 10px;
}

.skeleton-news-title-large-short {
  width: 75%;
  height: 32px;
  margin-bottom: 20px;
}

.skeleton-news-desc {
  width: 100%;
  height: 18px;
  margin-bottom: 8px;
}

.skeleton-news-desc-short {
  width: 85%;
  height: 18px;
  margin-bottom: 25px;
}

.skeleton-read-more-large {
  width: 120px;
  height: 40px;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  border: 2px solid rgba(0, 0, 0, 0.15);
  border-radius: 10px;
  position: relative;
  overflow: hidden;
}

.skeleton-read-more-large::before {
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

.side-news-skeleton {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.side-news-item-skeleton {
  background: rgba(255, 255, 255, 0.9);
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 15px;
  overflow: hidden;
  backdrop-filter: blur(10px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
  transition: transform 0.3s ease;
}

.side-news-item-skeleton:hover {
  transform: translateX(5px);
}

.skeleton-news-image-small {
  width: 100%;
  height: 150px;
  background: linear-gradient(
    145deg,
    rgba(0, 0, 0, 0.08) 0%,
    rgba(0, 0, 0, 0.18) 50%,
    rgba(0, 0, 0, 0.12) 100%
  );
  position: relative;
  overflow: hidden;
}

.skeleton-news-image-small::before {
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

.skeleton-news-content-small {
  padding: 15px;
}

.skeleton-date-small {
  width: 80px;
  height: 14px;
  margin-bottom: 10px;
}

.skeleton-news-title-small {
  width: 100%;
  height: 20px;
  margin-bottom: 6px;
}

.skeleton-news-title-small-short {
  width: 70%;
  height: 20px;
  margin-bottom: 10px;
}

.skeleton-news-excerpt {
  width: 90%;
  height: 16px;
}

@media (max-width: 768px) {
  .skeleton-news-image-large {
    height: 200px;
  }

  .skeleton-news-content-large {
    padding: 20px;
  }

  .skeleton-news-meta {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }

  .side-news-skeleton {
    margin-top: 30px;
  }

  .skeleton-news-image-small {
    height: 120px;
  }

  .skeleton-news-content-small {
    padding: 12px;
  }
}
</style>
