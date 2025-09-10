// Global skeleton management composable
import { ref, computed } from 'vue';

export function usePageSkeleton() {
  // State management
  const loading = ref(true);
  const sectionLoadingStates = ref({});
  const skeletonMinTime = ref(2000); // 2 seconds minimum display
  const observer = ref(null);
  const scrollSaveThrottle = ref(50);
  const lastScrollSave = ref(0);

  // Initialize section loading states
  const initializeSectionStates = (sections) => {
    const states = {};
    sections.forEach(section => {
      states[section] = true;
    });
    sectionLoadingStates.value = states;
  };

  // Start section timer
  const startSectionTimer = (sectionName) => {
    console.log(`Starting ${sectionName} skeleton timer for ${skeletonMinTime.value}ms`);
    setTimeout(() => {
      console.log(`${sectionName} skeleton timer completed`);
      if (sectionLoadingStates.value[sectionName] !== undefined) {
        sectionLoadingStates.value[sectionName] = false;
      }
    }, skeletonMinTime.value);
  };

  // Setup intersection observer
  const setupIntersectionObserver = (sectionRefs, sectionVisibility) => {
    const options = {
      root: null,
      rootMargin: "150px",
      threshold: 0.1,
    };

    const observerCallback = (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const sectionName = entry.target.getAttribute('data-section');
          if (sectionName && sectionVisibility[sectionName] !== undefined) {
            sectionVisibility[sectionName].value = true;
            startSectionTimer(sectionName);
          }
          observer.value.unobserve(entry.target);
        }
      });
    };

    observer.value = new IntersectionObserver(observerCallback, options);
  };

  // Observe elements
  const observeElements = (elements) => {
    elements.forEach((element) => {
      if (element) {
        observer.value.observe(element);
      }
    });
  };

  // Scroll persistence functions
  const saveScrollPosition = (pageKey) => {
    try {
      sessionStorage.setItem(
        `${pageKey}_scroll_pos`,
        String(window.scrollY || window.pageYOffset || 0)
      );
    } catch (e) {
      // ignore storage errors
    }
  };

  const restoreScrollPositionWithRetries = (pageKey) => {
    try {
      const pos = sessionStorage.getItem(`${pageKey}_scroll_pos`);
      if (pos === null) return;
      const yDesired = parseInt(pos, 10);
      if (Number.isNaN(yDesired)) return;

      console.log(`Attempting to restore scroll position to: ${yDesired}px`);

      const maxAttempts = 15;
      const intervalMs = 150;
      let attempts = 0;
      let timer;

      const attempt = () => {
        attempts++;

        const maxScroll = Math.max(
          0,
          document.documentElement.scrollHeight - window.innerHeight
        );
        const target = Math.min(Math.max(0, yDesired), maxScroll);
        const currentScroll = window.scrollY || window.pageYOffset || 0;

        if (Math.abs(currentScroll - target) > 5) {
          console.log(`Attempt ${attempts}: scrolling to ${target}px (current: ${currentScroll}px, max: ${maxScroll}px)`);
          window.scrollTo({ top: target, behavior: "auto" });
        }

        const newScroll = window.scrollY || window.pageYOffset || 0;
        if (Math.abs(newScroll - target) <= 5 || attempts >= maxAttempts) {
          console.log(`Scroll restore complete. Final position: ${newScroll}px`);
          if (timer) clearInterval(timer);
          return;
        }
      };

      attempt();

      if (attempts < maxAttempts) {
        timer = setInterval(attempt, intervalMs);
        setTimeout(() => {
          if (timer) clearInterval(timer);
        }, maxAttempts * intervalMs + 100);
      }
    } catch (e) {
      console.error("Error restoring scroll position:", e);
    }
  };

  const onScrollSave = (pageKey) => {
    try {
      const now = Date.now();
      if (now - lastScrollSave.value > scrollSaveThrottle.value) {
        lastScrollSave.value = now;
        saveScrollPosition(pageKey);
      }
    } catch (e) {
      // ignore
    }
  };

  const visibilityChangeHandler = (pageKey) => {
    if (document.visibilityState === "hidden") {
      saveScrollPosition(pageKey);
    }
  };

  const enableScrollPersistence = (pageKey) => {
    if ("scrollRestoration" in history) {
      try {
        history.scrollRestoration = "manual";
      } catch (e) {
        // ignore
      }
    }

    const beforeUnloadHandler = () => saveScrollPosition(pageKey);
    const scrollHandler = () => onScrollSave(pageKey);
    const visibilityHandler = () => visibilityChangeHandler(pageKey);
    const loadHandler = () => restoreScrollPositionWithRetries(pageKey);

    window.addEventListener("beforeunload", beforeUnloadHandler);
    window.addEventListener("unload", beforeUnloadHandler);
    document.addEventListener("visibilitychange", visibilityHandler);
    window.addEventListener("scroll", scrollHandler, { passive: true });
    window.addEventListener("load", loadHandler);

    restoreScrollPositionWithRetries(pageKey);

    // Return cleanup function
    return () => {
      window.removeEventListener("beforeunload", beforeUnloadHandler);
      window.removeEventListener("unload", beforeUnloadHandler);
      document.removeEventListener("visibilitychange", visibilityHandler);
      window.removeEventListener("scroll", scrollHandler);
      window.removeEventListener("load", loadHandler);

      if ("scrollRestoration" in history) {
        try {
          history.scrollRestoration = "auto";
        } catch (e) {
          // ignore
        }
      }
    };
  };

  // Cleanup
  const cleanup = () => {
    if (observer.value) {
      observer.value.disconnect();
    }
  };

  // Skeleton visibility helpers
  const shouldShowSkeleton = (isVisible, hasData, sectionName) => {
    return computed(() => {
      return isVisible.value && (
        loading.value || 
        !hasData.value || 
        (Array.isArray(hasData.value) && hasData.value.length === 0) ||
        sectionLoadingStates.value[sectionName]
      );
    });
  };

  return {
    loading,
    sectionLoadingStates,
    skeletonMinTime,
    observer,
    initializeSectionStates,
    startSectionTimer,
    setupIntersectionObserver,
    observeElements,
    enableScrollPersistence,
    cleanup,
    shouldShowSkeleton,
    saveScrollPosition,
    restoreScrollPositionWithRetries,
  };
}
