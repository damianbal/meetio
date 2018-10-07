export default {
    state: {
        token: "",
    },
    mutations: {
        SET_TOKEN(state, token) {
            this.token = token 
        }
    },
    actions: {
        fetchAuth({commit, dispatch}) {
            let tok = localStorage.getItem("_utoken")

            if(tok != null) {
                commit('SET_TOKEN', tok)
            } else {
                //
                dispatch('createToken')
            }
        },  
        createToken({dispatch}) {
            //var ID = Date.now() + Math.random().toString().slice(2);
            let rt = Math.round((Math.random() * 36 ** 12)).toString(36);

            localStorage.setItem("_utoken", rt)

            dispatch('fetchAuth')
        }
    }
}