<template>
  <div class="col-lg-6 col-md-6">
    <div class="event-single-items wow animate__animated animate__fadeInUp">
      <div
        class="event-img"
        :style="{ backgroundImage: `url(/${event.banner_image})` }"
      ></div>
      <div class="content">
        <div class="post-mate">
          <h2 class="post-date">{{ getDay(event.date_time) }}</h2>
          <div class="post-month">{{ getMonth(event.date_time) }}</div>
        </div>
        <div class="subtitle">
          <div class="location">
            <div class="icon">
              <i class="icon-location"></i>
            </div>
            <p>{{ event.place_address }}</p>
          </div>
          <div class="time">
            <div class="icon">
              <i class="icon-clock"></i>
            </div>
            <p>{{ getTime(event.date_time) }}</p>
          </div>
        </div>
        <h4 class="title">
          <Link :href="`/events/event/details?slug=${event.slug}`">{{ event.title }}</Link>
        </h4>
        <p class="description">{{ event.description }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  name: "EventSingleItem",
  props: {
    event: Object,
  },
  methods: {
    getDay(dateTime) {
      if (!dateTime) return "";
      const date = new Date(dateTime);
      return date.getDate().toString().padStart(2, "0");
    },
    getMonth(dateTime) {
      if (!dateTime) return "";
      const date = new Date(dateTime);
      const months = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ];
      return months[date.getMonth()];
    },
    getTime(dateTime) {
      if (!dateTime) return "";
      const date = new Date(dateTime);
      return date.toLocaleTimeString("en-US", {
        hour: "numeric",
        minute: "2-digit",
        hour12: true,
      });
    },
  },
};
</script>
