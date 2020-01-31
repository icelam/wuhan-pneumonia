<template>
  <table-card
    class="overseas-table-card"
    :tableData="provinceTableData"
    :tableHead="['國家', ' 確診', '治癒', '死亡']"
    :cellAlignment="['left', 'center', 'center', 'center']"
    enableSort
    :defaultSortColumnIndex="-1"
    defaultSortDirection="desc"
  />
</template>

<script>
import { tableCard } from '@components';
import { generateOverseasTableData } from '@utils';

export default {
  components: {
    tableCard
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
