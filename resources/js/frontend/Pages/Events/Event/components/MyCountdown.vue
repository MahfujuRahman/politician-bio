<template>
  <div id="mycountdown" class="counter-single-item style-02">
    <ul>
      <li class="counter-item wow animate__animated animate__fadeInUp">
        <span class="days">00</span>
        <h6>Days</h6>
      </li>
      <li
        class="counter-item wow animate__animated animate__fadeInUp animate__delay-1s"
      >
        <span class="hours">00</span>
        <h6>Hours</h6>
      </li>
      <li
        class="counter-item wow animate__animated animate__fadeInUp animate__delay-2s"
      >
        <span class="mins">00</span>
        <h6>Minuts</h6>
      </li>
      <li
        class="counter-item wow animate__animated animate__fadeInUp animate__delay-3s"
      >
        <span class="secs">00</span>
        <h6>Seconds</h6>
      </li>
    </ul>
  </div>
</template>

<script>
import { onMounted, watch, defineComponent } from "vue";

export default defineComponent({
  name: "MyCountdown",
  props: {
    dateTime: {
      type: String,
      required: true,
    },
  },
  setup(props) {
    onMounted(() => {
      if (
        window.jQuery &&
        window.jQuery("#mycountdown").length > 0 &&
        typeof window.jQuery("#mycountdown").countdown === "function"
      ) {
        window
          .jQuery("#mycountdown")
          .countdown(props.dateTime, function (event) {
            window.jQuery(".days").text(event.strftime("%D"));
            window.jQuery(".hours").text(event.strftime("%H"));
            window.jQuery(".mins").text(event.strftime("%M"));
            window.jQuery(".secs").text(event.strftime("%S"));
          });
      }
    });
    watch(
      () => props.dateTime,
      (newVal) => {
        if (
          window.jQuery &&
          window.jQuery("#mycountdown").length > 0 &&
          typeof window.jQuery("#mycountdown").countdown === "function"
        ) {
          window.jQuery("#mycountdown").countdown(newVal, function (event) {
            window.jQuery(".days").text(event.strftime("%D"));
            window.jQuery(".hours").text(event.strftime("%H"));
            window.jQuery(".mins").text(event.strftime("%M"));
            window.jQuery(".secs").text(event.strftime("%S"));
          });
        }
      }
    );
  },
});
</script>
