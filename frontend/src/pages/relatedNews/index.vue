<template>
  <div id="rssFeedWall">
    <div class="page-content" v-if="pageReady">
      <!-- Related News List -->
      <h2>新聞</h2>
      <div class="news">
        <rssapp-wall id="6mbkDJ9rbsKORnFA"></rssapp-wall>
      </div>
      <!-- /Related News List -->

      <app-footer sourceLink="https://news.google.com/search?q=%E8%82%BA%E7%82%8E&hl=zh-HK&gl=HK&ceid=HK:zh-Hant" sourceName="Google" />
    </div>

    <error-message message="無法取得最新資訊。" v-else-if="pageError" />

    <loading v-else/>
  </div>
</template>

<script>
import {
  appFooter,
  loading,
  errorMessage
} from '@components';

export default {
  components: {
    appFooter,
    loading,
    errorMessage
  },
  data() {
    return {
      pageReady: false,
      pageError: false,
      fetchedNews: undefined
    };
  },
  methods: {
    includeRssAppScript() {
      const script = document.createElement('script');
      script.src = 'https://widget.rss.app/v1/wall.js';
      document.getElementById('rssFeedWall').appendChild(script);

      script.onerror = () => {
        this.pageError = true;
        this.pageReady = true;
      };

      script.onload = () => {
        this.pageReady = true;
      };
    }
  },
  mounted() {
    this.includeRssAppScript();
  }
};
</script>

<style lang='scss' scoped>
  @import './relatedNews';
</style>
