export default {
    state: {
        meetings: [],
        page: 1,
        maxPage: 99999,
    },
    mutations: {
        SET_MEETINGS(state, meetings) {
            state.meetings = meetings
        },
        SET_PAGE(state, page) {
            state.page = page 
        },
        SET_MAXPAGE(state, maxPage) {
            state.maxPage = maxPage
        }
    },
    actions: {
        fetchMeetings({ commit, dispatch, state }) {
            // load from api
            // set commit setMeetings
            // set maxPage
            
        }
    }
}