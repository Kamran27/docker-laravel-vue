<template>
<v-container>
 <v-card>
   <v-card-title>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
   </v-card-title>
    <v-data-table
      :headers="thesisHeaders"
      :items="theses"
      :search="search"
      item-key="titel"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Abschlussarbeiten</v-toolbar-title>
        </v-toolbar>
      </template>
      <template v-slot:item.addTags="{ item }">

        <v-chip
          v-for="(it, i) in item.tag_names"  
          :key="i"
          class="mr-2"
          @click="$router.push({ 
            name: '/get_tag' , params: {tag_ids:item.tag_ids} })"
          color="pink"
          >
            <v-icon left>
              mdi-label
            </v-icon>
              <!-- {{getTag(item.tag_ids).name}} -->
              {{it}}
        </v-chip>

      </template>
      <template v-slot:item.actions="{ item }">
        <v-btn rounded 
        color="primary" @click="$router.push({ name: '/get_thesis', 
            params: {id:item.id, tag_ids:item.tag_ids} })">
        Mehr
        </v-btn>
      </template>
  </v-data-table> 
 </v-card>
 </v-container>
</template>

<script>
import { mapState, mapGetters } from 'vuex';
  export default {
    name: "ThesesList",
     data () {
      return {
        expanded: [],
        singleExpand: false,
        search: '',
        //url: document.head.querySelector('meta[name="url"]').content,
        //theses: [],
        thesisHeaders: [
          { text: 'TITEL', value: 'title' },
          { text: 'HERAUSGEBER', value: 'publisher' },
          { text: 'TECHNOLOGIE', value: 'proglang' },
          { text: 'TAGS', value: 'addTags'},
          { text: 'DETAIL', value: 'actions', sortable: false },
        ],  
      }
    },
    computed: {
       ...mapState(['theses', 'tags']),
       ...mapGetters(['getTag'])
    },
    mounted() {
      //this.$store.dispatch('loadTheses');
    },
    created() {
      //this.loadData();
    },
    methods: {
     /*  getTag(tag_id) { 
        console.log(tag_id, this.tags);
        return this.tags.find(t => t.id == t.tag_id);
      }, */
      /* loadData() {
        let url = this.url + '/api/getTheses';
        this.axios.get(url).then(response => {
          this.theses = response.data;
        })
      },
      mounted() {
        console.log('ThesesList Komponente');
      }, */
    },

  }
</script>
