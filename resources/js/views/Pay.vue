<template>
    <div class="pay">
        <h1 class="h-30" v-if="media.wind > media.tablet">Доступные варианты оплаты</h1>
        <div class="wrap-h" v-else>
            <Back v-bind:color="'grey'" v-bind:word="'Назад'"/>
            <h1 class="h-30">Оплата</h1>
        </div>
        <a href="../../Primer_Oplaty_Platezha_Po_Ie.docx" download><h2>Банковской картой онлайн</h2></a>
        <div class="pay-icons" id="iconsPay">
            <img :src="ic" v-for="(ic, i) in payIcons.lvlOne" alt="">
        </div>
        <p class="pay-text">
            Для выбора оплаты товара с помощью банковской карты на соответствующей странице необходимо нажать кнопку "оплата заказа банковской картой". Оплата происходит через ПАО СБЕРБАНК с использованием банковских карт следующих платёжных систем:
        </p>
        <p class="pay-text">
            МИР;
            <br>
            VISA International;
            <br>
            Mastercard Worldwide;
            <br>
            JCB.
        </p>
        <p class="pay-text">
            При возникновении проблем с оплатой свяжитесь с нами по WhatsApp, электронной почте или через форму обратной связи на странице "Контакты".
        </p>
<!--        <h2 v-if="media.wind > media.tablet">Онлайн кошельки</h2>-->
<!--        <div class="pay-icons">-->
<!--            <img :src="ic" v-for="(ic, ii) in payIcons.lvlTwo" alt="">-->
<!--        </div>-->
    </div>
</template>

<script>
    import Back from "../components/Back";
    export default {
        name: "Pay",
        components:{
          Back
        },
        data: () => ({
            payIcons: {lvlOne: ['../img/Mk.png', '../img/Viza.png', '../img/Mir.png'], lvlTwo: ['../../img/yandex-icon.png', '../../img/qiwi-icon.png', '../../img/paypal-icon.png']}
        }),
        computed: {
            media(){
                return this.$store.getters.media;
            }
        }
    }
</script>

<style scoped>

</style>
