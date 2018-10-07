<template>
    <div class="card">
        <div class="card-header"><i class="fas fa-calendar"></i> Create Meeting</div>

        <div class="card-body">
            <form @submit.prevent="submit">
                <div class="row">
                    <div class="col-sm-8">
              <div class="form-group">
                    <label>Title</label> 
                    <input v-model="title" minlength="3" placeholder="Title of event" type="text" class="form-control">
                </div>
                    </div>
                    <div class="col-sm-4">
           <label>Location</label> 
                    <input v-model="location" minlength="3" placeholder="Location of event" type="text" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea v-model="description" placeholder="Description of event" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Date <small class="text-muted">(When does that event take place?)</small></label>
                           
                            <input v-model="date" class="form-control" type="date">
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

export default {
    methods: {
        async submit() {
    
            let jDate = new Date(this.date)
            let mdy = `${jDate.getDay()}-${jDate.getMonth()}-${jDate.getFullYear()}`
           
           console.log(mdy)

            //let resp = await MeetingAPI.createMeeting(this.title, this.description, this.location, mdy)

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
