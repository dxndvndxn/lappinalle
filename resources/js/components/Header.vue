<template>
    <nav>
        <div class="menu-top">
            <ul class="grid-nav-top container">
                <li>
                    <form class="nav-search">
                        <div class="search">
                            <input type="search" id="search" placeholder="Поиск">
                            <label for="search"><img src="../../img/search.png" alt=""></label>
                        </div>
                    </form>
                </li>
                <router-link class="flexin-center logo" tag="li" to="/"><a href="#">Lappinalle</a></router-link>
                <li class="nav-icons">
                    <ul class="nav-icons-items">
                        <router-link tag="li" to="/login"><a href=""><img src="../../img/cabinet.png" alt=""></a></router-link>
                        <router-link tag="li" to="/izbrannoe"><a href=""><img src="../../img/bookmark.png" alt=""></a></router-link>
                        <router-link tag="li" to="/korzina"><a href=""><img src="../../img/cart.png" alt=""></a></router-link>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="menu-wrap" @mouseleave="unHoverTopMenu()">
            <div class="menu-middle">
                <ul class="container genders" v-bind:class="returnWidth" >
                    <li v-for="(gen, k) in $store.getters.topMenu"
                        :key="k"
                    >
                        <router-link :to="{name: 'gender', params: {gender: gen.url}}"
                            >
                            <span @mouseover="hoverTopMenu(gen.title, k)" :class="gen.hover ? 'active-top-menu' : 'unactive-top-menu'" @click="closeMenu">{{gen.title}}</span>
                        </router-link>
                    </li>
                </ul>
            </div>
            <div class="menu-bottom" v-if="showMenu">
                <ul class="menu-categories">
                    <li
                        v-for="(categ, value, i) in categories"
                        :key="i+'c'"
                        :class="categ[0].hover ? 'active-catg' : null"
                        @mouseleave="categ[0].hover = false"
                    >
                        <router-link :to="{name: 'category', params: {gender: categ[0].sex_alias, category: categ[0].categories_alias}}" >
                            <span @mouseover="showDepartment(value, categories, categ)" @click="closeMenu()" :class="value === 'Распродажа' ? 'sale' : null">{{value}}</span>
                        </router-link>
                    </li>
                </ul>
                <ul class="menu-departments" @mouseover="hoverCategories()" @mouseleave="getChosenCategory !== null ? categories[getChosenCategory][0].hover = false : true">
                    <li  v-for="(depart, d) in getDepartments" :key="d+'d'" @click="closeMenu()">
                        <router-link :to="{name: 'department', params: {gender: depart.sex_alias, category: depart.categories_alias, department: depart.departments_alias}}">{{depart.department}}</router-link>
                    </li>
                </ul>
            </div>
            <div class="menu-bottom" v-else>

            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </nav>
</template>

<script>
    export default {
        name: "Header",
        data:() => ({
            topMenuLength: null,
            showMenu: false,
            departments: null,
            chosenCatg: null,
            categories: null,
            chosenGender: null

        }),
        beforeMount() {
            this.$Progress.start();
        },
        methods: {
            // Наводим на главное меню
            hoverTopMenu(genderTitle, k){

                // Получаем категории
                this.categories = this.$store.getters.lastMenu[genderTitle];

                // Полуаем подкатегории для катергории по номер 1
                for (let i in this.categories) {
                    this.departments = this.categories[i];
                    break;
                }

                // Показываем меню
                this.showMenu = true;

                // Делаем hover на topMenu
                for (let gen in this.$store.getters.topMenu) {

                    this.$store.getters.topMenu[gen].hover = false;
                }

                this.$store.getters.topMenu[k].hover = true;
            },

            // Уводим с главного меню
            unHoverTopMenu(){

                for (let gen in this.$store.getters.topMenu) {

                    this.$store.getters.topMenu[gen].hover = false;
                }
                this.showMenu = false;
            },

            // Показываем подкатегории
            showDepartment(k, menu, categ){
                this.departments = categ;
                categ[0].hover = true;
                this.chosenCatg = k;
            },

            // Оставляем hover на категориях, если переходим на поле с подкатегориями
            hoverCategories(){
                if (this.chosenCatg !== null) this.categories[this.chosenCatg][0].hover = true
            },

            closeMenu(){
                this.showMenu = false;
            }
        },
        // Получаем меню
        created(){
            if (!this.$store.getters.lastMenu.length && !this.$store.getters.topMenu.length) this.$store.dispatch('getMenuData');
            this.$Progress.finish();
        },
        // Котролируем ширину меню
        updated() {
            this.topMenuLength = this.$store.getters.topMenu.length;
        },
        computed: {
            // Следим за шириной меню
            getTopMenuLength(){
                return this.topMenuLength;
            },

            // Отдаем ширину меню
            returnWidth(){
                let width = {
                    2: 'width-300',
                    3: 'width-500',
                    4: 'width-600',
                    5: 'width-700',
                    6: 'width-800',
                    7: 'width-900',
                    8: 'width-1000'
                };
                let resultWidth = null;

                for (let wd in width){

                    if (this.topMenuLength == wd) resultWidth = width[wd];
                }

                if (resultWidth === null) {
                    resultWidth = 'width-default';
                }
                return resultWidth;
            },

            // Следим за изменением выбранной категории
            getChosenCategory(){
                return this.chosenCatg;
            },

            // Следим за подкатегориями
            getDepartments(){
                return this.departments;
            }
        },
        watch: {
            categories(val){
                this.categories = val;
            },
        }
    }
</script>
<!--<template>-->
<!--  <nav>-->
<!--      <div class="menu-top">-->
<!--          <ul class="grid-nav-top container">-->
<!--              <li>-->
<!--                  <form class="nav-search">-->
<!--                      <div class="search">-->
<!--                          <input type="search" id="search" placeholder="Поиск">-->
<!--                          <label for="search"><img src="../../img/search.png" alt=""></label>-->
<!--                      </div>-->
<!--                  </form>-->
<!--              </li>-->
<!--              <router-link class="flexin-center logo" tag="li" to="/"><a href="#">Lappinalle</a></router-link>-->
<!--              <li class="nav-icons">-->
<!--                  <ul class="nav-icons-items">-->
<!--                      <router-link tag="li" to="/cabinet"><a href=""><img src="../../img/cabinet.png" alt=""></a></router-link>-->
<!--                      <router-link tag="li" to="/bookmark"><a href=""><img src="../../img/bookmark.png" alt=""></a></router-link>-->
<!--                      <router-link tag="li" to="/cart"><a href=""><img src="../../img/cart.png" alt=""></a></router-link>-->
<!--                  </ul>-->
<!--              </li>-->
<!--          </ul>-->
<!--      </div>-->
<!--      <div class="menu-wrap" @mouseleave="unHoverTopMenu()">-->
<!--          <div class="menu-middle">-->
<!--              <ul class="container genders" v-bind:class="returnWidth" >-->
<!--                  <router-link-->
<!--                          v-for="(link, i) in getTopMenu"-->
<!--                      :key="i"-->
<!--                      tag="li"-->
<!--                      :to="link.url"-->
<!--                      :exact="link.exact"-->
<!--                  >-->
<!--                      <a href="#" @mouseover="hoverTopMenu(link.title, getTopMenu, i)" :class="link.hover ? 'active-top-menu': 'unactive-top-menu'">{{link.title}}</a>-->
<!--                  </router-link>-->
<!--              </ul>-->
<!--          </div>-->
<!--          <div class="menu-bottom" v-if="showMenu">-->
<!--              <ul @mouseover="hoverMenu()" class="menu-categories" v-if="getTopMenu.length">-->
<!--                  <router-link v-for="(value, catg, i) in getBottomMenu[getChosenCatg]"-->
<!--                               :key="i"-->
<!--                               tag="li"-->
<!--                               active-class="active"-->
<!--                               :to="getBottomMenu[getChosenCatg][catg][0].categories_alias"-->
<!--                               :exact='catg.exact'-->
<!--                               :class="getBottomMenu[getChosenCatg][catg][0].hover ? 'active-catg' : null"-->
<!--                  >-->
<!--                      <a href="#" @mouseover="mouseOverDept(value, getBottomMenu[getChosenCatg], catg)" @mouseleave="getBottomMenu[getChosenCatg][catg][0].hover = false" :class="catg === 'Распродажа' ? 'sale' : null">{{catg}}</a>-->
<!--                  </router-link>-->
<!--              </ul>-->
<!--              <ul class="menu-departments" @mouseover="doHoverCatg()" v-if="returnDepart.length" @mouseleave="getBottomMenu[getChosenCatg][hoverCatg][0].hover = false">-->
<!--                  <router-link-->
<!--                      v-for="(valueIn, k) in returnDepart"-->
<!--                      :key="k"-->
<!--                      tag="li"-->
<!--                      active-class="active"-->
<!--                      :to="valueIn.departments_alias"-->
<!--                      :exact='valueIn.exact'-->
<!--                  >-->
<!--                      <a href="#">{{valueIn.department}}</a>-->
<!--                  </router-link>-->
<!--              </ul>-->
<!--          </div>-->
<!--          <div class="menu-bottom" v-else>-->

<!--          </div>-->
<!--      </div>-->
<!--  </nav>-->
<!--</template>-->

<!--<script>-->
<!--export default {-->
<!--    name: "Header",-->
<!--    data:() => ({-->
<!--        lastMenu: null,-->
<!--        topMenuLength: null,-->
<!--        showMenu: false,-->
<!--        departments: null,-->
<!--        hoverCatg: null,-->
<!--        chosenCatg: null-->

<!--    }),-->
<!--    methods: {-->
<!--        // Наводим на главное меню-->
<!--        hoverTopMenu(item, topMenu, i){-->
<!--            // Получаем меню категории для выбранного айтема меню-->
<!--            this.chosenCatg = item;-->

<!--            // Полуаем подкатегории для катергории по номер 1-->
<!--            for (let i in this.getBottomMenu[item]) {-->
<!--                this.departments = this.getBottomMenu[item][i];-->
<!--                break;-->
<!--            }-->
<!--            console.log(this.departments)-->
<!--            // Показываем меню-->
<!--            this.showMenu = true;-->

<!--            // Делаем hover на topMenu-->
<!--            for (let cat in topMenu) {-->

<!--                topMenu[cat].hover = false;-->
<!--            }-->
<!--            topMenu[i].hover = true;-->

<!--        },-->

<!--        // Уюираем мышку с лавного меню-->
<!--        unHoverTopMenu(){-->
<!--            this.showMenu = false;-->

<!--            for (let cat in this.getTopMenu) {-->

<!--                this.getTopMenu[cat].hover = false;-->
<!--            }-->
<!--        },-->

<!--        // Показывае меню с категориями и подкатегориями-->
<!--        hoverMenu(){-->
<!--            this.showMenu = true;-->
<!--        },-->

<!--        // Показываем категории-->
<!--        mouseOverDept(k, menu, catg){-->
<!--            this.departments = k;-->
<!--            this.hoverCatg = catg;-->
<!--            menu[catg][0].hover = true;-->
<!--        },-->

<!--        doHoverCatg(){-->
<!--            this.lastMenu[this.hoverCatg][0].hover = true;-->
<!--        }-->
<!--    },-->
<!--    // Получаем меню-->
<!--    created(){-->
<!--        if (!this.$store.getters.lastMenu.length && !this.$store.getters.topMenu.length) this.$store.dispatch('getMenuData');-->
<!--        // console.log(this.lastMenu)-->
<!--    },-->
<!--    // Котролируем ширину меню-->
<!--    updated() {-->
<!--        this.topMenuLength = this.getTopMenu.length;-->
<!--        console.log(1)-->
<!--    },-->
<!--    computed: {-->
<!--        // Следим за шириной меню-->
<!--        getTopMenuLength(){-->
<!--            return this.topMenuLength;-->
<!--        },-->

<!--        // Отдаем ширину меню-->
<!--        returnWidth(){-->
<!--            let width = {-->
<!--                2: 'width-300',-->
<!--                3: 'width-500',-->
<!--                4: 'width-600',-->
<!--                5: 'width-700',-->
<!--                6: 'width-800',-->
<!--                7: 'width-900',-->
<!--                8: 'width-1000'-->
<!--            };-->
<!--            let resultWidth = null;-->

<!--            for (let wd in width){-->

<!--                if (this.topMenuLength == wd) resultWidth = width[wd];-->
<!--            }-->

<!--            if (resultWidth === null) {-->
<!--                resultWidth = 'width-default';-->
<!--            }-->
<!--            return resultWidth;-->
<!--        },-->

<!--        // Отдаем категории-->
<!--        returnDepart(){-->
<!--            return this.departments;-->
<!--        },-->

<!--        // Отдаем категории и подкатегории-->
<!--        getBottomMenu(){-->
<!--          return this.$store.getters.lastMenu;-->
<!--        },-->

<!--        // Отдаем мальчки, девочики ..-->
<!--        getTopMenu(){-->
<!--            return this.$store.getters.topMenu;-->
<!--        },-->

<!--        getChosenCatg(){-->
<!--            return this.chosenCatg;-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<style lang = "scss">

</style>
