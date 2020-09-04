<template>
    <div class="admin-users">
        <AdminTopSide v-bind:H="'Пользователи'" v-bind:btn="false"/>
        <div class="admin-users-list">
            <div class="list-cell">
                <h1 class="admin-h3">
                    ID
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
        </div>
        <div class="admin-users-list">
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
                <router-link :to="{path: `user-1`}"><img @click="editUser()" src="../../../img/admin-set.png" alt=""></router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "AdminUsers",
        components: {AdminTopSide},
        methods: {
            editUser(){

            }
        }
    }
</script>

<style scoped>

</style>
