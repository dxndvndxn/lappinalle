<template>
    <div>
        <div class="bread">
            <Breadcrumbs v-bind:genderMenu="genderMenu" v-bind:catNdepart="categNdepartsMenu" />
        </div>
    </div>
</template>

<script>
    import Breadcrumbs from "../components/Breadcrumbs";
    export default {
        name: "Catalog",
        components: {
            Breadcrumbs
        },
        computed: {
            genderMenu(){
                return this.$store.getters.topMenu;
            },
            categNdepartsMenu(){
                return this.$store.getters.lastMenu;
            }
        }
    }
</script>

<style scoped>

</style>
