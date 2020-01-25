import 'core-js/stable';
import 'regenerator-runtime/runtime';
import 'core-js/es/map';
import 'core-js/es/set';

import Vue from 'vue';

import App from '@app';
import router from '@router';

Vue.config.productionTip = false;

new Vue({
  router,
  render: (h) => h(App)
}).$mount('#app');

if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('./service-worker.js').then((registration) => {
      console.log('SW registered: ', registration);
    }).catch((registrationError) => {
      console.log('SW registration failed: ', registrationError);
    });
  });
}
