<template>
  <div>
    <div class="remarks" v-if="lastUpdate">截至 {{ lastUpdate }}</div>
    <div class="row">
      <div
        class="column column--25"
        v-for="statistics in formattedLatestSuitation"
        :key="statistics.label"
      >
        <statistic
          :count="statistics.count"
          :label="statistics.displayLabel"
          :cardColor="statistics.color"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { statistic } from '@components';
import { formatDate } from '@utils';

export default {
  components: {
    statistic
  },
  props: {
    latestSuitationData: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      formattedLatestSuitation: undefined,
      latestSuitationLastUpdate: undefined
    };
  },
  methods: {
    getStatisticLabelAndColor(data) {
      const { label, count } = data;

      const displayLabel = label === '仍然住院接受檢查個案'
        ? '宗住院檢查'
        : label === '死亡'
          ? '宗死亡個案'
          : `宗${label}`;

      const color = label === '確診個案'
        ? 'red'
        : label === '排除個案' || label === '出院'
          ? 'green'
          : label === '仍然住院接受檢查個案' || label === '疑似個案'
            ? 'yellow'
            : 'grey';

      return {
        displayLabel,
        count: parseInt(count, 10),
        color
      };
    },
    formatStatistics() {
      const { data: statistics, lastUpdate } = this.latestSuitationData;

      const formattedLatestSuitation = statistics.filter(
        (s) => ['確診個案', '出院', '疑似個案', '死亡'].includes(s.label)
      ).map(
        (s) => this.getStatisticLabelAndColor(s)
      );

      // Sort with specific order
      const colorOrder = ['red', 'yellow', 'green', 'grey'];
      formattedLatestSuitation.sort((a, b) => (
        colorOrder.indexOf(a.color) > colorOrder.indexOf(b.color) ? 1 : -1
      ));

      this.formattedLatestSuitation = formattedLatestSuitation;
      this.latestSuitationLastUpdate = lastUpdate;
    }
  },
  beforeMount() {
    this.formatStatistics();
  },
  watch: {
    overseasSummary() {
      this.formatStatistics();
    }
  },
  computed: {
    lastUpdate() {
      return formatDate(this.latestSuitationLastUpdate * 1000);
    }
  }
};
</script>
