<template>
    <div>
        <component :is='layout'>
            <router-view></router-view>
        </component>
    </div>
</template>

<script>
    import MainLayout from "./layouts/MainLayout";
    export default {
        name: "Appi",
        components: {
            MainLayout
        },
        computed:{
            layout(){
                return this.$route.meta.layout + 'Layout'
            }
        }
    }
</script>

<style scoped>

</style>
