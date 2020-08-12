import Vue from 'vue'
import Vuex from  'vuex'
import axios from 'axios'
Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        topMenu: [],
        lastMenu: {},
        categAlias: {},
        departAlias: {},
        mySidebar: null,
        errors: null
    },
    mutations: {
        // Получаем категории и подкатегории меню
        async getMenuDataMutate(state){

            await axios.get('/api/menu')
                .then(response => {
                    // массив с изначальной датой
                    let menu = response.data;

                    // выборка на гендер
                    let listGenders = [];

                    // выборка на категории
                    let listCategories = [];

                    // Сайдбар
                    let sideBar = {};

                    // Алиас для категорий
                    let categoryAlias = {};

                    // Алиас для подкатегорий
                    let departmentAlias = {};

                    let topMenuGenders = [];

                    // проходимся по массиву с общими данными и пушим в верхние массивы, выбираем категории меню для 1 уровня
                    for (let i in menu) {

                        if (menu[i].categories_menu_lvlmenu === 1) {
                            topMenuGenders.push({
                                title: menu[i].categories_name,
                                url: menu[i].categories_alias,
                                hover: false
                            })
                        }

                        if (menu[i].sex_name === null) continue;

                        listGenders.push(menu[i].sex_name);
                        listCategories.push(menu[i].categories_name + (menu[i].season_name !== null ? ' ' + menu[i].season_name : ''));
                        categoryAlias[menu[i].categories_alias + (menu[i].season_alias !== null ? '-' + menu[i].season_alias : '')] = menu[i].categories_name + (menu[i].season_name !== null ? ' ' + menu[i].season_name : '');

                        if (menu[i].departments_alias !== null) departmentAlias[menu[i].departments_alias] = menu[i].departments_name;

                        sideBar[menu[i].sex_alias] = {
                            sex_name: menu[i].sex_name,
                        }
                    }

                    // Меняем стейт меню гендер
                    state.topMenu = topMenuGenders;

                    // Меням стейт для категории алиас
                    state.categAlias = categoryAlias;

                    // Меням стейт для подкатегории алиас
                    state.departAlias = departmentAlias;

                    // Создаем основу на для sidebar категории
                    for (let m in menu) {

                        // Заполняем sidebar
                        for (let i in sideBar){

                            // Если гендер алиас из главной даты = гендеру из sidebar
                            if (menu[m].sex_alias === i) {

                                //Разбираем категории
                                for (let categ in state.categAlias){

                                    // Если категории из главной даты = категории из sidebar
                                    if (menu[m].categories_alias + (menu[m].season_alias !== null ? '-' + menu[m].season_alias : '') === categ){
                                        sideBar[i][categ] = {category_name: state.categAlias[categ]}
                                    }
                                }
                            }
                        }
                    }

                    for (let m in menu) {

                        // Заполняем sidebar
                        for (let i in sideBar) {

                            // Если гендер алиас из главной даты = гендеру из sidebar
                            if (menu[m].sex_alias === i) {

                                //Разбираем категории
                                for (let categ in state.categAlias) {

                                    // Если категории алиас = категориям алиас из главной даты
                                    if (menu[m].categories_alias + (menu[m].season_alias !== null ? '-' + menu[m].season_alias : '') === categ){

                                        // Разбираем подкатегории
                                        for (let depart in departmentAlias) {

                                            sideBar[i][categ].show_category = true;

                                            // Если подкатегории алиас = подкатегориям алиас из главной даты
                                            if (menu[m].departments_alias === depart) {

                                                // Записываем эти подкатегории
                                                // sideBar[i][categ].departments = {depart_names: , depart_url: [sideBar[i][categ][depart]]}
                                                // sideBar[i][categ][depart] = state.departAlias[depart];
                                                sideBar[i][categ].departments = [];
                                                sideBar[i][categ].category_alias = menu[m].categories_alias + (menu[m].season_alias !== null ? '-' + menu[m].season_alias : '');
                                                // sideBar[i][categ].show = true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    for (let m in menu) {

                        // Заполняем sidebar
                        for (let i in sideBar) {

                            // Если гендер алиас из главной даты = гендеру из sidebar
                            if (menu[m].sex_alias === i) {

                                //Разбираем категории
                                for (let categ in state.categAlias) {

                                    // Если категории алиас = категориям алиас из главной даты
                                    if (menu[m].categories_alias + (menu[m].season_alias !== null ? '-' + menu[m].season_alias : '') === categ){

                                        // Разбираем подкатегории
                                        for (let depart in departmentAlias) {

                                            sideBar[i][categ].show_category = true;

                                            // Если подкатегории алиас = подкатегориям алиас из главной даты
                                            if (menu[m].departments_alias === depart) {

                                                try {
                                                    sideBar[i][categ].departments.push({depart_name: departmentAlias[depart], depart_alias: depart, depart_show: false});
                                                }catch (e) {
                                                    console.log(e)
                                                }
                                                // Записываем эти подкатегории
                                                //sideBar[i][categ][departments].sideBar[i][categ][depart] = state.departAlias[depart]

                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    state.mySidebar = sideBar;

                    // Выбираем уникальные гендеры
                    let genders = new Set(listGenders);
                    let gendersObj = {};

                    // Определяем гендеры в разных массивах, объекта
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
            });
        },
        sideBarDepartMutate(state, data){
            try{
                for (let i in state.mySidebar[data.gen]){
                    try {
                        state.mySidebar[data.gen][i].show_category = false;
                    }catch (e) {

                    }
                    for (let setFal in state.mySidebar[data.gen][i].departments){
                        state.mySidebar[data.gen][i].departments[setFal].depart_show = false;
                    }
                }

                try {
                    for (let setTrue in state.mySidebar[data.gen][data.categoryAlias].departments){
                        state.mySidebar[data.gen][data.categoryAlias].departments[setTrue].depart_show = true;
                    }
                    state.mySidebar[data.gen][data.categoryAlias].show_category = true;
                }catch(e){

                }
            }catch(e){
                console.log(e)
            }
        },
        sideBarDepartMutateAfterUpdated(state, data){
            try{
                if(data.categoryAlias === undefined){
                    for (let i in data.newSidebar[data.gen]){

                        if (i === 'sex_name') continue;

                        data.newSidebar[data.gen][i].show_category = true;
                    }
                }else{

                    for (let i in data.newSidebar[data.gen]){
                        try {
                            data.newSidebar[data.gen][i].show_category = false;
                        }catch (e) {

                        }
                        for (let setFal in data.newSidebar[data.gen][i].departments){
                            data.newSidebar[data.gen][i].departments[setFal].depart_show = false;
                        }
                    }

                    try {
                        for (let setTrue in data.newSidebar[data.gen][data.categoryAlias].departments){
                            data.newSidebar[data.gen][data.categoryAlias].departments[setTrue].depart_show = true;
                        }
                        data.newSidebar[data.gen][data.categoryAlias].show_category = true;
                    }catch(e){
                        console.log(e)
                    }
                }
            }catch(e){
                console.log(e)
            }
            state.mySidebar = data.newSidebar;
        },
        backToCategoryMutate(state, data){
            try{
                for (let i in state.mySidebar[data.gen]){
                    if (i === 'sex_name') continue;

                    state.mySidebar[data.gen][i].show_category = true;

                    for (let setFal in state.mySidebar[data.gen][i].departments){

                        state.mySidebar[data.gen][i].departments[setFal].depart_show = false;
                    }
                }
            }catch (e) {
                console.log(e)
            }
        }
    },
    actions: {
        getMenuData({commit}){
            commit('getMenuDataMutate');
        },
        showDepartments({commit}, data){
            commit('sideBarDepartMutate', data);
        },
        showDepartAfterUpdated({commit}, data){
            commit('sideBarDepartMutateAfterUpdated', data);
        },
        backToCategory({commit}, data){
            commit('backToCategoryMutate', data);
        }
    },
    getters:{
        topMenu: (state) => {
            return state.topMenu;
        },
        lastMenu: (state) => {
            return state.lastMenu;
        },
        categAlias: (state) => {
            return state.categAlias;
        },
        departAlias: (state) => {
            return state.departAlias;
        },
        mySidebar: (state) => {
            return state.mySidebar;
        }

    }
})
