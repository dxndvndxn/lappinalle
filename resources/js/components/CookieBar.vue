<template>
    <div class="cookie-bar" v-if="!Cookie">
        <p>
            Мы используем файлы cookie, чтобы вам было удобнее пользоваться нашим сайтом. Нажимая кнопку ОК, вы даете согласие на использование файлов cookie.
        </p>
        <button @click="CloseCookie" class="btn">Ок</button>
    </div>
</template>

<script>
    export default {
        name: "CoockieBar",
        methods: {
            CloseCookie(){
                this.$store.dispatch('CloseCookie')
            }
        },
        computed: {
            Cookie(){
                return this.$store.getters.cookie;
            }
        }

    }
</script>

<style scoped>

</style>
