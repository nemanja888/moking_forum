<template>
    <v-form @submit.prevent="create">
        <v-container>
            <v-layout>
                <v-flex >
                    <span class="red--text" v-if="errors.title">{{ errors.title[0] }}</span>
                    <v-text-field
                            v-model="form.title"
                            label="Question Title"
                            type="text"
                            required
                    ></v-text-field>
                    <span class="red--text" v-if="errors.category_id">{{ errors.category_id[0] }}</span>
                    <v-select
                            :items="categories"
                            item-text="name"
                            item-value="id"
                            label="Category"
                            v-model="form.category_id"
                            autocomplite
                    ></v-select>
                    <span class="red--text" v-if="errors.body">{{ errors.body[0] }}</span>
                    <markdown-editor v-model="form.body" ></markdown-editor>

                    <v-btn
                            color="green"
                            type="submit"
                            :disabled="disabled"
                    >
                        Create
                    </v-btn>
                </v-flex>
            </v-layout>
        </v-container>
    </v-form>
</template>

<script>
    export default {
        name: "Create",
        data() {
            return {
                form: {
                    title: null,
                    category_id: null,
                    body: null
                },
                categories: [],
                errors: {}
            }
        },
        methods: {
            create() {
                axios.post('api/question', this.form)
                    .then(res => this.$router.push(res.data.path))
                    .catch(error => this.errors = error.response.data.errors)
            }
        },
        computed: {
          disabled() {
              return !(this.form.title && this.form.body && this.form.category_id)
          }
        },
        created() {
            axios.get('api/category')
                .then(res => this.categories = res.data.data)
                .catch(error => this.errors = error.response.data.errors)
        }
    }
</script>

<style scoped>

</style>