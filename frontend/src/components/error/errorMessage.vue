<template>
  <div class="error-message">
    <p>{{message}}</p>
  </div>
</template>

<script>
export default {
  props: {
    message: {
      type: String,
      required: true
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './errorMessage';
</style>
