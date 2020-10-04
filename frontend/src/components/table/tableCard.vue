<template>
  <div>
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
            :enablePagination="enablePagination"
            :pageSize="pageSize"
            :currentPage="currentPage"
          />
        </div>
      </div>
    </card>
    <div class="table-card-pagination" v-if="enablePagination">
      <a
        @click="previousPage"
        class="table-card-pagination__link"
        v-bind:class="{
          'table-card-pagination__link--disabled': currentPage === 1
        }"
      >
        上一頁
      </a>
      <a
        @click="nextPage"
        class="table-card-pagination__link"
        v-bind:class="{
          'table-card-pagination__link--disabled': (currentPage * pageSize) >= tableData.length
        }"
      >
        下一頁
      </a>
    </div>
  </div>
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
    },
    enablePagination: {
      type: Boolean,
      required: false,
      default: false
    },
    pageSize: {
      type: Number,
      required: false,
      default: 10
    }
  },
  data() {
    return {
      currentPage: 1
    };
  },
  methods: {
    scrollToTableTop(table) {
      const options = {
        // behavior: 'smooth'
      };
      table.scrollIntoView(options);
    },
    nextPage(e) {
      if ((this.currentPage * this.pageSize) < this.tableData.length) {
        this.currentPage += 1;
        this.scrollToTableTop(e.target.parentNode.parentNode);
      }
    },
    previousPage(e) {
      if (this.currentPage > 1) {
        this.currentPage -= 1;
        this.scrollToTableTop(e.target.parentNode.parentNode);
      }
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './tableCard';
</style>
