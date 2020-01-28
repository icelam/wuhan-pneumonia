<template>
  <div class="footer">
    <div class="remarks">
      {{
        autoFetch
          ? `資料每 ${autoFetchMinutes} 分鐘自動更新・`
          : ''
      }}<!--
      -->資料來源：<a :href="sourceLink" target="_blank" rel="noopener noreferrer">{{sourceName}}</a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    sourceLink: {
      type: String,
      required: true
    },
    sourceName: {
      type: String,
      required: true
    },
    autoFetch: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      autoFetchMillSec: parseInt(process.env.VUE_APP_AUTO_FETCH_TIME, 10)
    };
  },
  computed: {
    autoFetchMinutes() {
      return this.autoFetchMillSec / 60 / 1000;
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './footer';
</style>
