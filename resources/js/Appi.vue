<template>
    <div :id="'app'">
        <component :is='layout'>
            <router-view></router-view>
        </component>
    </div>
</template>

<script>
    import MainLayout from "./layouts/MainLayout";
    import AdminLayout from "./admin/AdminLayout";
    import LoginAdminLayout from "./admin/LoginAdminLayout";
    export default {
        name: "Appi",
        components: {
            MainLayout, AdminLayout, LoginAdminLayout
        },
        computed:{
            layout(){
                return this.$route.meta.layout + 'Layout'
            }
        },
        watch: {
            $route(to, from){
                if (to.name === 'gender' || from.name === 'category') {
                    this.$store.dispatch('backToCategory', {gen: this.$route.params.gender})
                }
                if (to.name === 'category' || to.name === 'department' || to.name === 'item') {
                    this.$store.dispatch('showDepartments', {categoryAlias: this.$route.params.category, gen: this.$route.params.gender});
                }
            },
            layout(value){
                return value;

            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
