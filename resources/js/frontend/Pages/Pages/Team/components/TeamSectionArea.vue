<template>
  <div class="team-section-area">
    <!-- ...existing team-section-area markup... -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ short_title || "Meet Our Party Volunteer" }}
            </h4>
            <p
              class="description style-03 wow animate__animated animate__fadeInUp"
            >
              {{
                long_title ||
                "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently."
              }}
            </p>
          </div>
        </div>
      </div>
      <div class="team-wrapper">
        <div
          v-for="(group, idx) in volunteerGroups"
          :key="idx"
          :class="['team', idx === 2 ? 'style-01' : '']"
        >
          <div
            v-for="(volunteer, vIdx) in group"
            :key="vIdx"
            class="volunteer-single-items-02"
          >
            <div class="thum">
              <a
                :href="
                  '/' +
                  (volunteer?.image ? volunteer.image : 'uploads/default.jpg')
                "
                class="team-lightbox"
                target="_blank"
              >
                <img
                  :src="
                    '/' +
                    (volunteer?.image ? volunteer.image : 'uploads/default.jpg')
                  "
                  alt="Volunteer Image"
                />
              </a>
            </div>
            <div class="content">
              <div class="author-meta">
                <span class="author-name">{{
                  volunteer.name
                    ? volunteer.name.split(" ").slice(0, 3).join(" ")
                    : ""
                }}</span>
                <p class="designation">
                  {{
                    volunteer.designation
                      ? volunteer.designation.split(" ").slice(0, 4).join(" ")
                      : ""
                  }}
                </p>
              </div>
              <div class="social-links">
                <a
                  class="mr-2"
                  v-for="(item, index) in volunteer.social_link"
                  :key="index"
                  :href="item.link"
                  target="_blank"
                >
                  <i :class="`${item.icon}`"></i>
                </a>

                <!-- <i v-if="volunteer.facebook" class="fab fa-facebook-f"></i>
                <i v-if="volunteer.twitter" class="fab fa-twitter"></i>
                <i v-if="volunteer.linkedin" class="fab fa-linkedin-in"></i>
                <i v-if="volunteer.youtube" class="fab fa-youtube"></i> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="btn-wrapper desktop-center padding-top-20">
        <a href="#" class="boxed-btn btn-sanatory style-01"
          ><i class="fas fa-arrow-right"></i>Discover More</a
        >
      </div> -->
    </div>
  </div>
</template>

<script>
import { lightboxMixin } from "../../../../mixins/lightboxMixin.js";

export default {
  props: {
    volunteers: {
      type: Array,
      required: true,
    },
    short_title: {
      type: String,
      default: "Meet Our Party Volunteer",
    },
    long_title: {
      type: String,
      default:
        "Every pleasures is to welcomed pain avoided owing to the duty the obligations of business it will frequently.",
    },
  },
  name: "TeamSectionArea",
  mixins: [lightboxMixin],
  watch: {
    volunteers: {
      handler(newVal) {
        if (newVal && newVal.length) {
          console.log("volunteers updated:", newVal);
        }
        console.log("volunteers watch triggered:", newVal);
      },
      immediate: true,
      deep: true,
    },
  },
  mounted() {
    this.initLightbox(".team-lightbox");
  },
  updated() {
    this.initLightbox(".team-lightbox");
  },
  computed: {
    volunteerGroups() {
      // Divide volunteers into 3 groups as evenly as possible
      const groups = [[], [], []];
      if (!this.volunteers.data || !this.volunteers.data.length) return groups;
      this.volunteers.data.forEach((v, i) => {
        groups[Math.floor(i / Math.ceil(this.volunteers.data.length / 3))].push(
          v
        );
      });
      return groups;
    },
  },
};
</script>
