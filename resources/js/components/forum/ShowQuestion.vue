<template>
    <v-card>
        <v-container class="fluid">
            <v-card-title>
                <div>
                    <h2 class="headline">
                        {{ question.title }}
                    </h2>
                    <span class="grey--text">{{ question.user }} said {{ question.created_at }}</span>
                </div>
                <v-spacer></v-spacer>
                <v-btn color="teal" dark>{{ replyCount }} Replies</v-btn>

            </v-card-title>
            <v-card-text v-html="body"></v-card-text>
            <v-card-actions v-if="own">
                <v-btn
                        icon
                        small
                        @click="edit"
                >
                    <v-icon color="orange">edit</v-icon>
                </v-btn>
                <v-btn
                        icon
                        small
                        @click="destroy"
                >
                    <v-icon color="red">delete</v-icon>
                </v-btn>
            </v-card-actions>
        </v-container>
    </v-card>
</template>

<script>
    export default {
        name: "ShowQuestion",
        props: ['question'],
        data() {
            return {
                own: User.own(this.question.user_id),
                replyCount: this.question.replies_count
            }
        },
        computed: {
            body() {
                return md.parse(this.question.body);
            }
        },
        created() {
            EventBus.$on('newReply', () => {
                this.replyCount++;
            });
            EventBus.$on('deleteReply', () => {
                this.replyCount--;
            });
            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.replyCount++
            });
            Echo.channel('deleteReplyChannel')
                .listen('DeleteReplyEvent', (e) => {
                    this.replyCount--
            });
        },
        methods: {
            destroy() {
                axios.delete(`/api/question/${this.question.id}`)
                    .then(res => this.$router.push('/forum'))
                    .catch(error => console.log(error.response.data))
            },
            edit() {
                EventBus.$emit('startEdit');
            }
        }
    }
</script>

<style scoped>

</style>