<template>
    <div class="choose-pay container">
        <div class="choose-pay-header h1-m50">
            <Back v-bind:color="'grey'" v-bind:word="'Способ доставки'"/><h1 class="h1-bold-grey">Способ оплаты</h1>
        </div>
        <div class="choose-pay-img chozen-imgs">
            <img :src="pay.payIcon" v-for="(pay, i) in payments" v-bind:class="pay.payActive ? 'chozenImg' : null" alt="" @click="clickPay(i)">
        </div>
        <div class="choose-pay-button">
            <button class="classic-btn-sz btn">Перейти к оплате</button>
        </div>
    </div>
</template>

<script>
    import Back from "../components/Back";
    export default {
        name: "ChoosePay",
        components: {Back},
        data: () => ({
            payments: [
                {payIcon: '../img/paycard-icon.png', payUrl: '', payActive: true},
                {payIcon: '../img/yandex-icon.png', payUrl: '', payActive: false},
                {payIcon: '../img/qiwi-icon.png', payUrl: '', payActive: false},
                {payIcon: '../img/paypal-icon.png', payUrl: '', payActive: false},
            ]
        }),
        methods: {
            clickPay(i){
                this.payments.forEach(el => el.payActive = false);
                this.payments[i].payActive = true;
            },
        }
    }
</script>

<style scoped>

</style>
