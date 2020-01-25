<template>
  <div class="card" :class="{ 'card--bottom-gutter': bottomGutter }">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    bottomGutter: {
      type: Boolean,
      default: false
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './card';
</style>
