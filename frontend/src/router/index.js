import Router from 'vue-router';
import Vue from 'vue';
import landingPage from '@pages/landing/landing.vue';
import preventionMethodPage from '@pages/preventionMethod/index.vue';
import routes from './routes';

Vue.use(Router);

export default new Router({
  base: process.env.VUE_APP_CONTEXT,
  mode: 'history',
  linkExactActiveClass: 'nav__link--active',
  routes: [
    {
      path: routes.home,
      name: 'Landing Page',
      component: landingPage
    },
    {
      path: routes.preventionMethod,
      name: 'Prevention Method Page',
      component: preventionMethodPage
    },
    {
      path: '*',
      name: 'Not Found Page',
      component: landingPage
    }
  ]
});
