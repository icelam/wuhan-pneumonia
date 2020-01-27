<template>
  <div v-if="pageReady">
    <!-- Statistics -->
    <h2>全球數據統計</h2>
    <statisticCard :virusSummary="virusSummary" :overseasSummary="overseasSummary"/>
    <!-- /Statistics -->

    <!-- Map Section -->
    <h2>中國及港澳台地區疫情地圖</h2>
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
      provinceSummary: undefined,
      overseasSummary: undefined,
      getLiveDataInterval: undefined
    };
  },
  methods: {
    getLiveData() {
      LiveDataService.getLiveData().then(({ data }) => {
        const { getStatisticsService, getAreaStat, getListByCountryTypeService2 } = data;
        this.virusSummary = getStatisticsService;
        this.provinceSummary = getAreaStat;
        this.overseasSummary = getListByCountryTypeService2;
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
    this.getLiveDataInterval = setInterval(() => {
      this.getLiveData();
    }, autoFetchInterval);
  },
  beforeDestroy() {
    clearInterval(this.getLiveDataInterval);
  }
};
</script>

<style lang='scss' scoped>
  @import '~@style/_variables';

  .loading, .error-message {
    height: 100%;
  }
</style>
