<template>
    <div class="login">
        <h1 class="h-30 h1-m80">Вход</h1>
        <div v-if="err" class="error-log">
            Не правильный логин или пароль
        </div>
        <form @submit.prevent="logIn()">
            <div class="input-wrap">
                <input type="email" class="classic-input" :class="{invalid: ($v.email.$dirty && !$v.email.required) || ($v.email.$dirty && !$v.email.email)}" v-model.trim="email" placeholder="E-mail" autocomplete="on">
                <small v-if="$v.email.$dirty && !$v.email.email" class="small-invalid">Поле E-mail заполнено не корректно</small>
                <small v-else-if="$v.email.$dirty && !$v.email.required" class="small-invalid">Поле E-mail должно быть заполнено</small>
            </div>
            <div class="input-wrap">
                <input type="password" class="classic-input" v-model.trim="pass" :class="{invalid: (!$v.pass.required && $v.pass.$dirty) || (!$v.pass.minLength && $v.pass.$dirty)}" placeholder="Пароль" autocomplete="on">
                <small v-if="!$v.pass.required && $v.pass.$dirty" class="small-invalid">Поле Пароль должно быть заполнено</small>
                <small v-else-if="!$v.pass.minLength && $v.pass.$dirty" class="small-invalid">Пароль должен быть не менее 6 символов</small>
            </div>
            <button class="btn classic-btn-sz">Войти</button>
            <div class="added-links">
                <router-link :to="{path: 'registration'}" class="link-first">Регистрация</router-link>
                <router-link :to="{path: 'reset'}" class="link-sec">Забыли пароль?</router-link>
            </div>
        </form>
    </div>
</template>

<script>
    import {email, required, minLength} from 'vuelidate/lib/validators';
    export default {
        name: "Login",
        data: () => ({
            email: null,
            pass: null,
            err: false
        }),
        validations: {
            email: {
                email, required
            },
            pass: {
                required,
                minLength: minLength(6)
            }
        },
        methods: {
            logIn(){
                if (this.$v.$invalid){
                    this.$v.$touch();
                    return;
                }else{
                    this.$Progress.start();
                    this.$store.dispatch('login', {email: this.email, password: this.pass })
                        .then(() => this.$router.push({name: 'cabinet'}))
                        .catch((() => {
                            this.$Progress.finish();
                            this.err = true
                        }))
                }
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
