<template>
  <div class="page-content" v-if="pageReady">
    <!-- Related News List -->
    <h2>肺炎相關新聞</h2>
    <news-card
      v-for="article in newsData"
      :key="article.guid"
      :articleTitle="article.title"
      :articleDescription="article.description"
      :articleUrl="article.link"
      :articleSource="article.creator"
      :articlePublishTime="timeStampToDate(article.timestamp)"
      :articleImage="
        article.mediaContent
        && article.mediaContent['@attributes']
        && article.mediaContent['@attributes'].url
      "
    />
    <!-- /Related News List -->

    <app-footer sourceLink="https://news.google.com/search?q=%E8%82%BA%E7%82%8E&hl=zh-HK&gl=HK&ceid=HK:zh-Hant" sourceName="Google" />
  </div>

  <error-message message="無法取得最新資訊。" v-else-if="pageError" />

  <loading v-else/>
</template>

<script>
import {
  newsCard,
  appFooter,
  loading,
  errorMessage
} from '@components';

import { newsDataService } from '@services';
import { formatDate } from '@utils';

export default {
  components: {
    newsCard,
    appFooter,
    loading,
    errorMessage
  },
  data() {
    return {
      pageReady: false,
      pageError: false,
      newsData: undefined
    };
  },
  methods: {
    timeStampToDate(t) {
      if (!t) {
        return undefined;
      }

      // PHP uses seconds, Javascript uses milliseconds
      const timestampInt = parseInt(t * 1000, 10);
      return formatDate(timestampInt);
    },
    getRelatedNews() {
      newsDataService.getRelatedNews().then(({ data }) => {
        const { channel: { item } } = data;
        this.newsData = item;
        this.pageReady = true;
      }).catch(() => {
        this.pageError = true;
      });
    }
  },
  mounted() {
    this.getRelatedNews();
  }
};
</script>
