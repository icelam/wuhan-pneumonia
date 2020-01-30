<template>
  <div class="page-content" v-if="pageReady">
    <!-- AE Waiting Time -->
    <h2>急症室等候時間</h2>
    <div class="remarks">最後更新：{{lastUdate}}</div>
    <table-card
      class="ae-waiting-table-card"
      :tableData="aeWaitingTimeTableData"
      :tableHead="['醫院', '區域', '等候時間']"
      :cellAlignment="['left', 'left', 'right']"
    />
    <!-- /AE Waiting Time -->

    <app-footer sourceLink="https://data.gov.hk/tc-data/dataset/hospital-hadata-ae-waiting-time/resource/9fe0ddc4-e56a-4073-95ae-134b4c0ab3b1" sourceName="資料一線通" autoFetch />
  </div>

  <error-message message="無法取得最新資訊。" v-else-if="pageError" />

  <loading v-else/>
</template>

<script>
import {
  tableCard,
  appFooter,
  loading,
  errorMessage
} from '@components';
import { aeDataService } from '@services';
import { generateAeWaitingTimeTable } from '@utils';

export default {
  components: {
    tableCard,
    appFooter,
    loading,
    errorMessage
  },
  data() {
    return {
      initFetch: true,
      pageReady: false,
      pageError: false,
      aeWaitingTimeTableData: undefined,
      lastUdate: undefined,
      getAeDataInterval: undefined
    };
  },
  methods: {
    getAeWaitingTimeData() {
      aeDataService.getAeWaitingTime().then(({ data }) => {
        const { waitTime, updateTime } = data;
        this.aeWaitingTimeTableData = generateAeWaitingTimeTable(waitTime);
        this.lastUdate = updateTime;
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
    this.getAeWaitingTimeData();

    // Fetch new data every 5 minutes
    const autoFetchInterval = parseInt(process.env.VUE_APP_AUTO_FETCH_TIME, 10);
    this.getAeDataInterval = setInterval(() => {
      this.getAeWaitingTimeData();
    }, autoFetchInterval);
  },
  beforeDestroy() {
    clearInterval(this.getAeDataInterval);
  }
};
</script>

<style lang='scss' scoped>
  @import './aeWaitingTime';
</style>
