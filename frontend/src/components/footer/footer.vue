<template>
  <div class="footer">
    <div class="remarks">
      資料每 {{autoFetchMinutes}} 分鐘自動更新・資料來源：<a href="https://3g.dxy.cn/newh5/view/pneumonia" target="_blank" rel="noopener noreferrer">丁香醫生</a>
    </div>
  </div>
</template>

<script>
export default {
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
