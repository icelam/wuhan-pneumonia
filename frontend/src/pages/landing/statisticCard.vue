<template>
  <div>
    <div class="remarks" v-if="lastUpdate">截至 {{lastUpdate}}</div>
    <div class="row">
      <div class="column column--25">
        <statistic :count="virusSummary.confirmedCount" label="宗確診病例" cardColor="red" />
      </div>
      <div class="column column--25">
        <statistic :count="virusSummary.suspectedCount" label="宗懷疑個案" cardColor="yellow" />
      </div>
      <div class="column column--25">
        <statistic :count="virusSummary.curedCount" label="宗治癒個案" cardColor="green" />
      </div>
      <div class="column column--25">
        <statistic :count="virusSummary.deadCount" label="宗死亡病例" cardColor="grey" />
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
    virusSummary: {
      type: Object,
      required: true
    }
  },
  computed: {
    lastUpdate() {
      const { modifyTime } = this.virusSummary;
      return formatDate(modifyTime);
    }
  }
};
</script>
