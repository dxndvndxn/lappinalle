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
                    Основное <img src="../../img/cabinet-icon.png" v-if="media.wind > media.tablet" @click="basicData = !basicData" alt="">
                </li>
                <li>
                    <label for="name" v-if="media.wind > media.tablet">ФИО: </label>
                    <input type="text" id="name" v-bind:class="basicData ? 'active-input' : null" v-model.trim="userData.userName">
                    <small v-if="$v.userData.userName.$dirty && !$v.userData.userName.required" class="small-invalid">Поле ФИО должно быть заполнено</small>
                    <small v-else-if="($v.userData.userName.$dirty && !$v.userData.userName.minLength) || ($v.userData.userName.$dirty && !$v.userData.userName.maxLength) " class="small-invalid">Поле Имя заполнено не корректно</small>
                </li>
                <li>
                    <label for="tel" v-if="media.wind > media.tablet">Телефон: </label>
                    <input type="tel" id="tel" v-bind:class="basicData ? 'active-input' : null" v-model.trim="userData.userTel" v-bind:placeholder="media.wind <= media.tablet ? 'Телефон' : null">
                    <small v-if="($v.userData.userTel.$dirty && !$v.userData.userTel.phoneValid) && (userData.userTel !== null)" class="small-invalid">Поле Телефон заполнено не корректно</small>
                </li>
                <li>
                    <label for="email" v-if="media.wind > media.tablet">E-mail: </label>
                    <input type="text" id="email" v-bind:class="basicData ? 'active-input' : null" v-model.trim="userData.userEmail">
                    <small v-if="$v.userData.userEmail.$dirty && !$v.userData.userEmail.email" class="small-invalid">Поле E-mail заполнено не корректно</small>
                    <small v-else-if="$v.userData.userEmail.$dirty && !$v.userData.userEmail.required" class="small-invalid">Поле E-mail должно быть заполнено</small>
                </li>
            </ul>
            <ul class="user-data-addr">
                <li class="cabinet-h">
                    Адрес <img src="../../img/cabinet-icon.png" v-if="media.wind > media.tablet" @click="basicDataAddr = !basicDataAddr" alt="">
                </li>
                <li>
                    <label v-if="media.wind > media.tablet">Город: </label>
                    <input type="text" v-model.trim="userData.userCity" v-bind:class="basicDataAddr ? 'active-input' : null" v-bind:placeholder="media.wind <= media.tablet ? 'Город' : null">
                    <small v-if="$v.userData.userCity.$dirty && !$v.userData.userCity.maxLength" class="small-invalid">Поле Город заполнено не корректно</small>
                </li>
                <li>
                    <label v-if="media.wind > media.tablet">Улица: </label>
                    <input type="text" v-model.trim="userData.userAdrr" v-bind:class="basicDataAddr ? 'active-input' : null" v-bind:placeholder="media.wind <= media.tablet ? 'Поле' : null">
                    <small v-if="$v.userData.userAdrr.$dirty && !$v.userData.userAdrr.maxLength" class="small-invalid">Поле Улица заполнено не корректно</small>
                </li>
                <li>
                    <label v-if="media.wind > media.tablet">Дом: </label>
                    <input type="text" v-model.trim="userData.userBuild" v-bind:class="basicDataAddr ? 'active-input' : null" v-bind:placeholder="media.wind <= media.tablet ? 'Дом' : null">
                    <small v-if="$v.userData.userBuild.$dirty && !$v.userData.userBuild.maxLength" class="small-invalid">Поле Дом заполнено не корректно</small>
                </li>
                <li>
                    <label v-if="media.wind > media.tablet">Корпус: </label>
                    <input type="text" v-model.trim="userData.userCorpus" v-bind:class="basicDataAddr ? 'active-input' : null" v-bind:placeholder="media.wind <= media.tablet ? 'Корпус' : null">
                    <small v-if="$v.userData.userCorpus.$dirty && !$v.userData.userCorpus.maxLength" class="small-invalid">Поле Корпус заполнено не корректно</small>
                </li>
                <li>
                    <label v-if="media.wind > media.tablet">Квартира: </label>
                    <input type="text" v-model.trim="userData.userApart" v-bind:class="basicDataAddr ? 'active-input' : null" v-bind:placeholder="media.wind <= media.tablet ? 'Квартира' : null">
                    <small v-if="$v.userData.userApart.$dirty && !$v.userData.userApart.maxLength" class="small-invalid">Поле Квартира заполнено не корректно</small>
                </li>
                <li>
                    <label v-if="media.wind > media.tablet">Почтовый индекс: </label>
                    <input type="text" v-model.trim="userData.userPostI" v-bind:class="basicDataAddr ? 'active-input' : null" v-bind:placeholder="media.wind <= media.tablet ? 'Почтовый индекс' : null">
                    <small v-if="$v.userData.userPostI.$dirty && !$v.userData.userPostI.maxLength" class="small-invalid">Корпус Почтовый индекс заполнено не корректно</small>
                </li>
            </ul>
            <ul class="user-data-security">
                <li class="cabinet-h">
                    Безопасность <img src="../../img/cabinet-icon.png" v-if="media.wind > media.tablet" @click="basicDataPass = !basicDataPass" alt="">
                </li>
                <li>
                    <label v-if="media.wind > media.tablet">Старый пароль: </label>
                    <input type="password" v-model.trim="userData.userPass" @change="checkOldPass" v-bind:class="basicDataPass ? 'active-input' : null" v-bind:placeholder="media.wind <= media.tablet ? 'Старый пароль' : null">
                    <small v-if="passError" class="small-invalid">Неверный пароль</small>
                </li>
                <li>
                    <label v-if="media.wind > media.tablet">Новый пароль: </label>
                    <input type="password" v-model.trim="userData.userNewPass" v-bind:class="basicDataPass ? 'active-input' : null" v-bind:placeholder="media.wind <= media.tablet ? 'Новый пароль' : null">
                    <small v-if="!$v.userData.userNewPass.minLength && $v.userData.userNewPass.$dirty" class="small-invalid">Пароль должен быть не менее 6 символов</small>
                </li>
            </ul>
            <button class="btn">
                сохранить изменения
            </button>
            <p v-if="successUpdate" class="reviewleave-success">
                Ваши данные успешно сохранены
            </p>
        </form>
        <div class="cabinet-user-order" v-else-if="tabs[1].active">
            <div class="user-order-wrap" v-for="(ord, i) in orderData">
                <div class="user-order-head">
                    <div class="order-head-number">
                        <span class="cabinet-h">Заказ &#8470; </span>
                        <span class="order-view">{{ord.orders_id}}</span>
                    </div>
                    <div class="order-head-status">
                        <div class="head-status-wrap">
                            <span class="cabinet-h">Статус: </span>
                            <span class="order-view"> {{ord.orders_status}}</span>
                            <span class="head-status-btn" @click="ord.active = !ord.active" v-bind:class="ord.active ? 'active-arrow-cab' : 'passive-arrow-cab'"></span>
                        </div>
                    </div>
                </div>
                <div class="user-order-data"  v-if="ord.active" v-for="(dt, k) in ord.orders_korzina">
                    <img :src="dt[4]" alt="">
                    <ul class="order-data-desc">
                        <li class="cabinet-h">{{dt[0]}}</li>
                        <li>Количество: {{dt[1]}}</li>
                        <li>Размер: {{dt[2]}}</li>
                        <li>Цена: {{dt[3]}} &#8381;</li>
                    </ul>
                </div>
                <div class="user-order-delivery">
                    <span class="cabinet-h">Доставка: </span>
                    <span class="user-order-delivery-text" v-if="ord.orders_deliveryName === 'post-russia'">Почта России</span>
                    <span class="user-order-delivery-text" v-else-if="ord.orders_deliveryName === 'pek'">Пэк</span>
                    <span class="user-order-delivery-text" v-else-if="ord.orders_deliveryName === 'sdek'">Сдэк</span>
                    <span class="user-order-delivery-text" v-else-if="ord.orders_deliveryName === 'postman'">Курьерская доставка</span>
                </div>
                <div class="user-order-total">
                    <span class="cabinet-h">Итоговая стоимость: </span>
                    <span class="user-order-total-text">{{ord.orders_totalPrice}} &#8381;</span>
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
            orderData: null,
            basicData: false,
            basicDataAddr: false,
            basicDataPass: false,

            // Ошибка пароля
            passError: false,

            // Успешный апдейт
            successUpdate: false
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
                if (this.$v.userData.$invalid && !this.$v.userData.userTel.$invalid){
                    if (this.userData.userTel !== null && this.$v.userData.userTel.$invalid) {
                        this.$v.$touch();
                        return;
                    }
                    this.$v.$touch();
                    return;
                }else{
                    let formData = new FormData();
                    formData.append('userUpdate',  JSON.stringify(this.userData));

                    if (!this.passError) {
                        await axios.post(`${this.URI}lkupd`, formData)
                            .then(res => {
                                if (res.data) {
                                    this.successUpdate = true;
                                }
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
                    .catch(e => {
                        console.log(e)
                        this.passError = true;
                    })
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
                this.userData.userEmail = user[0][2];
                this.userData.userTel = user[0][3];
                this.userData.userCity = user[0][4];
                this.userData.userAdrr = user[0][5];
                this.userData.userBuild = user[0][6];
                this.userData.userCorpus = user[0][7];
                this.userData.userApart = user[0][8];
                this.userData.userPostI = user[0][9];

                this.orderData = user[1];
            }
        },
        computed: {
            URI(){
                return this.$store.getters.URI;
            },
            getUserData(){
                return this.$store.getters.userData;
            },
            media(){
                return this.$store.getters.media;
            }
        }
    }
</script>

<style scoped>

</style>
