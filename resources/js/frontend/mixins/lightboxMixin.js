// Lightbox Mixin for 3-step zoom functionality
export const lightboxMixin = {
  methods: {
    initLightbox(selector = ".lightbox", options = {}) {
      if (window.$ && window.$.fn.magnificPopup) {
        const defaultOptions = {
          type: "image",
          closeOnContentClick: false,
          closeBtnInside: true,
          image: {
            verticalFit: false,
            titleSrc: function (item) {
              return "Click image to zoom in/out";
            },
          },
          zoom: {
            enabled: true,
            duration: 300,
          },
          mainClass: "mfp-with-zoom",
          callbacks: {
            imageLoadComplete: function () {
              var self = this;
              setTimeout(function () {
                self.content
                  .find(".mfp-img")
                  .off("click")
                  .on("click", function () {
                    var $img = $(this);

                    if ($img.hasClass("zoom-3x")) {
                      // Reset to original size
                      $img.removeClass("zoom-3x zoom-2x");
                    } else if ($img.hasClass("zoom-2x")) {
                      // Go to 3x zoom
                      $img.removeClass("zoom-2x").addClass("zoom-3x");
                    } else {
                      // Go to 2x zoom
                      $img.addClass("zoom-2x");
                    }

                    // Auto-center the image when zoomed
                    if ($img.hasClass("zoom-2x") || $img.hasClass("zoom-3x")) {
                      setTimeout(function () {
                        var container = $(".mfp-container");
                        var scrollTop =
                          (container[0].scrollHeight - container.height()) / 2;
                        var scrollLeft =
                          (container[0].scrollWidth - container.width()) / 2;
                        container.scrollTop(scrollTop);
                        container.scrollLeft(scrollLeft);
                      }, 100);
                    }
                  });
              }, 100);
            },
          },
        };

        // Merge custom options with defaults
        const mergedOptions = { ...defaultOptions, ...options };

        // Initialize magnificPopup
        window.$(selector).magnificPopup(mergedOptions);
      }
    },

    // Gallery lightbox for multiple images
    initGalleryLightbox(selector = ".gallery-lightbox", options = {}) {
      if (window.$ && window.$.fn.magnificPopup) {
        const defaultOptions = {
          type: "image",
          gallery: {
            enabled: true,
          },
          closeOnContentClick: false,
          closeBtnInside: true,
          image: {
            verticalFit: false,
            titleSrc: function (item) {
              return "Click image to zoom in/out • Use arrows to navigate";
            },
          },
          zoom: {
            enabled: true,
            duration: 300,
          },
          mainClass: "mfp-with-zoom",
          callbacks: {
            imageLoadComplete: function () {
              var self = this;
              setTimeout(function () {
                self.content
                  .find(".mfp-img")
                  .off("click")
                  .on("click", function () {
                    var $img = $(this);

                    if ($img.hasClass("zoom-3x")) {
                      $img.removeClass("zoom-3x zoom-2x");
                    } else if ($img.hasClass("zoom-2x")) {
                      $img.removeClass("zoom-2x").addClass("zoom-3x");
                    } else {
                      $img.addClass("zoom-2x");
                    }

                    if ($img.hasClass("zoom-2x") || $img.hasClass("zoom-3x")) {
                      setTimeout(function () {
                        var container = $(".mfp-container");
                        var scrollTop =
                          (container[0].scrollHeight - container.height()) / 2;
                        var scrollLeft =
                          (container[0].scrollWidth - container.width()) / 2;
                        container.scrollTop(scrollTop);
                        container.scrollLeft(scrollLeft);
                      }, 100);
                    }
                  });
              }, 100);
            },
          },
        };

        const mergedOptions = { ...defaultOptions, ...options };
        window.$(selector).magnificPopup(mergedOptions);
      }
    },
  },
};
