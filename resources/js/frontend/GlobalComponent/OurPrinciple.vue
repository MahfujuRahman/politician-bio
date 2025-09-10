<template>
  <div class="our-principle-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-title">
            <h4 class="title wow animate__animated animate__fadeInUp">
              {{ short_title }}
            </h4>
            <p class="description wow animate__animated animate__fadeInUp">
              {{ long_title }}
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div
          class="col-lg-4 col-md-6"
          v-for="(item, index) in principleItems"
          :key="index"
        >
          <div
            class="princilple-single-items margin-bottom-60 wow animate__animated animate__fadeInUp"
          >
            <div class="icon">
              <i :class="item.icon"></i>
            </div>
            <div class="content">
              <h4 class="title">{{ item.title }}</h4>
              <p>
                {{
                  stripHtml(item.description).length > 80
                    ? stripHtml(item.description).slice(0, 80) + "..."
                    : stripHtml(item.description)
                }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "OurPrinciple",
  props: {
    short_title: {
      type: String,
      default: "Our Campaign Principles",
    },
    long_title: {
      type: String,
      default:
        "A choice that makes the difference from others.",
    },
    principleItems: {
      type: Array,
      default: () => [
        {
          icon: "icon-vallot",
          title: "Democracy",
          description:
            "A free society depends on a free media and organizes civic",
        },
        {
          icon: "icon-equality",
          title: "Equality",
          description:
            "All people are welcomed as part of a free society. All people are equal.",
        },
        {
          icon: "icon-hand-shake",
          title: "Diversity",
          description:
            "All people in a free society are different, and space for their.",
        },
        {
          icon: "icon-vallot",
          title: "Security",
          description:
            "Every human in a free society has secure access to meet.",
        },
        {
          icon: "icon-equality",
          title: "Justice",
          description:
            "All people have the right to be free from coercion, threat, and violence.",
        },
        {
          icon: "icon-hand-shake",
          title: "Peace",
          description:
            "A free society uses conflict as an opportunity to learn from.",
        },
      ],
    },
  },
  methods: {
    stripHtml(html) {
      const div = document.createElement("div");
      div.innerHTML = html;
      return div.textContent || div.innerText || "";
    },
  },
  mounted() {
    // You can add any additional logic here if needed
  },
};
</script>
