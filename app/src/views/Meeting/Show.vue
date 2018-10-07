<template>
    <div class="card">
        <div class="card-header">Meeting: {{ title }} </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
            {{ description }}
            </div>

            <div class="col-sm-4">
                Osoby
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    props: ["id"],
    computed: {
        ...mapState('meeting', ['title', 'description'])
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
    }
}
</script>

<style>

</style>
