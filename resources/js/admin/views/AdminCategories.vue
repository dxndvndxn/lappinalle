<template>
    <div class="admin-categories">
        <div class="admin-categories-list">
            <h1 class="admin-h1">Категории</h1>
            <ul class="admin-menu-gender">
                <li v-for="(categ, gender, i) in menuAdmin">
                    <input type="text" class="input-pale-blu width-300" :value="gender" @focus="focusAlias(menuAdmin[gender].dataForChangeMenu.menu_alias)" @change="changeGender(gender)">
                    <button @click="clickGen(gender)" class="btn-admin-arrow" v-bind:class="menuAdmin[gender].activeGen ? 'admin-btn-arrow' : 'admin-btn-arrow-pass'">
                    </button>
                    <ul class="admin-menu-category">
                        <li v-for="(depart, cat, c) in categ" v-if="menuAdmin[gender].activeGen && cat !== 'activeGen' && cat !== 'dataForChangeMenu'">
                            <input type="text" class="input-pale-blu width-300" :value="cat" @focus="focusAlias(menuAdmin[gender][cat][0].categories_alias)">
                            <button class="btn-admin-arrow width-300"  @click="clickCateg(gender, cat)" v-bind:class="menuAdmin[gender][cat][0].activeCateg ? 'admin-btn-arrow' : 'admin-btn-arrow-pass'"></button>
                            <button class="admin-btn-add width-300" v-if="Object.keys(menuAdmin[gender]).length - 1 === c">
                                Добавить раздел 2 уровня <img src="../../../img/krest-btn.png">
                            </button>
                            <ul class="admin-menu-depart">
                                <li v-for="(dep, t) in depart" v-if="dep.activeCateg && dep.department !== null">
                                    <input type="text" class="input-pale-blu width-300" @focus="focusAlias(dep.departments_alias)" :value="dep.department">
                                    <button class="admin-btn-add width-300" @click="addNewLavel" v-if="depart.length - 1 === t">
                                        Добавить раздел 3 уровня <img src="../../../img/krest-btn.png">
                                    </button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <button class="admin-btn-add width-300" @click="addNewLavel('newsex')">Добавить раздел 1 уровня <img src="../../../img/krest-btn.png"></button>
        </div>
        <div class="admin-categories-change width-300">
            <h1 class="admin-h1">Свойства раздела</h1>
            <label class="admin-h3">Алиас</label>
            <div class="wrap-inp-btn">
                <input type="text" class="input-transp input-transp-p" v-model.trim="changedAlias">
            </div>
            <div class="admin-categories-fields width-300">
                <div class="wrap-admin-choose-category" v-if="showChooseCategory">
                    <label class="admin-h3">Категория</label>
                    <div class="wrap-inp-btn">
                        <input type="text" class="input-transp input-transp-p" v-model="selected">
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <AdminCrumbs v-if="activeBtn" v-bind:lvl="'all'" v-bind:crumbs="getCrumbs"/>
                </div>
                <button class="admin-btn-delete">удалить раздел</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "AdminCategories",
        data: () => ({
            activeBtn: true,

            // Показываем прокрутку для выбора гендера, категорий
            showChooseCategory: false,

            // Меняем алиас
            changedAlias: null,

            menu: null
        }),
        created(){
             this.$store.dispatch('getMenuData');
        },
        methods: {
            focusAlias(alias){
                this.changedAlias = alias;
            },
            addNewLavel(apiWhere){
                axios.post(`${this.URI}${apiWhere}`)
                .then(res => {
                    console.log(res.data);
                    this.$store.dispatch('getMenuData');
                })
                .catch(e => console.log(e))
            },
            changeGender(gender){
                this.changedName = gender;
            },
            clickGen(gender){
                this.menuAdmin[gender].activeGen = !this.menuAdmin[gender].activeGen;
            },
            clickCateg(gen, cat){
                for (let i of this.menuAdmin[gen][cat]){
                    i.activeCateg = !i.activeCateg;
                }
            }
        },
        computed: {
            menuAdmin(){
                return this.$store.getters.menuAdmin;
            },
            getCrumbs(){
                return this.$store.getters.adminRawMenu;
            },
            URI(){
                return this.$store.getters.URI;
            }
        },
        watch: {
            menuAdmin(newValue){
                this.menu = newValue;
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
