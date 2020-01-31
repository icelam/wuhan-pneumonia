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
      enableSort
      :defaultSortColumnIndex="0"
      defaultSortDirection="desc"
    />
    <!-- /Hong Kong Cases Data -->

    <!-- High Risk Area Data -->
    <h2>過去 14 天內確診個案逗留大廈</h2>
    <table-card
      class="high-risk-area-table-card"
      :tableHead="['地區', '大廈', '最後逗留日期', '地圖']"
      :tableData="highRiskAreaData"
      :cellAlignment="['center', 'center', 'center']"
      enableSort
      :defaultSortColumnIndex="2"
      defaultSortDirection="desc"
    />
    <!-- /High Risk Area Data -->

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
import { formatDate, formatDateWithSlash } from '@utils';

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
      confirmedCasesData: undefined,
      highRiskAreaData: undefined
    };
  },
  methods: {
    getConfirmedCases() {
      const status = hongKongDataService.getConfirmedCases().then(({ data }) => {
        const [, ...rows] = data;

        // Format date
        const formattedRows = rows.map((row) => {
          const [id, date, ...caseDetails] = row;

          return [
            id,
            formatDateWithSlash(date),
            ...caseDetails
          ];
        });

        this.confirmedCasesData = formattedRows;

        return true;
      }).catch(() => false);

      return status;
    },
    getHighRiskArea() {
      const status = hongKongDataService.getHighRiskArea().then(({ data }) => {
        const [, ...rows] = data;

        // Format date and add google map link
        const formattedRows = rows.map((row) => {
          const [area, building, date] = row;

          return [
            area,
            building,
            formatDateWithSlash(date),
            `<a href="https://maps.google.com/?q=${encodeURI(building)}" target="_blank" rel="noopener noreferrer">查看</a>`
          ];
        });

        this.highRiskAreaData = formattedRows;

        return true;
      }).catch(() => false);

      return status;
    },
    async getAllData() {
      const getConfirmedCasesSuccess = await this.getConfirmedCases();
      const getHighRiskAreaSuccess = await this.getHighRiskArea();

      if (getConfirmedCasesSuccess && getHighRiskAreaSuccess) {
        this.pageReady = true;
      } else {
        this.pageError = true;
      }
    }
  },
  mounted() {
    this.getAllData();
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
