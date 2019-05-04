<template>
    <div>
        <app-edit-question
                v-if="editing"
                :question="question"
        >
        </app-edit-question>
        <div v-else>
            <app-show-question
                    :question="question"
                    v-if="question"
            ></app-show-question>
            <v-container>
                <app-show-reply
                        :question="question"
                ></app-show-reply>
                <app-new-reply
                        :slug="slug"
                ></app-new-reply>
            </v-container>
        </div>
    </div>
</template>

<script>
    import ShowQuestion from './ShowQuestion'
    import EditQuestion from './EditQuestion'
    import ShowReply from '../Reply/Replies'
    import NewReply from '../Reply/NewReply'

    export default {
        name: "Read",
        data() {
            return  {
                question: null,
                editing: false,
                slug: null,
            }
        },
        components: {
            appShowQuestion : ShowQuestion,
            appEditQuestion : EditQuestion,
            appShowReply: ShowReply,
            appNewReply: NewReply
        },
        created() {
            this.listen();
            this.getQuestion();
        },
        methods: {
            listen() {
                EventBus.$on('startEdit', () => {
                    this.editing = true;
                })
            },
            getQuestion() {
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(res => {
                        this.question = res.data.data;
                        if (this.question.replies_count > 0) {
                            this.slug = this.question.slug;
                        }
                    })
                    .catch(error => console.log(error.response.data))
            },
        }
    }
</script>

<style scoped>

</style>