<template>
  <div class="page-content" v-if="pageReady">
    <!-- Hong Kong Latest Suitation -->
    <h2>香港最新情況</h2>
    <latest-suitation :latestSuitationData="latestSuitationData" />
    <!-- /Hong Kong Latest Suitation -->

    <!-- Hong Kong Cases Data -->
    <h2>香港確診案例</h2>
    <div class="remarks" v-if="confirmedCaseSummary">{{ confirmedCaseSummary }}</div>
    <table-card
      class="confirmed-case-table-card"
      :tableHead="['#', '確診日期', '發病日期', '性別', '年齡', '入住醫院', '狀況', '是否香港居民', '個案分類','確診 / 疑似個案']"
      :tableData="confirmedCasesData"
      :cellAlignment="[
        'left',
        'center',
        'center',
        'center',
        'center',
        'center',
        'center',
        'center',
        'center',
        'center'
      ]"
      enableSort
      :defaultSortColumnIndex="0"
      defaultSortDirection="desc"
      enablePagination
      :pageSize="15"
    />
    <!-- /Hong Kong Cases Data -->

    <!-- High Risk Area Data -->
    <h2>過去 14 天內確診 / 疑似個案逗留大廈</h2>
    <table-card
      class="high-risk-area-table-card"
      :tableHead="['地區', '大廈', '最後逗留日期', '地圖']"
      :tableData="highRiskAreaData"
      :cellAlignment="['center', 'center', 'center']"
      enableSort
      :defaultSortColumnIndex="2"
      defaultSortDirection="desc"
      enablePagination
      :pageSize="15"
    />
    <!-- /High Risk Area Data -->

    <!-- Affected Transport Data -->
    <h2>過去 14 天內確診 / 疑似個案乘搭的航班、火車、船、車</h2>
    <table-card
      class="affected-transport-table-card"
      :tableHead="['航班 / 火車編號', '起點及終點', '乘搭日期']"
      :tableData="affectedTransportData"
      :cellAlignment="['center', 'center', 'center']"
      enableSort
      :defaultSortColumnIndex="2"
      defaultSortDirection="desc"
      enablePagination
      :pageSize="15"
    />
    <!-- /Affected Transport Data -->

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
import { formatDateWithSlash } from '@utils';

import latestSuitation from './latestStatistics.vue';

export default {
  components: {
    latestSuitation,
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
      highRiskAreaData: undefined,
      latestSuitationData: undefined,
      affectedTransportData: undefined
    };
  },
  methods: {
    getConfirmedCases() {
      const status = hongKongDataService.getConfirmedCases().then(({ data }) => {
        if (data.status && data.status === 500) {
          return false;
        }

        const [, ...rows] = data;

        // Format date
        const formattedRows = rows.map((row) => {
          const [id, identifiedDate, illnessDate, ...caseDetails] = row;

          return [
            id,
            formatDateWithSlash(identifiedDate),
            formatDateWithSlash(illnessDate),
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
        if (data.status && data.status === 500) {
          return false;
        }

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
    getAffectedTransport() {
      const status = hongKongDataService.getAffectedTransport().then(({ data }) => {
        if (data.status && data.status === 500) {
          return false;
        }

        const [, ...rows] = data;

        // Format date
        const formattedRows = rows.map((row) => {
          const [transport, fromTo, date] = row;

          return [
            transport,
            fromTo,
            date
          ];
        });

        this.affectedTransportData = formattedRows;

        return true;
      }).catch(() => false);

      return status;
    },
    getLatestSuitation() {
      const status = hongKongDataService.getLatestSuitation().then(({ data }) => {
        if (data.status && data.status === 500) {
          return false;
        }

        this.latestSuitationData = data;

        return true;
      }).catch((err) => {
        console.log(err);
        return false;
      });

      return status;
    },
    async getAllData() {
      const getConfirmedCasesSuccess = await this.getConfirmedCases();
      const getHighRiskAreaSuccess = await this.getHighRiskArea();
      const getAffectedTransportSuccess = await this.getAffectedTransport();
      const getLatestSuitationSuccess = await this.getLatestSuitation();

      if (getConfirmedCasesSuccess
        && getHighRiskAreaSuccess
        && getAffectedTransportSuccess
        && getLatestSuitationSuccess
      ) {
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
    confirmedCaseSummary() {
      const { data: statistics } = this.latestSuitationData;
      const summaryKeys = ['疑似個案', '出院', '死亡'];
      const confirmedSummary = statistics.filter(
        (s) => summaryKeys.includes(s.label)
      );

      const summaryList = confirmedSummary.filter(
        (s) => s.count > 0
      ).map(
        (s) => `${s.count} 宗${s.label}`
      );

      const summaryString = summaryList.join('，');

      return summaryString
        ? `香港案例中總共有 ${summaryString}`
        : '';
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './hongKongCases';
</style>
