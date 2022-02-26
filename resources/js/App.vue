<template>
    <div>
        <navbar></navbar>
    </div>    
</template>

<script>
import Navbar from './components/Navbar.vue';

export default {
  name: 'app',  
  components: {Navbar},
  mounted() {
      this.$store.dispatch('loadData');
    },

};
</script>
