<template>
    <div class="admin-categories">
        <div class="admin-categories-list">
            <h1 class="admin-h1">Категории</h1>
            <ul class="admin-menu-gender">
                <li v-for="(categ, gender, i) in menu">
                    <input type="text" class="input-pale-blu width-300" v-model.trim="gender" @focus="focusAlias(menu[gender].dataForChangeMenu.menu_alias, menuAdmin[gender].dataForChangeMenu.menu_sex, 'sex', null, null, null)" @change="changeMenuItemName(gender, 1, 'sex', 'sex_id', 'sex_name')">
                    <button @click="clickGen(gender)" class="btn-admin-arrow" v-bind:class="menu[gender].activeGen ? 'admin-btn-arrow' : 'admin-btn-arrow-pass'">
                    </button>
                    <ul class="admin-menu-category">
<!--                        Если категорий вообще не существует-->
                        <button class="admin-btn-add width-300" v-if="menu[gender].activeGen && Object.keys(menu[gender]).length === 2" @click="addNewLavel('newcat', menu[gender].dataForChangeMenu.menu_sex, null)">
                            Добавить раздел 2 уровня <img src="../../../img/krest-btn.png">
                        </button>

                        <li v-for="(depart, cat, c) in categ" v-if="menu[gender].activeGen && cat !== 'activeGen' && cat !== 'dataForChangeMenu'">
                            <input type="text" class="input-pale-blu width-300" v-model.trim="cat" @focus="focusAlias(menu[gender][cat][0].categories_alias, depart[0].categories_id, 'categories', menuAdmin[gender].dataForChangeMenu.menu_sex, null, depart[0].menu_id)" @change="changeMenuItemName(cat, 2, 'categories', 'categories_id', 'categories_name')">
                            <button class="btn-admin-arrow width-300" @click="clickCateg(gender, cat)" v-bind:class="menu[gender][cat][0].activeCateg ? 'admin-btn-arrow' : 'admin-btn-arrow-pass'"></button>
                            <!--                                Если подкатегорий вообще не существует-->
                            <button class="admin-btn-add width-300 btn-add-3-lvl" v-if="depart[0].activeCateg && depart[0].department == null && depart.length === 1" @click="addNewLavel('newdep', menu[gender].dataForChangeMenu.menu_sex, depart[0].categories_id)">
                                Добавить раздел 3 уровня <img src="../../../img/krest-btn.png">
                            </button>
                            <ul class="admin-menu-depart">

                                <li v-for="(dep, t) in depart" v-if="dep.activeCateg && dep.department !== null">
                                    <input type="text" class="input-pale-blu width-300" @focus="focusAlias(dep.departments_alias, dep.departments_id, 'departments', menuAdmin[gender].dataForChangeMenu.menu_sex, depart[0].categories_id, dep.menu_id)" v-model.trim="dep.department" @change="changeMenuItemName(dep.department, 3, 'departments', 'departments_id', 'departments_name')">
                                    <button class="admin-btn-add width-300" @click="addNewLavel('newdep', menu[gender].dataForChangeMenu.menu_sex, dep.categories_id)" v-if="depart.length - 1 === t">
                                        Добавить раздел 3 уровня <img src="../../../img/krest-btn.png">
                                    </button>
                                </li>
                                <button class="admin-btn-add width-300 btn-add-2-lvl" v-if="Object.keys(menu[gender]).length - 1 === c" @click="addNewLavel('newcat', menu[gender].dataForChangeMenu.menu_sex, null)">
                                    Добавить раздел 2 уровня <img src="../../../img/krest-btn.png">
                                </button>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <button class="admin-btn-add width-300" @click="addNewLavel('newsex', null, null)">Добавить раздел 1 уровня <img src="../../../img/krest-btn.png"></button>
        </div>
        <div class="admin-categories-change width-300">
            <h1 class="admin-h1">Свойства раздела</h1>
            <label class="admin-h3">Алиас</label>
            <div class="wrap-inp-btn">
                <input type="text" class="input-transp input-transp-p" @change="changeAlias()" v-model.trim="changedAlias">
            </div>
            <div class="admin-categories-fields width-300">
                <div class="wrap-admin-choose-category" v-if="showChooseCategory">
                    <label class="admin-h3">Категория</label>
                    <div class="wrap-inp-btn">
                        <input type="text" class="input-transp input-transp-p"
                               v-for="(current, i) in getCrumbs"
                               :value="current.sex_name + (current.categories_name !== null ? ' | ' + current.categories_name : '')"
                               v-if="current.sex_id === sexId && current.categories_id === categId && current.departments_id === null"
                               disabled
                        >
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <AdminCrumbs v-if="activeBtn" @addNewCategory="changeCategory" v-bind:lvl="lvl" v-bind:crumbs="getCrumbs"/>
                </div>
                <button class="admin-btn-delete">удалить раздел</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import AdminCrumbs from "../components/AdminCrumbs";
    export default {
        name: "AdminCategories",
        components: {
            AdminCrumbs
        },
        data: () => ({
            activeBtn: true,

            // Показываем прокрутку для выбора гендера, категорий
            showChooseCategory: false,

            // Меняем алиас
            changedAlias: null,

            // Фокусированный id раздел 1 уровня
            activeFocusId: null,

            // Названия раздела, которой хотим по менять типа гендер, категория или подкатегория
            activeNameOfWhatSectionNeedChange: null,
            menu: null,

            // Какой список категорий показывать
            lvl: null,

            // Для показывания списка строки в какой секции находится категории
            sexId: null,
            categId: null,

            // id в таблице меню
            menuId: null
        }),
        created(){
             this.$store.dispatch('getMenuData');
        },
        methods: {
            changeCategory(chozenCategory){
                this.$Progress.start();
                let data = {
                    changePosition: true,
                    sexId: chozenCategory.sexId,
                    categId: chozenCategory.categId,
                    menuId: this.menuId
                }

                axios.post(`${this.URI}updmenu`, data)
                    .then(res => {
                        console.log(res.data);
                        this.$store.dispatch('getMenuData');
                        this.$Progress.finish();
                    })
                    .catch(e => console.log(e))
            },
            // Меняем алиас
            changeAlias(){
                this.$Progress.start();
                let data = {
                    alias: true,
                    section: this.activeNameOfWhatSectionNeedChange,
                    sectionId: this.activeFocusId,
                    newAlias: this.changedAlias,
                }

                axios.post(`${this.URI}updmenu`, data)
                    .then(res => {
                        console.log(res.data);
                        this.$store.dispatch('getMenuData');
                        this.$Progress.finish();
                    })
                    .catch(e => console.log(e))
            },

            // Делаем фокус на input меню
            // this.activeFocusId активный id сфокусированного инпута
            focusAlias(alias, activeId, nameOfSection, sexId, categId, menuId){
                this.changedAlias = alias;
                this.activeFocusId = activeId;
                this.activeNameOfWhatSectionNeedChange = nameOfSection;
                this.sexId = sexId
                this.categId = categId
                this.menuId = menuId
                this.showChooseCategory = this.activeNameOfWhatSectionNeedChange === 'categories' || this.activeNameOfWhatSectionNeedChange === 'departments';


                if (this.activeNameOfWhatSectionNeedChange === 'categories') this.lvl = 1
                if (this.activeNameOfWhatSectionNeedChange === 'departments') this.lvl = 2
            },

            // Добавляем новый раздел
            addNewLavel(apiWhere, sexId, catId){
                this.$Progress.start();
                axios.post(`${this.URI}${apiWhere}`, {sexId, catId})
                .then(res => {
                    console.log(res.data);
                    this.$store.dispatch('getMenuData');
                    this.$Progress.finish();
                })
                .catch(e => console.log(e))
            },

            // Меняем названия меню категорий
            changeMenuItemName(newGender, lvl, tableName, tableNameId, tableFieldName){

                this.$Progress.start();
                let data = {
                    lvl: lvl,
                    newGenderName: newGender,
                    menuItemId: this.activeFocusId,
                    tableName: tableName,
                    tableNameId: tableNameId,
                    tableFieldName: tableFieldName

                }

                axios.post(`${this.URI}updmenu`, data)
                .then(res => {
                    this.$store.dispatch('getMenuData');
                    this.$Progress.finish();
                })
                .catch(e => console.log(e))
            },
            clickGen(gender){
                this.menu[gender].activeGen = !this.menu[gender].activeGen;
            },
            clickCateg(gen, cat){
                for (let i of this.menu[gen][cat]){
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
