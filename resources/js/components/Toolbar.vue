<template>
    <v-toolbar>
        <v-toolbar-side-icon></v-toolbar-side-icon>
        <v-toolbar-title>Moking Forum</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down">
<!--            <route-link to="/question">-->
<!--                <v-btn flat>Forum</v-btn>-->
<!--            </route-link>-->

            <v-btn flat>Ask Question</v-btn>
            <v-btn flat>Categories</v-btn>
            <v-btn flat>Log In</v-btn>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
    export default {
        name: "Toolbar"
    }
</script>

<style scoped>

</style>