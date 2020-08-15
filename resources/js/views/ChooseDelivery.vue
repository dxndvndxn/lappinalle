<template>
    <div class="chozen-delivery container">
        <div class="chozen-delivery-header h1-m50">
            <Back v-bind:color="'grey'" v-bind:word="'Контактная информация'"/><h1 class="h1-bold-grey">Способ доставки</h1>
        </div>
        <div class="chozen-delivery-img">
            <img :src="del.delImg" v-for="(del, i) in deliveries" v-bind:class="del.delChooze ? 'chozenDel' : null" alt="" @click="clickDel(i)">
        </div>
        <form class="chozen-delivery-fill">
            <div class="fill-inputs">
                <input type="text" class="classic-input" v-model.trim="street" placeholder="Улица" autocomplete="on">
                <input type="text" class="classic-input" v-model.trim="house" placeholder="Дом" autocomplete="on">
                <input type="text" class="classic-input" v-model.trim="corps" placeholder="Корпус" autocomplete="on">
                <input type="text" class="classic-input" v-model.trim="apart" placeholder="Квартира" autocomplete="on">
            </div>
            <div class="chozen-delivery-text">
                <p>
                    {{deliveries[chozenDel].delText}}
                </p>
                <div class="chozen-delivery-price">
                    Стоимость доставки:
                    <span v-if="1999 >= deliveries[chozenDel].freeShip">0 &#8381;</span>
                    <span v-else>{{deliveries[chozenDel].delPrice + ' &#8381;'}} </span>
                </div>
                <div class="chozen-delivery-total">
                    Итоговая стоимость: <span></span>
                </div>
            </div>
            <div class="chozen-delivery-btn">
                <button class="classic-btn-sz btn">следующий шаг</button>
            </div>
        </form>
    </div>
</template>

<script>
    import Back from "../components/Back";
    export default {
        name: "ChooseDelivery",
        components: {Back},
        data: () => ({
            deliveries: [
                {
                    delImg: '../img/post-icon.png',
                    delText: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis corporis cum cumque eum mollitia, nulla perferendis saepe sequi sit? Ad assumenda beatae doloribus eos magni natus quod repellat similique voluptates.\n',
                    delPrice: null,
                    delChooze: true
                },
                {
                    delImg: '../img/sdek-icon.png',
                    delText: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis corporis cum cumque eum mollitia, nulla perferendis saepe sequi sit? Ad assumenda beatae doloribus eos magni natus quod repellat similique voluptates.\n',
                    delPrice: null,
                    delChooze: false
                },
                {
                    delImg: '../img/pek-icon.png',
                    delText: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis corporis cum cumque eum mollitia, nulla perferendis saepe sequi sit? Ad assumenda beatae doloribus eos magni natus quod repellat similique voluptates.\n',
                    delPrice: null,
                    delChooze: false
                },
                {
                    delImg: '../img/postman-icon.png',
                    delText: 'Действует бесплатная курьерская доставка по СПБ\n' +
                        'в пределах КАД при заказе от 2000 рублей. При заказе на сумму\n' +
                        'менее 2000 рублей, отказе или выкупе товара на сумму менее\n' +
                        '2000 рублей стоимость курьерской доставки по СПБ 300 рублей.',
                    delPrice: 300,
                    delChooze: false,
                    freeShip: 2000
                },
            ],
            house: null,
            apart: null,
            corps: null,
            street: null,
            chozenDel: 1
        }),
        methods: {
            clickDel(i){
                this.chozenDel = i;
                this.deliveries.forEach(el => el.delChooze = false);
                this.deliveries[i].delChooze = true;
            }
        }
    }
</script>

<style scoped>

</style>
