<template>
    <div class="admin-order-card">
        <div class="warp-head-order-card">
            <AdminTopSide v-bind:H="'Подробности заказа'"/>
        </div>
        <div class="wrap-admin-order-card" v-for="(order, i) in orderInfo" v-if="orderInfo !== null">
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">№ заказа</label>
                    <input type="text" class="input-pale-blu" :value="order.orders_id" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">ФИО</label>
                    <input type="text" class="input-pale-blu" :value="order.orders_name" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Телефон</label>
                    <input type="text" class="input-pale-blu" :value="order.orders_tel" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">E-mail</label>
                    <input type="text" class="input-pale-blu" :value="order.orders_email" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Дата и время</label>
                    <input type="text" class="input-pale-blu" :value="order.created_at" disabled>
                </div>
            </div>
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-if="order.orders_deliveryName === 'post-russia'">
                    <label class="admin-h3">Способ доставки</label>
                    <input type="text" class="input-pale-blu" value="Почта России" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-else-if="order.orders_deliveryName === 'sdek'">
                    <label class="admin-h3">Способ доставки</label>
                    <input type="text" class="input-pale-blu" value="СДЭК" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-else-if="order.orders_deliveryName === 'pek'">
                    <label class="admin-h3">Способ доставки</label>
                    <input type="text" class="input-pale-blu" value="ПЭК" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-else-if="order.orders_deliveryName === 'postman'">
                    <label class="admin-h3">Способ доставки</label>
                    <input type="text" class="input-pale-blu" value="Курьерская доставка" disabled>
                </div>

                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-if="order.orders_deliveryName === 'pek' || order.orders_deliveryName === 'sdek'">
                    <label class="admin-h3">До куда</label>
                    <input type="text" class="input-pale-blu" :value="order.orders_whereGet" disabled>
                </div>

                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-if="order.orders_deliveryName === 'post-russia'">
                    <label class="admin-h3">Адрес доставки</label>
                    <input type="text" class="input-pale-blu" :value="
                    order.orders_city + ', '
                     + order.orders_street + ', '
                      + 'дом ' + order.orders_house + ', '
                       + 'корпус ' + order.orders_corps + ', '
                        + 'кв ' + order.orders_apart + ', '
                         + 'почтовый индекс ' + order.orders_indexPost" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-else-if="order.orders_deliveryName === 'sdek' || order.orders_deliveryName === 'pek'">
                    <label class="admin-h3">Адрес доставки</label>
                    <input type="text" class="input-pale-blu" :value="
                    order.orders_city + ', '
                     + order.orders_street + ', '
                      + 'дом ' + order.orders_house + ', '
                       + 'корпус ' + order.orders_corps + ', '
                        + 'кв ' + order.orders_apart
                         " disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-else-if="order.orders_deliveryName === 'postman'">
                    <label class="admin-h3">Адрес доставки</label>
                    <input type="text" class="input-pale-blu" :value="
                    'Санкт-Петербург, '
                     + order.orders_street + ', '
                      + 'дом ' + order.orders_house + ', '
                       + 'корпус ' + order.orders_corps + ', '
                        + 'кв ' + order.orders_apart
                         " disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-if="order.orders_deliveryName === 'sdek' || order.orders_deliveryName === 'pek'">
                    <label class="admin-h3">Паспортные данные</label>
                    <input type="text" class="input-pale-blu" :value="order.orders_passportData" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-if="order.orders_Comment !== null">
                    <label class="admin-h3">Комментарий</label>
                    <textarea class="input-pale-blu width-300" :value="order.orders_Comment" disabled> </textarea>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Способ оплаты</label>
                    <input type="text" class="input-pale-blu" :value="order.orders_payment" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Статус заказа</label>
                    <div class="wrap-input">
                        <input type="text" class="input-transp input-transp-p" v-model="actvieStatus" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <div type="text" class="input-transp input-transp-p" v-for="(st, i) in status" @click="changeStatus(st.name)" v-if="!activeBtn">
                        {{st.name}}
                    </div>
                </div>
            </div>
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Корзина</label>
                    <div class="wrap-admin-order" v-for="(product, i) in orderProducts">
                        <input type="text" class="input-pale-blu" :value="product" disabled>
                        <img @click="ReturnProduct(i)" src="../../../img/returnBack.png" alt="">
                    </div>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Стоимость</label>
                    <input type="text" class="input-pale-blu" :value="order.orders_totalPrice + ' ₽'" disabled>
                </div>
                <button class="admin-btn-add pdf width-300" @click="loadFile()">
                    скачать накладную <img src="../../../img/pdf.png" alt="">
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "OrderCard",
        components: {AdminTopSide},
        data: () => ({
            activeBtn: true,
            orderInfo: null,
            orderProducts: null,
            status: [
                {
                    name: 'В обработке'
                },
                {
                    name: 'Подтверждён'
                },
                {
                    name: 'Отправлен'
                },
                {
                    name: 'Получен'
                },
                {
                    name: 'Возврат'
                }
            ],
            actvieStatus: null
        }),
        created() {
            this.$Progress.start();
            this.$store.dispatch('GetOneOrder', {id: this.$route.params.id});
        },
        methods: {
            ReturnProduct(i){
                console.log(this.orderProducts[i].split(', '))
                let splited = this.orderProducts[i].split(', ');
                let data = {
                    order_id: this.orderInfo[0].orders_id,
                }

                splited.forEach((el, i) => {

                    if (i === 0) {
                        data.product_id = +el.split(': ')[1];
                    }
                    if (i === 2) {
                        data.size = el.split(': ')[1];
                    }
                    if (i === 3) {
                        data.amount = +el.split(': ')[1];
                    }
                })
                this.$Progress.start();
                axios.post(`${this.URI}returnproduct`, data)
                .then(res => {
                    console.log(res.data)
                    this.$store.dispatch('GetOneOrder', {id: this.$route.params.id});
                })
                console.log(data)
            },
            loadFile(){
                this.$Progress.start();
                let address = '';
                let deliveryName = '';

                if (this.orderInfo[0].orders_deliveryName === 'post-russia') {
                    deliveryName = 'Почта России';

                    address = this.orderInfo[0].orders_city + ', '
                        + this.orderInfo[0].orders_street + ', '
                        + 'дом ' + this.orderInfo[0].orders_house + ', '
                        + 'корпус ' + this.orderInfo[0].orders_corps + ', '
                        + 'кв ' + this.orderInfo[0].orders_apart + ', '
                        + 'почтовый индекс ' + this.orderInfo[0].orders_indexPost
                }
                else if (this.orderInfo[0].orders_deliveryName === 'sdek' || this.orderInfo[0].orders_deliveryName === 'pek') {
                    deliveryName = this.orderInfo[0].orders_deliveryName === 'sdek' ? 'СДЭК' : 'ПЭК';

                    address = this.orderInfo[0].orders_city + ', '
                        + this.orderInfo[0].orders_street + ', '
                        + 'дом ' + this.orderInfo[0].orders_house + ', '
                        + 'корпус ' + this.orderInfo[0].orders_corps + ', '
                        + 'кв ' + this.orderInfo[0].orders_apart
                }
                else if (this.orderInfo[0].orders_deliveryName === 'postman') {
                    deliveryName = 'Курьерская доставка';

                    address = 'Санкт-Петербург, '
                        + this.orderInfo[0].orders_street + ', '
                        + 'дом ' + this.orderInfo[0].orders_house + ', '
                        + 'корпус ' + this.orderInfo[0].orders_corps + ', '
                        + 'кв ' + this.orderInfo[0].orders_apart
                }

                let data = {
                    id: this.orderInfo[0].orders_id,
                    name: this.orderInfo[0].orders_name,
                    tel: this.orderInfo[0].orders_tel,
                    email: this.orderInfo[0].orders_email,
                    adres: address,
                    del: deliveryName,
                    comment: this.orderInfo[0].orders_Comment,
                    korzina: this.orderProducts,
                    total_price: this.orderInfo[0].orders_totalPrice,
                    paymentName: this.orderInfo[0].orders_payment,
                    whereGet: this.orderInfo[0].orders_whereGet,
                    passport: this.orderInfo[0].orders_passportData,
                    status: this.orderInfo[0].orders_status,
                    data: this.orderInfo[0].created_at,
                }

                axios.post(`${this.URI}loadfile`, data)
                    .then(res => {
                        window.location.href = res.data;
                        this.$Progress.finish();
                    })
                    .catch(e => console.log(e))
            },
            changeStatus(status){
                this.$Progress.start();
                this.actvieStatus = status;

                axios.post(`${this.URI}ordstatus`, {id: this.$route.params.id, status: status})
                    .then(res => {
                        this.$Progress.finish();
                    })
                    .catch(e => console.log(e))
            }
        },
        computed: {
            returnOneProduct(){
                return this.$store.getters.oneOrder;
            },
            URI(){
                return this.$store.getters.URI;
            },
        },
        watch: {
            returnOneProduct(newValue){
                console.log(newValue)
                this.orderInfo = newValue[0];
                this.orderProducts = newValue[1];
                this.actvieStatus = this.orderInfo[0].orders_status;
                this.$Progress.finish();
            }
        }
    }
</script>

<style scoped>

</style>
