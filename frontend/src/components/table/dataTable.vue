<template>
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
    <div class="data-table__row"
      v-for="(row, i) in sortedTableData"
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
</template>

<script>
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
      if (!this.enableSort || this.currentSortColumn === -1) {
        return this.tableData;
      }

      // Fast and lazy way to deep clone array
      const clonedTableData = JSON.parse(JSON.stringify(this.tableData));

      clonedTableData.sort((a, b) => {
        const modifier = this.currentSortDirection === 'asc' ? 1 : -1;

        // handle integer sort
        const aValue = /^\d+$/.test(a[this.currentSortColumn])
          ? parseInt(a[this.currentSortColumn], 10)
          : a[this.currentSortColumn];

        const bValue = /^\d+$/.test(b[this.currentSortColumn])
          ? parseInt(b[this.currentSortColumn], 10)
          : b[this.currentSortColumn];

        const result = aValue < bValue
          ? -1 * modifier
          : aValue > bValue
            ? 1 * modifier
            : 0;

        return result;
      });

      return clonedTableData;
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './dataTable';
</style>
