<template>
  <div class="page-content" v-if="pageReady">
    <!-- Bad Pharmacy List -->
    <h2>炒賣口罩藥房名單</h2>
    <div class="remarks">
      <sup>*</sup>由電腦程式自動摘取，當中資料取自<a href="https://docs.google.com/spreadsheets/d/1x4gHNkS5cfKO8qi-MIp7EiNZP2m5zhK-yv9XSseZqmA/edit#gid=225766462" target="_blank" rel="noopener noreferrer">民間自製資料表</a>。只供參考。
    </div>
    <card class="bad-pharmacy-card" smallPadding>
      <div class="row">
        <div class="column column--100 column--no-padding">
          <data-table
            class="bad-pharmacy-table"
            :tableData="pharmacyTableRows"
            :tableHead="pharmacyTableHeader"
            :cellAlignment="['left', 'left', 'left', 'left']"
          />
        </div>
      </div>
    </card>
    <!-- /Bad Pharmacy List -->

    <app-footer sourceLink="https://lihkg.com/thread/1836571/page/1" sourceName="lihkg.com" />
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
import { pharmacyDataService } from '@services';

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
      pharmacyTableHeader: undefined,
      pharmacyTableRows: undefined
    };
  },
  methods: {
    getHistoricalData() {
      pharmacyDataService.getPharmacyData().then(({ data }) => {
        const [header, ...rows] = data;

        // Remove first column
        header.shift();
        rows.forEach((row) => row.shift());

        // Filter empty rows
        const filteredRows = rows.filter((row) => row.reduce((allNonEmpty, cell) => (!!cell.trim() && allNonEmpty), true));

        this.pharmacyTableHeader = header;
        this.pharmacyTableRows = filteredRows;
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
  @import './pharmacyList';
</style>
