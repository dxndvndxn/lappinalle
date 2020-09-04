<template>
    <div class="user-card">
        <AdminTopSide v-bind:H="'карточка пользователя'" v-bind:btn="true"/>
        <div class="wrap-admin-order-card">
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">ФИО</label>
                    <input type="text" class="input-pale-blu" :value="'Иван Иванович Иванов'" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Телефон</label>
                    <input type="text" class="input-pale-blu" :value="'89111234567'" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">E-mail</label>
                    <input type="text" class="input-pale-blu" :value="'ivanovIvan@yandex.ru'" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Адрес</label>
                    <input type="text" class="input-pale-blu" :value="'СПБ, ул. Долгоозерная, дом 1, квартира 458'" disabled>
                </div>
            </div>
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Корзина</label>
                    <div class="wrap-admin-order">
                        <input type="text" class="input-pale-blu" :value="'Комбинезон LAPPINALLE, 46 размер'" disabled>
                        <router-link :to="{path: `order-1`}"><img @click="editOrder()" src="../../../img/admin-set.png" alt=""></router-link>
                    </div>
                    <div class="wrap-admin-order">
                        <input type="text" class="input-pale-blu" :value="'Комбинезон LAPPINALLE, 46 размер'" disabled>
                        <router-link :to="{path: `order-1`}"><img @click="editOrder()" src="../../../img/admin-set.png" alt=""></router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "UserCard",
        components: {AdminTopSide}
    }
</script>

<style scoped>

</style>
