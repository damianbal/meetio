<template>
    <div class="bg-light p-3 rounded border" >
        <h3>Join that meeting!</h3>
        <form v-if="added == false" @submit.prevent="submit">
            <div class="form-group">
                <label>Your name: </label>
                <input minlength="3" v-model="name" type="text" class="form-control" placeholder="Your full name" required>
            </div>
            <div class="text-sm-right">
                <button class="btn btn-primary btn-dark">Add me!</button>
            </div>
        </form>

        <div v-if="added">
            <div class="alert alert-success">
                You are added to that meeting!
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('meeting', {
            addAttendee: 'addAttendee',
        }),
        async submit() {
            let resp = await this.addAttendee(this.name)

            if(resp.data.created)
            {
                this.name = ""
                this.added = true
            }
            else 
            {
                alert('Could not add you to meeting: ' + resp.data.message)
            }
        },
    },
    data: () => {
        return {
            name: "",
            added:false,
        }
    }
}
</script>

<style>

</style>
