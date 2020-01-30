<template>
  <card class="table-card" smallPadding>
    <div class="row">
      <div class="column column--100 column--no-padding">
        <data-table
          :tableHead="tableHead"
          :tableData="tableData"
          :cellAlignment="cellAlignment"
        />
      </div>
    </div>
  </card>
</template>

<script>
import {
  card
} from '@components';
import dataTable from './dataTable.vue';

export default {
  components: {
    card,
    dataTable
  },
  props: {
    tableHead: {
      type: Array,
      required: false,
      default: undefined
    },
    tableData: {
      type: Array,
      required: true
    },
    cellAlignment: {
      type: Array,
      required: true
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './tableCard';
</style>
