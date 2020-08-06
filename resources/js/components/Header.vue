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
                      <router-link tag="li" to="/cabinet"><a href=""><img src="../../img/cabinet.png" alt=""></a></router-link>
                      <router-link tag="li" to="/bookmark"><a href=""><img src="../../img/bookmark.png" alt=""></a></router-link>
                      <router-link tag="li" to="/cart"><a href=""><img src="../../img/cart.png" alt=""></a></router-link>
                  </ul>
              </li>
          </ul>
      </div>
      <div class="menu-wrap" @mouseleave="unHoverTopMenu()">
          <div class="menu-middle">
              <ul class="container genders" v-bind:class="returnWidth">
                  <router-link
                      v-for="(link, i) in topMenu"
                      :key="i"
                      tag="li"
                      active-class="active"
                      :to="link.url"
                      :exact="link.exact"
                  >
                      <a href="#" @mouseover="hoverTopMenu(link.title, topMenu, i)"  :class="link.hover ? 'active-top-menu': null">{{link.title}}</a>
                  </router-link>
              </ul>
          </div>
          <div class="menu-bottom" v-if="showMenu">
              <ul @mouseover="hoverMenu()" class="menu-categories">
                  <router-link v-for="(value, catg, i) in lastMenu"
                               :key="i"
                               tag="li"
                               active-class="active"
                               :to="value[0].categories_alias"
                               :exact='catg.exact'
                               :class="lastMenu[catg][0].hover ? 'active-catg' : null"
                  >
                      <a href="#" @mouseover="mouseOverDept(value, lastMenu, catg)" @mouseleave="lastMenu[catg][0].hover = false" :class="catg === 'Распродажа' ? 'sale' : null">{{catg}}</a>
                  </router-link>
              </ul>
              <ul class="menu-departments">
                  <router-link
                      v-for="(valueIn, k) in returnDepart"
                      :key="k"
                      tag="li"
                      active-class="active"
                      :to="valueIn.departments_alias"
                      :exact='valueIn.exact'
                  >
                      <a href="#">{{valueIn.department}}</a>
                  </router-link>
              </ul>
          </div>
          <div class="menu-bottom" v-else>

          </div>
      </div>
  </nav>
</template>

<script>
import axios from 'axios';
export default {
    name: "Header",
    data:() => ({
        links: [],
        topMenu: [],
        bottomMenu: null,
        lastMenu: null,
        topMenuLength: null,
        showMenu: false,
        departments: null

    }),
    methods: {
        // Получаем категории и подкатегории меню
        async getMenu() {
            await axios
            .get('/api/menu')
            .then(response => {
                // массив с изначальной датой
                let menu = response.data;

                // выборка на гендер
                let listGenders = [];

                // выборка на категории
                let listCategories = [];

                // проходимся по массиву с общими данными и пушим в верхние массивы, выбираем категории меню для 1 уровня
                for (let i in menu) {

                    if (menu[i].categories_menu_lvlmenu === 1) {
                        this.topMenu.push({
                            title:menu[i].categories_name,
                            url: menu[i].categories_alias,
                            hover: false
                        })
                    }

                    if (menu[i].sex_name === null) continue;

                    listGenders.push(menu[i].sex_name);
                    listCategories.push(menu[i].categories_name + (menu[i].season_name !== null ? ' ' + menu[i].season_name : ''));
                }

                // Выбираем уникальные гендеры
                let genders = new Set(listGenders);
                let gendersObj = {}
                let lastMenu = {};

                // Определяем гендеры в разных массивах, объектаъ
                for (let i of genders) {
                    gendersObj[i] = [];
                    lastMenu[i] = {};
                }

                // Пушим данным по гендарным различиям
                for (let i in menu){

                    for (let k of genders){

                         if (k === menu[i].sex_name) gendersObj[k].push(menu[i]);
                    }
                }

                // Выбираем уникальные категории
                let categories = new Set(listCategories);
                let categoriesObj = {};

                // Распределяем категории по гендеру
                for (let i in lastMenu) {

                    for (let k of categories) {
                         lastMenu[i][k] = [];
                         categoriesObj[k] = [];
                    }
                }

                for (let g in gendersObj) {

                    for (let gg in gendersObj[g]) {

                        for (let c of categories) {

                            if (c === (gendersObj[g][gg].season_name !== null ? gendersObj[g][gg].categories_name + ' ' + gendersObj[g][gg].season_name : gendersObj[g][gg].categories_name) && gendersObj[g][gg].sex_name === g) {
                                lastMenu[g][c].push({
                                department: gendersObj[g][gg].departments_name,
                                departments_alias: gendersObj[g][gg].season_alias !== null
                                ? gendersObj[g][gg].sex_alias + '/' + gendersObj[g][gg].categories_alias + '-' + gendersObj[g][gg].season_alias + (gendersObj[g][gg].departments_alias !== null ? '/' : '') + (gendersObj[g][gg].departments_alias ?? '')
                                : gendersObj[g][gg].sex_alias + '/' + gendersObj[g][gg].categories_alias + (gendersObj[g][gg].departments_alias !== null ? '/' : '') + (gendersObj[g][gg].departments_alias ?? ''),
                                category: c,
                                hover: false,
                                categories_alias: gendersObj[g][gg].season_alias !== null ? gendersObj[g][gg].sex_alias + '/' + gendersObj[g][gg].categories_alias + '-' + gendersObj[g][gg].season_alias : gendersObj[g][gg].sex_alias + '/' + gendersObj[g][gg].categories_alias}
                                );
                            }
                        }
                    }
                }

                // Удаляем категорию, в которой ничего нету
                for (let l in lastMenu) {

                    for (let ll in lastMenu[l]) {
                        if (!lastMenu[l][ll].length) delete lastMenu[l][ll];
                    }
                }

                this.bottomMenu = lastMenu;
            })
            .catch(error => {
                console.log(error);
            })
        },
        // Наводим на главное меню
        hoverTopMenu(item, topMenu, i){
            // Получаем меню категории для выбранного айтема меню
            this.lastMenu = this.bottomMenu[item];

            // Полуаем подкатегории для катергории по номер 1
            for (let i in this.lastMenu) {
                this.departments = this.lastMenu[i];
                break;
            }

            // Показываем меню
            this.showMenu = true;

            // Делаем hover на topMenu
            for (let cat in topMenu) {

                topMenu[cat].hover = false;
            }

            topMenu[i].hover = true;

        },
        unHoverTopMenu(){
            this.showMenu = false;

            for (let cat in this.topMenu) {

                this.topMenu[cat].hover = false;
            }
        },
        hoverMenu(){
            this.showMenu = true;
        },
        mouseOverDept(k, menu, catg){
            this.departments = k;
            menu[catg][0].hover = true;
        }
    },
    created(){
        this.getMenu();
    },
    updated() {
        this.topMenuLength = this.topMenu.length;
    },
    computed: {
        getTopMenuLength(){
            return this.topMenuLength;
        },
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
        returnDepart(){
            return this.departments;
        }
    }
}
</script>

<style lang = "scss">

</style>
