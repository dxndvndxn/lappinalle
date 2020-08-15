<template>
    <span class="back">
        <span v-if="getBackPage !== null">
            <router-link :to="getBackPage" v-bind:class="color === 'grey' ? color : color">Назад</router-link>
        </span>
        <span v-else></span>
    </span>
</template>

<script>
    export default {
        name: "Back",
        props: ['color'],
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
