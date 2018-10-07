<template>
    <div class="bg-light p-3 rounded border">
        <h3>Join that meeting!</h3>
        <form @submit.prevent="submit">
            <div class="form-group">
                <label>Your name: </label>
                <input v-model="name" type="text" class="form-control" placeholder="Your full name">
            </div>
            <div class="text-sm-right">
                <button class="btn btn-primary btn-dark">Add me!</button>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('meeting', 'addAttendee'),
        submit() {
            this.addAttendee(this.name)
        },
    },
    data: () => {
        return {
            name: ""
        }
    }
}
</script>

<style>

</style>
