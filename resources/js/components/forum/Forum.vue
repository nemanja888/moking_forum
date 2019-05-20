<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>
                <app-question
                    v-for="question in questions"
                    :key="question.id"
                    :question=question
                ></app-question>
            </v-flex>
            <v-flex xs4>
                <app-sidebar></app-sidebar>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import Question from './question';
    import SideBar from './SideBar';

    export default {
        name: "Forum",
        data () {
            return {
                questions: {}
            }
        },
        components: {
            appQuestion: Question,
            appSidebar: SideBar
        },
        created () {
            axios.get('/api/question')
                .then(res => this.questions = res.data.data)
                .catch(error => console.log(error.response.data));
        }
    }

</script>

<style scoped>

</style>