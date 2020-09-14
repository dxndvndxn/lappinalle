<template>
    <div class="user-card">
        <AdminTopSide v-bind:H="'карточка пользователя'" v-bind:btn="true"/>
        <div class="wrap-admin-order-card">
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">ФИО</label>
                    <input type="text" class="input-pale-blu" :value="name" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Телефон</label>
                    <input type="text" class="input-pale-blu" :value="tel" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">E-mail</label>
                    <input type="text" class="input-pale-blu" :value="email" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Адрес</label>
                    <input type="text" class="input-pale-blu" :value="this.adress" disabled>
                </div>
            </div>
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp width-300" v-if="ordersUser !== null">
                    <label class="admin-h3">История заказов</label>
                    <div class="wrap-admin-order" v-for="(order, i) in ordersUser">
                        <input type="text" class="input-pale-blu" :value="'Заказ №' + order" disabled>
                        <router-link :to="{path: `order-${order}`}"><img src="../../../img/admin-set.png" alt=""></router-link>
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
        components: {AdminTopSide},
        data: () => ({
           adress: '',
           name: null,
           tel: null,
           email: null,
           ordersUser: null
        }),
        created() {
            this.$store.dispatch('GetOneUser', {id: this.$route.params.id})
        },
        computed: {
            returnOneUser(){
                return this.$store.getters.GetOneUser;
            }
        },
        watch: {
            returnOneUser(newValue){
                // Заполняем адресс
                this.adress += newValue[0][3] !== null ? newValue[0][3] + ', ' : '';
                this.adress += newValue[0][4] !== null ? newValue[0][4] + ', ' : '';
                this.adress += newValue[0][5] !== null ? 'дом ' + newValue[0][5] + ', ' : '';
                this.adress += newValue[0][6] !== null ? 'корпус ' + newValue[0][6] + ', ' : '';
                this.adress += newValue[0][7] !== null ? 'кв ' + newValue[0][7] + ', ' : '';
                this.adress += newValue[0][8] !== null ? 'почтовый индекс ' + newValue[0][8] : '';

                // Инфо юзера
                this.name = newValue[0][0];
                this.email = newValue[0][1];
                this.tel = newValue[0][2];

                // Корзина
                this.ordersUser= newValue[1];
            }
        }
    }
</script>

<style scoped>

</style>
