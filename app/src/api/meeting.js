import axios from 'axios'

export default {
    getMeeting(id) {
        return axios.get(`/meetings/${id}`)
    },
    getMeetings(page) {
        return axios.get(`/meetings?page=${page}`)
    },
    createMeeting(title, description, location, date = '01-01-2055') {
        return axios.post('/meetings', {title,description,location,date})
    },
    addAttendee(meetingId, name) {
        return axios.post(`/meetings/${meetingId}/attendees`, { name })
    }
}