<template>
    <div class="delivery">
        <h1 class="h-30" v-if="media.wind > media.tablet">
            Доступные варианты доставки
        </h1>
        <div class="wrap-h" v-else>
            <Back v-bind:color="'grey'" v-bind:word="'Назад'"/>
            <h1 class="h-30">Оплата</h1>
        </div>
        <div class="delivery-icons" v-if="returnDeliveries !== null">
            <img v-for="(del, i) in imgDelivery" v-if="returnDeliveries[i].delivery_confirm === 1" :src="del.img" alt="" @click="chosenDel(del.id)">
        </div>
        <div class="delivery-text" v-for="(text, i) in imgText" v-if="text.id === chosenText">
            <h3>
                {{text.h1}}
            </h3>
            <p>
                {{text.text}}
            </p>
        </div>
    </div>
</template>

<script>
    import Back from "../components/Back";
    export default {
        name: "Delivery",
        components: {
          Back
        },
        metaInfo(){
            return {
                title: "Доставка"
            }
        },
        data: () => ({
            imgDelivery: [{img: '../img/postman-icon.png', id: 1}, {img: '../img/post-icon.png', id: 2}, {img: '../img/sdek-icon.png', id: 3}, {img: '../img/pek-icon.png', id: 4}],
            imgText: [
                {id: 1, h1: 'Доставка Курьерская действительна при сумме заказа от 2000 рублей.', text: ' ПРИ ЗАКАЗЕ НА СУММУ МЕНЕЕ 2000 РУБ, ОТКАЗЕ ОТ ЗАКАЗА ИЛИ ВЫКУПЕ ЗАКАЗА НА СУММУ МЕНЕЕ 2000 РУБ, СТОИМОСТЬ КУРЬЕРСКОЙ ДОСТАВКИ СОСТАВИТ 300 РУБ.'},
                {id: 2, h1: 'ПО РОССИИ ДОСТАВКА ПОЧТОЙ РОССИИ ЗАКАЗОВ ОТ 2000 РУБ.', text: 'ПРИ ЗАКАЗЕ НА СУММУ ОТ 5000 РУБ ДОСТАВКА ПО РОССИИ ПОЧТОЙ РОССИИ БЕСПЛАТНАЯ (ЗА ИСКЛЮЧЕНИЕМ ДОСТАВКИ В ТРУДНОДОСТУПНЫЕ РАЙОНЫ, ОПЛАЧИВАЕМЫЕ ПО ИНДИВИДУАЛЬНЫМ ТАРИФАМ). ПРИ ЗАКАЗЕ НА СУММУ МЕНЕЕ 2000 РУБ, ПОМИМО ПОЧТОВЫХ РАСХОДОВ, ОПЛАЧИВАЮТСЯ КУРЬЕРСКИЕ УСЛУГИ В РАЗМЕРЕ 300 РУБ'},
                {id: 3, h1: 'Доставка СДЭК действительна при сумме заказа от 2000 рублей.', text: 'Также действует бесплатная курьерская доставка в пределах КАД  при заказе от 2000 рублей. При заказе на сумму менее 2000 рублей отказе или выкупе товара на сумму менее 2000 рублей стоимость курьерской доставки 300 рублей.'},
                {id: 4, h1: 'Доставка ПЭК действительна при сумме заказа от 2000 рублей.', text: 'Также действует бесплатная курьерская доставка в пределах КАД  при заказе от 2000 рублей. При заказе на сумму менее 2000 рублей отказе или выкупе товара на сумму менее 2000 рублей стоимость курьерской доставки 300 рублей.'}
                ],
            chosenText: 1

        }),
        methods: {
            chosenDel(id){
                this.chosenText = id;
            }
        },
        created() {
            this.$Progress.start();
            this.$store.dispatch('GetAllDeliveries');
        },
        computed: {
            returnDeliveries(){
                this.$Progress.finish();
                return this.$store.getters.GetAllDeliveries;
            },
            media(){
                return this.$store.getters.media;
            }
        }
    }
</script>

<style scoped>

</style>
