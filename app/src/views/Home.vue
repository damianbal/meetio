<template>
    <div class="row">
        <div class="col-sm-12">
        <div class="card shadow-sm border-0">
            <div class="card-header"><i class="fas fa-calendar-alt"></i> Meetings</div> 

            <div class="card-body row text-center">
                <meeting-card v-for="(meeting, idx) in meetings" 
                            :key="idx" 
                            :title="meeting.title"
                            :id="meeting.id" />

                <div class="col-sm-12 mt-3">
  <button class="btn btn-light btn-sm btn-block p-3" @click="fetchMeetings"><i class="fas fa-arrow-down"></i> Load Older Meetings</button>
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
    //let resp = await MeetingAPI.getMeetings(1)

    this.reset()
    this.fetchMeetings();

    //this.meetings = resp.data.data
  },
  methods: {
    ...mapActions({
      fetchMeetings: "meetings/fetchMeetings",
      reset: "meetings/reset"
    })
  },
  computed: {
    ...mapState("meetings", ["meetings"])
  },
  data: () => {
    return {
      //   meetings: []
    };
  },
  components: { MeetingCard }
};
</script>

<style>
</style>
