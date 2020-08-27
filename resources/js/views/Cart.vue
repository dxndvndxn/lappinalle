<template>
    <div class="cart container">
        <div class="cart-head h1-m50">
            <Back v-bind:color="'grey'" v-bind:word="'Назад'"/> <h1 class="h1-bold-grey">Корзина <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 510.2 418.41"><defs></defs><title>icon_kor</title><path d="M552.72,93.5c-.77,3.55-1.1,7.26-2.39,10.61q-5.24,13.55-11.15,26.83-27,60.36-54.24,120.61a187.52,187.52,0,0,1-9.51,17.29c-6.51,11.1-16.9,15.39-29.17,16.13-3.11.19-6.24.2-9.36.2H210.66a62,62,0,0,0,8,17c7.14,10.51,16.82,15.78,29.82,15.75,64.81-.18,129.63-.09,194.44-.08a20.25,20.25,0,0,1,4.13.26,10.44,10.44,0,0,1,8.35,11.25,10.59,10.59,0,0,1-9.85,9.71c-1,.09-2.09.05-3.13.05-64.37,0-128.75-.15-193.13.08-21.91.08-38-9.46-49.64-27.46-6.72-10.41-10-22.12-13.3-33.94-8.74-31.45-17.85-62.8-27-94.14C148.26,145.41,136.94,107.22,125.7,69c-2.74-9.34-13.21-17.12-23.47-17.18-16-.1-32.1,0-48.15,0-5.21,0-9-2.42-10.77-6.68-2.75-6.75,2.06-14.52,9.38-14.52,21.17,0,42.34,0,63.49.62,5.3.14,10.77,1.88,15.75,3.89,7.21,2.92,11.72,8.75,13.81,16.27q29.14,104.75,58.18,209.5c.69,2.49,1.68,3.19,4.2,3.18q114.66-.1,229.31-.06c2.78,0,5.55-.18,8.32-.25,5.67-.14,10-2.41,12.64-7.61,5.07-10,10.53-19.91,15.16-30.16q27.33-60.5,54.14-121.22a48.89,48.89,0,0,0,3.56-13.48c.89-7-.71-8.5-7.75-8.55s-14.05.08-21.08.09q-58.95.06-117.91.09c-22.73,0-45.46-.08-68.19-.1L200,82.7c-6.46,0-10.43-2.71-11.84-8a10.46,10.46,0,0,1,8.09-13,25,25,0,0,1,4.66-.31q132.09.07,264.19.19c18.74,0,37.48-.22,56.22-.14a52.19,52.19,0,0,1,12.6,1.4c10.22,2.63,16.16,9.56,18.27,19.84.14.65.37,1.29.55,1.94Z" transform="translate(-42.53 -30.59)"/><path d="M437.67,449c-4.33-1.14-8.81-1.9-13-3.5A49.57,49.57,0,0,1,437.16,350c26.07-3,50.22,15.1,54.56,40.83,4.41,26.13-12.49,51.39-38.13,57-1.83.4-3.67.78-5.51,1.17Zm-24.18-49.62a29.39,29.39,0,0,0,29.34,29.25c15.94-.07,29.24-13.38,29.16-29.19a29.25,29.25,0,1,0-58.5-.06Z" transform="translate(-42.53 -30.59)"/><path d="M235.67,449c-5.22-1.5-10.69-2.42-15.61-4.6-20.4-9-31.76-30.29-28.6-52.74,2.94-20.83,20.25-38.15,41.44-41.46,27.06-4.22,53,14.75,56.84,41.67A49.75,49.75,0,0,1,247,448.55a8.76,8.76,0,0,0-1.46.45Zm4.85-78.92a29.28,29.28,0,1,0,.22,58.55c15.84-.11,29.07-13.29,29.09-29A29.38,29.38,0,0,0,240.52,370.08Z" transform="translate(-42.53 -30.59)"/><path class="cls-1" d="M413.49,399.38a29.25,29.25,0,1,1,58.5.06c.08,15.81-13.22,29.12-29.16,29.19A29.39,29.39,0,0,1,413.49,399.38Z" transform="translate(-42.53 -30.59)"/><path class="cls-1" d="M240.52,370.08a29.38,29.38,0,0,1,29.31,29.55c0,15.71-13.25,28.89-29.09,29a29.28,29.28,0,1,1-.22-58.55Z" transform="translate(-42.53 -30.59)"/></svg></h1>
        </div>
        <div class="cart-wrap" v-if="getCart.length">
            <div class="cart-cards">
                <div class="card" v-for="(card, c) in cartCards">
                    <div class="card-img">
                        <img :src="card.cardImg" alt="">
                    </div>
                    <div class="card-info">
                        <div class="card-name">
                            {{card.cardName}}
                        </div>
                        <div class="card-counts">
                            <div class="card-size">
                                Размер: <span> {{card.cardSize}}</span>
                            </div>
                            <div class="card-amount">
                                Количество:  <span> {{card.cardAmount}}</span>
                                <div class="change-amount">
                                    <button class="change-plus" @click="itemPlus(c)"></button>
                                    <button class="change-minus" @click="itemMinus(c)"></button>
                                </div>
                            </div>
                            <div class="card-price">Цена: <span>{{card.cardAmount * card.cardPrice}} &#8381;</span></div>
                        </div>
                        <div class="card-desc">
                            {{card.cardText}}
                        </div>
                    </div>
                    <div class="card-close">
                        <span class="close-btn" @click="removeCard(card.cardId)"></span>
                    </div>
                </div>
            </div>
            <div class="cart-total">
                <div class="total-price">
                    Итого: <span>{{totalPrice}} &#8381;</span>
                </div>
                <button class="classic-btn-sz btn" @click="pushToOrder">Оформить заказ</button>
            </div>
        </div>
        <div class="cart-no bookmark-text">
            В корзине пока нет товаров.
        </div>
    </div>
</template>

<script>
    import Back from "../components/Back";
    export default {
        name: "Cart",
        components: {Back},
        data: () => ({
            cartCards: [
                {cardId: 1, cardImg: '../../img/item.png', cardName: 'Комбинезон "LAPPINALLE', cardSize: 46, cardAmount: 1, cardPrice: 5400, cardText: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium commodi ea\n' +
                    '                            earum harum ipsa maxime, modi mollitia omnis quisquam ratione sunt. Aliquid dignissimos\n' +
                    '                            eius, fuga natus nostrum sed sunt?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium commodi ea\n' +
                    '                            earum harum ipsa maxime, modi mollitia omnis quisquam ratione sunt. Aliquid dignissimos\n' +
                    '                            eius, fuga natus nostrum sed sunt?'},
                {cardId: 2, cardImg: '../../img/item.png', cardName: 'Комбинезон "LAPPINALLE', cardSize: 46, cardAmount: 1, cardPrice: 5400, cardText: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium commodi ea\n' +
                    '                            earum harum ipsa maxime, modi mollitia omnis quisquam ratione sunt. Aliquid dignissimos\n' +
                    '                            eius, fuga natus nostrum sed sunt?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium commodi ea\n' +
                    '                            earum harum ipsa maxime, modi mollitia omnis quisquam ratione sunt. Aliquid dignissimos\n' +
                    '                            eius, fuga natus nostrum sed sunt?'},
                {cardId: 3, cardImg: '../../img/item.png', cardName: 'Комбинезон "LAPPINALLE', cardSize: 46, cardAmount: 1, cardPrice: 5400, cardText: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium commodi ea\n' +
                        '                            earum harum ipsa maxime, modi mollitia omnis quisquam ratione sunt. Aliquid dignissimos\n' +
                        '                            eius, fuga natus nostrum sed sunt?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium commodi ea\n' +
                        '                            earum harum ipsa maxime, modi mollitia omnis quisquam ratione sunt. Aliquid dignissimos\n' +
                        '                            eius, fuga natus nostrum sed sunt?'},

            ],
            totalPrice: null

        }),
        methods:{
            countTotal(arr){
                this.totalPrice = 0;
                arr.forEach((val) => {
                    this.totalPrice += val.cardPrice * val.cardAmount;
                })
            },
            itemPlus(i){
                this.cartCards[i].cardAmount++;
                this.countTotal(this.cartCards);
            },
            itemMinus(i){
                if (this.cartCards[i].cardAmount > 1){
                    this.cartCards[i].cardAmount--;
                    this.countTotal(this.cartCards);
                }
            },
            removeCard(i){
                this.cartCards = this.cartCards.filter(item => item.cardId !== i);
                this.countTotal(this.cartCards);
            },
            pushToOrder(){
                this.$router.push({ name: 'ordering' })
            }
        },
        created() {
            this.$Progress.start();
            this.$store.dispatch('getProductForCart');
            this.countTotal(this.cartCards);
        },
        computed: {
            getCart(){
                this.$Progress.finish();
                return this.$store.getters.cart;
            },
            getProductCart(){
                return this.$store.getters.cartProduct;
            }
        }
    }
</script>

<style scoped>

</style>
