<template>
    <div>
        <app-reply
                v-for="reply in content"
                :key="reply.id"
                :data="reply"
        ></app-reply>
    </div>
</template>

<script>
    import Reply from './Reply'

    export default {
        name: "Replies",
        props: ['replies'],
        data () {
            return {
                content: this.replies
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
                    this.content.unshift(reply);
                });
            }
        },


    }
</script>

<style scoped>

</style>