<template>
    <div class="card">
        <div class="card-header">Meeting: {{ title }} </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <div>
                     Description: {{ description }}
                    </div>

                    <div>
                        Location: {{ location }}
                    </div>

                    <div>Taking place on {{ fullDate }} </div>
            </div>

            <div class="col-sm-4">
                Osoby
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

export default {
    props: ["id"],
    computed: {
        ...mapState('meeting', ['title', 'description', 'location']),
        ...mapGetters('meeting', ['fullDate'])
    },
    mounted() {
        this.fetchMeeting(this.id)
    },
    watch: {
        '$route': function(to, from) {
            this.fetchMeeting(this.id)
        }
    },
    methods: {
        ...mapActions({
            fetchMeeting: 'meeting/fetchMeeting'
        })
    },
    components: { AddAttendeeComponent }
}
</script>

<style>

</style>
