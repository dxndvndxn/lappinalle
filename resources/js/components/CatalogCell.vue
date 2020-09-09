<template>
    <div class="catalog-items" v-if="total">
        <div class="item" v-for="(item, i) in catalogData">
            <router-link :to="{path: `item-${item.product_id}`}" :append="true"><img v-bind:src="item.product_img.split(',')[0]" alt=""></router-link>
            <div class="item-title">
                {{item.product_title}}
            </div>
            <div class="item-price" v-if="item.product_old_price !== null">
                <span class="through-line">{{item.product_old_price}} &#8364;</span> <span class="sale-price">{{item.product_price}} &#8364;</span>
            </div>
            <div v-else class="item-price">
                {{item.product_price }} &#8364;
            </div>
        </div>
    </div>
    <p v-else class="catalog-error">
       По вашему запросу ничего не найдено.
    </p>
</template>

<script>
    export default {
        name: "CatalogCell",
        props: ['catalogData','total'],
        data: () => ({

        }),
        watch:{
            catalogData(val){
                this.CatalogData = val;
            }
        }
    }
</script>

<style scoped>

</style>
