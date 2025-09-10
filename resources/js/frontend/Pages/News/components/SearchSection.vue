<template>
  <div class="widget widget_search wow animate__animated animate__fadeInRight">
    <h2 class="widget-title style-01">Search</h2>
    <div class="search-form">
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          placeholder="Search news..."
          v-model="searchTerm"
          @input="handleSearch"
          @focus="showResults = true"
          @blur="handleBlur"
        />
      </div>
      <div class="search-icon">
        <i class="fa fa-search"></i>
      </div>

      <!-- Search Results Dropdown -->
      <div
        v-if="
          showResults &&
          (searchResults.length > 0 ||
            isSearching ||
            (searchTerm && searchTerm.length >= 2))
        "
        class="search-results-dropdown"
        @mouseenter="preventHide = true"
        @mouseleave="preventHide = false"
      >
        <div v-if="isSearching" class="search-loading">
          <i class="fa fa-spinner fa-spin"></i> Searching...
        </div>

        <!-- Debug info -->
        <div
          v-if="!isSearching && searchTerm"
          class="debug-info"
          style="padding: 8px; background: #f0f0f0; font-size: 11px"
        >
          searched by "{{ searchTerm }}", results {{
            searchResults.length
          }}
        </div>

        <div v-if="searchResults.length > 0" class="search-results">
          <div
            v-for="(item, index) in searchResults"
            :key="item.id || index"
            class="search-result-item"
          >
            <Link
              :href="`/news/details?slug=${item.slug}`"
              class="search-result-link"
              @click="handleResultClick"
            >
              <div class="search-result-content">
                <h6 class="search-result-title">{{ item.title }}</h6>
                <p class="search-result-excerpt">
                  {{ truncateText(item.content || "", 80) }}
                </p>
                <span class="search-result-date">
                  {{ formatDate(item.date || item.created_at) }}
                </span>
              </div>
            </Link>
          </div>
        </div>

        <div
          v-else-if="searchTerm && searchTerm.length >= 2"
          class="no-results"
        >
          No results found for "{{ searchTerm }}"
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { mapActions, mapState } from "pinia";
import { store as news_store } from "../Store/news_store.js";
import debounce from "../helpers/debounce.js";

export default {
  name: "SearchSection",
  components: {
    Link,
  },
  data() {
    return {
      searchTerm: "",
      showResults: false,
      preventHide: false,
    };
  },
  computed: {
    ...mapState(news_store, ["searchResults", "isSearching"]),
  },
  created() {
    // Create the debounced function with proper context binding
    this.debouncedSearch = debounce((event) => {
      this.searchTerm = event.target.value;
      console.log("Search term:", this.searchTerm); // Debug log
      if (this.searchTerm.length >= 2) {
        this.searchNews(this.searchTerm);
        this.showResults = true;
      } else {
        this.clearSearch();
        this.showResults = false;
      }
    }, 300);
  },
  methods: {
    ...mapActions(news_store, ["searchNews", "clearSearch"]),

    handleSearch(event) {
      this.debouncedSearch(event);
    },

    handleBlur() {
      // Delay hiding results to allow clicking on them
      setTimeout(() => {
        if (!this.preventHide) {
          this.showResults = false;
        }
      }, 500); // Increased delay
    },

    handleResultClick() {
      this.showResults = false;
      this.clearSearch();
      this.searchTerm = "";
    },

    formatDate(date) {
      if (!date) return "";
      try {
        const dateObj = new Date(date);
        const day = dateObj.getDate();
        const dayWithSuffix = this.getDayWithSuffix(day);
        const months = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];
        const month = months[dateObj.getMonth()];
        const year = dateObj.getFullYear();
        return `${dayWithSuffix} ${month}, ${year}`;
      } catch (error) {
        return "";
      }
    },

    getDayWithSuffix(day) {
      if (day >= 11 && day <= 13) {
        return day + "th";
      }
      switch (day % 10) {
        case 1:
          return day + "st";
        case 2:
          return day + "nd";
        case 3:
          return day + "rd";
        default:
          return day + "th";
      }
    },

    truncateText(text, maxLength) {
      if (!text) return "";
      // Remove HTML tags
      const cleanText = text.replace(/<[^>]*>/g, "");
      if (cleanText.length <= maxLength) return cleanText;
      return cleanText.slice(0, maxLength) + "...";
    },
  },
};
</script>

<style scoped>
.search-form {
  position: relative;
}

.search-icon {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #666;
  pointer-events: none;
}

.search-results-dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: white;
  border: 1px solid #ddd;
  border-radius: 4px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  max-height: 400px;
  overflow-y: auto;
}

.search-loading {
  padding: 12px;
  text-align: center;
  color: #666;
}

.search-result-item {
  border-bottom: 1px solid #eee;
}

.search-result-item:last-child {
  border-bottom: none;
}

.search-result-link {
  display: block;
  padding: 12px;
  text-decoration: none;
  color: inherit;
  transition: background-color 0.2s;
}

.search-result-link:hover {
  background-color: #f8f9fa;
  text-decoration: none;
  color: inherit;
}

.search-result-title {
  font-size: 14px;
  font-weight: 600;
  margin: 0 0 4px 0;
  color: #333;
  line-height: 1.3;
}

.search-result-excerpt {
  font-size: 12px;
  color: #666;
  margin: 0 0 4px 0;
  line-height: 1.4;
}

.search-result-date {
  font-size: 11px;
  color: #999;
}

.no-results {
  padding: 12px;
  text-align: center;
  color: #666;
  font-style: italic;
}

/* Ensure the search form has proper styling */
.form-group {
  position: relative;
}

.form-control {
  padding-right: 40px; /* Make space for the search icon */
}

.form-control:focus {
  border-color: #007bff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
</style>
