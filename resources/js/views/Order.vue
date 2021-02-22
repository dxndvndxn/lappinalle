<template>
    <div class="order container">
        <div class="order-header h1-m50">
            <Back v-bind:color="'grey'" v-bind:word="'Корзина'"/><h1 class="h1-bold-grey">контактная информация</h1>
        </div>
        <form class="order-from" @submit.prevent="toDeliveryChoose">
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
                <input type="tel" class="classic-input" :class="{invalid: ($v.tel.$dirty && !$v.tel.required) || ($v.tel.$dirty && !$v.tel.phoneValid)}" v-model.trim="tel" placeholder="Телефон">
                <small v-if="$v.tel.$dirty && !$v.tel.required" class="small-invalid">Поле Телефон должно быть заполнено</small>
                <small v-else-if="$v.tel.$dirty && !$v.tel.phoneValid" class="small-invalid">Поле Телефон заполнено не корректно</small>
            </div>
            <button class="classic-btn-sz btn">следующий шаг</button>
        </form>
    </div>
</template>

<script>
    import {email, required, minLength, maxLength} from 'vuelidate/lib/validators';
    import Back from "../components/Back";
    const isPhone = (value) => /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/.test(value);
    export default {
        name: "Order",
        components: {Back},
        data: () => ({
            name: '',
            email: '',
            tel: null,
        }),
        metaInfo(){
            return {
                title: "Контактные данные"
            }
        },
        validations: {
            name: {
                required,
                minLength: minLength(2),
                maxLength: maxLength(30)
            },
            email: {
                email, required
            },
            tel: {
                required,
                phoneValid: isPhone
            }
        },
        methods: {
            toDeliveryChoose(){
                if (this.$v.$invalid){
                    this.$v.$touch();
                    return;
                }
                let data = {
                    name: this.name,
                    email: this.email,
                    tel: this.tel
                };
                this.$store.dispatch('customerData', data);
                this.$router.push({name: 'chooseDelivery'})
            }
        },
        mounted() {
            this.$Progress.start();
            this.$store.dispatch('GetUserData').then(() => this.$Progress.finish());
        },
        computed: {
            isLoggedIn(){
                return this.$store.getters.isLoggedIn;
            },
            getUserData(){
                return this.$store.getters.userData;
            }
        },
        watch:{
            getUserData(user){
                this.name = user[0][1];
                this.email = user[0][2];
                this.tel = user[0][3];
                this.$Progress.finish()
            }
        }
    }
</script>

<style scoped>

</style>
