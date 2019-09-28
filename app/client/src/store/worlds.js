import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        worlds: [],
    },
    mutations: {
        add (state, world) {
            state.worlds.push (world);
        },
    },
    getters: {
        worlds (state) {
            return state.worlds;
        }
    }
})
