<template>
<div>
     <h2>Abschlussarbeiten</h2>
     <div>
      
     </div>
 </div>
</template>

<script>

export default {
  name: "Home",
  components: {},
  data() {
    return {
      theses: [],
    }
  },
  methods: {
      loadData() {
        let url = this.url + '/api/getTheses';
        this.axios.get(url).then(response => {
          this.theses = response.data;
        })
      },
      mounted() {
        console.log('Home Komponente');
      },
      clicked(value) {
        this.expanded.push(value)      
      },
    },
};
</script>