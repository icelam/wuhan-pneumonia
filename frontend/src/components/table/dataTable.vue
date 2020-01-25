<template>
  <div class="data-table">
    <div class="data-table__row" v-for="(rows, i) in tableData" :key="i">
      <div class="data-table__cell" v-for="(cells, i) in rows" :key="i">
        {{ cells }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    tableData: {
      type: Array,
      required: true
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './dataTable';
</style>
