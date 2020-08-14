<template>
    <span class="back">
        <router-link :to="getBackPage">Назад</router-link>
    </span>
</template>

<script>
    export default {
        name: "Back",
        data: () => ({

        }),
        computed: {
            getBackPage(){
                return this.$store.getters.backPage;
            }
        }
    }
</script>

<style scoped>

</style>
