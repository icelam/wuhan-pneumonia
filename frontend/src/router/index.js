import Router from 'vue-router';
import Vue from 'vue';
import landingPage from '@pages/landing/landing.vue';

Vue.use(Router);

export default new Router({
  base: process.env.VUE_APP_CONTEXT,
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Landing Page',
      component: landingPage
    }
  ]
});
