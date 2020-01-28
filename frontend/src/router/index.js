import Router from 'vue-router';
import Vue from 'vue';
import liveDataPage from '@pages/liveData/index.vue';
import preventionMethodPage from '@pages/preventionMethod/index.vue';
import { scrollElement } from '@utils';
import routes from './routes';

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
