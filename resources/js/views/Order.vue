<template>
    <div class="order container">
        <div class="order-header h1-m50">
            <Back v-bind:color="'grey'" v-bind:word="'Корзина'"/><h1 class="h1-bold-grey">контактная информация</h1>
        </div>
        <form class="order-from" @submit.prevent="toDeliveryChoose">
            <input type="text" class="classic-input" v-model.trim="name" placeholder="Имя" autocomplete="on">
            <input type="email" class="classic-input" v-model.trim="email" placeholder="E-mail" autocomplete="on">
            <input type="tel" class="classic-input" v-model.trim="tel" placeholder="Телефон">
            <button class="classic-btn-sz btn">следующий шаг</button>
        </form>
    </div>
</template>
s
<script>
    import Back from "../components/Back";
    export default {
        name: "Order",
        components: {Back},
        data: () => ({
            name: null,
            email: null,
            tel: null,
        }),
        methods: {
            toDeliveryChoose(){
                this.$router.push({name: 'chooseDelivery'})
            }
        }
    }
</script>

<style scoped>

</style>
