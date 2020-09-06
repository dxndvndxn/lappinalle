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
                    <input type="text" id="name" v-bind:class="basicData ? 'active-input' : null" v-model.trim="userName">
                </li>
                <li>
                    <label for="tel">Телефон: </label>
                    <input type="tel" id="tel" v-bind:class="basicData ? 'active-input' : null" v-model.trim="userTel">
                </li>
                <li>
                    <label for="email">E-mail: </label>
                    <input type="text" id="email" v-bind:class="basicData ? 'active-input' : null" v-model.trim="userTel">
                </li>
            </ul>
            <ul class="user-data-addr">
                <li class="cabinet-h">
                    Адрес <img src="../../img/cabinet-icon.png" @click="basicDataAddr = !basicDataAddr" alt="">
                </li>
                <li>
                    <label>Город: </label>
                    <input type="text" v-model.trim="userCity" v-bind:class="basicDataAddr ? 'active-input' : null">
                </li>
                <li>
                    <label>Улица: </label>
                    <input type="text" v-model.trim="userAdrr" v-bind:class="basicDataAddr ? 'active-input' : null">
                </li>
                <li>
                    <label>Дом: </label>
                    <input type="text" v-model.trim="userBuild" v-bind:class="basicDataAddr ? 'active-input' : null">
                </li>
                <li>
                    <label>Корпус: </label>
                    <input type="text" v-model.trim="userCorpus" v-bind:class="basicDataAddr ? 'active-input' : null">
                </li>
                <li>
                    <label>Квартира: </label>
                    <input type="text" v-model.trim="userApart" v-bind:class="basicDataAddr ? 'active-input' : null">
                </li>
                <li>
                    <label>Почтовый индекс: </label>
                    <input type="text" v-model.trim="userPostI" v-bind:class="basicDataAddr ? 'active-input' : null">
                </li>
            </ul>
            <ul class="user-data-security">
                <li class="cabinet-h">
                    Безопасность <img src="../../img/cabinet-icon.png" @click="basicDataPass = !basicDataPass" alt="">
                </li>
                <li>
                    <label>Пароль: </label>
                    <input type="password" v-model.trim="userPass" v-bind:class="basicDataPass ? 'active-input' : null">
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
    export default {
        name: "Cabinet",
        data:() => ({
            tabs: [{name: 'Личные данные', active: true}, {name: 'Заказы', active: false}],
            userName: 'Назимов илья игоревич',
            userTel: null,
            userEmail: null,
            userCity: null,
            userAdrr: null,
            userBuild: null,
            userCorpus: null,
            userApart: null,
            userPostI: null,
            userPass: null,
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
            basicDataPass: false


        }),
        methods: {
            clickTab(){
                this.tabs.forEach(el => el.active = !el.active);
            }
        },
        created() {
            this.$Progress.start();
            // this.$Progress.set(100);
        },
        mounted() {
            this.$Progress.finish();
        }
    }
</script>

<style scoped>

</style>
