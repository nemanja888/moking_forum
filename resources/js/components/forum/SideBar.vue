<template>
    <v-card class="mt-2">
        <v-toolbar color="cyan" dark dance>
            <v-toolbar-title>Categories</v-toolbar-title>
            <v-spacer></v-spacer>

        </v-toolbar>
        <v-list>
            <v-list-tile>
                <v-list-tile-content>
                    <v-list-tile-title>
                        Category
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-list-tile v-for="category in categories" :key="category.id">
                <v-list-tile-content>
                    <v-list-tile-title>
                        {{ category.name }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-card>
</template>

<script>
    export default {
        name: "SideBar",
        data() {
            return {
                categories: {}
            }
        },
        created() {
            axios.get('/api/category')
                .then(res => this.categories = res.data.data)
                .catch(error => console.log(error.response.data))
        }
    }
</script>

<style scoped>

</style>