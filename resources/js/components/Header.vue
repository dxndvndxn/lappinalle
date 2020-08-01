<template>
  <nav>
      <ul>
          <router-link
                v-for="(link, i) in topMenu"
                :key="i"
                tag="li"
                active-class="active"
                :to="link.url"
                :exact="link.exact"
                >
                    <a href="#" @mouseover="hoverTopMenu(link.title)">{{link.title}}</a>
                </router-link>
      </ul>
      <ul>
          <router-link v-for="(value, catg, i) in lastMenu" 
          :key="i"
          tag="li"
          active-class="active"
          :to="value[0].categories_alias"
          :exact='catg.exact'
          >
            <a href="#">{{catg}}</a>
            <ul>
                <router-link
                v-for="(valueIn, catgIn, k) in value" 
                :key="k"
                tag="li"
                active-class="active"
                :to="valueIn.departments_alias"
                :exact='valueIn.exact'
                >
                    <a href="#">{{valueIn.department}}</a>
                </router-link>
            </ul>
           </router-link>
      </ul>
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
        lastMenu: null
    }),
    methods: {
        // Получаем категории и подкатегории меню
        getMenu() {
            axios
            .get('/api/menu')
            .then(response => {
                let menu = response.data;
                let listGenders = [];
                let listCategories = [];
                
                for (let i in menu) {

                    if (menu[i].categories_menu_lvlmenu === 1) {
                        this.topMenu.push({
                            title:menu[i].categories_name,
                            url: menu[i].categories_alias
                        })
                    }

                    if (menu[i].sex_name === null) continue;

                    listGenders.push(menu[i].sex_name);
                    listCategories.push(menu[i].categories_name + (menu[i].season_name !== null ? ' ' + menu[i].season_name : ''));
                }

                let genders = new Set(listGenders);
                let gendersObj = {}
                let lastMenu = {};

                for (let i of genders) {
                    gendersObj[i] = [];
                    lastMenu[i] = {};
                }

                for (let i in menu){

                    for (let k of genders){

                         if (k === menu[i].sex_name) gendersObj[k].push(menu[i]);
                    }
                }
                
                let categories = new Set(listCategories);
                let categoriesObj = {};

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
                                categories_alias: gendersObj[g][gg].season_alias !== null ? gendersObj[g][gg].sex_alias + '/' + gendersObj[g][gg].categories_alias + '-' + gendersObj[g][gg].season_alias : gendersObj[g][gg].sex_alias + '/' + gendersObj[g][gg].categories_alias}
                                );
                            }
                        }
                    }
                }
                this.bottomMenu = lastMenu;
            })
        },
        hoverTopMenu(item){
            this.lastMenu = this.bottomMenu[item];
        }
    },
    created(){
        this.getMenu();
    },
}
</script>

<style>

</style>