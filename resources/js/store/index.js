import Vue from "vue";
import Vuex from "vuex";
import Api from "../services/api"

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        theses: [],
        tags: [],
        users: [],
        currentUser: {},
    },
    mutations: {
        SET_THESES(state, theses) {
            state.theses = theses;
        },
        SET_TAGS(state, tags) {
            state.tags = tags;
        },
        SET_USERS(state, users) {
            state.users = users;
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
        LOGOUT_USER(state) {
            state.currentUser = {}
            window.localStorage.currentUser = JSON.stringify({});
        },
        SET_CURRENT_USER(state, user) {
            state.currentUser = user;
            window.localStorage.currentUser = JSON.stringify(user);
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
        async loadUsers({commit}) {  
            let responseUsers = await Api().get('/users');
            //debugger
            let users = responseUsers.data.data;
            users.forEach(u=> {
                u.attributes.id = u.id;
            });
            //debugger
            commit('SET_USERS', users.map(u => u.attributes));
            
            /* let user = JSON.parse(window.localStorage.currentUser);
            commit('SET_CURRENT_USER', user); */
        },
        async loadCurrentUser({commit}) {  
            let user = JSON.parse(window.localStorage.currentUser);
            commit('SET_CURRENT_USER', user);
        },
        async createThesis({commit}, thesis) { 
            let response = await Api().post('/theses', thesis);
            let savedThesis = response.data.data.attributes;
            //debugger
            commit('ADD_THESES', savedThesis);
        },
        async editThesis({commit}, thesis) { 
            let response = await Api().put(`/theses/${thesis.id}`, thesis);
            //debugger
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
        logoutUser({commit}) {
            commit('LOGOUT_USER')
        },
        async loginUser({commit}, loginInfo) {
             try {
                let response = await Api().post('/login', loginInfo);
                //debugger
                let user = response.data.user;
                
                commit('SET_CURRENT_USER', user);
                return user;
             } catch {
                 return {error: 
                    "Email/password Kombination war leider falsch. Bitte, versuchen Sie nochmal."}
             }
             
        },
        async registerUser({commit}, registerInfo) {
            try {
               let response = await Api().post('/register', registerInfo);
               let user = response.data.user;
               debugger
               //let ustok = response.data;
               //let token = response.data.token;
               
              /*  ustok.forEach(u=> {
                     u.user.token = u.token;
               }); */   
               //debugger
               commit('SET_CURRENT_USER', user);
               //commit('SET_USERS', user);
               return user;
            } catch {
                return {error: "Es gab einen Fehler. Bitte versuchen Sie nochmal"}
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