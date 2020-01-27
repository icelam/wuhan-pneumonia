<template>
  <div>
    <div class="remarks" v-if="lastUpdate">截至 {{lastUpdate}}</div>
    <div class="row">
      <div class="column column--25">
        <statistic :count="totalConfirmed" label="宗確診病例" cardColor="red" />
      </div>
      <div class="column column--25">
        <statistic :count="totalSuspected" label="宗懷疑個案" cardColor="yellow" />
      </div>
      <div class="column column--25">
        <statistic :count="totalCured" label="宗治癒個案" cardColor="green" />
      </div>
      <div class="column column--25">
        <statistic :count="totalDead" label="宗死亡病例" cardColor="grey" />
      </div>
    </div>
  </div>
</template>

<script>
import { statistic } from '@components';
import { getOverseasSum, formatDate } from '@utils';

export default {
  components: {
    statistic
  },
  props: {
    virusSummary: {
      type: Object,
      required: true
    },
    overseasSummary: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      overseasCount: undefined
    };
  },
  methods: {
    getOverseasCounts() {
      const count = {
        confirmedCount: getOverseasSum(this.overseasSummary, 'confirmedCount'),
        suspectedCount: getOverseasSum(this.overseasSummary, 'suspectedCount'),
        curedCount: getOverseasSum(this.overseasSummary, 'curedCount'),
        deadCount: getOverseasSum(this.overseasSummary, 'deadCount')
      };

      this.overseasCount = count;
    }
  },
  beforeMount() {
    this.getOverseasCounts();
  },
  watch: {
    overseasSummary() {
      this.getOverseasCounts();
    }
  },
  computed: {
    lastUpdate() {
      const { modifyTime } = this.virusSummary;
      return formatDate(modifyTime);
    },
    totalConfirmed() {
      return this.overseasCount
        ? this.virusSummary.confirmedCount + this.overseasCount.confirmedCount
        : this.virusSummary.confirmedCount;
    },
    totalSuspected() {
      return this.overseasCount
        ? this.virusSummary.suspectedCount + this.overseasCount.suspectedCount
        : this.virusSummary.suspectedCount;
    },
    totalCured() {
      return this.overseasCount
        ? this.virusSummary.curedCount + this.overseasCount.curedCount
        : this.virusSummary.curedCount;
    },
    totalDead() {
      return this.overseasCount
        ? this.virusSummary.deadCount + this.overseasCount.deadCount
        : this.virusSummary.deadCount;
    }
  }
};
</script>
