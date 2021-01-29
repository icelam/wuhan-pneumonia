<template>
  <card class="map-card">
    <div class="row">
      <div class="column column--60">
        <china-epidemic-map :provinceSummary="provinceSummary" />
      </div>
      <div class="column column--40 column--no-padding">
        <data-table
          class="map-table"
          :tableData="provinceTableData"
          :cellAlignment="['left', 'left']"
          v-on:row-clicked="rowClickHandler"
        />
      </div>
    </div>
  </card>
</template>

<script>
import { card, chinaEpidemicMap, dataTable } from '@components';
import { generateMapTableData } from '@utils';

export default {
  components: {
    card,
    chinaEpidemicMap,
    dataTable
  },
  props: {
    provinceSummary: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      provinceTableData: undefined
    };
  },
  methods: {
    formatTableData() {
      this.provinceTableData = generateMapTableData(this.provinceSummary);
    },
    rowClickHandler({ data }) {
      const [clickedItem] = data;
      document.querySelector(`.china-epidemic-map__province[data-label*=${clickedItem}]`).dispatchEvent(new MouseEvent('click'));
    }
  },
  beforeMount() {
    this.formatTableData();
  },
  watch: {
    provinceSummary() {
      this.formatTableData();
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './mapCard';
</style>
