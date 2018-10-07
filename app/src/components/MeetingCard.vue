<template>
    <div class="col-sm-3 mt-3">
        <div class="p-3 w-100 bg-light border">{{ title }}</div>
        <div class="p-3">
            <router-link class="btn btn-primary btn-sm btn-block" :to="{ name: 'meetingShow', params: { id } }">
               <i class="fas fa-info-circle"></i> Show
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: "Meeting Title",
            required: false,
        },
        id: {
            type: Number,
            default: 1,
            required: false,
        }
    }
}
</script>

<style>

</style>
