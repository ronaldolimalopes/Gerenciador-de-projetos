<template>
    <v-card color="blue-grey lighten-4">
        <v-card-title>
            <div class="headline">Adicionar Projetos</div>
        </v-card-title>
        <v-cotainer>
            <v-form ref="form" v-model="valid" xs12>

              <v-text-field
              id="project-title"
              v-model="data.title"
              :rules="validation.title"
              label="Título"
              required
              ></v-text-field>

              <div v-show="data.title">

                <v-text-field
                v-model="data.description"
                label="Descrição"
                textarea
                >
                </v-text-field>

                <v-menu
                ref="menu"
                v-model="menu"
                >

                <v-text-field
                v-model="data.due_date"
                label="Data de  "
                ></v-text-field>

                    <v-date-picker
                  v-model="data.due_date"
                  no-title
                  scrollable
                  ></v-date-picker>
                </v-menu>

                <v-menu>
                  <v-time-picker
                  v-model="due_date_time"
                  >
                  </v-time-picker>
                </v-menu>

                <v-btn flat>Salvar</v-btn>
              </div>

            </v-form>
        </v-cotainer>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            valid: false,
            data: {},
            menu: null,
            due_date_time : null,
            validation: {
                title: [
                        v => !!v || 'Título é obrigatório'
                    ]
                }
            }
        }
    }
</script>
