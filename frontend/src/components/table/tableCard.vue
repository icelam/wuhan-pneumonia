<template>
  <card class="table-card" smallPadding>
    <div class="row">
      <div class="column column--100 column--no-padding">
        <data-table
          :tableHead="tableHead"
          :tableData="tableData"
          :cellAlignment="cellAlignment"
          :enableSort="enableSort"
          :defaultSortColumnIndex="defaultSortColumnIndex"
          :defaultSortDirection="defaultSortDirection"
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
    },
    enableSort: {
      type: Boolean,
      required: false,
      default: false
    },
    defaultSortColumnIndex: {
      type: Number,
      required: false,
      default: -1 // No column is selected
    },
    defaultSortDirection: {
      type: String, // TODO: type checking, only allow 'asc' or 'desc'
      required: false,
      default: 'asc'
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './tableCard';
</style>
