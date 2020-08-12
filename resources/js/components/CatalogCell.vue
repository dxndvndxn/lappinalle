<template>
    <div class="catalog-items">
        <div class="item" v-for="(item, i) in items">
            <img v-bind:src="item.src" alt="">
            <div>
                {{item.name}}
            </div>
            <div>
                {{item.price}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CatalogCell",
        data: () => ({
            items: [
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png'},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png'},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png'},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png'},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png'},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png'},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png'},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png'},
                {name: "Комбинезоны", price: '5400', src: '../../img/item.png'},

            ],

        })
    }
</script>

<style scoped>

</style>
