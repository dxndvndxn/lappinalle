<template>
    <div class="login">
        <h1 class="h-30 h1-m80">Вход</h1>
        <form @submit.prevent="logIn()">
            <input type="email" class="classic-input" v-model.trim="email" placeholder="E-mail" autocomplete="on">
            <input type="password" class="classic-input" v-model.trim="pass" placeholder="Пароль" autocomplete="on">
            <button class="btn classic-btn-sz">Войти</button>
            <div class="added-links">
                <router-link :to="{path: 'registration'}" class="link-first">Регистрация</router-link>
                <router-link :to="{path: 'reset'}" class="link-sec">Забыли пароль?</router-link>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data: () => ({
            email: null,
            pass: null
        }),
        methods: {
            logIn(){

            }
        },
        created() {
            this.$Progress.start();
        },
        mounted() {
            this.$Progress.finish();
        }
    }
</script>

<style scoped>

</style>
