<template>
    <div class="delivery">
        <h1 class="h-30">
            Доступные варианты доставки
        </h1>
        <div class="delivery-icons">
            <img v-for="(del, i) in imgDelivery" :src="del" alt="" @click="chosenDel(i)">
        </div>
        <div class="delivery-text">
            <h3 v-if="imgText[chosenText].h1 !== null">
                {{imgText[chosenText].h1}}
            </h3>
            <p>
                {{imgText[chosenText].text}}
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Delivery",
        data: () => ({
            imgDelivery: ['../img/post-icon.png', '../img/sdek-icon.png', '../img/pek-icon.png'],
            imgText: [
                {h1: 'Загловок почты',
                    text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta illum magni officia quis totam vero!\n' +
                    'Assumenda delectus eum necessitatibus nobis vero. Cum debitis itaque quos ratione temporibus! Enim\n' +
                    'perferendis, praesentium!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta illum magni officia quis totam vero!\n' +
                        'Assumenda delectus eum necessitatibus nobis vero. Cum debitis itaque quos ratione temporibus! Enim\n' +
                        'perferendis, praesentium!'}
                    , {h1: null,
                    text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta illum magni officia quis totam vero!\n' +
                    ' Assumenda delectus eum necessitatibus nobis vero. Cum debitis itaque quos ratione temporibus! Enim\n' +
                    ' perferendis, praesentium!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta illum magni officia quis totam vero!\n' +
                        'Assumenda delectus eum necessitatibus nobis vero. Cum debitis itaque quos ratione temporibus! Enim\n' +
                        'perferendis, praesentium!'},
                {h1: 'Доставка ПЭК действительна при сумме заказа от 20000 рублей.', text: 'Также действует бесплатная курьерская доставка в пределах КАД\n' +
                        'при заказе от 2000 рублей. При заказе на сумму менее 2000 рублей,\n' +
                        'отказе или выкупе товара на сумму менее 2000 рублей стоимость\n' +
                        'курьерской доставки 300 рублей.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta illum magni officia quis totam vero!\n' +
                        'Assumenda delectus eum necessitatibus nobis vero. Cum debitis itaque quos ratione temporibus! Enim\n' +
                        'perferendis, praesentium!'}],
            chosenText: 0

        }),
        methods: {
            chosenDel(i){
                this.chosenText = i;
            }
        }
    }
</script>

<style scoped>

</style>
