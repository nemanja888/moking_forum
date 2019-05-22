<template>
    <v-toolbar color="indigo" dark>
        <v-toolbar-side-icon></v-toolbar-side-icon>
        <v-toolbar-title>
             <router-link to="/" class="white--text">Moking Forum</router-link>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <app-notification v-if="loggedIn"></app-notification>
        <div class="hidden-sm-and-down">
            <router-link
                    v-for="item in items"
                    :key="item.title"
                    :to="item.to"
                    v-if="item.show"
            >
                <v-btn flat>{{ item.title }}</v-btn>
            </router-link>

        </div>
    </v-toolbar>
</template>

<script>
    import Notification from './AppNotification';
    export default {
        name: "Toolbar",
        data() {
            return {
                loggedIn: User.loggedIn(),
                items: [
                    { title: 'Forum', to:'/forum', show:true },
                    { title: 'Category', to:'/category', show: User.loggedIn() },
                    { title: 'Ask Question', to:'/ask', show: User.loggedIn() },
                    { title: 'Login', to:'/login', show: !User.loggedIn() },
                    { title: 'Log Out', to:'/logout', show: User.loggedIn() },
                ]
            }
        },
        created () {
            EventBus.$on('logout', () => {
                console.log('proslo');
                User.logout();
            })
        },
        components: {
            appNotification: Notification
        }
    }
</script>

<style scoped>

</style>