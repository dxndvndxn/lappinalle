<template>
    <div class="choose-pay container">
        <div class="choose-pay-header h1-m50">
            <Back v-bind:color="'grey'" v-bind:word="'Способ доставки'"/><h1 class="h1-bold-grey">Способ оплаты</h1>
        </div>
        <div class="choose-pay-img chozen-imgs">
            <img :src="pay.payIcon" v-for="(pay, i) in payments" v-bind:class="pay.payActive ? 'chozenImg' : null" alt="" @click="clickPay(i)">
        </div>
        <p v-if="amountError" v-for="(product, i) in errorProductsAmount" class="errorAmountProduct">
            Товар {{product.product_title}} с {{product.size}} размером отсутствует в необходимом количестве на складе.
        </p>
        <div class="choose-pay-button">
            <button class="classic-btn-sz btn" @click="GoPay()">
                Перейти к оплате
                <div class="spinner-wrap" v-if="checkAmount">
                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                </div>
            </button>
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
                {payIcon: '../img/paycard-icon.png', payUrl: 'https://3dsec.sberbank.ru/payment/rest/register.do', payActive: true, payName: 'Сбербанк'},
                {payIcon: '../img/yandex-icon.png', payUrl: '', payActive: false, payName: 'Яндекс Деньги'},
                {payIcon: '../img/qiwi-icon.png', payUrl: '', payActive: false, payName: 'QiWi'},
                {payIcon: '../img/paypal-icon.png', payUrl: '', payActive: false, payName: 'WebMoney'},
            ],
            activeUrl: 'https://3dsec.sberbank.ru/payment/rest/register.do',
            activePayName: 'Сбербанк',
            lastId: null,
            checkAmount: false,
            amountError: false,
            errorProductsAmount: []
        }),
        methods: {
            clickPay(i){
                this.payments.forEach(el => el.payActive = false);
                this.payments[i].payActive = true;
                this.activeUrl = this.payments[i].payUrl;
            },
            async GoPay(){
                let checkAmount = [];
                this.errorProductsAmount = [];
                this.amountError = false;
                this.checkAmount = !this.checkAmount;

                this.getProductCart.forEach(el => checkAmount.push({catalog_size_id: el.catalog_size_id, amount: el.count}))

                await this.$store.dispatch('CheckAmount', checkAmount)
                    .then(res => {
                        this.checkAmount = !this.checkAmount;

                        res.forEach(el => {

                            if (!el.amount) {
                                let findIndexProduct = this.getProductCart.findIndex(elProd => elProd.catalog_size_id === el.catalog_size_id);
                                this.errorProductsAmount.push(this.getProductCart[findIndexProduct]);
                            }
                        })

                        if (this.errorProductsAmount.length) {
                            this.amountError = true;
                        }else{
                            this.$Progress.start();
                            this.$store.dispatch('sentData', this.activePayName);
                        }
                    })
            }
        },
        created() {
            this.$Progress.start();
            this.$store.dispatch('getProductForCart');
        },
        beforeDestroy() {
            this.errorProductsAmount = [];
            this.amountError = false;
            this.checkAmount = false;
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
            },
            myCart(){
                return this.$store.getters.cart;
            },
            getProductCart(){
                if (this.$store.getters.cartProduct !== null){
                    this.$Progress.finish();
                    return this.$store.getters.cartProduct;
                }
            }
        },
    }
</script>

<style scoped>

</style>
