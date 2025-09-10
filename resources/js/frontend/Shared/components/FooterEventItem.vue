<template>
  <div class="row">
    <div class="col-lg-6" v-for="(event, index) in events" :key="index">
      <div class="footer-event-item">
        <div class="content">
          <div class="designation">
            <span class="event">Event</span>
            <span class="date">{{ formatDate(event?.date_time) }}</span>
          </div>
          <h6 class="title">
            <Link :href="`/events/event/details?slug=${event?.slug}`">{{
              event?.title
            }}</Link>
          </h6>
          <p>{{ event?.short_description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FooterEventItem",
  props: {
    events: {
      type: Array,
      required: true,
    },
  },
  created() {
    console.log("FooterEventItem events prop:", this.events);

    if (!Array.isArray(this.events)) {
      console.warn("Expected 'events' prop to be an array.");
    }
  },
  methods: {
    formatDate(dateStr) {
      if (!dateStr) return "";
      try {
        // Ensure compatible ISO-like format for reliable parsing
        let d = new Date(String(dateStr).replace(" ", "T"));
        if (isNaN(d)) d = new Date(dateStr);
        if (isNaN(d)) return dateStr; // fallback to original
        const day = d.getDate();
        const month = d.toLocaleString("default", { month: "short" });
        const year = d.getFullYear();
        return `${day} ${month} ${year}`;
      } catch (e) {
        return dateStr;
      }
    },
  },
};
</script>

<style scoped></style>
