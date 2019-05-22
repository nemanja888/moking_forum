<template>
    <v-container>
        <v-alert
                v-if="errors"
                type="error"
                :value="true"
        >
            Error. Wrong input!
        </v-alert>
        <v-layout row >
            <v-flex
                    sm12
                    md6
                    mr-5
                    v-if="!editing"
            >
                    <h2>Add Category</h2>

                    <v-form @submit.prevent="create">
                        <v-flex
                                xs12
                                md12
                        >
                            <v-text-field
                                    v-model="form.name"
                                    label="Category name"
                                    type="text"
                                    required
                            ></v-text-field>
                            <v-btn
                                    color="green"
                                    type="submit"
                                    :disabled="disabled"
                            >
                                Create
                            </v-btn>
                        </v-flex>
                    </v-form>
            </v-flex>
            <v-flex
                    sm12
                    md6
                    mr-5
                    v-else
            >
                <v-layout row>
                  <v-flex sm-10>
                      <h2>Update Category</h2>
                  </v-flex>
                  <v-flex sm-2>
                      <v-btn
                              @click="getCreate"
                      >
                          Create
                      </v-btn>
                  </v-flex>
                </v-layout>
                <v-form @submit.prevent="update">
                    <v-flex
                            xs12
                            md12
                    >
                        <v-text-field
                                v-model="form.name"
                                label="Category name"
                                type="text"
                                required
                        ></v-text-field>
                        <v-btn
                                color="green"
                                type="submit"
                                :disabled="disabled"
                        >
                            Update
                        </v-btn>
                    </v-flex>
                </v-form>
            </v-flex>
            <v-flex sm12 md6>
                <v-card>
                    <v-toolbar color="cyan" dark dance>
                        <v-toolbar-title>All Categories</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-list>
                        <div v-for="(category, index) in categories" :key="category.id">
                            <v-list-tile >
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        {{ category.name }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                                <v-list-tile-action>
                                    <v-btn icon samll @click="getUpdate(category)">
                                        <v-icon color="tile">edit</v-icon>
                                    </v-btn>
                                </v-list-tile-action>
                                <v-list-tile-action>
                                    <v-btn icon samll @click="destroy(category, index)">
                                        <v-icon color="red">delete</v-icon>
                                    </v-btn>
                                </v-list-tile-action>
                            </v-list-tile>
                            <v-divider></v-divider>
                        </div>
                    </v-list>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>

</template>

<script>
    export default {
        name: "create",
        data() {
            return {
                form: {
                    name: null,
                    id: null
                },
                categories: {},
                editing: false,
                errors: null
            }
        },
        methods: {
            getUpdate(category, index) {
                console.log(index);
                this.editing = true;
                this.form.name = category.name;
                this.form.id = category.id;
            },
            getCreate() {
                this.editing = false;
                this.form.name = null;
                this.form.id = null;
            },
            create() {
                axios.post('/api/category', this.form)
                    .then(res => {
                        this.categories.unshift(res.data);
                        this.form.name = null;
                    })
                    .catch(error => this.errors = error.response.data.errors);
            },
            update() {
                axios.patch(`/api/category/${this.form.id}`, this.form)
                    .then(res => this.$router.go())
                    .catch(error => this.errors = error.response.data.errors)
            },
            destroy(category, index) {
                axios.delete(`/api/category/${category.id}`)
                    .then(res => this.categories.splice(index, 1))
                    .catch(error => this.errors = error.response.data.errors)
            }

        },
        computed: {
          disabled() {
              return !this.form.name;
          }
        },
        created () {
            axios.get('/api/category')
                .then(res => this.categories = res.data.data)
                .catch(error => this.errors = error.response.data.errors);
        }
    }
</script>

<style scoped>

</style>