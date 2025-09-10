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
      <!-- Render array fields as readable blocks -->
      <td v-else-if="isArrayField(item[row_item])" class="text-wrap max-w-240">
        <div v-if="row_item === 'planning_steps'">
          <div class="content">
            <div v-if="item[row_item] && item[row_item].length > 0">
              <i
                v-if="item[row_item][0].icon"
                :class="item[row_item][0].icon"
              ></i>
              {{ item[row_item][0].title }} -
              {{ item[row_item][0].description }}
            </div>
          </div>
          <!-- <div
            v-for="(data, index) in item[row_item]" :key="index"
          >
            <div class="content mb-2 border rounded p-2">
              <div class="">* 
                <i v-if="data.icon" :class="data.icon"></i>
              </div>
              <div class="">* {{ data.title }}</div>
              <div class="">* {{ data.description }}</div>
            </div>
          </div> -->
        </div>
        <div v-else-if="row_item === 'statistics'">
          <div class="content">
            <div v-if="item[row_item] && item[row_item].length > 0">
              <i
                v-if="item[row_item][0].icon"
                :class="item[row_item][0].icon"
              ></i>
              {{ item[row_item][0].number }} -
              {{ item[row_item][0].title }} -
              {{ item[row_item][0].unit }}
            </div>
          </div>
          <!-- <div v-for="(data, index) in item[row_item]" :key="index" >
            <div class="content mb-2 border rounded p-2">
              <div class="">* 
                <i v-if="data.icon" :class="data.icon"></i>
              </div>
              <div class="">* {{ data.number }}</div>
              <div class="">* {{ data.title }}</div>
              <div class="">* {{ data.unit }}</div>
            </div>
          </div> -->
        </div>
        <div v-else>
          <pre class="array-preview">{{
            JSON.stringify(item[row_item], null, 2)
          }}</pre>
        </div>
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

    // New helper to detect array fields
    isArrayField(content) {
      return Array.isArray(content) && content.length > 0;
    },
  },
};
</script>

<style scoped>
.max-w-120 {
  max-width: 120px;
}
.max-w-240 {
  max-width: 240px;
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

/* Styles for planning_steps and statistics rendering */
.planning-step-item,
.stat-item {
  display: flex;
  gap: 8px;
  align-items: flex-start;
  padding: 6px 0;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}
.planning-step-item:last-child,
.stat-item:last-child {
  border-bottom: none;
}
.step-icon,
.stat-icon {
  font-size: 18px;
  width: 28px;
  text-align: center;
  color: #5a6b7a;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}
.icon-slot {
  width: 28px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: #5a6b7a;
  font-size: 18px;
}
.icon-slot.empty::before {
  content: "\00a0";
  display: block;
  width: 100%;
}

/* Reserve space when there is no icon class */
.no-icon::before {
  content: "\00a0";
  display: inline-block;
  width: 100%;
}

.step-content .step-title,
.stat-content .stat-title {
  font-weight: 600;
  font-size: 13px;
}
.step-content .step-desc {
  font-size: 12px;
  color: #fff;
}
.stat-content .stat-number {
  font-weight: 700;
  font-size: 16px;
}
.stat-content .stat-unit {
  font-size: 12px;
  color: #6c757d;
}
.array-preview {
  white-space: pre-wrap;
  font-size: 12px;
  color: #333;
  margin: 0;
}
</style>
