<template>
    <div class="registration">
        <div class="reg-from" v-if="!regWhat">
            <h1 class="h-30 h1-m80">Регистрация</h1>
            <form @submit.prevent="regIn()">
                <input type="text" class="classic-input" v-model.trim="name" placeholder="Имя" autocomplete="on">
                <input type="email" class="classic-input" v-model.trim="email" placeholder="E-mail" autocomplete="on">
                <input type="password" class="classic-input" v-model.trim="pass" placeholder="Пароль" autocomplete="Pass">
                <input type="password" class="classic-input" v-model.trim="passRepeat" placeholder="Повторите пароль" autocomplete="new-password">
                <div class="check-agree">
                    <input v-model.trim="checkAgree" type="checkbox" id="agree" @click="checkAgree = !checkAgree"
                           v-bind:class="checkAgree ? 'active-size' : null">
                    <label for="agree">согласие на обработку
                        персональных данных</label>
                </div>
                <button class="btn classic-btn-sz">Зарегистрироваться</button>
                <div class="added-links">
                    <router-link :to="{path: 'login'}" class="link-first">Вход</router-link>
                </div>
            </form>
        </div>
        <div class="reg-success" v-else>
            <h1 class="h-30-ease h1-m80">Вы успешно зарегистрированы в системе.</h1>
            <div class="added-links">
                <router-link :to="{path: 'login'}" class="link-first">Вход</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Registration",
        data: () => ({
            name: null,
            email: null,
            pass: null,
            passRepeat: null,
            checkAgree: false,
            regWhat: false
        }),
        methods: {
            async regIn(){

                if (this.checkAgree){
                    this.$Progress.start();
                    await setTimeout(() => {
                        console.log(this.name, this.email)
                        this.regWhat = true;
                        this.$Progress.finish();
                    }, 5000);

                }
            }
        }
    }
</script>

<style scoped>

</style>
