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
                        <router-link tag="li" to="/korzina"><a href="" v-bind:class="getCartCount ? 'active-cart' : null"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 510.2 418.41"><path d="M552.72,93.5c-.77,3.55-1.1,7.26-2.39,10.61q-5.24,13.55-11.15,26.83-27,60.36-54.24,120.61a187.52,187.52,0,0,1-9.51,17.29c-6.51,11.1-16.9,15.39-29.17,16.13-3.11.19-6.24.2-9.36.2H210.66a62,62,0,0,0,8,17c7.14,10.51,16.82,15.78,29.82,15.75,64.81-.18,129.63-.09,194.44-.08a20.25,20.25,0,0,1,4.13.26,10.44,10.44,0,0,1,8.35,11.25,10.59,10.59,0,0,1-9.85,9.71c-1,.09-2.09.05-3.13.05-64.37,0-128.75-.15-193.13.08-21.91.08-38-9.46-49.64-27.46-6.72-10.41-10-22.12-13.3-33.94-8.74-31.45-17.85-62.8-27-94.14C148.26,145.41,136.94,107.22,125.7,69c-2.74-9.34-13.21-17.12-23.47-17.18-16-.1-32.1,0-48.15,0-5.21,0-9-2.42-10.77-6.68-2.75-6.75,2.06-14.52,9.38-14.52,21.17,0,42.34,0,63.49.62,5.3.14,10.77,1.88,15.75,3.89,7.21,2.92,11.72,8.75,13.81,16.27q29.14,104.75,58.18,209.5c.69,2.49,1.68,3.19,4.2,3.18q114.66-.1,229.31-.06c2.78,0,5.55-.18,8.32-.25,5.67-.14,10-2.41,12.64-7.61,5.07-10,10.53-19.91,15.16-30.16q27.33-60.5,54.14-121.22a48.89,48.89,0,0,0,3.56-13.48c.89-7-.71-8.5-7.75-8.55s-14.05.08-21.08.09q-58.95.06-117.91.09c-22.73,0-45.46-.08-68.19-.1L200,82.7c-6.46,0-10.43-2.71-11.84-8a10.46,10.46,0,0,1,8.09-13,25,25,0,0,1,4.66-.31q132.09.07,264.19.19c18.74,0,37.48-.22,56.22-.14a52.19,52.19,0,0,1,12.6,1.4c10.22,2.63,16.16,9.56,18.27,19.84.14.65.37,1.29.55,1.94Z" transform="translate(-42.53 -30.59)"/><path d="M437.67,449c-4.33-1.14-8.81-1.9-13-3.5A49.57,49.57,0,0,1,437.16,350c26.07-3,50.22,15.1,54.56,40.83,4.41,26.13-12.49,51.39-38.13,57-1.83.4-3.67.78-5.51,1.17Zm-24.18-49.62a29.39,29.39,0,0,0,29.34,29.25c15.94-.07,29.24-13.38,29.16-29.19a29.25,29.25,0,1,0-58.5-.06Z" transform="translate(-42.53 -30.59)"/><path d="M235.67,449c-5.22-1.5-10.69-2.42-15.61-4.6-20.4-9-31.76-30.29-28.6-52.74,2.94-20.83,20.25-38.15,41.44-41.46,27.06-4.22,53,14.75,56.84,41.67A49.75,49.75,0,0,1,247,448.55a8.76,8.76,0,0,0-1.46.45Zm4.85-78.92a29.28,29.28,0,1,0,.22,58.55c15.84-.11,29.07-13.29,29.09-29A29.38,29.38,0,0,0,240.52,370.08Z" transform="translate(-42.53 -30.59)"/><path class="cls-1" d="M413.49,399.38a29.25,29.25,0,1,1,58.5.06c.08,15.81-13.22,29.12-29.16,29.19A29.39,29.39,0,0,1,413.49,399.38Z" transform="translate(-42.53 -30.59)"/><path class="cls-1" d="M240.52,370.08a29.38,29.38,0,0,1,29.31,29.55c0,15.71-13.25,28.89-29.09,29a29.28,29.28,0,1,1-.22-58.55Z" transform="translate(-42.53 -30.59)"/></svg></a></router-link>
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
            },

            getCartCount(){
                return this.$store.getters.cartCount;
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
