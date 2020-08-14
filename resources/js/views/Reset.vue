<template>
    <div class="reset">
        <div class="reset-block" v-if="!resetWhat">
            <h1 class="h-30 h1-m80">
                восстановление пароля
            </h1>
            <form @submit.prevent="resetPas">
                <input type="email" class="classic-input" v-model.trim="email" placeholder="E-mail" autocomplete="on">
                <button class="btn classic-btn-sz">отправить новый пароль</button>
                <div class="added-links">
                    <router-link :to="{path: 'registration'}" class="link-first">Регистрация</router-link>
                    <router-link :to="{path: 'login'}" class="link-sec">Вход</router-link>
                </div>
            </form>
        </div>
        <div class="reset-success" v-else>
            <h1 class="h-30-ease h1-m80">Новый пароль отправлен на указанный e-mail.</h1>
            <div class="added-links">
                <router-link :to="{path: 'login'}" class="link-first">Вход</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Reset",
        data: () => ({
            email: null,
            resetWhat: false
        }),
        methods: {
            async resetPas(){

                if (this.email){
                    this.$Progress.start();
                    await setTimeout(() => {
                        console.log(this.email)
                        this.resetWhat = true;
                        this.$Progress.finish();
                    }, 5000);

                }
            }
        }
    }
</script>

<style scoped>

</style>
