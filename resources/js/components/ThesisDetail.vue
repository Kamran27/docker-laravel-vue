<template>
  <v-card
    class="mx-auto"
    max-width="344"
  >
    <v-img
      src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
      height="200px"
    ></v-img>

    <v-card-title>
     {{thesis.titel}}
    </v-card-title>

    <v-card-subtitle>
     {{thesis.publisher}}
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
           {{thesis.description}}
        </v-card-text>
      </div>
    </v-expand-transition>
  </v-card>
</template>

<script>
  export default {
    data: () => ({
      show: false,

      url: document.head.querySelector('meta[name="url"]').content,
      thesis: {},

    }),
    created() {
      this.loadData();
    },
    methods: {
      loadData() {
        let url = this.url + `/api/get_thesis/${this.$route.params.id}`;
        this.axios.get(url).then(response => {
          this.thesis = response.data;
          console.log(this.thesis);
        })
        console.log(this.theses);
      },
      mounted() {
        console.log('ThesisDetail Komponente');
      },
    },
  }
</script>