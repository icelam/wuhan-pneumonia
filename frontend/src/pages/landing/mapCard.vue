<template>
  <card class="map-card">
    <div class="row">
      <div class="column column--60">
        <data-map :provinceSummary="provinceSummary"/>
      </div>
      <div class="column column--40">
        <data-table :tableData="provinceTableData"/>
      </div>
    </div>
  </card>
</template>

<script>
import { card, dataMap, dataTable } from '@components';
import { generateMapTableData } from '@utils';

export default {
  components: {
    card,
    dataMap,
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
  beforeMount() {
    this.provinceTableData = generateMapTableData(this.provinceSummary);
  },
  watch: {
    provinceSummary() {
      this.provinceTableData = generateMapTableData(this.provinceSummary);
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './mapCard';
</style>
