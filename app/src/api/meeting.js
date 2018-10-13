import axios from 'axios';

import querystring from 'querystring';

export default {
    getMeeting(id) {
        return axios.get(`/meetings/${id}`);
    },
    getMeetings(page) {
        return axios.get(`/meetings?page=${page}`);
    },
    createMeeting(title, description, location, meetingDate = '01-01-2055') {
        let data = {
            title,
            description,
            location,
            date: meetingDate
        };
        return axios.post('/meetings', querystring.stringify(data));
    },
    search(query) {
        if(query.length < 1) query = "Meeting"
        return axios.get(`/meetings/search/${query}`);
    },
    addAttendee(meetingId, name) {
        let data = { name };
        return axios.post(`/meetings/${meetingId}/attendees`, querystring.stringify(data));
    }
}