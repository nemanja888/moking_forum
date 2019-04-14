<template>
    <div>
        <toolbar></toolbar>
<!--        <router-view></router-view>-->
        <app-footer></app-footer>
    </div>
</template>

<script>
import Toolbar from './Toolbar';
import Footer from './AppFooter';

    export default {
        name: "AppHome",
        components: {
            toolbar: Toolbar,
            appFooter: Footer,
        }
    }
</script>

<style scoped>

</style>