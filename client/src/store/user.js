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
        }
    },
    actions: {

    },
    getters: {
        isLogged (state) {
            return state.isLogged;
        }
    }
})
