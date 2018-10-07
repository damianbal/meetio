import MeetingAPI from '@/api/meeting'

export default {
    namespaced: true,
    state: {
        meetings: [],
        page: 1,
        maxPage: 0,
    },
    mutations: {
        SET_MEETINGS(state, meetings) {
            state.meetings = meetings
        },
        ADD_MEETINGS(state, m) {
            state.meetings.push(...m)
        },
        SET_PAGE(state, page) {
            state.page = page
        },
        SET_MAXPAGE(state, maxPage) {
            state.maxPage = maxPage
        },
        CLEAR_MEETINGS(state) {
            state.meetings = []
        },
        CLEAR_META(state) {
            state.page = 1
            state.maxPage = 0
        }
    },
    actions: {
        reset({commit}) {
            commit('CLEAR_MEETINGS')
            commit('CLEAR_META')
        },
        async fetchMeetings({
            commit,
            dispatch,
            state
        }) {
            let resp = await MeetingAPI.getMeetings(state.page)

            console.log(resp.data)

            if (resp.data.data.length < 1) {
                alert("No more to load!");
            } else {

                commit("SET_MAXPAGE", resp.data.meta.lastPage)
                commit('ADD_MEETINGS', resp.data.data)


                if (state.page <= state.maxPage) {
                    commit('SET_PAGE', state.page + 1)

                }
            }
        }
    }
}