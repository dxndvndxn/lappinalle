<template>
    <div class="catalog-items">
        <div class="item" v-for="(item, i) in catalogData">
            <router-link :to="{name: 'item', params: {number: item.product_id }}"><img v-bind:src="item.product_img" alt=""></router-link>
            <div class="item-title">
                {{item.product_title}}
            </div>
            <div class="item-price" v-if="item.product_sale !== null">
                <span class="through-line">{{item.product_price}}</span> <span class="sale-price">{{item.product_price - ((item.product_sale / 100  ) * item.product_price)}} &#8381;</span>
            </div>
            <div v-else class="item-price">
                {{item.product_price }} &#8381;
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CatalogCell",
        props: ['catalogData'],
        data: () => ({

        })
    }
</script>

<style scoped>

</style>
