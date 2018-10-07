import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

// components
import LoadingComponent from '@/components/LoadingComponent'

// styles
import './assets/styles/style.scss'

Vue.config.productionTip = false

Vue.component('loading-component', LoadingComponent)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
