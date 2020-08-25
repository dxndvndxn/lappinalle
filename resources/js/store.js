import Vue from 'vue'
import Vuex from  'vuex'
import axios from 'axios'
Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        // Верхнее меню с гендером
        topMenu: [],

        // Меню с категориями и подкатегориями
        lastMenu: {},

        // Алиасы для категории
        // Алиасы для подкатегории
        categAlias: {},
        departAlias: {},

        // Данные на sidebar
        mySidebar: null,

        // Ошибки
        errorQuery: false,

        // Данные для для каталога
        catalogData: null,
        catalogDataCellCount: null,

        // Данные для товара
        catalogItem: null,
        catalogItemReview: null,
        catalogItemStars: null,
        catalogItemReviewCount: null,

        // Данные для фильтра
        filterMin: null,
        filterMax: null,
        filterSizes: null,

        // Данные по меню для админа
        menuAdmin: null,
        SITE_URI: 'http://lappinalle.test/api/',
    },
    mutations: {
        // Получаем категории и подкатегории меню
        async getMenuDataMutate(state){
            await axios.get(`${state.SITE_URI}menu`)
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
                                                sideBar[i][categ].departments = [];
                                                sideBar[i][categ].category_alias = menu[m].categories_alias + (menu[m].season_alias !== null ? '-' + menu[m].season_alias : '');
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
                    let lastMenu = {};
                    let menuForAdmin = {};
                    for (let i of genders) {
                        gendersObj[i] = [];
                        lastMenu[i] = {};
                        menuForAdmin[i] = {
                            activeGen: false
                        };
                    }

                    // Пушим данным по гендарным различиям
                    for (let i in menu){

                        for (let k of genders){

                            if (k === menu[i].sex_name) {
                                gendersObj[k].push(menu[i]);
                            }
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
                            menuForAdmin[i][k] = [];
                        }
                    }
                    for (let g in gendersObj) {

                        for (let gg in gendersObj[g]) {

                            for (let c of categories) {

                                if (c === (gendersObj[g][gg].season_name !== null ? gendersObj[g][gg].categories_name + ' ' + gendersObj[g][gg].season_name : gendersObj[g][gg].categories_name) && gendersObj[g][gg].sex_name === g) {
                                    lastMenu[g][c].push({
                                        department: gendersObj[g][gg].departments_name,
                                        departments_alias: gendersObj[g][gg].departments_alias,
                                        category: c,
                                        hover: false,
                                        sex_alias: gendersObj[g][gg].sex_alias,
                                        categories_alias: gendersObj[g][gg].season_alias !== null ? gendersObj[g][gg].categories_alias + '-' + gendersObj[g][gg].season_alias : gendersObj[g][gg].categories_alias}
                                    );
                                    menuForAdmin[g][c].push({
                                        department: gendersObj[g][gg].departments_name,
                                        category: c,
                                        activeCateg: false
                                    });
                                }
                            }
                        }
                    }

                    // Удаляем категорию, в которой ничего нету
                    for (let l in lastMenu) {

                        for (let ll in lastMenu[l]) {
                            if (!lastMenu[l][ll].length){
                                delete lastMenu[l][ll];
                                delete menuForAdmin[l][ll];
                            }
                        }
                    }

                    state.lastMenu = lastMenu;
                    state.menuAdmin = menuForAdmin;
                })
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
        },

        // Получаем дату в каталог по категориям
        async getCatalogDataMutate(state, data){
            // Смотрим по длинне объекта с параметрами
            // 1 - значит запрос по гендеру
            // 2 - значит запрос по категории
            // 3 - запрос по подкатегории
            switch (Object.keys(data.params).length) {
                case 1:
                    await axios.get(`${state.SITE_URI}${data.params.gender}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по гендеру
                            let itemCell = response.data;

                            // Устанавливаем min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number))

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов

                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            // Устанавливаем дату в стейт
                            state.catalogData = itemCell.data;

                            // Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
                    break;
                case 2:
                    await axios.get(`${state.SITE_URI}${data.params.gender}/${data.params.category}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по категории
                            let itemCell = response.data;

                            // Устанавливаес min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number));

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов
                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            // Устанавливаем дату в стейт
                            state.catalogData = itemCell.data;

                            //Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
                    break;
                case 3:
                    await axios.get(`${state.SITE_URI}${data.params.gender}/${data.params.category}/${data.params.department}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по категории
                            let itemCell = response.data;

                            // Устанавливаес min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number));

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов
                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            // Устанавливаем дату в стейт
                            state.catalogData = itemCell.data;

                            //Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
                    break;
            }
        },

        // Получаем дату для конкретного товара
        async getItemDataMutate(state, data){
            await axios.get(`/api/item-${data}`)
                .then(response => {
                    let itemData = response.data;
                    let stateItemData = {};
                    let pics = null;
                    let stars = {
                        5: [],
                        4: [],
                        3: [],
                        2: [],
                        1: [],
                    };
                    // Пробегаемся по массиву с данными
                    // Первым элементом идёт сам товар
                    // Присваеваем значения этого элемента @stateItemData
                    for (let el in itemData){

                        if (el == 0) {
                            stateItemData.itemTitle = itemData[el].product_title;
                            stateItemData.itemPrice = itemData[el].product_price;
                            pics = itemData[el].product_img.split(',');
                            stateItemData.itemPics = [];

                            // Пушим картинки
                            pics.forEach((img, ii) => {
                                if (ii === 0) {
                                    stateItemData.itemPics.push({img: img, clicked: true, video: false})
                                } else {
                                    stateItemData.itemPics.push({img: img, clicked: false, video: false})
                                }
                            });

                            // Если видео, то ставим его первым в массив с картинками, ставим ему ckicked true, скороее всего будет добавляться картинка как превье этого видео
                            if (itemData[el].product_video !== null){
                                stateItemData.itemPics[0].clicked = false;
                                stateItemData.itemPics.unshift({video: itemData[el].product_video, clicked: true});
                            }

                            // Если sale
                            if (itemData[el].product_old_price !== null) stateItemData.oldPrice = itemData[el].product_old_price;
                            else stateItemData.oldPrice = false;

                            stateItemData.itemDesc = itemData[el].product_description;
                            stateItemData.itemPrice = itemData[el].product_price;

                            state.catalogItem = stateItemData;
                        }else if (el === 'stars'){
                            itemData[el].forEach(element => {
                                stars[element.reviews_star].push(element.reviews_star)
                            });
                        }
                    }
                    state.catalogItemStars = stars;

                }).catch(errors => console.log(errors))
        },

        // Получаем отзывы
        async getItemReviewsMutate(state, data){
            await axios.get(`${state.SITE_URI}itemsreview-${data.item}?page=${data.page}`)
                .then(response => {
                    let reviews = response.data;
                    state.catalogItemReview = reviews.data;
                    state.catalogItemReviewCount = reviews.total
                })
        },

        // Получаем товары по скидки
        async showSaleProductsMutate(state, data){
            // Смотрим по длинне объекта с параметрами
            // 1 - значит запрос по гендеру
            // 2 - значит запрос по категории
            // 3 - запрос по подкатегории
            // let itemCell = null;
            switch (Object.keys(data.params).length) {
                case 1:
                    await axios.get(`${state.SITE_URI}sale/${data.params.gender}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по гендеру
                            let itemCell = response.data;

                            // Устанавливаем min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number));

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов
                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            state.catalogData = itemCell.data;

                            //Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
                    break;
                case 2:
                    await axios.get(`${state.SITE_URI}sale/${data.params.gender}/${data.params.category}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по гендеру
                            let itemCell = response.data;

                            // Устанавливаем min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number));

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов
                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            state.catalogData = itemCell.data;

                            //Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
                    break;
                case 3:
                    await axios.get(`${state.SITE_URI}sale/${data.params.gender}/${data.params.category}/${data.params.department}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по гендеру
                            let itemCell = response.data;

                            // Устанавливаем min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number));

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов
                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            state.catalogData = itemCell.data;

                            //Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
                    break;
            }
        },

        // Получаем данные по фильтрку кешу
        async showCashProductsMutate(state, data){
            // Смотрим по длинне объекта с параметрами
            // 1 - значит запрос по гендеру
            // 2 - значит запрос по категории
            // 3 - запрос по подкатегории
            // let itemCell = null;
            switch (Object.keys(data.params).length) {
                case 1:
                    await axios.get(`${state.SITE_URI}cash/${data.params.gender}/min-${data.min}/max-${data.max}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по гендеру
                            let itemCell = response.data;

                            // Устанавливаем min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number));

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов
                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            state.catalogData = itemCell.data;

                            //Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
                    break;
                case 2:
                    await axios.get(`${state.SITE_URI}cash/${data.params.gender}/${data.params.category}/min-${data.min}/max-${data.max}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по гендеру
                            let itemCell = response.data;

                            // Устанавливаем min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number));

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов
                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            state.catalogData = itemCell.data;

                            //Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
                    break;
                case 3:
                    await axios.get(`${state.SITE_URI}cash/${data.params.gender}/${data.params.category}/${data.params.department}/min-${data.min}/max-${data.max}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по гендеру
                            let itemCell = response.data;

                            // Устанавливаем min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number));

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов
                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            state.catalogData = itemCell.data;

                            //Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
                    break;
            }
        },

        // Сортинг
        async sortByActionMutate(state, data){
            let params = null;
            switch (Object.keys(data.params).length) {
                case 1:
                    params = data.params.gender + '/';
                    break;
                case 2:
                    params = data.params.gender + '/' + data.params.category;
                    break;
                case 3:
                    params = data.params.gender + '/' + data.params.category + '/' + data.params.department;
                    break;
            }
            switch (data.price) {
                case "low":
                    axios.get(`${state.SITE_URI}price-${data.price}/${params}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по категории
                            let itemCell = response.data;

                            // Устанавливаес min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number));

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов
                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            // Устанавливаем дату в стейт
                            state.catalogData = itemCell.data;

                            //Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
                    break;
                case "high":
                    axios.get(`${state.SITE_URI}price-${data.price}/${params}?page=${data.page}`)
                        .then(response => {
                            // Получаем данные для отображения товаров в каталоге по категории
                            let itemCell = response.data;

                            // Устанавливаес min и max
                            state.filterMin = itemCell.data.min;
                            state.filterMax = itemCell.data.max;

                            // Удаляем свойства из объекта
                            delete itemCell.data.min;
                            delete itemCell.data.max;

                            // Создаем массив для размеров и пушим все размеры
                            let localSize = [];
                            itemCell.data.sizes.forEach(el => localSize.push(el.sizes_number));

                            // Выбираем уникальные размеры
                            let sortSizes = new Set(localSize);
                            let totalSizes = {};

                            // Проходимся по объекту с уникальынми размерами
                            // делаем ключом каждый размер и создаем пустой массив
                            // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                            // если так, то пушим id продуктов
                            for (let i of sortSizes) {
                                totalSizes[i] = {
                                    active: false,
                                    ids: []
                                };

                                itemCell.data.sizes.forEach(el => {

                                    if (el.sizes_number === i) totalSizes[i].ids.push(el.product_id,)
                                })
                            }

                            // Устанаваливаем размеры
                            state.filterSizes = totalSizes;
                            delete itemCell.data.sizes;

                            // Устанавливаем дату в стейт
                            state.catalogData = itemCell.data;

                            //Получаем общее число товаров для пагинации
                            state.catalogDataCellCount = itemCell.total;
                        });
            }
        },

        // Получаем данные по фильтру размеры
        async showSizeProductsMutate(state, data){
            let params = null;
            switch (Object.keys(data.params).length) {
                case 1:
                    params = data.params.gender + '/';
                    break;
                case 2:
                    params = data.params.gender + '/' + data.params.category;
                    break;
                case 3:
                    params = data.params.gender + '/' + data.params.category + '/' + data.params.department;
                    break;
            }
            let queryStr = '';

            data.sizes.forEach(el => {
                queryStr +=  el[1].ids.join(', ') + ', ';
            });

            axios.get(`${state.SITE_URI}sizesIds=${queryStr}/${params}?page=${data.page}`)
                .then(response => {
                    // Получаем данные для отображения товаров в каталоге по категории
                    let itemCell = response.data;

                    // Устанавливаес min и max
                    state.filterMin = itemCell.data.min;
                    state.filterMax = itemCell.data.max;

                    // Удаляем свойства из объекта
                    delete itemCell.data.min;
                    delete itemCell.data.max;

                    // Устанавливаем дату в стейт
                    state.catalogData = itemCell.data;

                    //Получаем общее число товаров для пагинации
                    state.catalogDataCellCount = itemCell.total;
                });
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
        },
        getCatalogData({commit}, data){
            commit('getCatalogDataMutate',data);
        },
        getItemData({commit}, data){
            commit('getItemDataMutate', data);
        },
        getItemReviews({commit}, data){
            commit('getItemReviewsMutate', data);
        },
        showSaleProducts({commit}, data){
            commit('showSaleProductsMutate', data);
        },
        showCashProducts({commit}, data){
            commit('showCashProductsMutate', data);
        },
        sortByAction({commit}, data){
            commit('sortByActionMutate', data);
        },
        showSizeProducts({commit}, data){
            commit('showSizeProductsMutate', data);
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
        },
        catalogData: (state) => {
            return state.catalogData;
        },
        catalogItem: (state) => {
            return state.catalogItem;
        },
        catalogItemReview: (state) => {
            return state.catalogItemReview;
        },
        catalogItemStars: state => {
            return state.catalogItemStars;
        },
        catalogItemReviewCount: state => {
            return state.catalogItemReviewCount;
        },
        catalogDataCellCount: state => {
            return state.catalogDataCellCount;
        },
        errorQuery: state => {
            return state.errorQuery;
        },
        minMax: state => {
            return {
                min: state.filterMin,
                max: state.filterMax
            }
        },
        filterSizes: state => {
            return state.filterSizes;
        },
        menuAdmin: state => {
            return state.menuAdmin;
        }

    }
})
