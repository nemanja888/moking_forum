<template>
    <div class="mt-4">
        <v-card>
            <v-card-title>
                <div class="headline">{{ data.user }}</div>
                <div class="ml-2">  said {{ data.created_at }}</div>

                <v-spacer></v-spacer>

                <app-like :content="data"></app-like>
            </v-card-title>

            <v-divider></v-divider>

            <app-edit-reply
                    v-if="editing"
                    :reply="data"
            ></app-edit-reply>
            <v-card-text v-else v-html="reply"></v-card-text>

            <v-divider></v-divider>

            <div v-if="!editing">
                <v-card-actions v-if="own">
                    <v-btn icon small @click="edit">
                        <v-icon color="orange">edit</v-icon>
                    </v-btn>
                    <v-btn icon small @click="destroy">
                        <v-icon color="red" >delete</v-icon>
                    </v-btn>
                </v-card-actions>
            </div>
        </v-card>
    </div>
</template>

<script>
    import EditReply from "./EditReply";
    import Like from "../likes/Like";

    export default {
        name: "Reply",
        props: ['data', 'index'],
        data() {
            return {
                editing: false
            }
        },
        computed: {
            own() {
                return User.own(this.data.user_id);
            },
            reply() {
                return md.parse(this.data.reply);
            }
        },
        methods: {
            destroy() {
                EventBus.$emit('deleteReply', this.index);
            },
            edit() {
                this.editing = true;
            },
            listen() {
                EventBus.$on('cancelEditing', () => {
                    this.editing = false;
                });
            }
        },
        created() {
            this.listen()
        },
        components: {
            appEditReply: EditReply,
            appLike: Like
        }
    }
</script>

<style scoped>

</style>