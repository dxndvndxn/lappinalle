<template>
    <div class="cabinet">
        <ul class="cabinet-tabs">
            <li v-for="(tb, i) in tabs" class="cabinet-h" v-bind:class="tb.active ? 'active-catg' : null" @click="clickTab">
                {{tb.name}}
            </li>
        </ul>
        <form @submit.prevent="changeData" v-if="tabs[0].active" class="cabinet-user-data">
            <ul class="user-data-basic">
                <li class="cabinet-h">
                    Основное <img src="../../img/cabinet-icon.png" @click="basicData = !basicData" alt="">
                </li>
                <li>
                    <label for="name">ФИО: </label>
                    <input type="text" id="name" v-bind:class="basicData ? 'active-input' : null" v-model.trim="userData.userName">
                    <small v-if="$v.userData.userName.$dirty && !$v.userData.userName.required" class="small-invalid">Поле ФИО должно быть заполнено</small>
                    <small v-else-if="($v.userData.userName.$dirty && !$v.userData.userName.minLength) || ($v.userData.userName.$dirty && !$v.userData.userName.maxLength) " class="small-invalid">Поле Имя заполнено не корректно</small>
                </li>
                <li>
                    <label for="tel">Телефон: </label>
                    <input type="tel" id="tel" v-bind:class="basicData ? 'active-input' : null" v-model.trim="userData.userTel">
                    <small v-if="$v.userData.userTel.$dirty && !$v.userData.userTel.phoneValid" class="small-invalid">Поле Телефон заполнено не корректно</small>
                </li>
                <li>
                    <label for="email">E-mail: </label>
                    <input type="text" id="email" v-bind:class="basicData ? 'active-input' : null" v-model.trim="userData.userEmail">
                    <small v-if="$v.userData.userEmail.$dirty && !$v.userData.userEmail.email" class="small-invalid">Поле E-mail заполнено не корректно</small>
                    <small v-else-if="$v.userData.userEmail.$dirty && !$v.userData.userEmail.required" class="small-invalid">Поле E-mail должно быть заполнено</small>
                </li>
            </ul>
            <ul class="user-data-addr">
                <li class="cabinet-h">
                    Адрес <img src="../../img/cabinet-icon.png" @click="basicDataAddr = !basicDataAddr" alt="">
                </li>
                <li>
                    <label>Город: </label>
                    <input type="text" v-model.trim="userData.userCity" v-bind:class="basicDataAddr ? 'active-input' : null">
                    <small v-if="$v.userData.userCity.$dirty && !$v.userData.userCity.maxLength" class="small-invalid">Поле Город заполнено не корректно</small>
                </li>
                <li>
                    <label>Улица: </label>
                    <input type="text" v-model.trim="userData.userAdrr" v-bind:class="basicDataAddr ? 'active-input' : null">
                    <small v-if="$v.userData.userAdrr.$dirty && !$v.userData.userAdrr.maxLength" class="small-invalid">Поле Улица заполнено не корректно</small>
                </li>
                <li>
                    <label>Дом: </label>
                    <input type="text" v-model.trim="userData.userBuild" v-bind:class="basicDataAddr ? 'active-input' : null">
                    <small v-if="$v.userData.userBuild.$dirty && !$v.userData.userBuild.maxLength" class="small-invalid">Поле Дом заполнено не корректно</small>
                </li>
                <li>
                    <label>Корпус: </label>
                    <input type="text" v-model.trim="userData.userCorpus" v-bind:class="basicDataAddr ? 'active-input' : null">
                    <small v-if="$v.userData.userCorpus.$dirty && !$v.userData.userCorpus.maxLength" class="small-invalid">Корпус Дом заполнено не корректно</small>
                </li>
                <li>
                    <label>Квартира: </label>
                    <input type="text" v-model.trim="userData.userApart" v-bind:class="basicDataAddr ? 'active-input' : null">
                    <small v-if="$v.userData.userApart.$dirty && !$v.userData.userApart.maxLength" class="small-invalid">Корпус Квартира заполнено не корректно</small>
                </li>
                <li>
                    <label>Почтовый индекс: </label>
                    <input type="text" v-model.trim="userData.userPostI" v-bind:class="basicDataAddr ? 'active-input' : null">
                    <small v-if="$v.userData.userPostI.$dirty && !$v.userData.userPostI.maxLength" class="small-invalid">Корпус Почтовый индекс заполнено не корректно</small>
                </li>
            </ul>
            <ul class="user-data-security">
                <li class="cabinet-h">
                    Безопасность <img src="../../img/cabinet-icon.png" @click="basicDataPass = !basicDataPass" alt="">
                </li>
                <li>
                    <label>Старый пароль: </label>
                    <input type="password" v-model.trim="userData.userPass" @change="checkOldPass" v-bind:class="basicDataPass ? 'active-input' : null">
                    <small v-if="passError" class="small-invalid">Неверный пароль</small>
                </li>
                <li>
                    <label>Новый пароль: </label>
                    <input type="password" v-model.trim="userData.userNewPass" v-bind:class="basicDataPass ? 'active-input' : null">
                </li>
            </ul>
            <button class="btn">
                сохранить изменения
            </button>
        </form>
        <div class="cabinet-user-order" v-else-if="tabs[1].active">
            <div class="user-order-wrap" v-for="(ord, i) in orderData">
                <div class="user-order-head">
                    <div class="order-head-number">
                        <span class="cabinet-h">Заказ &#8470; </span>
                        <span class="order-view">{{ord.orders_number}}</span>
                    </div>
                    <div class="order-head-status">
                        <div class="head-status-wrap">
                            <span class="cabinet-h">Статус: </span>
                            <span class="order-view"> {{ord.status}}</span>
                            <span class="head-status-btn" @click="ord.active = !ord.active" v-bind:class="ord.active ? 'active-arrow-cab' : 'passive-arrow-cab'"></span>
                        </div>
                    </div>
                </div>
                <div class="user-order-data"  v-if="ord.active" v-for="(dt, k) in ord.order_data">
                    <img :src="dt.img" alt="">
                    <ul class="order-data-desc">
                        <li class="cabinet-h">{{dt.order_name}}</li>
                        <li>Количество: {{dt.count}}</li>
                        <li>Размер: {{dt.size}}</li>
                        <li>Цена: {{dt.price}} &#8381;</li>
                    </ul>
                </div>
                <div class="user-order-delivery">
                    <span class="cabinet-h">Доставка: </span>
                    <span class="user-order-delivery-text">{{ord.delivery}} &#8381;</span>
                </div>
                <div class="user-order-total">
                    <span class="cabinet-h">Итоговая стоимость: </span>
                    <span class="user-order-total-text">{{ord.totalPrice}} &#8381;</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    const isPhoneCabinet = (value) => /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/.test(value);
    import {email, required, sameAs, minLength, maxLength} from 'vuelidate/lib/validators';
    export default {
        name: "Cabinet",
        data:() => ({
            tabs: [{name: 'Личные данные', active: true}, {name: 'Заказы', active: false}],
            userData: {
                userName: null,
                userTel: null,
                userEmail: null,
                userCity: null,
                userAdrr: null,
                userBuild: null,
                userCorpus: null,
                userApart: null,
                userPostI: null,
                userPass: null,
                userNewPass: null,
                token: localStorage.getItem('token')
            },
            orderData: [
                {
                    orders_number: 1234556,
                    status: 'В обработке',
                    active: true,
                    order_data: [
                        {img: '../../img/order-img.png', order_name: 'Комбинезон LAPPINALE', count: 1, size: 43, price: 5400},
                        {img: '../../img/order-img.png', order_name: 'Комбинезон LAPPINALE', count: 1, size: 43, price: 5400},
                    ],
                    delivery: 'курьерская по СПБ, 14.08.2020, 300',
                    totalPrice: 11100
                },
                {
                    orders_number: 1234556,
                    status: 'Доставлен',
                    active: false,
                    order_data: [
                        {img: '../../img/order-img.png', order_name: 'Комбинезон LAPPINALE', count: 1, size: 43, price: 5400}
                    ],
                    delivery: 'курьерская по СПБ, 14.08.2020, 300',
                    totalPrice: 11100
                },
                {
                    orders_number: 1234556,
                    status: 'Доставлен',
                    active: false,
                    order_data: [
                        {img: '../../img/order-img.png', order_name: 'Комбинезон LAPPINALE', count: 1, size: 43, price: 5400}
                    ],
                    delivery: 'курьерская по СПБ, 14.08.2020, 300',
                    totalPrice: 11100
                }
                ],
            basicData: false,
            basicDataAddr: false,
            basicDataPass: false,

            // Ошибка пароля
            passError: false
        }),
        validations: {
            userData: {
                userName: {
                    required,
                    minLength: minLength(2),
                    maxLength: maxLength(80)
                },
                userEmail: {
                    email, required
                },
                userTel: {
                    phoneValid: isPhoneCabinet
                },
                userCity: {
                    maxLength: maxLength(40)
                },
                userAdrr: {
                    maxLength: maxLength(40)
                },
                userBuild: {
                    maxLength: maxLength(8)
                },
                userCorpus: {
                    maxLength: maxLength(5)
                },
                userApart: {
                    maxLength: maxLength(7)
                },
                userPostI: {
                    maxLength: maxLength(6)
                },
                userPass: {
                    minLength: minLength(6)
                },
                userNewPass: {
                    minLength: minLength(6)
                }
            },
        },
        methods: {
            clickTab(){
                this.tabs.forEach(el => el.active = !el.active);
            },
            async changeData(){
                if (this.$v.userData.$invalid){
                    this.$v.$touch();
                    console.log('hui')
                    return;
                }else{
                    let formData = new FormData();
                    formData.append('userUpdate',  JSON.stringify(this.userData));
                    console.log(1)
                    if (!this.passError) {
                        console.log(2)
                        await axios.post(`${this.URI}lkupd`, formData)
                            .then(res => {
                                console.log(res.data);
                            })
                            .catch(e => console.log(e))
                    }
                }
            },
            async checkOldPass(){
                let check = {
                    token: this.userData.token,
                    password: this.userData.userPass
                };

                let formData = new FormData();
                formData.append('check',  JSON.stringify(check));
                await axios.post(`${this.URI}checkpass`, formData)
                    .then(res => {
                        this.passError = !res.data;
                    })
                    .catch(e => console.log(e))
            }
        },
        created() {
            this.$Progress.start();
            this.$store.dispatch('GetUserData');
        },
        mounted() {
            this.$Progress.finish();
        },
        watch:{
            getUserData(user){
                this.userData.userName = user[0][1];
                this.userData.userTel = user[0][3];
                this.userData.userEmail = user[0][2];
                this.userData.userCity = user[0][4];
                this.userData.userAdrr = user[0][5];
                this.userData.userBuild = user[0][6];
                this.userData.userCorpus = user[0][7];
                this.userData.userApart = user[0][8];
                this.userData.userPostI = user[0][9];
            }
        },
        computed: {
            URI(){
                return this.$store.getters.URI;
            },
            getUserData(){
                return this.$store.getters.userData;
            }
        }
    }
</script>

<style scoped>

</style>
