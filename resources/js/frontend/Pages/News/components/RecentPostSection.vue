<template>
  <div
    class="widget widget_recent_posts wow animate__animated animate__fadeInRight animate__delay-1s"
  >
    <h4 class="widget-title style-02">Recent News</h4>
    <ul class="recent_post_item">
      <li
        class="single-recent-post-item"
        v-for="(item, idx) in news"
        :key="idx"
      >
        <div class="thumb">
          <img :src="'/' + item.banner_image" :alt="item.title" />
        </div>
        <div class="content">
          <span class="time">{{ formatDate(item.date) }}</span>
          <h4 class="title">
            <Link :href="`/news/details?slug=${item.slug}`">{{
              item.title
            }}</Link>
          </h4>
        </div>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    news: {
      type: Array,
      required: true,
    },
  },
  name: "RecentPostSection",
  data() {
    return {
      // recentPosts: [
      //   {
      //     img: "/frontend/assets/img/blog-01.png",
      //     alt: "recent post",
      //     time: "AUG 23,2021",
      //     title: "Producing ideas is the main way to grow the",
      //     url: "#",
      //   },
      //   {
      //     img: "/frontend/assets/img/blog-02.png",
      //     alt: "recent post",
      //     time: "AUG 23,2021",
      //     title: "Donald Rumsfeld: Anti–Nation-Builder",
      //     url: "#",
      //   },
      //   {
      //     img: "/frontend/assets/img/blog-03.png",
      //     alt: "recent post",
      //     time: "AUG 23,2021",
      //     title: "Negotiating with TTP—A Different Perspective",
      //     url: "#",
      //   },
      //   {
      //     img: "/frontend/assets/img/blog-04.png",
      //     alt: "recent post",
      //     time: "AUG 23,2021",
      //     title: "Policing in the Post-Floyd Era",
      //     url: "#",
      //   },
      // ],
    };
  },
  methods: {
    formatDate(date) {
      if (!date) return "";
      try {
        const dateObj = new Date(date);
        const months = [
          "JAN",
          "FEB",
          "MAR",
          "APR",
          "MAY",
          "JUN",
          "JUL",
          "AUG",
          "SEP",
          "OCT",
          "NOV",
          "DEC",
        ];
        const month = months[dateObj.getMonth()];
        const day = dateObj.getDate();
        const year = dateObj.getFullYear();
        return `${month} ${day}, ${year}`;
      } catch (error) {
        return "";
      }
    },
  },
};
</script>
