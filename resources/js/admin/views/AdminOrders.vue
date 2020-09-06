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
            <div class="orders-list" v-for="(order, i) in GetOrders">
                <div class="list-cell">
                    <div class="admin-h3">
                        {{order[0]}}
                    </div>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" :value="order[1]" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" :value="order[2]" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" :value="order[3]" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" :value="order[0]" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" :value="order[4]" disabled>
                </div>
                <div class="list-cell">
                    <input type="text" class="input-pale-blu" :value="order[5]" disabled>
                    <router-link :to="{path: `order-${order[0]}`}"><img @click="editOrder()" src="../../../img/admin-set.png" alt=""></router-link>
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
        data: () => ({

        }),
        methods: {
            editOrder(){

            }
        },
        mounted() {
            this.$store.dispatch('GetAllOrders');
        },
        computed: {
            GetOrders(){
                return this.$store.getters.GetAllOrders;
            }
        }
    }
</script>

<style scoped>

</style>
