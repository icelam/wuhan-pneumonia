<template>
  <card class="statistic">
    <div :class="['statistic__number', `statistic__number--${cardColor}`]">
      {{count}}
    </div>
    {{label}}
  </card>
</template>

<script>
import { card } from '@components';

export default {
  components: {
    card
  },
  props: {
    count: {
      type: Number,
      required: true
    },
    label: {
      type: String,
      required: true
    },
    cardColor: {
      validator: (value) => ['red', 'yellow', 'green', 'grey'].indexOf(value) !== -1,
      default: 'grey'
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './statistic';
</style>
