<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-sm border-0">
                <div class="card-header"><i class="fas fa-search"></i> Search Meetings</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" v-model="searchQuery" placeholder="Search title...">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div v-if="searchQuery.length > 0" class="row">
                        <div class="col-sm-12 text-left small text-muted">
                            Looking for '{{ searchQuery }}' (found {{ meetingsCount }} meetings)
                        </div>
                    </div>

                    <div v-if="searchQuery.length > 0" class="row">
                        <div class="col-sm-12">
                            <div class="text-muted" v-if="meetingsCount < 1">
                                There is no meetings matching that query
                            </div>
                            <div v-else class="row">
                                <meeting-card v-for="(meeting, idx) in meetings" :key="idx" :title="meeting.title" :id="meeting.id" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {
        mapActions,
        mapState,
        mapGetters
    } from 'vuex';

    import MeetingCard from "@/components/MeetingCard"

    export default {
        mounted() {

        },
        methods: {
            ...mapActions({
                searchMeetings: "meetings/search",
            })
        },
        computed: {
            ...mapState("meetings", ["meetings"]),
            ...mapGetters({
                meetingsCount: 'meetings/meetingsCount',
            })
        },
        data: () => {
            return {
                searchQuery: ""
            }
        },
        watch: {
            searchQuery: function (v) {
                // search
                if (this.searchQuery.length > 0) {
                    this.searchMeetings(this.searchQuery)
                }
            }
        },
        components: {
            MeetingCard
        }
    }
</script>

<style>

</style>