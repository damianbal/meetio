import meetingApi from '@/api/meeting'

export default {
    namespaced: true,
    state: {
        id: 0,
        title: "Loading..",
        description: "Loading...",
        location: "Loading...",
        date: "01-01-2099",
        attendees:[],
    },
    mutations: {
        SET_ID(state,id) {
            state.id = id
        },
        SET_TITLE(state, title) {
            state.title = title 
        },
        SET_DESCRIPTION(state, description) {
            state.description = description
        },
        SET_LOCATION(state, location) {
            state.location = location
        },
        SET_DATE(state, date) {
            state.date = date
        },
        SET_ATTENDEES(state, attendees) {
            state.attendees = attendees
        },
        ADD_ATTENDEE(state, attendee) {
            state.attendees.push(attendee)
        }
    },
    actions: {
        async addAttendee({ commit }, attendee) {
            commit('ADD_ATTENDEE', attendee)

            // API CALL 
        },
        async fetchMeeting({ commit }, id) {
            let resp = await meetingApi.getMeeting(id)

            if(resp.data.success)
            {
                commit('SET_TITLE', resp.data.title)
                commit('SET_DESCRIPTION', resp.data.description)
                commit('SET_LOCATION', resp.data.location)
                commit('SET_DATE', resp.data.date)
                commit('SET_ID', resp.data.id)
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
            return `TODO`
        }
    }
}