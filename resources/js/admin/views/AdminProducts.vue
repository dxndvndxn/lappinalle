<template>
    <div class="admin-products">
        <div class="admin-products-header">
            <div class="wrap-admin-h">
                <h1 class="admin-h1">Товары</h1>
                <div class="wrap-btn-add">
                    <button class="admin-btn-add" @click="addNewProduct()">
                        Добавить товар <img src="../../../img/krest-btn.png" alt="">
                    </button>
                    <small v-if="errorAdd" class="small-invalid">Отредактируйте уже добавленный товар.</small>
                </div>
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
                    <h1 class="admin-h3">ФИО</h1>
                </div>
                <div class="list-category">
                    <h1 class="admin-h3">Телефон</h1>
                </div>
                <div class="list-last">
                    <div class="list-artikul">
                        <h1 class="admin-h3">Артикул</h1>
                    </div>
                    <div class="list-amount">
                        <h1 class="admin-h3">ID</h1>
                    </div>
                </div>
            </div>
            <div class="products-list" v-for="(prd, i) in newProduct">
                <div class="list-name">
                    <div class="admin-h3">
                        {{Object.keys(returnAllProducts).length == 0 ? 1 : Object.keys(returnAllProducts).length + 1}}
                    </div>
                    <input type="text" class="input-pale-blu" @change="newProduct[0].name = newNamePrdouct" v-model.trim="newNamePrdouct">
                </div>
                <div class="list-category">
                    <div class="wrap-list-input">
                        <input type="text" class="input-pale-blu"
                               :value="newAddedCategory"
                               disabled
                        >
                        <button class="btn-admin-arrow" @click="activeAddNew = !activeAddNew" v-bind:class="activeAddNew ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <AdminCrumbs v-if="activeAddNew" v-bind:lvl="3" @addNewCategory="addNewCategory" v-bind:crumbs="getCrumbs"/>
                </div>
                <div class="list-last">
                    <div class="list-artikul">
                        <input type="text" class="input-pale-blu" @change="newProduct[0].vendor = newVendorProduct" v-model.trim="newVendorProduct">
                    </div>
                    <div class="list-amount">
                        <input type="text" class="input-pale-blu" value="0" disabled>
                    </div>
                    <div class="list-set">
                        <router-link :to="{path: `card-${Object.keys(returnAllProducts).length === 0 ? 1 : Object.keys(returnAllProducts).length + 1}`}"><img @click="addNewProductData(Object.keys(returnAllProducts).length + 1)" src="../../../img/admin-set.png" alt=""></router-link>
                        <img src="../../../img/krest-btn.png" alt="">
                    </div>
                </div>
            </div>
            <div class="products-list" v-for="(prd, i) in returnAllProducts">
                <div class="list-name">
                    <div class="admin-h3">
                        {{prd.product_id}}.
                    </div>
                    <input type="text" class="input-pale-blu" :value=prd.product_title>
                </div>
                <div class="list-category">
                    <div class="wrap-list-input">
                        <input type="text" class="input-pale-blu"
                               v-for="(current, i) in getCrumbs"
                               :value="current.sex_name + ' | ' + current.categories_name + ' | ' + current.departments_name"
                               v-if="changedCategory | ((current.sex_id === prd.sex_id) && (current.categories_id === prd.categories_id) && (current.departments_id === prd.departments_id))" disabled>
                        <button class="btn-admin-arrow" @click="prd.active = !prd.active" v-bind:class="prd.active ? 'admin-btn-arrow' : 'admin-btn-arrow-pass'"></button>
                    </div>
                    <AdminCrumbs v-if="prd.active" v-bind:lvl="3" @addNewCategory="addNewCategory" v-bind:crumbs="getCrumbs"/>
                </div>
                <div class="list-last">
                    <div class="list-artikul">
                        <input type="text" class="input-pale-blu" :value=prd.product_vendor>
                    </div>
                    <div class="list-amount">
                        <input type="text" class="input-pale-blu" :value=prd.catalog_size_amount disabled>
                    </div>
                    <div class="list-set">
                        <router-link :to="{path: `card-${prd.product_id}`}"><img src="../../../img/admin-set.png" alt=""></router-link>
                        <img src="../../../img/krest-btn.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import AdminCrumbs from "../components/AdminCrumbs";
    export default {
        name: "AdminProducts",
        components: {AdminCrumbs},
        data: () => ({
            searched: null,
            errorAdd: false,
            activeBtn: null,

            // Переменная для стрелки, где добавить новый товар
            activeAddNew: false,

            // Контейнер для нового товара
            newProduct: [],

            // Если поменяли категорию у товара
            changedCategory: null,

            // Новый товар категория
            newAddedCategory: null,

            // Новый товав название
            newNamePrdouct: null,

            // Новый товар артикул
            newVendorProduct: null,

            // Кол-во товара
            newCountProduct: null

        }),
        methods: {
            addNewProduct(){

                if (Object.keys(this.newProduct).length) {
                    this.errorAdd = true;
                    return;
                }

                this.newProduct.push({id: null, name: null, category: null, vendor: null})
            },
            addNewCategory(data){
                this.newAddedCategory = '';

                this.getCrumbs.forEach(el => {
                    if ((el.sex_id === data.sexId) && (el.categories_id === data.categId) && (el.departments_id === data.departId)) {
                        this.newAddedCategory = el.sex_name + ' | ' + el.departments_name + ' | ' + el.categories_name;
                    }
                });

                this.newProduct[0].category = data;
            },
            addNewProductData(newId){
                this.newProduct[0].id = newId === 0 ? 1 : newId;
                this.$store.dispatch('DataAdminFromProducts', this.newProduct);
            }
        },
        created() {
            this.$Progress.start();
            this.$store.dispatch('AdminGetAllPrducts');

            if (this.getCrumbs === null) this.$store.dispatch('getMenuData');

        },
        computed: {
            returnAllProducts(){
                this.$Progress.finish();
                return this.$store.getters.adminProducts;
            },
            getCrumbs(){
                return this.$store.getters.adminRawMenu;
            }
        }
    }
</script>

<style scoped>

</style>
