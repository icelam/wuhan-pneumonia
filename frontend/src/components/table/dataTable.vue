<template>
  <div :class="['data-table', `data-table--${tableHead ? 'even' : 'odd'}-highlight`]">
    <div class="data-table__head" v-if="tableHead">
      <div
        :class="['data-table__cell', `data-table__cell--${cellAlignment[i] || 'left'}`]"
        v-for="(head, i) in tableHead"
        :key="i"
      >
        {{head}}
      </div>
    </div>
    <div class="data-table__row" v-for="(rows, i) in tableData" :key="i">
      <div
        :class="['data-table__cell', `data-table__cell--${cellAlignment[i] || 'left'}`]"
        v-for="(cells, i) in rows"
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
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './dataTable';
</style>
