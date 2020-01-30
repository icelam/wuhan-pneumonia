<template>
  <div class="page-content" v-if="pageReady">
    <!-- Bad Pharmacy List -->
    <h2>炒賣口罩藥房名單</h2>
    <div class="remarks">
      <sup>*</sup>由電腦程式自動摘取，當中資料取自<a href="https://docs.google.com/spreadsheets/d/1x4gHNkS5cfKO8qi-MIp7EiNZP2m5zhK-yv9XSseZqmA/edit#gid=225766462" target="_blank" rel="noopener noreferrer">民間自製資料表</a>。只供參考。
    </div>
    <table-card
      class="bad-pharmacy-card"
      :tableData="pharmacyTableRows"
      :tableHead="pharmacyTableHeader"
      :cellAlignment="['left', 'left', 'left', 'left']"
    />
    <!-- /Bad Pharmacy List -->

    <app-footer sourceLink="https://lihkg.com/thread/1836571/page/1" sourceName="lihkg.com" />
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
import { pharmacyDataService } from '@services';

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
      pharmacyTableHeader: undefined,
      pharmacyTableRows: undefined
    };
  },
  methods: {
    getPharmacyData() {
      pharmacyDataService.getPharmacyData().then(({ data }) => {
        const [header, ...rows] = data;

        // Include only useful columns
        const selectedHeaderColumn = header.slice(1, 5);
        const selectedColumnRows = rows.map((row) => row.slice(1, 5));

        // Filter empty rows
        // const filteredRows = rows.filter(
        //   (row) => row.reduce((allNonEmpty, cell) => (!!cell.trim() && allNonEmpty), true)
        // );

        this.pharmacyTableHeader = selectedHeaderColumn;
        this.pharmacyTableRows = selectedColumnRows;
        this.pageReady = true;
      }).catch((err) => {
        console.error(err);
        this.pageError = true;
      });
    }
  },
  mounted() {
    this.getPharmacyData();
  }
};
</script>

<style lang='scss' scoped>
  @import './pharmacyList';
</style>
