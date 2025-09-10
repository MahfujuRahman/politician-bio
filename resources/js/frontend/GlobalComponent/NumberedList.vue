<template>
  <div class="taking-action-issue">
    <div class="subtitle">{{ subtitle }}</div>
    <div v-for="(item, idx) in items" :key="idx" class="action-single-items">
      <h4 class="title">{{ item.title }}</h4>
      <p>{{ item.description }}</p>
      <div
        class="action-shape"
        style="background-image: url(/frontend/assets/img/shape-07.png)"
      >
        <p>{{ (idx + 1).toString().padStart(2, "0") }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "NumberedList",
  props: {
    subtitle: String,
    items: Array,
  },
};
</script>
