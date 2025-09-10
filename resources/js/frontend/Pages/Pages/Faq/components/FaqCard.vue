<template>
  <div class="card">
    <div class="card-header" :id="'heading-' + index">
      <h5 class="mb-0">
        <a
          class="collapsed"
          role="button"
          data-toggle="collapse"
          :data-target="'#collapse-' + index"
          :aria-expanded="false"
          :aria-controls="'collapse-' + index"
        >
          <i class="fas fa-star"></i>
          {{ faq.question }}
        </a>
      </h5>
    </div>
    <div :id="'collapse-' + index" class="collapse" data-parent="#accordion">
      <div class="card-body">
        {{ faq.answer }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FaqCard",
  props: {
    faq: Object,
    index: Number,
  },
  mounted() {
    // Ensure Bootstrap collapse is initialized
    if (typeof window !== "undefined" && window.$ && window.$.fn.collapse) {
      this.$nextTick(() => {
        window.$(`#collapse-${this.index}`).collapse({
          toggle: false,
          parent: "#accordion",
        });
      });
    }
  },
};
</script>
