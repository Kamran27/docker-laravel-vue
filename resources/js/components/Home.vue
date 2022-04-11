<template>
<div>
  <h1>Willkomen</h1>
     <!-- <h2>Tags</h2>
     <div v-for="tag in tags" :key="tag.name">
       {{tag}}
     </div>

     <h2>Abschlussarbeiten</h2>
     <div v-for="thesis in theses" :key="thesis.title">
       {{thesis}}
     </div>

    <h2>Abschlussarbeiten mit Tags</h2>
     <div v-for="thesis in theses" :key="thesis.title">
       <h4>{{ thesis.title }}</h4>
       <div v-for="tag_id in thesis.tag_ids" :key="tag_id">
        <button>{{getTag(tag_id).name}}</button>
       </div>
     </div>

    <h2>Tags mit Abschlussarbeiten</h2>
     <div v-for="tag in tags" :key="tag.name">
       <h4>{{ tag.name }}</h4>
       <div v-for="thesis_titles in tag.theses_ids" :key="thesis_titles">
        <button>{{getThesis(thesis_titles).title}}</button>
       </div>
     </div>  -->
 </div>
</template>

<script>
import { mapState , mapGetters } from 'vuex';
export default {
  /* name: "Home",
  components: {},
  computed: {
      //tags() {return this.$store.state.tags}
      ...mapState(['theses', 'tags']),
      ...mapGetters(['getTag', 'getThesis'])
  },
  mounted() {
      this.$store.dispatch('loadTags');
      this.$store.dispatch('loadTheses');
    },
  methods: {
      mounted() {
        console.log('Home Komponente');
      },
      clicked(value) {
        this.expanded.push(value)      
      },
    }, */
};
</script>