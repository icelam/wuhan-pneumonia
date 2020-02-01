<template>
  <div class="page-content" v-if="pageReady">
    <!-- AE Waiting Time -->
    <h2>急症室等候時間</h2>
    <div class="remarks">
      最長等候時間顯示上限為 8 小時。以上數據只供參考，並非預計等候時間。急症室須處理突發意外傷者及危重病人，因此未能準確提供預計等候時間，敬請見諒及耐心等候。病況輕微病人可考慮使用私營醫療服務，請到<a href="https://apps.pcdirectory.gov.hk/mobile/tc" target="_blank" rel="noopener noreferrer">基層醫療指南</a>或<a href="http://www.hkdoctors.org/chinese/" target="_blank" rel="noopener noreferrer">香港醫生網</a>查看更多資訊。<br/><br/>
      最後更新：{{lastUdate}}
    </div>
    <card>
      <hospital-map :aeWaitingTimeData="aeWaitingTimeData" />
    </card>
    <!-- /AE Waiting Time -->

    <app-footer sourceLink="https://data.gov.hk/tc-data/dataset/hospital-hadata-ae-waiting-time/resource/9fe0ddc4-e56a-4073-95ae-134b4c0ab3b1" sourceName="資料一線通" autoFetch />
  </div>

  <error-message message="無法取得最新資訊。" v-else-if="pageError" />

  <loading v-else/>
</template>

<script>
import {
  card,
  hospitalMap,
  appFooter,
  loading,
  errorMessage
} from '@components';
import { aeDataService } from '@services';

export default {
  components: {
    card,
    hospitalMap,
    appFooter,
    loading,
    errorMessage
  },
  data() {
    return {
      initFetch: true,
      pageReady: false,
      pageError: false,
      aeWaitingTimeData: undefined,
      lastUdate: undefined,
      getAeDataInterval: undefined
    };
  },
  methods: {
    getAeWaitingTimeData() {
      aeDataService.getAeWaitingTime().then(({ data }) => {
        const { waitTime, updateTime } = data;
        this.aeWaitingTimeData = waitTime;
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
