<template>
  <v-data-table
    :headers="headers"
    :items="theses"
    sort-by="titel"
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
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Neue Abschlussarbeit
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
                v-model="editedItem.titel"
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

                <v-checkbox
                v-model="checkbox"
                :rules="[v => !!v || 'You must agree to continue!']"
                label="Do you agree?"
                required
                ></v-checkbox>

                <v-btn
                :disabled="!valid"
                color="success"
                class="mr-4"
                @click="validate"
                >
                Validate
                </v-btn>

                <v-btn
                color="error"
                class="mr-4"
                @click="reset"
                >
                Reset Form
                </v-btn>

                <v-btn
                color="warning"
                @click="resetValidation"
                >
                Reset Validation
                </v-btn>
            </v-form>    
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
      <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
      </v-dialog>

    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
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
        { text: 'TITEL',align: 'titel', sortable: false, value: 'titel'},
        { text: 'HERAUSGEBER', value: 'publisher' },
        { text: 'TECHNOLOGY', value: 'proglang' },
        { text: 'FILE', value: 'image' },
        { text: 'ACTIONS', value: 'actions', sortable: false },
      ],

      theses: [],
      fileData: null,

      url: document.head.querySelector('meta[name="url"]').content,

      editedIndex: -1,
      editedItem: {
        titel: '',
        publisher: '',
        proglang: '',
        image: null,
        description: '',
      },
      defaultItem: {
        titel: '',
        publisher: '',
        proglang: '',
        image: null,
        description: '',
      },
    }),

    computed: {
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

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
            let url = this.url + '/api/getTheses';
            this.axios.get(url).then(response => {
                this.theses = response.data;
            })
      },

      editItem (item) {
        this.editedIndex = this.theses.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true





        
      },

      deleteItem (item) {
       
        this.editedIndex = this.theses.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true

       
          let url = this.url + `/api/deleteThesis/${item.id}`;
          this.axios.delete(url).then(response => {                   
                  if(response.status) {
                      console.log(response.data);
                  } else {
                      console.log("error");
                  }
              })    
      },

      deleteItemConfirm () {
        //this.initialize();
        this.theses.splice(this.editedIndex, 1)
        this.closeDelete()
      },

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

        /* f (!this.editedItem.image) {this.fileData = "No File Chosen"}
        var reader = new FileReader();
      
        // Use the javascript reader object to load the contents
        // of the file in the v-model prop
        
        reader.readAsText(this.editedItem.image[0]);

        reader.onload = () => {
            
            this.fileData = reader.result;
        }

        this.editedItem.image = this.fileData; */

        if (this.editedIndex > -1) {
          Object.assign(this.theses[this.editedIndex], this.editedItem)
        } else {
          this.theses.push(this.editedItem)
          let url = this.url + '/api/theses';
          this.axios.post(url, this.editedItem).then(response => {
                if(response.status) {
                    console.log(response.data);
                } else {
                    console.log("error");
                }
            })
        }
        this.close()
      },

      validate () {
        this.$refs.form.validate()
      },
      reset () {
        this.$refs.form.reset()
      },
      resetValidation () {
        this.$refs.form.resetValidation()
      },

    },
  }
</script>
