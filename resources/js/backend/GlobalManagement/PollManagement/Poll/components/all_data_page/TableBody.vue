<template>
  <tr
    v-for="(item, dataindex) in data"
    :key="item.id"
    :class="`table_rows table_row_${item.id}`"
  >
    <td>
      <table-row-action :item="item"></table-row-action>
    </td>
    <td>
      <select-single :data="item" />
    </td>
    <template v-for="(row_item, index) in setup.table_row_data" :key="index">
      <td v-if="row_item == 'id'">
        {{ (current_page - 1) * per_page + dataindex + 1 }}
      </td>
      <td v-else-if="row_item == 'is_voting'">
        <label class="switch">
          <input
            type="checkbox"
            :checked="item.is_voting == 1"
            @change="toggleIsVoting(item , $event)"
          />
          <span class="slider round"></span>
        </label>
      </td>
      <td
        v-else-if="row_item === 'image' || isImageFile(item[row_item])"
        class="text-wrap max-w-120"
      >
        <a
          :href="item[row_item] || '/avatar.png'"
          data-fancybox="gallery"
          :data-caption="`Image ${dataindex + 1}`"
        >
          <img
            :src="item[row_item] || '/avatar.png'"
            @error="handleImageError($event)"
            style="width: 40px; height: 40px; object-fit: cover"
            alt="image"
          />
        </a>
      </td>
      <td v-else-if="isFileField(item[row_item])" class="text-wrap max-w-120">
        <template v-if="isImageFile(item[row_item])">
          <a
            :href="item[row_item] || '/avatar.png'"
            data-fancybox="gallery"
            :data-caption="`${row_item} - Image ${dataindex + 1}`"
          >
            <img
              :src="item[row_item] || '/avatar.png'"
              @error="handleImageError($event)"
              style="width: 60px; height: 40px; object-fit: cover"
              alt="image"
            />
          </a>
        </template>
        <template v-else>
          <a
            :href="item[row_item]"
            target="_blank"
            class="file-download-link"
            :title="`Download ${getFileName(item[row_item])}`"
          >
            <i class="fas fa-file-download"></i>
            {{ getFileName(item[row_item]) }}
          </a>
        </template>
      </td>
      <td v-else class="text-wrap max-w-120">
        {{ trim_content(item[row_item], row_item) }}
      </td>
    </template>
  </tr>
</template>

<script>
import setup from "../../setup";
import SelectAll from "./select_data/SelectAll.vue";
import TableRowAction from "./TableRowAction.vue";
import SelectSingle from "./select_data/SelectSingle.vue";
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

import { mapActions, mapWritableState } from "pinia";
import { store } from "../../store";

export default {
  props: ["data", "current_page", "per_page"],
  data: () => ({
    setup,
  }),
  components: {
    SelectAll,
    TableRowAction,
    SelectSingle,
  },

  mounted() {
    this.initFancybox();
  },

  updated() {
    this.initFancybox();
  },

  beforeUnmount() {
    // Cleanup Fancybox instances
    Fancybox.destroy();
  },

  methods: {
    ...mapActions(store, {
      get_all: "get_all",
      set_item: "set_item",
      update_is_voting: "update_is_voting",
    }),

    handleImageError(event) {
      // When image fails to load, set src to avatar.png
      event.target.src = "/avatar.png";
      // Also update the parent link href to avatar.png
      const parentLink = event.target.closest("a");
      if (parentLink) {
        parentLink.href = "/avatar.png";
      }
    },

    initFancybox() {
      // Initialize Fancybox for all images in this component
      Fancybox.bind('[data-fancybox="gallery"]', {
        // Fancybox options
        Toolbar: {
          display: {
            left: ["infobar"],
            middle: [
              "zoomIn",
              "zoomOut",
              "toggle1to1",
              "rotateCCW",
              "rotateCW",
              "flipX",
              "flipY",
            ],
            right: ["slideshow", "thumbs", "close"],
          },
        },
        Thumbs: {
          autoStart: false,
        },
      });
    },

    isFileField(content) {
      // Check if content looks like a file path (contains uploads/ and has file extension)
      if (typeof content === "string") {
        return content.includes("uploads/") && this.getFileExtension(content);
      }
      return false;
    },

    isImageFile(content) {
      if (!content || typeof content !== "string") return false;

      const imageExtensions = [
        "jpg",
        "jpeg",
        "png",
        "gif",
        "webp",
        "svg",
        "bmp",
      ];
      const extension = this.getFileExtension(content);
      return imageExtensions.includes(extension.toLowerCase());
    },

    getFileExtension(filePath) {
      if (!filePath || typeof filePath !== "string") return "";

      const parts = filePath.split(".");
      return parts.length > 1 ? parts[parts.length - 1] : "";
    },

    getFileName(filePath) {
      if (!filePath || typeof filePath !== "string") return "Download";

      // Extract filename from path like "uploads/GalleryManagement\\GalleryCategory/2025-07-14-10352237554.pdf"
      const parts = filePath.split(/[\/\\]/);
      const fileName = parts[parts.length - 1];

      // If filename is too long, truncate it
      if (fileName.length > 20) {
        const extension = this.getFileExtension(fileName);
        const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf("."));
        return (
          nameWithoutExt.substring(0, 15) +
          "..." +
          (extension ? "." + extension : "")
        );
      }

      return fileName;
    },

    trim_content(content, row_item = null) {
      if (typeof content == "string") {
        if (row_item == "created_at" || row_item == "updated_at") {
          return new Intl.DateTimeFormat("en-US", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
          }).format(new Date(content));
        }
        return content.length > 50 ? content.substring(0, 25) + "..." : content;
      }
      if (content && typeof content === "object") {
        for (const key of Object.keys(content)) {
          if (key === "title" && content.title) {
            return content.title;
          }
          if (key === "name" && content.name) {
            return content.name;
          }
        }
      }

      return content || "";
    },

    async toggleIsVoting(item ,event) {
      const newValue = event.target.checked ? 1 : 0;

      await this.set_item(item);
      await this.update_is_voting({ is_voting: newValue, slug: item.slug });
      await this.get_all();
    },
  },
  computed: {
    ...mapWritableState(store, {
      item: "item",
    }),
  },
};
</script>

<style scoped>
.max-w-120 {
  max-width: 120px;
}
.text-wrap {
  text-overflow: ellipsis !important;
  overflow: hidden !important;
  white-space: nowrap !important;
}

.file-download-link {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  color: #007bff;
  text-decoration: none;
  padding: 4px 8px;
  border-radius: 4px;
  transition: all 0.2s ease;
  font-size: 12px;
}

.file-download-link:hover {
  background-color: #f8f9fa;
  text-decoration: underline;
}

.file-download-link i {
  font-size: 14px;
}

/* Switch styles */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

input:checked + .slider {
  background-color: #2196f3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196f3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
