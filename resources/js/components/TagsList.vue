<template>
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
      :items="thesesOnTag"                    
      :search="search"
      item-key="titel"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Abschlussarbeiten mit dem Tag 
              <v-chip
                 class="ma-2"
                 color="red"
               >
                {{ tag.name }}
            </v-chip>
              
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-switch
            v-model="singleExpand"
            label="Single expand"
            class="mt-2"
          ></v-switch>
        </v-toolbar>
      </template>
      <template v-slot:item.addTags="{ item }">
        <v-chip
        class="mr-2"
        @click="lights"
        color="pink"
        >
        <v-icon left>
          mdi-label
        </v-icon>
           {{getTag(item.tag_ids).name}}
          <!-- {{item.tag_names.toString()}}-->
      </v-chip>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-btn depressed color="primary" @click="$router.push({ name: '/get_thesis',
             params: {id:item.id, tag_ids:item.tag_ids} })">
        Mehr 
        </v-btn>
      </template>
  </v-data-table> 
 </v-card>
</template>

<script>
import { mapState, mapGetters } from 'vuex';
  export default {
    name: "TagsList",
     data () {
      return {
        expanded: [],
        singleExpand: false,
        search: '',
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
       ...mapGetters(['getTag']),
       tag() {
           return this.getTag(this.$route.params.tag_ids)
       },
       thesesOnTag() {
           //return this.theses.filter(t=>t.id == this.tag.theses_ids);
           return this.theses.filter(t=>t.tag_names == this.tag.name);
       }
    },
    methods: {
      lights () {
        console.log(this.theses.tag_ids);
      },
      clicked(value) {
        this.expanded.push(value)      
      },
    },

  }
</script>