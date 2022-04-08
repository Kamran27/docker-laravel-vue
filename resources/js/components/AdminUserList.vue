<template>
<div>
     <h2>Nutzer</h2>
     <!-- <div v-for="user in users" :key="user.id">
        {{user}} <v-btn x-small @click="loginUser(user)">Login</v-btn>
     </div> -->
     <div v-for="user in users" :key="user.id">
        {{user}} <v-btn x-small @click="loginUser(user)">Login</v-btn>
     </div>
 </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: "UserList",
  components: {},
  computed: {
      //tags() {return this.$store.state.tags}
      ...mapState(['users']),
  },
  mounted() {
      this.$store.dispatch('loadUsers');
    },
  methods: {
     loginUser(user) {
         this.$store.dispatch('loginUser', user);
     }
    },
};
</script>