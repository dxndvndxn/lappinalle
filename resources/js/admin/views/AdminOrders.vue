<template>
    <div class="admin-orders">
        <AdminTopSide v-bind:H="'Заказы'" v-bind:btn="false"/>
        <div class="orders">
            <div class="orders-list">
                <div class="list-cell">
                    <h1 class="admin-h3">
                        &#8470;
                    </h1>
                </div>
                <div class="list-cell">
                    <h1 class="admin-h3">ФИО</h1>
                </div>
                <div class="list-cell">
                    <h1 class="admin-h3">Телефон</h1>
                </div>
                <div class="list-cell">
                    <h1 class="admin-h3">E-mail</h1>
                </div>
                <div class="list-cell">
                    <h1 class="admin-h3">ID</h1>
                </div>
                <div class="list-cell">
                    <h1 class="admin-h3">Дата/время</h1>
                </div>
                <div class="list-cell">
                    <h1 class="admin-h3">Статус</h1>
                </div>
            </div>
            <div class="orders-list">
                <div class="list-cell">
                    <div class="admin-h3">
                        1.
                    </div>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="Иван Иванович Иванов" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="89111234567" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="ivanIvanov@yandex.ru" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="1234" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="21.08.2020  21:40" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="В обработке" disabled>
                    <router-link :to="{path: `order-1`}"><img @click="editOrder()" src="../../../img/admin-set.png" alt=""></router-link>
                </div>
            </div>
            <div class="orders-list">
                <div class="list-cell">
                    <div class="admin-h3">
                        1.
                    </div>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="Иван Иванович Иванов" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="89111234567" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="ivanIvanov@yandex.ru" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="1234" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="21.08.2020  21:40" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" value="В обработке" disabled>
                    <router-link :to="{path: `order-1`}"><img @click="editOrder()" src="../../../img/admin-set.png" alt=""></router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "AdminOrders",
        components: {AdminTopSide},
        methods: {
            editOrder(){

            }
        }
    }
</script>

<style scoped>

</style>
