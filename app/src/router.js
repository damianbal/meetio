import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'

import MeetingShow from './views/Meeting/Show.vue'
import MeetingCreate from './views/Meeting/Create.vue'
import MeetingSearch from './views/Meeting/Search.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/meeting/:id',
      name: 'meetingShow',
      component: MeetingShow,
      props: true,
    },
    {
      path: '/meeting-create',
      name: 'meetingCreate',
      component: MeetingCreate,
      props: true
    },
    {
      path: '/search',
      name: 'meetingSearch',
      component: MeetingSearch,
      props: true,
    }
  ]
})
