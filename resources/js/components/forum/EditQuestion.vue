<template>
    <v-container>
        <v-form @submit.prevent="update">
            <v-text-field
                    v-model="form.title"
                    label="Question Title"
                    type="text"
                    required
            ></v-text-field>
            <markdown-editor v-model="form.body" ></markdown-editor>
            <v-btn
                    color="green"
                    type="submit"
            >
                Update
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>
    export default {
        name: "EditQuestion",
        props: ['question'],
        data () {
            return {
                form: {
                    title: this.question.title,
                    body: this.question.body
                }
            }
        },
        methods: {
            update() {
                axios.patch(`/api/question/${this.question.id}`, this.form)
                    .then(res => this.$router.push('/forum'))
                    .catch(error => this.errors = error.response.data)
            }
        }
    }
</script>

<style scoped>

</style>