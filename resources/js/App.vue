<template>
    <v-app>
        <v-app-bar app color="blue">
            <v-btn to="/" text>
                Home
            </v-btn>
            <v-btn to="/theses" text>
                <span class="mr-2">Abschlussarbeiten</span>
            </v-btn>
            <v-btn to="/admin" text>
                <span class="mr-2">Admin</span>
            </v-btn>
        </v-app-bar>
        <v-main>
            <router-view />
        </v-main>
  </v-app>
</template> 

<!-- App.vue -->

<script>

export default {
  name: 'app',  
  mounted() {
      this.$store.dispatch('loadTheses');
      this.$store.dispatch('loadTags');
    },
};
</script>
