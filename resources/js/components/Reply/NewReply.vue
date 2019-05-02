<template>
    <div class="mt-4">
        <markdown-editor v-model="form.body"></markdown-editor>
        <v-btn icon @click="submit">
            <v-icon color="green">done</v-icon>
        </v-btn>
    </div>
</template>

<script>
    export default {
        name: "NewReply",
        props: ['slug'],
        data() {
            return {
                form: {
                    body: null
                }
            }
        },
        methods: {
            submit() {
                axios.post(`/api/question/${this.slug}/reply`, this.form)
                    .then(res => {
                        this.form.body = '';
                        EventBus.$emit('newReply', res.data.reply);
                        window.scrollTo(0,0);
                    })
            }
        }
    }
</script>

<style scoped>

</style>