<template>
    <div class="admin-login">
        <vue-progress-bar></vue-progress-bar>
        <div class="wrap-admin-login">
            <form @submit.prevent="LogAdmin">
                <h1 v-if="error" class="error-log">Неверный логин или пароль</h1>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="login" placeholder="Логин" autocomplete="on">
                </div>
                <div class="input-wrap">
                    <input type="password" class="classic-input" v-model.trim="pass" placeholder="Пароль" autocomplete="on">
                </div>
                <button class="btn" type="submit">
                    Войти
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LoginAdminLayout",
        data: ()=> ({
            login: null,
            pass: null,
            error: false
        }),
        beforeMount() {
            if (this.mamakusa !== null) {
                this.$router.push({name: 'AdminCategories'})
            }
        },
        created() {
            this.$Progress.start();
        },
        mounted() {
            this.$Progress.finish();
        },
        methods: {
            async LogAdmin(){
                this.$Progress.start();
                await this.$store.dispatch('Mamase', {login: this.login, pass: this.pass})
                    .then((res) => {
                        if (res) {
                            this.error = false;
                            this.$router.push({name: 'AdminCategories'})
                        }else{
                            this.$Progress.fail()
                            this.error = true;
                        }
                    })
            }
        },
        computed: {
            mamakusa(){
                return this.$store.getters.mamakusa;
            }
        }
    }
</script>

<style scoped>

</style>
