<template>
  <v-data-table
    :headers="headers"
    :items="theses"
    sort-by="title"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Abschlussarbeiten verwalten</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="indigo"
              dark
              class="mx-2"
              fab
              v-bind="attrs"
              v-on="on"
            >
            <v-icon dark>
              mdi-plus
            </v-icon>
            </v-btn>
          </template>
          <v-card>        
           <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>
            <v-card-text>

             <v-form
                ref="form"
                v-model="valid"
                lazy-validation
             >
                <v-text-field
                v-model="editedItem.title"
                :counter="10"
                :rules="textRules"
                label="Titel"
                required
                ></v-text-field>

                <v-text-field
                v-model="editedItem.publisher"
                :rules="textRules"
                label="Herausgeber"
                required
                ></v-text-field>

                <v-text-field
                v-model="editedItem.proglang"
                :rules="textRules"
                label="Technologie"
                required
                ></v-text-field>

                <v-select
                v-model="select"
                :items="items"
                :rules="[v => !!v || 'Item is required']"
                label="Studiengang"
                required
                chips
                multiple
                solo
                ></v-select>

                <v-textarea
                  v-model="editedItem.description"
                  clearable
                  clear-icon="mdi-close-circle"
                  label="Beschreibung"
                  value=""
                ></v-textarea>

                <v-file-input
                v-model="editedItem.image"
                accept="image/*"
                show-size
                counter
                chips
                multiple
                label="File input"
                ></v-file-input> 

            </v-form>    
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Abbrechen
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Speichern
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        
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
      <v-btn
       class="mx-2"
       fab
       dark
       small
       color="cyan"
      >
        <v-icon
          @click="editItem(item)"
        >
          mdi-pencil
        </v-icon>
      </v-btn>
      <v-icon
        @click="deleteItemConf"
      >
        mdi-delete
      </v-icon>
      <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItem(item)">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
      </v-dialog>

    </template>
  </v-data-table>
</template>

<script>
import { mapState, mapGetters } from 'vuex';
//import AddTheses from './AddTheses.vue'
  export default {
    data: () => ({
      valid: true,
      textRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 10) || 'Name must be less than 10 characters',
      ],
      /* imageRules: [
        value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
      ], */
      select: null,
      items: [
        'Informatik',
        'Wirtschaftsinformatik',
        'Medieninformatik',
        'Verwaltungsinformatik',
      ],
      checkbox: false,

      dialog: false,
      dialogDelete: false,
      headers: [
        { text: 'TITEL',align: 'title', sortable: false, value: 'title'},
        { text: 'HERAUSGEBER', value: 'publisher' },
        { text: 'TECHNOLOGY', value: 'proglang' },
        { text: 'FILE', value: 'image' },
        { text: 'TAGS', value: 'addTags'},
        { text: 'ACTIONS', value: 'actions', sortable: false },
      ],

      editedIndex: -1,
      editedItem: {
        title: '',
        publisher: '',
        proglang: '',
        image: null,
        description: '',
      },
      defaultItem: {
        title: '',
        publisher: '',
        proglang: '',
        image: null,
        description: '',
      },
    }),

    computed: {
      ...mapState(['theses', 'tags']),
      ...mapGetters(['getTag']),
      formTitle () {
        return this.editedIndex === -1 ? 'Neue Abschlussarbeit' : 'Abschlussarbeit bearbeiten'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },
    methods: {
      edititemConf () {
        this.dialog = true
      },
      editItem (item) {
        this.editedIndex = this.theses.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true   
        //this.$store.dispatch('editThesis', item);
      },
      deleteItemConf () {
        this.dialogDelete = true
      },
      deleteItem (item) {  
        this.editedIndex = this.theses.indexOf(item)
        this.editedItem = Object.assign({}, item)
    
        this.$store.dispatch('deleteThesis', item);

        this.closeDelete();   
      },

      /* deleteItemConfirm () {
         this.theses.splice(this.editedIndex, 1)
         this.closeDelete()
      }, */

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.theses[this.editedIndex], this.editedItem)
          // Für den Fall , das Thesis nur geändert wurde
          this.$store.dispatch('editThesis', this.editedItem);
        } else {
          //this.theses.push(this.editedItem)

          this.$store.dispatch('createThesis', this.editedItem);

          /* let url = this.url + '/api/theses';
          this.axios.post(url, this.editedItem).then(response => {
                if(response.status) {
                    console.log(response.data);
                } else {
                    console.log("error");
                }
            }) */
        }
        this.close()
      },
    },
  }
</script>
