<template>
  <div v-if="pageReady">
    <h2>中國及港澳台地區數據統計</h2>
    <statisticCard :virusSummary="virusSummary" />

    <!-- Map Section -->
    <h2>疫情地圖</h2>
    <map-card :provinceSummary="provinceSummary"/>
    <!-- /Map Section -->

    <app-footer />
  </div>

  <error-message message="無法取得最新資訊。" v-else-if="pageError" />

  <loading v-else/>
</template>

<script>
import {
  loading,
  appFooter,
  errorMessage
} from '@components';
import LiveDataService from '@services/live-data';

import mapCard from './mapCard.vue';
import statisticCard from './statisticCard.vue';

export default {
  components: {
    loading,
    statisticCard,
    mapCard,
    appFooter,
    errorMessage
  },
  data() {
    return {
      initFetch: true,
      pageReady: false,
      pageError: false,
      virusSummary: undefined,
      provinceSummary: undefined
    };
  },
  methods: {
    getLiveData() {
      LiveDataService.getLiveData().then(({ data }) => {
        const { getStatisticsService, getAreaStat } = data;
        this.virusSummary = getStatisticsService;
        this.provinceSummary = getAreaStat;
        this.pageReady = true;
      }).catch(() => {
        if (this.initFetch) {
          this.pageError = true;
        }
      }).finally(() => {
        this.initFetch = false;
      });
    }
  },
  mounted() {
    this.getLiveData();
    const autoFetchInterval = parseInt(process.env.VUE_APP_AUTO_FETCH_TIME, 10);

    // Fetch new data every 5 minutes
    setInterval(() => {
      this.getLiveData();
    }, autoFetchInterval);
  }
};
</script>

<style lang='scss' scoped>
  @import '~@style/_variables';

  .loading, .error-message {
    height: 100%;
  }
</style>
