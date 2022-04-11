<template>
    <v-container>
        <h2>Registration {{registerInfo}}</h2>
        <v-form v-model="valid">
            <v-text-field v-model="registerInfo.name" 
                            label="Name"
                            :rules="[required('name')]">
            </v-text-field>
            <v-text-field v-model="registerInfo.email" 
                            label="Email"
                            :rules="[required('email'), emailFormat()]">
            </v-text-field>
            <v-text-field v-model="registerInfo.password" 
                            label="Passwort" 
                            :type="showPassword ? 'text' : 'password'"
                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                            @click:append="showPassword = !showPassword"
                            :rules="[required('password'), minLength('password', 3)]">
             </v-text-field>
             <v-text-field v-model="registerInfo.password_confirmation" 
                            label="Passwort wiederholen" 
                            :type="showPassword ? 'text' : 'password'"
                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                            @click:append="showPassword = !showPassword"
                            :rules="[required('password_confirmation'), minLength('password_confirmation', 3)]">
             </v-text-field>

            <v-btn @click="registerUser" :disabled="!valid">Registrieren</v-btn>
        </v-form>
    </v-container>
</template> 

<!-- App.vue -->

<script>
import validations from "../utils/validations";
import { mapState } from 'vuex';
export default {
  name: 'UserRegistration',  
    data() {
        return {
            showPassword: false,
            registerInfo: {
                name: '',
                email:'',
                password: '',
                password_confirmation: ''
            },
            valid: false,
            ...validations,
        }
    },
    computed: {
        ...mapState(['snackbar'])
    },
    methods: {
        async registerUser() {
            let user = await this.$store.dispatch('registerUser', this.registerInfo);
            if (user.error) {
                this.$store.dispatch('setSnackbar', {
                 text: `${user.error} erfolgreich registriert.` , color: 'error'});
                //alert(user.error)
            } else {
                this.$store.dispatch('setSnackbar', {
                text: `${user.name} erfolgreich registriert.`});
                //alert('Willkomen in unseren WebApp!, ' + user.name)
                this.$router.push('/');
            }
        },
    },
};
</script>