<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow-sm border-0">
            <div class="card-header"><i class="fas fa-calendar-alt"></i> Meetings</div>

            <div class="card-body row text-center">

                <transition name="fade">
                    <loading-component v-if="loading" />
                </transition>

              
                <meeting-card v-for="(meeting, idx) in meetings" 
                    :key="idx" 
                    :title="meeting.title" 
                    :id="meeting.id" />
             

                <div class="col-sm-12 mt-3">
                    <button class="btn btn-light btn-sm btn-block p-3" @click="load"><i class="fas fa-arrow-down"></i>
                        Load Older Meetings</button>
                </div>
            </div>

        </div>
    </div>
</div>
</template>

<script>
import Axios from "axios";

import MeetingAPI from "@/api/meeting";

import { mapActions, mapState } from "vuex";

import MeetingCard from "@/components/MeetingCard"

export default {
  async mounted() {
    this.loading = true

    await this.reset()
    await this.fetchMeetings();

    this.loading = false

    setInterval(async () => {
      await this.reset()
      await this.fetchMeetings()
    }, 5000)  
  },
  methods: {
    ...mapActions({
      fetchMeetings: "meetings/fetchMeetings",
      reset: "meetings/reset"
    }),
    async load() {
        this.loading = true
        

        setTimeout(() => {
            this.fetchMeetings()
            this.loading = false
        }, 500)
        
    }
  },
  computed: {
    ...mapState("meetings", ["meetings"])
  },
  data: () => {
    return {
      //   meetings: []
      loading: false
    };
  },
  components: { MeetingCard }
};
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
