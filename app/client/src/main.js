import Vue from 'vue'
import './plugins/axios'

import App from './App.vue'
import router from './router'

import apiConfig from './config/api.js';

Vue.config.productionTip = false

new Vue({
  router,
  data: {
    api: apiConfig,
  },
  render: h => h(App)
}).$mount('#app')
