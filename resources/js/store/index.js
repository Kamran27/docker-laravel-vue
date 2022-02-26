import Vue from "vue";
import Vuex from "vuex";
import Api from "../services/api"

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        theses: [],
        tags: [],
    },
    mutations: {
        SET_THESES(state,theses) {
            state.theses = theses;
        },
        SET_TAGS(state,tags) {
            state.tags = tags;
        },
    },
    actions: {
        async loadData({commit}) {
            let response = await Api().get('/getTheses');
           
            commit('SET_THESES', response.data);  
            commit('SET_TAGS', response.data);    
          },
    },
    modules: {},
});