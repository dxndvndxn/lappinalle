<template>
    <div class="admin-main">
        <header>
            <AdminHeader/>
        </header>
        <div class="main-view">
            <aside>
                <AdminSidebar/>
            </aside>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import AdminHeader from "./components/AdminHeader";
    import AdminSidebar from "./components/AdminSidebar";
    export default {
        name: "AdminLayout",
        components: {AdminSidebar, AdminHeader}
    }
</script>

<style lang="scss" scoped>
    html,body{
        height: 100%;
        #app{
            height: 100%;
            >div{
                height: 100%
            }
        }
    }
</style>
