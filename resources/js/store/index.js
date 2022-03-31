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
        SET_THESES(state, theses) {
            state.theses = theses;
        },
        SET_TAGS(state, tags) {
            state.tags = tags;
        },
        ADD_THESES(state, thesis) {
            let theses =  state.theses.concat(thesis);
            state.theses = theses;
        },
        EDIT_THESES(state, thesis) {
            state.theses.forEach(t=> {
                if (t.id == thesis.id) {
                    t = thesis;
                    
                }
            })
        },
        DELETE_THESES(state, thesisId) {
            let theses =  state.theses.filter(t=>t.id != thesisId);
            state.theses = theses;
        },
    },
    actions: {
        async loadTheses({commit}) {
            let responseTheses = await Api().get('/theses');
            //let theses = responseTheses.data.data.map(t=>t.attributes);
            let theses = responseTheses.data.data;
            theses.forEach(t => {
                t.attributes.tag_ids = t.relationships.tag.map(t => t.id);
                t.attributes.tag_names = t.relationships.tag.map(t => t.name);
                t.attributes.id = t.id;
            });
            //debugger
            commit('SET_THESES', theses.map(t => t.attributes));     
        },
        async loadTags({commit}) { 
            let responseTags = await Api().get('/tags');
            //let tags = responseTags.data.data.map(t => t.attributes);
            let tags = responseTags.data.data;
             tags.forEach(t => {
                t.attributes.theses_ids = t.relationships.thesis.map(t => t.id);
                t.attributes.theses_titles = t.relationships.thesis.map(t => t.title);
                t.attributes.id = t.id;
            }); 
            //debugger
            //commit('SET_TAGS', tags);
            commit('SET_TAGS', tags.map(t => t.attributes));    
        },
        async createThesis({commit}, thesis) { 
            let response = await Api().post('/theses', thesis);
            let savedThesis = response.data.data.attributes;
            //debugger
            commit('ADD_THESES', savedThesis);
        },
        async editThesis({commit}, thesis) { 
            let response = await Api().put(`/theses/${thesis.id}`, thesis);
            debugger
            let editedThesis = response.data.data.attributes;
            
            commit('EDIT_THESES', editedThesis);
        },
        async deleteThesis({commit}, thesis) { 
            let response = await Api().delete(`/theses/${thesis.id}`);
            //debugger
            if (response.status == 200 || response.status == 204) {
                commit('DELETE_THESES', thesis.id);
            } 
        },
    },
    getters: {
        getTag: state => id => {   
            //debugger
            return state.tags.find(t=>t.id == id);     
        },
        getThesis: state => id => {  
            //debugger
            return state.theses.find(t=>t.id == id);         
        },
    },
    modules: {},
});