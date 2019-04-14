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
        methods: {
            login () {
                User.login(this.form)
            }
        }
    }
</script>

<style scoped>

</style>