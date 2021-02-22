<template>
    <div class="pay-success container">
        <h1 class="h1-m50">
            <span class="pay-success-order">
                &#8470; заказа:
            </span>
            <span class="pay-success-number">
                {{payID}}
            </span>
        </h1>
        <p class="pay-success-text">
            Заказ успешно оформлен. Детали заказа отправлены на указанный E-mail.
        </p>
    </div>
</template>

<script>
    export default {
        name: "PaySuccess",
        data: () => ({

        }),
        metaInfo(){
            return {
                title: "Успешная оплата"
            }
        },
        created() {
            this.$Progress.start();
            this.$store.dispatch('ChangeStatusOrder');
        },
        computed: {
            payID(){
                if (this.$store.getters.payId !== false) {
                    this.$Progress.finish();
                    return this.$store.getters.payId;
                }
            }
        },
        beforeDestroy(){
            this.$store.dispatch('killPaySuccess');
        },
    }
</script>

<style scoped>

</style>
