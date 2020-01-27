<template>
  <div class="header">
    <div class="container">
      <!-- Logo -->
      <router-link :to="appRoutes.home">
        <img src="~@images/logo/logo.svg" class="logo" alt="武漢肺炎感染即時資訊"/>
      </router-link>
      <!-- /Logo -->

      <!-- Nav -->
      <ul class="nav" :class="{ 'nav--open': showNav }">
        <li>
          <router-link
            :to="appRoutes.home"
            v-on:click.native="closeNav"
            class="nav__link"
          >
            即時數據
          </router-link>
        </li>
        <li>
          <router-link
            :to="appRoutes.preventionMethod"
            v-on:click.native="closeNav"
            class="nav__link"
            >
            防疫資訊
          </router-link>
        </li>
      </ul>
      <!-- /Nav -->

      <!-- Hamburger -->
      <div class="hamburger" :class="{ 'hamburger--active': showNav }" v-on:click="toggleNav">
        <span class="hamburger__strip"></span>
      </div>
      <!-- /Hamburger -->
    </div>
  </div>
</template>

<script>
import routes from '@router/routes';

export default {
  data() {
    return {
      appRoutes: routes,
      showNav: false
    };
  },
  methods: {
    toggleNav() {
      const navStatus = this.showNav;
      this.showNav = !navStatus;
    },
    closeNav() {
      this.showNav = false;
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './header';
</style>
