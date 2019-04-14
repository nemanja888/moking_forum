<template>
    <div>
        <toolbar></toolbar>
        <router-view></router-view>
        <app-footer></app-footer>
    </div>
</template>

<script>
import Toolbar from './Toolbar';
import Footer from './AppFooter';
import Login from './login/Login';

    export default {
        name: "AppHome",
        components: {
            toolbar: Toolbar,
            appFooter: Footer,
            appLogin: Login
        }
    }
</script>

<style scoped>

</style>