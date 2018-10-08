<template>
    <div class="card shadow-sm border-0">
        <div class="card-header"><i class="fas fa-calendar"></i> Create Meeting</div>

        <div class="card-body">
            <form @submit.prevent="submit">
                <div class="row">
                    <div class="col-sm-8">
              <div class="form-group">
                    <label>Title</label> 
                    <input v-model="title" minlength="3" placeholder="Title of event" type="text" class="form-control" required>
                </div>
                    </div>
                    <div class="col-sm-4">
           <label>Location</label> 
                    <input v-model="location" minlength="3" placeholder="Location of event" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea minlength="10" v-model="description" placeholder="Description of event" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Date <small class="text-muted">(When does that event take place?)</small></label>
                           
                            <input v-model="date" class="form-control" type="date" required>
                        </div>
                    </div>

                </div>
                
                <div class="text-right m-3">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-plus"></i> Create Meeting</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import MeetingAPI from "@/api/meeting"

import moment from 'moment'

export default {
    methods: {
        async submit() {
            let mdy = moment(this.date, 'YYYY-MM-DD').format('DD-MM-YYYY')

            let resp = await MeetingAPI.createMeeting(this.title, this.description, this.location, mdy)

            let success = resp.data.created 

            if(success) {
                let id = resp.data.id 

                alert('Meeting created!')

                this.$router.push({name: 'meetingShow', params: { id } })
            }
            else {
                alert('Could not create meeting!')
            }

            //console.log(resp)
        }
    },
    data: () => {
        return {
            title: "",
            description: "",
            location: "",
            date: "",
        }
    }
}
</script>

<style>

</style>
