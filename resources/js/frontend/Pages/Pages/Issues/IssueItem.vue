<template>
    <div class="issues-single-items style-01">
      <div class="issue-img" :style="{ backgroundImage: `url(/${item.image})` }">
        <div class="content">
          <h4 class="title">
            <Link :href="`/pages/issues/details?slug=${item.slug}`">{{ item.title }}</Link>
          </h4>
          <p v-html="item.short_description"></p>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  name: "IssueItem",
  props: {
    item: Object,
  },
};
</script>
