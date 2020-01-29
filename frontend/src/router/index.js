import Router from 'vue-router';
import Vue from 'vue';
import liveDataPage from '@pages/liveData/index.vue';
import historicalDataPage from '@pages/historicalData/index.vue';
import preventionMethodPage from '@pages/preventionMethod/index.vue';
import aeWaitingTimePage from '@pages/aeWaitingTime/index.vue';
import { scrollElement } from '@utils';
import routes from './routes.json';

Vue.use(Router);

const router = new Router({
  base: process.env.VUE_APP_CONTEXT,
  mode: 'history',
  linkExactActiveClass: 'nav__link--active',
  routes: [
    {
      path: routes.home,
      name: 'Live Data Page',
      component: liveDataPage
    },
    {
      path: routes.historicalData,
      name: 'Historical Data Page',
      component: historicalDataPage
    },
    {
      path: routes.aeWaitingTime,
      name: 'AE Waiting Time Page',
      component: aeWaitingTimePage
    },
    {
      path: routes.preventionMethod,
      name: 'Prevention Method Page',
      component: preventionMethodPage
    },
    {
      path: '*',
      name: 'Not Found Page',
      component: liveDataPage
    }
  ]
});

router.afterEach(() => {
  const mainContent = document.getElementById('content');
  mainContent && scrollElement(mainContent, 0, 0);
});

export default router;
