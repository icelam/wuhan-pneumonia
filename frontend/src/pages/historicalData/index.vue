<template>
  <div class="page-content" v-if="pageReady">
    <!-- Historical Data -->
    <h2>中國及港澳台地區歷史數據</h2>
    <div class="remarks"><sup>*</sup>本資料表與即時數據並不是同一個來源，因此數據可能存在差異。數據只供參考。</div>
    <card class="historical-table-card" smallPadding>
      <div class="row">
        <div class="column column--100 column--no-padding">
          <data-table
            class="historical-table"
            :tableData="historicalTableData"
            :tableHead="['日期', ' 確診', '疑似' , '治癒', '死亡']"
            :cellAlignment="['left', 'center', 'center', 'center', 'center']"
          />
        </div>
      </div>
    </card>
    <!-- /Historical Data -->

    <app-footer sourceLink="https://news.qq.com/zt2020/page/feiyan.htm" sourceName="騰訊新聞" />
  </div>

  <error-message message="無法取得最新資訊。" v-else-if="pageError" />

  <loading v-else/>
</template>

<script>
import {
  card,
  dataTable,
  appFooter,
  loading,
  errorMessage
} from '@components';
import { pneumoniaDataService } from '@services';
import { generateHistoricalTableData } from '@utils';

export default {
  components: {
    card,
    dataTable,
    appFooter,
    loading,
    errorMessage
  },
  data() {
    return {
      pageReady: false,
      pageError: false,
      historicalTableData: undefined
    };
  },
  methods: {
    getHistoricalData() {
      pneumoniaDataService.getHistoricalData().then(({ data }) => {
        const { data: result } = data;
        // Sort date string
        result.sort((a, b) => (a.date > b.date ? -1 : 1));
        this.historicalTableData = generateHistoricalTableData(result);
        this.pageReady = true;
      }).catch(() => {
        this.pageError = true;
      });
    }
  },
  mounted() {
    this.getHistoricalData();
  }
};
</script>

<style lang='scss' scoped>
  @import './historicalTable';
</style>
