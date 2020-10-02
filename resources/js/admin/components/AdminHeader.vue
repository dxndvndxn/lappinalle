<template>
    <div class="header-admin">
        <div class="header-admin-wrap">
            <div class="admin-logo">
                Панель администратора
            </div>
            <router-link :to="{name: 'Home'}"><img src="../../../img/logo-admin.png" class="admin-img-logo" alt=""></router-link>
            <div></div>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>

<script>
    export default {
        name: "AdminHeader"
    }
</script>

<style scoped>

</style>
