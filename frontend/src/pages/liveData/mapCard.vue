<template>
  <card class="map-card">
    <div class="row">
      <div class="column column--60">
        <data-map :provinceSummary="provinceSummary"/>
      </div>
      <div class="column column--40 column--no-padding">
        <data-table
          class="map-table"
          :tableData="provinceTableData"
          :cellAlignment="['left', 'left']"
        />
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
  methods: {
    formatTableData() {
      this.provinceTableData = generateMapTableData(this.provinceSummary);
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
