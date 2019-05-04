<template>
    <div>
        <app-reply
                v-for="(reply, index) in question.replies"
                :index=index
                :key="reply.id"
                :data="reply"
        ></app-reply>
    </div>
</template>

<script>
    import Reply from './Reply'

    export default {
        name: "Replies",
        props: ['question'],
        data () {
            return {
            }
        },
        components: {
            appReply: Reply
        },
        created () {
            this.listen()
        },
        methods: {
            listen() {
                EventBus.$on('newReply', (reply) => {
                    this.question.replies.unshift(reply);
                });
                EventBus.$on('deleteReply', (index) => {
                    axios.delete(`/api/question/${this.question.slug}/reply/${this.question.replies[index].id}`)
                        .then(res => {
                            this.question.replies.splice(index, 1);
                        });

                })
            }
        },


    }
</script>

<style scoped>

</style>