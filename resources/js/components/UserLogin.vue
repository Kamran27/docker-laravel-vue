<template>
    <v-container>
        <h2>Login {{ loginInfo }}</h2>
        <v-form v-model="valid">
            <v-text-field v-model="loginInfo.email" 
                            label="Email"
                            :rules="[required('email'), emailFormat()]">
            </v-text-field>
            <v-text-field v-model="loginInfo.password" 
                            label="Password" 
                            :type="showPassword ? 'text' : 'password'"
                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                            @click:append="showPassword = !showPassword"
                            :rules="[required('password'), minLength('password', 3)]">
             </v-text-field>

            <v-btn @click="loginUser" :disabled="!valid">Login</v-btn>
        </v-form>
    </v-container>
</template> 

<!-- App.vue -->

<script>
import validations from "../utils/validations";
import { mapState } from 'vuex';
export default {
  name: 'UserLogin',  
    data() {
        return {
            showPassword: false,
            loginInfo: {
                email:'',
                password: ''
            },
            valid: false,
            ...validations,
        }
    },
    computed: {
        ...mapState(['snackbar','token'])
    },
    methods: {
        async loginUser() {
            let user = await this.$store.dispatch('loginUser', this.loginInfo);
            if (user.error) {
                this.$store.dispatch('setSnackbar', {
                color: 'red accent-2',
                text: `${user.error} Nicht angemeldet.` });
            } else {
                this.$store.dispatch('setSnackbar', {
                text: ` ${user.name} erfolgreich angemeldet.` });
                //alert('Danke für die Anmeldung, ' + user.name)
                if(user.admin) {
                    this.$router.push('admin/theses');
                } else {
                    this.$router.push('/');
                }
            }
        },
    },
};
</script>