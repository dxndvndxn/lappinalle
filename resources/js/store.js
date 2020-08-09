import Vue from 'vue'
import Vuex from  'vuex'
import axios from 'axios'
Vue.use(Vuex);

export default new Vuex.Store({
    state:() => ({
        topMenu: [],
        lastMenu: {},
        errors: [],
    }),
    mutations: {
        // Получаем категории и подкатегории меню
        getMenuDataMutate(state){
            state.topMenu = [];
            state.lastMenu = {};
            axios.get('/api/menu')
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
                            state.topMenu.push({
                                title: menu[i].categories_name,
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

                    // Определяем гендеры в разных массивах, объектаъ
                    for (let i of genders) {
                        gendersObj[i] = [];
                        state.lastMenu[i] = {};
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
                    for (let i in state.lastMenu) {

                        for (let k of categories) {
                            state.lastMenu[i][k] = [];
                            categoriesObj[k] = [];
                        }
                    }

                    for (let g in gendersObj) {

                        for (let gg in gendersObj[g]) {

                            for (let c of categories) {

                                // if (c === (gendersObj[g][gg].season_name !== null ? gendersObj[g][gg].categories_name + ' ' + gendersObj[g][gg].season_name : gendersObj[g][gg].categories_name) && gendersObj[g][gg].sex_name === g) {
                                //     state.lastMenu[g][c].push({
                                //         department: gendersObj[g][gg].departments_name,
                                //         departments_alias: gendersObj[g][gg].season_alias !== null
                                //             ? gendersObj[g][gg].sex_alias + '/' + gendersObj[g][gg].categories_alias + '-' + gendersObj[g][gg].season_alias + (gendersObj[g][gg].departments_alias !== null ? '/' : '') + (gendersObj[g][gg].departments_alias ?? '')
                                //             : gendersObj[g][gg].sex_alias + '/' + gendersObj[g][gg].categories_alias + (gendersObj[g][gg].departments_alias !== null ? '/' : '') + (gendersObj[g][gg].departments_alias ?? ''),
                                //         category: c,
                                //         hover: false,
                                //         categories_alias: gendersObj[g][gg].season_alias !== null ? gendersObj[g][gg].sex_alias + '/' + gendersObj[g][gg].categories_alias + '-' + gendersObj[g][gg].season_alias : gendersObj[g][gg].sex_alias + '/' + gendersObj[g][gg].categories_alias}
                                //     );
                                // }
                                if (c === (gendersObj[g][gg].season_name !== null ? gendersObj[g][gg].categories_name + ' ' + gendersObj[g][gg].season_name : gendersObj[g][gg].categories_name) && gendersObj[g][gg].sex_name === g) {
                                    state.lastMenu[g][c].push({
                                        department: gendersObj[g][gg].departments_name,
                                        departments_alias: gendersObj[g][gg].departments_alias,
                                        category: c,
                                        hover: false,
                                        sex_alias: gendersObj[g][gg].sex_alias,
                                        categories_alias: gendersObj[g][gg].season_alias !== null ? gendersObj[g][gg].categories_alias + '-' + gendersObj[g][gg].season_alias : gendersObj[g][gg].categories_alias}
                                    );
                                }
                            }
                        }
                    }

                    // Удаляем категорию, в которой ничего нету
                    for (let l in state.lastMenu) {

                        for (let ll in state.lastMenu[l]) {
                            if (!state.lastMenu[l][ll].length) delete state.lastMenu[l][ll];
                        }
                    }
                }).catch(error => {
                error = 'Упс что-то пошло не так';
                state.errors = [];
                state.errors.push(error)
            })
        },

    },
    actions: {
        getMenuData({commit}){
            commit('getMenuDataMutate');
        }
    },
    getters:{
        topMenu: (state) => {
            return state.topMenu;
        },
        lastMenu: (state) => {
            return state.lastMenu;
        }
    }
})
