<template>
    <v-container>
        <v-form @submit.prevent="login">
            <v-container>
                <v-layout>
                    <v-flex
                            xs12
                            md4
                    >
                        <v-text-field
                                v-model="form.email"
                                label="E-mail"
                                type="email"
                                required
                        ></v-text-field>
                    </v-flex>
                    <v-flex
                            xs12
                            md4
                    >
                        <v-text-field
                                v-model="form.password"
                                label="Password"
                                type="password"
                                required
                        ></v-text-field>
                    </v-flex>
                    <v-btn
                            color="green"
                            type="submit"
                    >
                        Login
                    </v-btn>
                    <router-link to="/signup">
                        <v-btn flat>Sign Up</v-btn>
                    </router-link>
                </v-layout>
            </v-container>
        </v-form>
    </v-container>
</template>

<script>
    export default {
        name: "Login",
        data(){
            return {
                form: {
                    email: null,
                    password: null
                }
            }
        },
        created() {
            if (User.loggedIn()) {
                this.$router.push({name: 'forum'});
            }
        },
        methods: {
            login () {
                User.login(this.form);
            }
        }
    }
</script>

<style scoped>

</style>