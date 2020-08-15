<template>
    <span class="back">
        <span @click="backTo()" v-bind:class="color === 'grey' ? color : color">
            {{word}}
        </span>
    </span>
</template>

<script>
    export default {
        name: "Back",
        props: ['color','word'],
        data: () => ({

        }),
        methods: {
            backTo(){
                this.$router.go(-1);
            }
        }
    }
</script>

<style scoped>

</style>
