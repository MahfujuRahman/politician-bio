<template>
  <div class="event-content-section margin-top-120">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="event-single-items">
            <img
              src="/frontend/assets/img/event-single-shape.png"
              class="event-single-shape"
              alt=""
            />
            <div class="bg-wrapper">
              <div
                class="event-bg"
                :style="
                  'background-image: url(/' +
                  (event?.banner_image || '/uploads/default.jpg') +
                  ');'
                "
              >
                <div class="post-mate style-01">
                  <h2 class="post-date">{{ getDay(event.date_time) }}</h2>
                  <div class="post-month">{{ getMonth(event.date_time) }}</div>
                </div>
                <my-countdown :date-time="event.date_time" />
              </div>
            </div>
            <div class="content style-01">
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
              <h4 class="title wow animate__animated animate__fadeInUp">
                {{ event.title }}
              </h4>
              <p
                class="description wow animate__animated animate__fadeInUp"
                v-html="event.description"
              ></p>
            </div>
          </div>
          <div class="event-location">
            <div class="row">
              <div class="col-lg-4">
                <join-the-event :event_id="event.id" :title="joinEventTitle" />
              </div>
              <div class="col-lg-8">
                <location-map :location="event.location_link" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import MyCountdown from "./MyCountdown.vue";
import JoinTheEvent from "./JoinTheEvent.vue";
import LocationMap from "../../../../GlobalComponent/LocationMap.vue";
export default {
  props: {
    event: Object,
    joinEventTitle: {
      type: String,
      default: "Join the event",
    },
  },
  name: "EventBannerSection",
  components: {
    MyCountdown,
    JoinTheEvent,
    LocationMap,
  },
  created: function () {
    // This method can be used to fetch additional data if needed
    console.log("Event details", this.event);
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
      return date.toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
      });
    },
  },
};
</script>
