<template>
    <div class="admin-categories">
        <div class="admin-categories-list">
            <h1 class="admin-h1">Категории</h1>
            <ul class="admin-menu-gender">
                <li v-for="(categ, gender, i) in menuAdmin">
                    <span class="input-pale-blu width-300">{{gender}}<button @click="clickGen(gender)" class="btn-admin-arrow" v-bind:class="menuAdmin[gender].activeGen ? 'admin-btn-arrow' : 'admin-btn-arrow-pass'"></button></span>
                    <ul class="admin-menu-category">
                        <li v-for="(depart ,cat, c) in categ" v-if="menuAdmin[gender].activeGen">
                            <span class="input-pale-blu width-300"  v-if="cat !== 'activeGen'">
                                {{cat}}<button class="btn-admin-arrow width-300"  @click="clickCateg(gender, cat)" v-bind:class="menuAdmin[gender][cat][0].activeCateg ? 'admin-btn-arrow' : 'admin-btn-arrow-pass'"></button>
                            </span>
                            <button class="admin-btn-add width-300" v-if="Object.keys(menuAdmin[gender]).length - 1 === c">
                                Добавить раздел 2 уровня <img src="../../../img/krest-btn.png">
                            </button>
                            <ul class="admin-menu-depart">
                                <li v-for="(dep, t) in depart" v-if="dep.activeCateg">
                                    <span class="input-pale-blu width-300">
                                        {{dep.department}}
                                    </span>
                                    <button class="admin-btn-add width-300" v-if="depart.length - 1 === t">
                                        Добавить раздел 3 уровня <img src="../../../img/krest-btn.png">
                                    </button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <button class="admin-btn-add width-300">Добавить раздел 1 уровня <img src="../../../img/krest-btn.png"></button>
        </div>
        <div class="admin-categories-change width-300">
            <h1 class="admin-h1">Свойства раздела</h1>
            <div class="admin-categories-fields width-300">

                <label class="admin-h3">Название</label>
                <input type="text" class="input-transp input-transp-p" value="Куркти">

                <label class="admin-h3">Категория</label>
                <div class="wrap-inp-btn">
                    <input type="text" class="input-transp input-transp-p" v-model="selected">
                    <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                </div>
                <ul class="selected-categories input-transp-p">
                    <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                </ul>
                <button class="admin-btn-complete">Сохранить изменения</button>
                <button class="admin-btn-delete">удалить раздел</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AdminCategories",
        data: () => ({
            clickedLvlOne: null,
            selected: 'Мальчики | Верхняя одежда ЗИМА/...',
            newSelected: null,
            activeBtn: true
        }),
        created(){
            if (!this.$store.getters.lastMenu.length && !this.$store.getters.topMenu.length) this.$store.dispatch('getMenuData');
        },
        methods: {
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
            lvlOne(){
                return this.$store.getters.topMenu;
            },
            lvlTwo(){
                return this.$store.getters.lastMenu;
            },
            menuAdmin(){
                return this.$store.getters.menuAdmin;
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
