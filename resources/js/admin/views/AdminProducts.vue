<template>
    <div class="admin-products">
        <div class="admin-products-header">
            <div class="wrap-admin-h">
                <h1 class="admin-h1">Товары</h1>
                <button class="admin-btn-add">
                    Добавить товар <img src="../../../img/krest-btn.png" alt="">
                </button>
            </div>
            <button class="admin-btn-complete">Сохранить изменения</button>
            <div class="admin-products-search">
                <input type="text" class="input-transp input-transp-p" v-model="searched" placeholder="поиск">
                <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                <button class="btn-admin-purpp"><img src="../../../img/Lupa.png" alt=""></button>
            </div>
        </div>
        <div class="admin-products-list">
            <div class="products-list">
                <div class="list-name">
                    <div class="admin-h3">
                        &#8470;
                    </div>
                    <h1 class="admin-h3">Название</h1>
                </div>
                <div class="list-category">
                    <h1 class="admin-h3">Категория</h1>
                </div>
                <div class="list-last">
                    <div class="list-artikul">
                        <h1 class="admin-h3">Артикул</h1>
                    </div>
                    <div class="list-amount">
                        <h1 class="admin-h3">Кол-во на складе</h1>
                    </div>
                </div>
            </div>
            <div class="products-list">
                <div class="list-name">
                    <div class="admin-h3">
                        1.
                    </div>
                    <input type="text" class="input-pale-blu" value="Комбинезон LAPPINALLE">
                </div>
                <div class="list-category">
                    <input type="text" class="input-pale-blu" value="Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ">
                </div>
                <div class="list-last">
                    <div class="list-artikul">
                        <input type="text" class="input-pale-blu" value="12345">
                    </div>
                    <div class="list-amount">
                        <input type="text" class="input-pale-blu" value="17">
                    </div>
                    <div class="list-set">
                        <router-link :to="{path: 'card-1'}"><img src="../../../img/admin-set.png" alt=""></router-link>
                        <img src="../../../img/krest-btn.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AdminProducts",
        data: () => ({
            activeBtn: false,
            searched: null,

        })
    }
</script>

<style scoped>

</style>
