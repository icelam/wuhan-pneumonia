<template>
  <div class="card" :class="{'card--small-padding': smallPadding}">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    smallPadding: {
      type: Boolean,
      required: false,
      default: false
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './card';
</style>
