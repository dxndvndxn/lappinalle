<template>
    <div class="registration">
        <div class="reg-from" v-if="!regWhat">
            <h1 class="h-30 h1-m80">Регистрация</h1>
            <div v-if="error" class="error-log">
                Данный email уже зарегестрирован
            </div>
            <form @submit.prevent="registerMe()" method="post">
                <div class="input-wrap">
                    <input type="text" class="classic-input" :class="{invalid: ($v.name.$dirty && !$v.name.required) || ($v.name.$dirty && !$v.name.minLength) || ($v.name.$dirty && !$v.name.maxLength)}" v-model.trim="name" placeholder="Имя" autocomplete="on">
                    <small v-if="$v.name.$dirty && !$v.name.required" class="small-invalid">Поле Имя должно быть заполнено</small>
                    <small v-else-if="($v.name.$dirty && !$v.name.minLength) || ($v.name.$dirty && !$v.name.maxLength) " class="small-invalid">Поле Имя заполнено не корректно</small>
                </div>
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
                <div class="input-wrap">
                    <input type="password" class="classic-input" v-model.trim="passRepeat" :class="{invalid: (!$v.passRepeat.required && $v.passRepeat.$dirty) || (!$v.passRepeat.sameAsPassword && $v.passRepeat.$dirty)}"placeholder="Повторите пароль" autocomplete="on">
                    <small v-if="!$v.passRepeat.sameAsPassword && $v.passRepeat.$dirty" class="small-invalid">Пароль введен не верно</small>
                    <small v-else-if="!$v.passRepeat.required && $v.passRepeat.$dirty" class="small-invalid">Поле Пароль должно быть заполнено</small>
                </div>
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
    import {email, required, sameAs, minLength, maxLength} from 'vuelidate/lib/validators';
    export default {
        name: "Registration",
        data: () => ({
            name: null,
            email: null,
            pass: null,
            passRepeat: null,
            checkAgree: false,
            regWhat: false,
            error: false
        }),
        validations: {
            name: {
                required,
                minLength: minLength(2),
                maxLength: maxLength(16)
            },
            email: {
                email, required
            },
            pass: {
                required,
                minLength: minLength(6)
            },
            passRepeat: {
                required,
                sameAsPassword: sameAs('pass')
            }
        },
        methods: {
            registerMe(){
                if (this.$v.$invalid){
                    this.$v.$touch();
                    return;
                }else{

                    if (this.checkAgree) {
                        this.$Progress.start();
                        this.$store.dispatch('register', {name: this.name, email: this.email, password: this.pass })
                            .then((res) =>{
                                this.$router.push({name: 'cabinet'})
                            })
                            .catch((e) => {
                                console.log(e)
                                this.$Progress.finish();
                                this.error = true;
                            })
                    }
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
