import meetingApi from '@/api/meeting';
import moment from 'moment';


export default {
    namespaced: true,
    state: {
        id: 0,
        title: "Loading..",
        description: "Loading...",
        location: "Loading...",
        date: "2050-05-05",
        attendees:[],
    },
    mutations: {
        SET_ID(state,id) {
            state.id = id;
        },
        SET_TITLE(state, title) {
            state.title = title;
        },
        SET_DESCRIPTION(state, description) {
            state.description = description;
        },
        SET_LOCATION(state, location) {
            state.location = location;
        },
        SET_DATE(state, date) {
            state.date = date;
        },
        SET_ATTENDEES(state, attendees) {
            state.attendees = attendees;
        },
        ADD_ATTENDEE(state, attendee) {
            state.attendees.push({ name: attendee });
        }
    },
    actions: {
        async addAttendee({ commit, state }, attendee) {
            
            meetingApi.addAttendee(state.id, attendee).then(resp => {
                commit('ADD_ATTENDEE', attendee)
               // console.log(resp.data)
            })
        },
        async fetchMeeting({ commit }, id) {
            let resp = await meetingApi.getMeeting(id)

            if(resp.data.success)
            {
                commit('SET_TITLE', resp.data.title)
                commit('SET_DESCRIPTION', resp.data.description)
                commit('SET_LOCATION', resp.data.location)
                commit('SET_DATE', resp.data.date.date)
                commit('SET_ID', resp.data.id)
                commit('SET_ATTENDEES', resp.data.attendees)
            }
            else 
            {
                commit('SET_TITLE', 'Not found')
                commit('SET_DESCRIPTION', 'Meeting with that ID does not exist')
            }
       
        }
    },
    getters: {
        fullDate: state => {
            return moment(state.date, 'YYYY-MM-DD').format('MM-DD-YYYY')
        }
    }
}