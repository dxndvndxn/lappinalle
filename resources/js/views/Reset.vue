<template>
    <div class="reset">
        <div class="reset-block" v-if="!resetWhat">
            <h1 class="h-30 h1-m80">
                восстановление пароля
            </h1>
            <form @submit.prevent="resetPas">
                <div class="input-wrap">
                    <input type="email" class="classic-input" :class="{invalid: ($v.email.$dirty && !$v.email.required) || ($v.email.$dirty && !$v.email.email)}" v-model.trim="email" placeholder="E-mail" autocomplete="on">
                    <small v-if="$v.email.$dirty && !$v.email.email" class="small-invalid">Поле E-mail заполнено не корректно</small>
                    <small v-else-if="$v.email.$dirty && !$v.email.required" class="small-invalid">Поле E-mail должно быть заполнено</small>
                </div>
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
    import {email, minLength, required} from 'vuelidate/lib/validators';
    import axios from 'axios';
    export default {
        name: "Reset",
        data: () => ({
            email: null,
            resetWhat: false
        }),
        metaInfo(){
            return {
                title: "Новый пароль"
            }
        },
        validations: {
            email: {
                email, required
            }
        },
        methods: {
            async resetPas(){
                if (this.$v.$invalid){
                    this.$v.$touch();
                    return;
                }

                this.$Progress.start();
                axios.post(`${this.URI}changepass`, {email: this.email})
                .then(res => {
                    console.log(res.data)
                    if (res.data) this.resetWhat = true;
                    this.$Progress.finish();
                })
                .catch(e => console.log(e))
            }
        },
        computed: {
            URI(){
                return this.$store.getters.URI;
            },
        }
    }
</script>

<style scoped>

</style>
