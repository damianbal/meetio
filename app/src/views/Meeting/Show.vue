<template>
<div class="card shadow-sm border-0">
    <div class="card-header">Meeting: {{ title }} </div>

    <loading-component v-if="loading">Loading</loading-component>

    <div v-else class="card-body">
        <div class="row">
            <div class="col-sm-8">
                <div>
                    Description: {{ description }}
                </div>

                <div>
                    Location: {{ location }}
                </div>

                <div>Date: {{ fullDate }} </div>
            </div>

            <div class="col-sm-4">
<h3 class="text-muted"><i class="fas fa-users"></i>  People coming</h3>

                <div v-if="attendees.length < 1">There is no body coming yet!</div>

                <transition-group name="fade">
                <div class="row mb-3" v-for="(attendee, idx) in attendees" :key="idx">
<div class="col-sm-1"><i class="far fa-user bg-primary circle p-2 text-white"></i></div>
                     <div class="col-sm-11">&nbsp;{{ attendee.name }}</div>
                </div>
                </transition-group>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <add-attendee-component />
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex'

import AddAttendeeComponent from '@/components/AddAttendeeComponent'
import LoadingComponent from '@/components/LoadingComponent'

export default {
    props: ["id"],
    computed: {
        ...mapState('meeting', ['title', 'description', 'location', 'attendees']),
        ...mapGetters('meeting', ['fullDate'])
    },
    async mounted() {
        this.loading = true
        await this.fetchMeeting(this.id)
        this.loading = false
    },
    watch: {
        '$route': async function(to, from) {
            this.loading = true
            await this.fetchMeeting(this.id)
            this.loading = false
        }
    },
    methods: {
        ...mapActions({
            fetchMeeting: 'meeting/fetchMeeting'
        })
    },
    data: () => {
        return {
            loading: true
        }
    },
    components: { AddAttendeeComponent, LoadingComponent }
}
</script>

<style>

</style>
