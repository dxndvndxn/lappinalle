<template>
    <div class="choose-pay container">
        <div class="choose-pay-header h1-m50">
            <Back v-bind:color="'grey'" v-bind:word="'Способ доставки'"/><h1 class="h1-bold-grey">Способ оплаты</h1>
        </div>
        <div class="choose-pay-img chozen-imgs">
            <img :src="pay.payIcon" v-for="(pay, i) in payments" v-bind:class="pay.payActive ? 'chozenImg' : null" alt="" @click="clickPay(i)">
        </div>
        <div class="choose-pay-button">
            <button class="classic-btn-sz btn" @click="GoPay()">Перейти к оплате</button>
        </div>
    </div>
</template>

<script>
    import Back from "../components/Back";
    import axios from "axios";
    export default {
        name: "ChoosePay",
        components: {Back},
        data: () => ({
            payments: [
                {payIcon: '../img/paycard-icon.png', payUrl: 'https://3dsec.sberbank.ru/payment/rest/register.do', payActive: true, payName: 'Сбербанк'},
                {payIcon: '../img/yandex-icon.png', payUrl: '', payActive: false, payName: 'Яндекс Деньги'},
                {payIcon: '../img/qiwi-icon.png', payUrl: '', payActive: false, payName: 'QiWi'},
                {payIcon: '../img/paypal-icon.png', payUrl: '', payActive: false, payName: 'WebMoney'},
            ],
            activeUrl: 'https://3dsec.sberbank.ru/payment/rest/register.do',
            activePayName: 'Сбербанк',
            lastId: null
        }),
        methods: {
            clickPay(i){
                this.payments.forEach(el => el.payActive = false);
                this.payments[i].payActive = true;
                this.activeUrl = this.payments[i].payUrl;
            },
            async GoPay(){
                this.$Progress.start();
                this.$store.dispatch('sentData', this.activePayName);
            }
        },
        created() {
            this.$Progress.start();
        },
        mounted() {
            this.$Progress.finish();
        },
        computed: {
            URI(){
                return this.$store.getters.URI;
            },
            totalPrice() {
                return this.$store.getters.totalPrice;
            },
            returnDeliveryData(){
                return this.$store.getters.deliveryData;
            }
        },
    }
</script>

<style scoped>

</style>
