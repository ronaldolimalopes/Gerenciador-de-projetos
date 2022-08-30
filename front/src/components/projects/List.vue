<template>
    <v-layout row wrap>
      <v-flex xs3 v-for="n in 2" :key="n">
      <v-card color="blue-grey darken-2" class="white--text">
        <v-card-title primary-title>
          <div class="headline">App Mobille SON</div>
        </v-card-title>
        <v-card-text>
          In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.
        </v-card-text>
        <v-card-actions>
          <v-btn flat dark>Ver +</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>

    <v-flex xs3>
      <projects-create></projects-create>
    </v-flex>
    </v-layout>
</template>

<script>
  import ProjectCreate from './Create';

  export default {
    components: {
    'projects-create' : ProjectCreate
    }
  }
</script>