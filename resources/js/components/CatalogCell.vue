<template>
    <div class="catalog-items">
        <div class="item" v-for="(item, i) in items">
            <router-link :to="item.link"><img v-bind:src="item.src" alt=""></router-link>
            <div class="item-title">
                {{item.name}}
            </div>
            <div class="item-price" v-if="item.sale !== null">
                <span class="through-line">{{item.price}}</span> <span class="sale-price">{{item.price - ((item.sale / 100  ) * item.price)}} &#8381;</span>
            </div>
            <div v-else class="item-price">
                {{item.price }} &#8381;
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CatalogCell",
        data: () => ({
            items: [
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png', link: 'malchiki/verhnjaodejda/kurtrko/item-1', sale: null},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png', link: 'malchiki/verhnjaodejda/kurtrko/item-1', sale: 20},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png', link: 'malchiki/verhnjaodejda/kurtrko/item-1', sale: null},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png', link: 'malchiki/verhnjaodejda/kurtrko/item-1', sale: null},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png', link: 'malchiki/verhnjaodejda/kurtrko/item-1', sale: null},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png', link: 'malchiki/verhnjaodejda/kurtrko/item-1', sale: null},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png', link: 'malchiki/verhnjaodejda/kurtrko/item-1', sale: null},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png', link: 'malchiki/verhnjaodejda/kurtrko/item-1', sale: null},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png', link: 'malchiki/verhnjaodejda/kurtrko/item-1', sale: 30},

            ],

        })
    }
</script>

<style scoped>

</style>
