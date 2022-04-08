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
      this.$store.dispatch('loadUsers');
      this.$store.dispatch('loadCurrentUser');
  },
  computed: {
        ...mapState(['users','currentUser'])
   },
   methods: {
       logoutUser() {
           this.$store.dispatch("logoutUser");
       },
   },
};
</script>
