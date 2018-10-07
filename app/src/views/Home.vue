<template>
    <div class="row">
        <div class="col-sm-12">
        <div class="card shadow-sm border-0">
            <div class="card-header"><i class="fas fa-calendar-alt"></i> Meetings</div> 

            <div class="card-body row text-center">
                        <div v-for="(meeting, idx) in meetings" :key="idx" class="col-sm-3">
            <div>Meeting: {{ meeting.title }}</div>
            <div>
            <button class="btn btn-light btn-sm">Show</button>
            </div>
        </div>
            </div>
        </div>

        </div>
    </div>
</template>

<script>
import Axios from 'axios'

export default {
    mounted() {
        Axios.get('/meetings').then(resp => {
            this.meetings = resp.data
        })
    },
    data: () => {
        return {
            meetings: []
        }
    }
}
</script>

<style>

</style>
