<template>
  <div
    class="header-area header-sanatory header-bg-04"
    :style="{
      backgroundImage: `url(/${
        data?.background_image || 'uploads/default.jpg'
      })`,
    }"
  >
    <div class="container custom-container-02">
      <div class="home-five-banner">
        <!-- Loading Skeleton -->
        <div v-if="shouldShowSkeleton" class="row align-items-center">
          <div class="col-lg-6 order-lg-1 order-md-2 order-2">
            <div class="header-inner-02">
              <div class="skeleton-wrapper">
                <!-- Slogan skeleton -->
                <div class="skeleton-subtitle">
                  <div class="skeleton-line skeleton-line-sm"></div>
                  <div class="skeleton-stars">
                    <div class="skeleton-star"></div>
                    <div class="skeleton-star"></div>
                    <div class="skeleton-star"></div>
                  </div>
                  <div class="skeleton-election-type"></div>
                </div>
                <!-- Main title skeleton -->
                <div class="skeleton-title">
                  <div class="skeleton-line skeleton-line-lg"></div>
                  <div class="skeleton-line skeleton-line-lg"></div>
                </div>
                <!-- Description skeleton -->
                <div class="skeleton-description">
                  <div class="skeleton-line skeleton-line-md"></div>
                  <div class="skeleton-line skeleton-line-md"></div>
                  <div class="skeleton-line skeleton-line-sm"></div>
                </div>
                <!-- Button skeleton -->
                <div class="skeleton-button"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1 order-md-1">
            <div class="thumbnail text-center mb-md-4">
              <div class="skeleton-image"></div>
            </div>
          </div>
        </div>

        <!-- Actual Content -->
        <div v-else class="row align-items-center">
          <div class="col-lg-6 order-lg-1 order-md-2 order-2 pb-md-4">
            <div class="header-inner-02">
              <h4 class="subtitle">
                {{ data?.slogan }}<i class="icon-star"></i
                ><i class="icon-star"></i><i class="icon-star"></i>
                <span>{{ data?.election_type }}</span>
              </h4>
              <h1 class="title">{{ data?.main_title }}</h1>
              <p>
                {{ data?.short_title }}
              </p>
              <div class="btn-wrapper">
                <Link href="/about-us" class="boxed-btn read-btn"
                  ><i class="fas fa-arrow-right"></i>Read More</Link
                >
              </div>
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1 order-md-1">
            <div class="thumbnail text-center mb-md-4">
              <img
                :src="data?.image || '/uploads/default.jpg'"
                alt="mayor image"
              />
            </div>
          </div>
        </div>
      </div>
      <!-- Navbar area Start -->
      <template class="d-lg-block">
        <NavbarArea />
      </template>
      <!-- navbar area end -->
    </div>
  </div>
</template>

<script>
import NavbarArea from "../../../CommonComponents/NavbarArea.vue";

export default {
  props: {
    data: {
      type: Object,
      default: () => ({
        background_image: "",
        image: "",
        slogan: "",
        election_type: "",
        main_title: "",
        short_title: "",
      }),
    },
    isLoading: {
      type: Boolean,
      default: true,
    },
  },
  components: {
    NavbarArea,
  },
  data() {
    return {
      componentLoading: true,
    };
  },
  computed: {
    shouldShowSkeleton() {
      console.log("Debug skeleton:", {
        componentLoading: this.componentLoading,
        isLoading: this.isLoading,
        hasData: !!this.data,
        hasMainTitle: !!this.data?.main_title,
        hasSlogan: !!this.data?.slogan,
      });

      return (
        this.componentLoading ||
        this.isLoading ||
        !this.data ||
        (!this.data.main_title && !this.data.slogan)
      );
    },
  },
  mounted() {
    // Ensure minimum loading time for skeleton visibility
    setTimeout(() => {
      console.log("Setting componentLoading to false");
      this.componentLoading = false;
    }, 2000); // 2 seconds to clearly see skeleton
  },
};
</script>

<style scoped>
/* Skeleton Loading Styles */
.skeleton-wrapper {
  animation: pulse 1.5s ease-in-out infinite;
  padding: 20px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 12px;
  backdrop-filter: blur(5px);
  border: 1px solid rgba(0, 0, 0, 0.1);
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
    rgba(0, 0, 0, 0.1) 25%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.1) 75%
  );
  border-radius: 6px;
  margin-bottom: 12px;
  height: 20px;
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(0, 0, 0, 0.15);
  backdrop-filter: blur(1px);
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
    rgba(0, 0, 0, 0.3),
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

.skeleton-line-sm {
  width: 60%;
  height: 16px;
}

.skeleton-line-md {
  width: 80%;
  height: 18px;
}

.skeleton-line-lg {
  width: 90%;
  height: 32px;
  margin-bottom: 16px;
}

.skeleton-subtitle {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
}

.skeleton-stars {
  display: flex;
  gap: 5px;
}

.skeleton-star {
  width: 12px;
  height: 12px;
  background: rgba(0, 0, 0, 0.25);
  border-radius: 2px;
  border: 1px solid rgba(0, 0, 0, 0.3);
}

.skeleton-election-type {
  width: 80px;
  height: 16px;
  background: rgba(0, 0, 0, 0.2);
  border: 1px solid rgba(0, 0, 0, 0.25);
  border-radius: 4px;
}

.skeleton-title {
  margin-bottom: 24px;
}

.skeleton-description {
  margin-bottom: 32px;
}

.skeleton-button {
  width: 140px;
  height: 48px;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.15) 0%,
    rgba(0, 0, 0, 0.25) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  border: 2px solid rgba(0, 0, 0, 0.2);
  border-radius: 8px;
  position: relative;
  overflow: hidden;
  backdrop-filter: blur(2px);
}

.skeleton-button::before {
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

.skeleton-image {
  width: 100%;
  max-width: 400px;
  height: 500px;
  background: linear-gradient(
    145deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.2) 50%,
    rgba(0, 0, 0, 0.15) 100%
  );
  border: 3px solid rgba(0, 0, 0, 0.25);
  border-radius: 15px;
  margin: 0 auto;
  position: relative;
  overflow: hidden;
  backdrop-filter: blur(3px);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.skeleton-image::before {
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

/* Responsive adjustments */
@media (max-width: 768px) {
  .skeleton-image {
    height: 350px;
  }

  .skeleton-line-lg {
    height: 28px;
  }
}
</style>
