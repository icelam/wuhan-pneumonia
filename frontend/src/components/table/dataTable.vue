<template>
  <div>
    <div
      :class="[
        'data-table',
        `data-table--${tableHead ? 'even' : 'odd'}-highlight`,
        `data-table--${enableSort ? 'sortable' : 'non-sortable'}`
      ]"
    >
      <div class="data-table__head" v-if="tableHead">
        <div
          :class="[
            'data-table__cell',
            `data-table__cell--${cellAlignment[i] || 'left'}`,
            `${currentSortColumn === i
                ? `data-table__cell--sort-${currentSortDirection}`
                : ''
            }`
          ]"
          v-for="(head, i) in tableHead"
          :key="i"
          v-on:click="sortByColumn(i)"
        >
          {{head}}
        </div>
      </div>
      <div
        class="data-table__row"
        v-for="(row, i) in paginatedTableData"
        :key="i"
        v-on:click="$emit('rowClicked', { index: i, data: row })"
      >
        <div
          :class="['data-table__cell', `data-table__cell--${cellAlignment[i] || 'left'}`]"
          v-for="(cells, i) in row"
          :key="i"
          v-html="cells"
        >
        </div>
      </div>
    </div>
    <div
      v-if="!paginatedTableData || !paginatedTableData.length"
      class="data-table__no-data"
    >
      暫時未有資料
    </div>
  </div>
</template>

<script>
import { zeroPad } from '@utils';

export default {
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
    },
    currentPage: {
      type: Number,
      required: false,
      default: 1
    }
  },
  data() {
    return {
      currentSortColumn: this.defaultSortColumnIndex,
      currentSortDirection: this.defaultSortDirection
    };
  },
  methods: {
    sortByColumn(columnIndex) {
      if (this.enableSort) {
        const newSortDirection = columnIndex !== this.currentSortColumn
          ? this.defaultSortDirection
          : this.currentSortDirection === 'asc'
            ? 'desc'
            : 'asc';

        this.currentSortColumn = columnIndex;
        this.currentSortDirection = newSortDirection;
      }
    }
  },
  computed: {
    sortedTableData() {
      // Skip sorting when not enabled
      if (!this.tableData.length || !this.enableSort || this.currentSortColumn === -1) {
        return this.tableData;
      }

      // Fast and lazy way to deep clone array
      const clonedTableData = JSON.parse(JSON.stringify(this.tableData));

      clonedTableData.sort((a, b) => {
        const modifier = this.currentSortDirection === 'asc' ? 1 : -1;

        const dateRegex = /^(\d{1,2})\s?月\s?(\d{1,2})\s?日$/;

        // handle integer and date sort
        const aValue = a[this.currentSortColumn];

        const aValueForSort = /^\d+$/.test(aValue)
          ? parseInt(aValue, 10)
          : dateRegex.test(aValue)
            ? `${zeroPad(aValue.match(dateRegex)[1], 1)}${zeroPad(aValue.match(dateRegex)[2], 1)}`
            : aValue;

        const bValue = b[this.currentSortColumn];

        const bValueForSort = /^\d+$/.test(bValue)
          ? parseInt(bValue, 10)
          : dateRegex.test(bValue)
            ? `${zeroPad(bValue.match(dateRegex)[1], 1)}${zeroPad(bValue.match(dateRegex)[2], 1)}`
            : bValue;

        const result = aValueForSort < bValueForSort
          ? -1 * modifier
          : aValueForSort > bValueForSort
            ? 1 * modifier
            : 0;

        return result;
      });

      return clonedTableData;
    },
    paginatedTableData() {
      return this.enablePagination
        ? this.sortedTableData.slice(
          ((this.currentPage - 1) * this.pageSize),
          ((this.currentPage - 1) * this.pageSize + this.pageSize)
        )
        : this.sortedTableData;
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './dataTable';
</style>
