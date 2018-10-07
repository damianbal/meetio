import axios from 'axios'

export default {
    getMeeting(id) {
        return axios.get(`/meetings/${id}`)
    },
    createMeeting(title, description, location) {
        return axios.post('/meetings', {title,description,location})
    },
}