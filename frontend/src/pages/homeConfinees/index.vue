<template>
  <div class="page-content" v-if="pageReady">
    <!-- Building of Home Confinees Data -->
    <h2>接受家居檢疫人士所居住大廈</h2>
    <table-card
      class="home-confinees-building-table-card"
      :tableHead="['編號', '地區', '大廈名稱', '家居檢疫最後日期', '地圖']"
      :tableData="homeConfineesBuildingData"
      :cellAlignment="['left','center', 'center', 'center','center']"
      enableSort
      :defaultSortColumnIndex="0"
      defaultSortDirection="asc"
      enablePagination
      :pageSize="15"
    />
    <!-- /Building of Home Confinees Data -->

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
      homeConfineesBuildingData: undefined
    };
  },
  methods: {
    getHomeConfineesBuilding() {
      hongKongDataService.getHomeConfineesBuilding().then(({ data }) => {
        const { rows } = data;

        // Format date
        const formattedRows = rows.map((row) => {
          const [id, area, building, date] = row;

          return [
            id,
            area.replace(/[a-z\s&]/gi, ''),
            building.split('\n')[0],
            formatDateWithSlash(date),
            `<a href="https://maps.google.com/?q=${encodeURI(building)}" target="_blank" rel="noopener noreferrer">查看</a>`
          ];
        });

        this.homeConfineesBuildingData = formattedRows;
        this.pageReady = true;
      }).catch(() => {
        this.pageError = true;
      });
    }
  },
  mounted() {
    this.getHomeConfineesBuilding();
  }
};
</script>

<style lang='scss' scoped>
  @import './homeConfinees';
</style>
