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
        },
        watch: {
            $route(){
                console.log(1)
                //this.$store.dispatch('MakeCrumbs', this.$route.params);
            }
        }
    }
</script>

<style scoped>

</style>
