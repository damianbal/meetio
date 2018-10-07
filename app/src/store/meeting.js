import meetingApi from '@/api/meeting'

export default {
    namespaced: true,
    state: {
        title: "Loading..",
        description: "Loading...",
        attendees:[],
    },
    mutations: {
        SET_TITLE(state, title) {
            state.title = title 
        },
        SET_DESCRIPTION(state, description) {
            state.description = description
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
            }
            else 
            {
                commit('SET_TITLE', 'Not found')
                commit('SET_DESCRIPTION', 'Meeting with that ID does not exist')
            }
       
        }
    }
}