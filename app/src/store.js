import Vue from 'vue'
import Vuex from 'vuex'

import meeting from './store/meeting'
import meetings from './store/meetings'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    meeting: meeting,
    meetings: meetings
  },
  state: {

  },
  mutations: {

  },
  actions: {

  }
})
