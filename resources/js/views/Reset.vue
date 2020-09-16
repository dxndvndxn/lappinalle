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
    export default {
        name: "Reset",
        data: () => ({
            email: null,
            resetWhat: false
        }),
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
