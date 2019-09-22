import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        
        data: {},
        token: "",
        isLogged: false

    },
    mutations: {
        save (state, user) {
            state.token = user.token;
            state.data = user;
        },
        changeIsLogged (state, bool) {
            state.isLogged = bool;
		},
		logoutUser (state, data) {
			state.data = data;
			state.token = "";
			state.isLogged = false;
		}
    },
    actions: {

    },
    getters: {
        isLogged (state) {
            return state.isLogged;
		},
        getToken (state) {
            return state.token;
        },
    }
})
