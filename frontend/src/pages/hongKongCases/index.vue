<template>
  <div class="page-content" v-if="pageReady">
    <!-- Hong Kong Cases Data -->
    <h2>香港確診案例</h2>
    <div class="remarks" v-if="lastUpdate">
      截至 {{lastUpdate}}，香港總共有 {{ confirmedCasesData.length }} 宗確診案例。
    </div>
    <table-card
      class="confirmed-case-table-card"
      :tableHead="['#', '日期', '性別', '年齡', '入住醫院', '狀況']"
      :tableData="confirmedCasesData"
      :cellAlignment="['left', 'center', 'center', 'center', 'center', 'center']"
    />
    <!-- /Hong Kong Cases Data -->

    <app-footer sourceLink="https://data.gov.hk/tc-data/dataset/hk-dh-chpsebcddr-novel-infectious-agent" sourceName="資料一線通" />
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
import { hongKongDataService } from '@services';
import { formatDate } from '@utils';

export default {
  components: {
    tableCard,
    appFooter,
    loading,
    errorMessage
  },
  data() {
    return {
      pageReady: false,
      pageError: false,
      fetchTime: Date.now(),
      confirmedCasesData: undefined
    };
  },
  methods: {
    getConfirmedCases() {
      hongKongDataService.getConfirmedCases().then(({ data }) => {
        const [, ...rows] = data;
        // Sort DESC by id
        rows.sort((a, b) => (parseInt(a[0], 10) > parseInt(b[0], 10) ? -1 : 1));

        // Format date
        const formattedRows = rows.map((row) => {
          const [id, date, ...caseDetails] = row;

          const datePart = date.split('/');
          return [
            id,
            datePart.length > 1 ? `${parseInt(datePart[1], 10)} 月 ${parseInt(datePart[0], 10)} 日` : date,
            ...caseDetails
          ];
        });

        this.confirmedCasesData = formattedRows;
        this.pageReady = true;
      }).catch(() => {
        this.pageError = true;
      });
    }


  },
  mounted() {
    this.getConfirmedCases();
  },
  computed: {
    lastUpdate() {
      return formatDate(this.fetchTime);
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './hongKongCases';
</style>
