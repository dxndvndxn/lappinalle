<template>
    <div class="pay">
        <h1 class="h-30">Доступные варианты оплаты</h1>
        <h2>Банковской картой онлайн</h2>
        <div class="pay-icons">
            <img :src="ic" v-for="(ic, i) in payIcons.lvlOne" alt="">
        </div>
        <h2>Онлайн кошельки</h2>
        <div class="pay-icons">
            <img :src="ic" v-for="(ic, ii) in payIcons.lvlTwo" alt="">
        </div>
    </div>
</template>

<script>
    export default {
        name: "Pay",
        data: () => ({
            payIcons: {lvlOne: ['../img/yandex-icon.png', '../img/qiwi-icon.png', '../../img/paypal-icon.png'], lvlTwo: ['../../img/yandex-icon.png', '../../img/qiwi-icon.png', '../../img/paypal-icon.png']}
        })
    }
</script>

<style scoped>

</style>
