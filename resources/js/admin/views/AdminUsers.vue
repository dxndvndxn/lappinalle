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
        <div class="admin-users-list" v-for="(user, i) in returnAllUsers">
            <div class="list-cell">
                <div class="admin-h3">
                    {{user[0]}}
                </div>
            </div>
            <div class="list-cell">
                <input type="text" class="input-pale-blu" :value="user[1]" disabled>
            </div>
            <div class="list-cell">
                <input type="text" class="input-pale-blu" :value="user[2]" disabled>
            </div>
            <div class="list-cell">
                <input type="text" class="input-pale-blu" :value="user[3]" disabled>
                <router-link :to="{path: `user-${user[0]}`}"><img src="../../../img/admin-set.png" alt=""></router-link>
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

        },
        created() {
          this.$store.dispatch('GetAllUsers');
        },
        computed: {
            returnAllUsers(){
                return this.$store.getters.GetAllUsers;
            }
        }
    }
</script>

<style scoped>

</style>
