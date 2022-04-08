<template>
    <div>
      <v-tabs>
        <v-tab to="/admin/theses">Abschlussarbeiten</v-tab>
        <v-tab to="/admin/users">Nutzer</v-tab> 
      </v-tabs>
      <router-view></router-view>
    </div>
</template> 

<script>
export default {
  name: 'Admin',  
};
</script>