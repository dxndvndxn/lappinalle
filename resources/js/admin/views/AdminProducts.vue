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
            <div class="products-list" v-for="(prd, i) in newProduct">
                <div class="list-name">
                    <div class="admin-h3">
                        {{newId}}
                    </div>
                    <input type="text" class="input-pale-blu" @change="changeFreshProductTitle" v-model.trim="newNamePrdouct">
                </div>
                <div class="list-category">
                    <div class="wrap-list-input">
                        <input type="text" class="input-pale-blu"
                               :value="newAddedCategory"
                               disabled
                        >
                        <button class="btn-admin-arrow" @click="activeAddNew = !activeAddNew" v-bind:class="activeAddNew ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <AdminCrumbs v-if="activeAddNew" v-bind:lvl="3" @addNewCategoryForFresh="addNewCategoryForFresh" v-bind:crumbs="getCrumbs"/>
                </div>
                <div class="list-last">
                    <div class="list-artikul">
                        <input type="text" class="input-pale-blu" @change="changeFreshVendor" v-model.trim="newVendorProduct">
                    </div>
                    <div class="list-amount">
                        <input type="text" class="input-pale-blu" value="0" disabled>
                    </div>
                    <div class="list-set">
                        <router-link :to="{path: `card-${newId}`}"><img src="../../../img/admin-set.png" alt=""></router-link>
                        <img src="../../../img/krest-btn.png" alt="">
                    </div>
                </div>
            </div>










            <div class="products-list" v-for="(prd, i) in returnAllProducts">
                <div class="list-name">
                    <div class="admin-h3">
                        {{prd.product_id}}.
                    </div>
                    <input type="text" class="input-pale-blu" @change="changeProductTitle(prd.product_id, i)" ref="title" :value="prd.product_title">
                </div>




                <div class="list-category">
                    <div class="wrap-list-input" v-if="prd.sex_id || prd.categories_id || prd.departments_id">
                        <input type="text" class="input-pale-blu"
                               v-for="(current, i) in getCrumbs"
                               :value="current.sex_name + ' | ' + current.categories_name + ' | ' + current.departments_name"
                               v-if="(current.sex_id === prd.sex_id) && (current.categories_id === prd.categories_id) && (current.departments_id === prd.departments_id)" disabled>
                        <button class="btn-admin-arrow" @click="openCategory(prd.product_id, i)" v-bind:class="prd.active ? 'admin-btn-arrow' : 'admin-btn-arrow-pass'"></button>
                    </div>
                    <div class="wrap-list-input" v-else>
                        <input type="text" class="input-pale-blu"
                               ref="category"
                               :value="prd.name"
                               disabled>
                        <button class="btn-admin-arrow" @click="openCategory(prd.product_id, i)" v-bind:class="prd.active ? 'admin-btn-arrow' : 'admin-btn-arrow-pass'"></button>
                    </div>
                    <AdminCrumbs v-if="prd.active" v-bind:lvl="3" @addNewCategory="addNewCategory" v-bind:crumbs="getCrumbs"/>
                </div>




                <div class="list-last">
                    <div class="list-artikul">
                        <input type="text" class="input-pale-blu" @change="changeProductVendor(prd.product_id, i)" ref="vendor" :value=prd.product_vendor>
                    </div>
                    <div class="list-amount">
                        <input type="text" class="input-pale-blu" :value=prd.catalog_size_amount disabled>
                    </div>
                    <div class="list-set">
                        <router-link :to="{path: `card-${prd.product_id}`}"><img src="../../../img/admin-set.png" alt=""></router-link>
                        <img src="../../../img/krest-btn.png" alt="" @click="removeProduct(prd.product_id)">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
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

            // Новый товар категория
            newAddedCategory: null,

            // Новый товав название
            newNamePrdouct: null,

            // Новый товар артикул
            newVendorProduct: null,

            // Кол-во товара
            newCountProduct: null,

            // Ставим новый id для определения номера в таблице и для переходов
            newId: 0,

            // Чтобы определять активный продукт, который меняется
            activeProduct: null


        }),
        methods: {
           async addNewProduct(){

                if (this.newProduct.length) {
                    this.errorAdd = true;
                    return;
                }


                if (this.returnAllProducts.length !== 0) {
                    try {
                        this.newId = +this.returnAllProducts[0].product_id;
                    }catch (e) {
                        console.log(e)
                    }
                }

                let data = {
                    id: ++this.newId
                };

               await axios.post(`${this.URI}addprod`, data)
                    .then(res => {

                        console.log('Success created item with id ', this.newId)
                    }).catch(er => console.log(er))

                this.newProduct.push({id: null, name: null, category: null, vendor: null})

            },

            // @whatNeedToChange - имя поля, которое надо поменять
            // @newValue - новое значение
            async updateProduct(id, whatNeedToChange, newValue){
               let stringData = {
                   id: id,
                   [whatNeedToChange]: newValue
               };

               let formData = new FormData();
               formData.append('stringData',  JSON.stringify(stringData));

               await axios.post(`${this.URI}updprod`, formData)
                   .then(res => {

                       console.log('Success change', whatNeedToChange)
                   })
                   .catch(e => console.log(e))
            },

            // Меняем свежо добавленное название
            changeFreshProductTitle(){
                this.updateProduct(this.newId, 'name', this.newNamePrdouct);
            },

            // Меняем название товара
            // берем id и i массива title
            // подставляем i массив refs с инпутами названий
            changeProductTitle(id, i){
               let titles = this.$refs.title;
               this.updateProduct(id, 'name', titles[i].value);
            },

            // Меняем свежо добавленный артикул
            changeFreshVendor() {
                this.updateProduct(this.newId, 'vendor', this.newVendorProduct);
            },

            // Меняем уже добавленный артикул после обновления страницы
            changeProductVendor(id, i){
                let vendor = this.$refs.vendor;
                this.updateProduct(id, 'vendor', vendor[i].value);
            },

            // Определяем активный продукт
            openCategory(id, i){
               this.returnAllProducts.forEach(el => el.active = false);

               if (this.activeProduct !== null){

                   if (id === this.activeProduct.id) {
                       this.returnAllProducts[i].active = false;
                       return;
                   }
               }

                this.returnAllProducts[i].active = true;
                this.activeProduct = {
                    id, i
                }
            },

            addNewCategoryForFresh(data){
                this.getCrumbs.forEach(el => {
                    if ((el.sex_id === data.sexId) && (el.categories_id === data.categId) && (el.departments_id === data.departId)) {
                        this.newAddedCategory = el.sex_name + ' | ' + el.categories_name + ' | ' + el.departments_name;
                    }
                });
                this.updateProduct(this.newId, 'category', {sexId: data.sexId, categId: data.categId, departId: data.departId});
            },

            addNewCategory(data){
               // Если input категории не заполнено
                this.getCrumbs.forEach(el => {
                    if ((el.sex_id === data.sexId) && (el.categories_id === data.categId) && (el.departments_id === data.departId)) {
                        this.returnAllProducts[this.activeProduct.i].name = el.sex_name + ' | ' + el.categories_name + ' | ' + el.departments_name;
                    }
                });

                // Если input категории заполненеы, меняем на новые
                this.returnAllProducts[this.activeProduct.i].sex_id = data.sexId;
                this.returnAllProducts[this.activeProduct.i].categories_id = data.categId;
                this.returnAllProducts[this.activeProduct.i].departments_id = data.departId;

                // Отправляем на апдейет
                this.updateProduct(this.activeProduct.id, 'category', {sexId: data.sexId, categId: data.categId, departId: data.departId});
            },
            removeProduct(id){
                this.$Progress.start();
               axios.post(`${this.URI}delprod`, {id})
                   .then(res => {
                       console.log(res.data);
                       this.$Progress.start();
                       this.$store.dispatch('AdminGetAllPrducts');
                   })
                   .catch(e => console.log(e))
            }
        },
        created() {
            this.$Progress.start();
            this.$store.dispatch('AdminGetAllPrducts');

            if (this.getCrumbs === null) this.$store.dispatch('getMenuData');

        },
        computed: {
            returnAllProducts(){
                if (this.$store.getters.adminProducts !== null) {
                    this.$Progress.finish();
                    return this.$store.getters.adminProducts;
                }
            },
            getCrumbs(){
                return this.$store.getters.adminRawMenu;
            },
            URI(){
                return this.$store.getters.URI;
            }
        }
    }
</script>

<style scoped>

</style>
