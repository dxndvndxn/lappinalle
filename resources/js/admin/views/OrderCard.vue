<template>
    <div class="admin-order-card">
        <div class="warp-head-order-card">
            <AdminTopSide v-bind:H="'Подробности заказа'" v-bind:btn="true"/>
        </div>
        <div class="wrap-admin-order-card">
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">№ заказа</label>
                    <input type="text" class="input-pale-blu" :value="1" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">ФИО</label>
                    <input type="text" class="input-pale-blu" :value="'Иванов Иван Иванович'" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Телефон</label>
                    <input type="text" class="input-pale-blu" :value="'89111234567'" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">E-mail</label>
                    <input type="text" class="input-pale-blu" :value="'ivaivanov@yandex.ru'" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Дата и время</label>
                    <input type="text" class="input-pale-blu" :value="'21.08.2020  21:40'" disabled>
                </div>
            </div>
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Способ доставки</label>
                    <input type="text" class="input-pale-blu" :value="'СДЭК'" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Адрес доставки</label>
                    <input type="text" class="input-pale-blu" :value="'СПБ, ул. Долгоозёрная, дом 1, кв 458'" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Способ оплаты</label>
                    <input type="text" class="input-pale-blu" :value="'Сбербанк Онлайн'" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Статус заказа</label>
                    <div class="wrap-input">
                        <input type="text" class="input-transp input-transp-p" :value="actvieStatus.nameStatus" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <div type="text" class="input-transp input-transp-p" v-for="(st, i) in status" @click="actvieStatus = {idStatus: st.id, nameStatus: st.name}" v-if="!activeBtn">
                        {{st.name}}
                    </div>
                </div>
            </div>
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Корзина</label>
                    <div class="wrap-admin-order">
                        <input type="text" class="input-pale-blu" :value="'Комбинезон LAPPINALLE, 46 размер'" disabled>
                        <img src="../../../img/returnBack.png" alt="">
                    </div>
                    <div class="wrap-admin-order">
                        <input type="text" class="input-pale-blu" :value="'Комбинезон LAPPINALLE, 46 размер'" disabled>
                        <img src="../../../img/returnBack.png" alt="">
                    </div>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Стоимость с учётом доставки</label>
                    <input type="text" class="input-pale-blu" :value="'11800'" disabled>
                </div>
                <button class="admin-btn-add pdf width-300">
                    скачать накладную <img src="../../../img/pdf.png" alt="">
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "OrderCard",
        components: {AdminTopSide},
        data: () => ({
            activeBtn: true,
            status: [
                {
                    name: 'В обработке', id: 1
                },
                {
                    name: 'Подтверждён', id: 2
                },
                {
                    name: 'Отправлен', id: 3
                },
                {
                    name: 'Получен', id: 4
                },
                {
                    name: 'Возврат', id: 5
                }
            ],
            actvieStatus: {idStatus: 1, nameStatus: 'В обработке'}
        }),
        created() {
            this.$store.dispatch('GetOneOrder', {id: this.$route.params.id});
        }
    }
</script>

<style scoped>

</style>
