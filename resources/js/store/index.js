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