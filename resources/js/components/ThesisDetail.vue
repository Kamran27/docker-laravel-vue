<template>
  <v-card
    class="mx-auto"
    max-width="1000"
  >
    <v-img
      src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
      height="200px"
    ></v-img>

    <v-card-title>
     {{getThesis(this.$route.params.id).title}}
    </v-card-title>

    <v-card-subtitle>   
    {{getThesis(this.$route.params.id).publisher}}
    </v-card-subtitle>

    <v-card-subtitle>   
     <v-chip
        class="mr-2"
        @click="lights"
        color="pink"
        >
        <v-icon left>
          mdi-label
        </v-icon>
          {{getTag(this.$route.params.tag_ids).name}}
      </v-chip>
    </v-card-subtitle>

    <v-card-actions>
      <v-btn
        color="orange lighten-2"
        text
      >
        Exportieren als PDF
      </v-btn>

      <v-spacer></v-spacer>

      <v-btn
        icon
        @click="show = !show"
      >
        <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
      </v-btn>
    </v-card-actions>

    <v-expand-transition>
      <div v-show="show">
        <v-divider></v-divider>

        <v-card-text>
           {{getThesis(this.$route.params.id).description}}
        </v-card-text>
      </div>
    </v-expand-transition>
  </v-card>
</template>

<script>
import { mapState , mapGetters } from 'vuex';
  export default {
    data: () => ({
      show: false,
     /*  thesis() {
        return theses.find(tid=>tid.id == this.$route.params.id) || {}
      }, */
     /*  url: document.head.querySelector('meta[name="url"]').content,
      thesis: {}, */

    }),
    computed: {
       ...mapState(['theses', 'tags']),
       ...mapGetters(['getThesis','getTag'])
    },
   /*  created() {
      this.loadData();
    }, */
    methods: {
      lights () {
        console.log(this.theses.tag_ids);
      },
     /*  loadData() {
        let url = this.url + `/api/get_thesis/${this.$route.params.id}`;
        this.axios.get(url).then(response => {
          this.thesis = response.data;
          console.log(this.thesis);
        })
        console.log(this.theses);
      }, */
      mounted() {
        //this.$store.dispatch('loadTheses');
      },
    },
  }
</script>