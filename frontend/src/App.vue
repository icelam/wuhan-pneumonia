<template>
  <div id="app">
    <app-header />
    <div class="content">
      <div class="container">
        <router-view/>
      </div>
    </div>
  </div>
</template>

<script>
import { appHeader } from '@components';

export default {
  components: {
    appHeader
  },
  name: 'App'
};
</script>

<style lang='scss'>
@import '~@style/index.scss';
</style>
