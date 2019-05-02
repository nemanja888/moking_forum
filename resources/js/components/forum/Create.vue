<template>
    <v-form @submit.prevent="create">
        <v-container>
            <v-layout>
                <v-flex >
                    <v-text-field
                            v-model="form.title"
                            label="Question Title"
                            type="text"
                            required
                    ></v-text-field>

                    <v-select
                            :items="categories"
                            item-text="name"
                            item-value="id"
                            label="Category"
                            v-model="form.category_id"
                            autocomplite
                    ></v-select>

                    <markdown-editor v-model="form.body" ></markdown-editor>

                    <v-btn
                            color="green"
                            type="submit"
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
                    .catch(error => this.errors = error.response.data)
            }
        },
        created() {
            axios.get('api/category')
                .then(res => this.categories = res.data.data)
                .catch(error => console.log(error.response.error))
        }
    }
</script>

<style scoped>

</style>