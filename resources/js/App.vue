<template>
    <v-app>
        <v-app-bar app color="blue">
            <v-btn to="/" text>
                Home
            </v-btn>
            <v-btn to="/theses" text>
                <span class="mr-2">Abschlussarbeiten</span>
            </v-btn>
            <v-btn to="/admin/theses" v-if="currentUser.admin" text>
                <span class="mr-2">Admin</span>
            </v-btn>
            <!--  <v-btn to="/users" v-if="currentUser.admin" text>
                <span class="mr-2">Nutzer</span>
            </v-btn> -->
            <v-spacer></v-spacer>
            <div v-if="currentUser.name">
             {{ currentUser.name }}
             <v-btn text @click="logoutUser">Logout</v-btn>
            </div>
            <div v-else>
                <v-btn to="/login" text>
                    <span class="mr-2">Login</span>
                </v-btn>
                <v-btn to="/registration" text>
                <span class="mr-2">Registrieren</span>
            </v-btn>
            </div>    
        </v-app-bar>
        <v-main>
            <v-container>
                <router-view />
                <v-snackbar
                    v-for="snackbar in snackbars"
                    :key="snackbar.text + Math.random()"
                    v-model="snackbar.showing"
                    :timeout="3000"
                    color="snackbar.color"
                >
                    {{snackbar.text}}
                    <v-btn text @click="snackbar.showing = false">
                    Schließen
                    </v-btn>
                </v-snackbar>
            </v-container>
        </v-main>
    </v-app>
</template> 
<!-- App.vue -->
<script>
import { mapState } from 'vuex';
export default {
  name: 'app',  
  mounted() {
      this.$store.dispatch('loadTheses');
      this.$store.dispatch('loadTheses');
      this.$store.dispatch('loadTags');
      this.$store.dispatch('loadCurrentUser');
  },
  computed: {
        ...mapState(['users','currentUser', 'snackbars','token'])
   },
   methods: {
       logoutUser() {
           this.$store.dispatch("logoutUser");
       },
   },
};
</script>
