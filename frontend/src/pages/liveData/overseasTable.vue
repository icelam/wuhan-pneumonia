<template>
  <card class="overseas-table-card" smallPadding>
    <div class="row">
      <div class="column column--100 column--no-padding">
        <data-table
          class="overseas-table"
          :tableData="provinceTableData"
          :tableHead="['國家', ' 確診', '治癒', '死亡']"
          :cellAlignment="['left', 'center', 'center', 'center']"
        />
      </div>
    </div>
  </card>
</template>

<script>
import { card, dataTable } from '@components';
import { generateOverseasTableData } from '@utils';

export default {
  components: {
    card,
    dataTable
  },
  props: {
    overseasSummary: {
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
    formatOverseasData() {
      this.provinceTableData = generateOverseasTableData(this.overseasSummary);
    }
  },
  beforeMount() {
    this.formatOverseasData();
  },
  watch: {
    overseasSummary() {
      this.formatOverseasData();
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './overseasTable';
</style>
