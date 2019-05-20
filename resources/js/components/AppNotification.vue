<template>
        <div class="text-xs-center">
            <v-menu offset-y>
                <template v-slot:activator="{ on }">
                    <v-btn
                            icon
                            dark
                            v-on="on"
                    >
                        <v-icon :color="color">add_alert</v-icon>
                    </v-btn>
                    {{ unReadCount }}
                </template>
                <v-list>
                    <v-list-tile
                            v-for="item in unRead"
                            :key="item.id"
                    >
                        <v-list-tile-title @click="readIt(item)">
                            <router-link
                                    :to="item.path">
                                {{ item.question }}
                            </router-link>
                        </v-list-tile-title>
                    </v-list-tile>
                    <v-divider></v-divider>
                    <v-list-tile
                            v-for="item in read"
                            :key="item.id"
                    >
                        <v-list-tile-title>
                                {{ item.question }}
                        </v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
        </div>
</template>

<script>
    import Exception from "../Helpers/Exception";

    export default {
        name: "AppNotification",
        data() {
            return {
                read: {},
                unRead: {},
                unReadCount: 0
            }
        },
        computed: {
            color() {
                if (this.unRead.length > 0) {
                    return "red"
                }
                else {
                    return 'red lighten-4'
                }
            }
        },
        created(){
            if(User.loggedIn()) {
                this.getNotifications();
            }

            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.unRead.unshift(notification);
                    this.unReadCount++;

                })
        },
        methods:{
            getNotifications() {
                axios.post('/api/notifications')
                    .then(res => {
                        this.read = res.data.read;
                        this.unRead = res.data.unRead;
                        this.unReadCount = this.unRead.length;
                    })
                    .catch(error => Exception.handle(error))
            },
            readIt(data) {
                axios.post('/api/markAsRead', {id:data.id})
                    .then(res => {
                        this.unRead.splice(data, 1);
                        this.read.push(data);
                        this.unReadCount--;
                    })
            }
        }
    }
</script>

<style scoped>

</style>