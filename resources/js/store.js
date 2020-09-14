import Vue from 'vue'
import Vuex from  'vuex'
import axios from 'axios'
Vue.use(Vuex);
const URI = 'http://lappinalle.test/api/';
const admin = {
    state: () => ({
        SITE_URI: URI,
        adminProducts: null,
        adminRawMenu: null,

        // Данные по новому товару со страницы Продукты
        dataFromProductsPage: null,

        // Данные по размеру
        allSizes: null,

        // Получить один товар
        oneProduct: null,
        productSuccess: false,

        //ЗАКАЗЫ
        GetAllOrders: null,
        oneOrder: null,

        // ЮЗЕРЫ
        GetAllUsers: null,
        GetOneUser: null,

        // ОТЗЫВЫ
        GetAllReviews: null,
        GetOneReview: null,

        // ДОСТАВКА
        GetAllDeliveries: null
    }),
    mutations: {
        // Получаем все товары СТРАНИЧКА ТОВАРЫ
        async AdminGetAllPrductsMutate(state){
           await axios.get(`${state.SITE_URI}adminallproducts`)
                .then(response => {
                    let resultArr = [];
                    for (let data in response.data){
                        resultArr.push(response.data[data])
                    }
                    state.adminProducts = resultArr;
                    console.log(state.adminProducts)
                }).catch(e => console.log(e))
        },

        // Отправлем данные о новоном товаре на сервер
        async SentDataToBackendMutate(state, data){
            let formData = new FormData();
            formData.append('video', data.video);

            let i = 0;
            for (let img of data.imgs) {
                i++;
                formData.append(`img-${i}`, img);
            }

            let stringData = {
                description: data.description,
                price: data.price,
                sale: data.sale,
                sizes: data.sizes,
                amountWithoutSizes: data.amountWithoutSizes
            };

            formData.append('stringData', JSON.stringify(stringData));

           await axios.post(`${state.SITE_URI}addproduct`,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                )
                .then(success => {
                    state.productSuccess = success.data;
                })
                .catch(err => {
                    state.productSuccess = err.data;
                    console.log(err)
                })
        },

        // Получаем все размеры для нового товара
       async GetAllSizesMutate(state){
            await axios.get(`${state.SITE_URI}adminallsizes`)
                .then(response => {
                    state.allSizes = response.data;
                })
                .catch(e => {
                    console.log(e)
                })
        },
       // Получаем данные по конкретному товару
       async GetOneProductMutate(state, id){
            await axios.get(`${state.SITE_URI}admin-product-${id}`)
                .then(res => {
                    state.oneProduct = res.data;
                })
                .catch(e => console.log(e))
       },

       async GetAllOrdersMutate(state){
            await axios.get(`${state.SITE_URI}admorders`)
                .then(res => {
                    console.log(res.data)
                    state.GetAllOrders = res.data;
                })
                .catch(e => console.log(e))
        },
       GetOneOrderMutate(state, data){
            state.oneOrder = data;
       },
       GetAllUsersMutate(state, data){
            state.GetAllUsers = data;
       },
        GetOneUserMutate(state, data){
            state.GetOneUser = data;
        },
        GetAllReviewsMutate(state, data){
            state.GetAllReviews = data;
        },
        GetOneReviewMutate(state, data) {
            state.GetOneReview = data;
        },
        GetAllDeliveriesMutate(state, data){
            state.GetAllDeliveries = data;
        }
    },
    actions: {
        AdminGetAllPrducts({commit}){
            commit('AdminGetAllPrductsMutate');
        },
        SentDataToBackend({commit}, data){
            commit('SentDataToBackendMutate', data);
        },
        GetAllSizes({commit}){
            commit('GetAllSizesMutate');
        },
        GetOneProduct({commit}, data){
            commit('GetOneProductMutate', data);
        },
        GetAllOrders({commit}){
            commit('GetAllOrdersMutate');
        },
        async GetOneOrder({commit}, id){
            let formData = new FormData();
            formData.append('id', JSON.stringify(id.id));
            await axios.post(`${URI}admorder`, formData)
                .then(res => {
                    commit('GetOneOrderMutate', res.data)
                })
                .catch(e => console.log(e))
        },
        async GetAllUsers({commit}){
            await axios.get(`${URI}adminusers`)
                .then(res => {
                    commit('GetAllUsersMutate', res.data);
                })
        },
        async GetOneUser({commit}, data){
            await axios.post(`${URI}lkadm`, data)
                .then(res => {
                    commit('GetOneUserMutate', res.data);
                })
                .catch(e => console.log(e))
        },
        async GetAllReviews({commit}){
            await axios.get(`${URI}allrev`)
                .then(res => {
                    commit('GetAllReviewsMutate', res.data)
                })
                .catch(e => console.log(e))
        },
        async GetOneReview({commit}, id){
            await axios.get(`${URI}revcard-${id}`)
                .then(res => {
                    commit('GetOneReviewMutate', res.data);
                    console.log(res.data);
                })
                .catch(e => console.log(e))
        },
        async GetAllDeliveries({commit}){
            await axios.get(`${URI}delsite`)
                .then(res => {
                    commit('GetAllDeliveriesMutate', res.data);
                    console.log(res.data)
                })
                .catch(e => console.log(e))
        }
    },
    getters: {
        GetAllOrders: state => {
          return state.GetAllOrders;
        },
        adminProducts: state => {
            return state.adminProducts;
        },
        getAllSizes: state => {
            return state.allSizes;
        },
        productSuccess: state => {
            return state.productSuccess;
        },
        URI: state => {
            return state.SITE_URI;
        },
        oneProduct: state => {
            return state.oneProduct;
        },
        oneOrder: state => {
            return state.oneOrder;
        },
        GetAllUsers: state => {
            return state.GetAllUsers;
        },
        GetOneUser: state => {
            return state.GetOneUser;
        },
        GetAllReviews: state => {
            return state.GetAllReviews;
        },
        GetOneReview: state => {
            return state.GetOneReview;
        },
        GetAllDeliveries: state => {
            return state.GetAllDeliveries;
        }
    }
};
const store = {
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
        SITE_URI: URI,

        token: localStorage.getItem('token') || null,

        // Корзина
        cart: JSON.parse(localStorage.getItem('cart') || '[]'),
        countCart: JSON.parse(localStorage.getItem('countCart') || '0'),
        cartProduct: null,
        updatedCart: {
            cart: null,
            cartCount: null
        },
        totalPrice: JSON.parse(localStorage.getItem('totalPrice') || '0'),
        customerData: [],

        // Админ
        adminRawMenu: null,

        // Оплата товара
        paySuccess: false,

        // Данные юзера
        userData: null,

        EU: null
    },
    mutations: {
        // Регистрация
        auth_success(state, token){
            state.status = true;
            state.token = token;
        },
        auth_error(state){
            state.status = false;
        },
        // Получаем категории и подкатегории меню
        async getMenuDataMutate(state){
            await axios.get(`${state.SITE_URI}menu`)
                .then(response => {
                    // массив с изначальной датой
                    let menu = response.data;

                    // Сырые данные меню
                    state.adminRawMenu = menu;

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

                        if (menu[i].menu_lvlmenu === 1) {
                            topMenuGenders.push({
                                title: menu[i].sex_name,
                                url: menu[i].sex_alias,
                                hover: false
                            })
                        }

                        if (menu[i].sex_name === null) continue;

                        listGenders.push(menu[i].sex_name);

                        if (menu[i].categories_name === null) continue;

                        listCategories.push(menu[i].categories_name);
                        categoryAlias[menu[i].categories_alias] = menu[i].categories_name;

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
                                    if (menu[m].categories_alias === categ){
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
                                    if (menu[m].categories_alias === categ){

                                        // Разбираем подкатегории
                                        for (let depart in departmentAlias) {

                                            sideBar[i][categ].show_category = true;

                                            // Если подкатегории алиас = подкатегориям алиас из главной даты
                                            if (menu[m].departments_alias === depart) {

                                                // Записываем эти подкатегории
                                                sideBar[i][categ].departments = [];
                                                sideBar[i][categ].category_alias = menu[m].categories_alias;
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
                                    if (menu[m].categories_alias === categ){

                                        // Разбираем подкатегории
                                        for (let depart in departmentAlias) {

                                            sideBar[i][categ].show_category = true;

                                            // Если подкатегории алиас = подкатегориям алиас из главной даты
                                            if (menu[m].departments_alias === depart) {

                                                sideBar[i][categ].departments.push({depart_name: departmentAlias[depart], depart_alias: depart, depart_show: false});
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

                                if (c === gendersObj[g][gg].categories_name && gendersObj[g][gg].sex_name === g) {
                                    lastMenu[g][c].push({
                                        department: gendersObj[g][gg].departments_name,
                                        departments_alias: gendersObj[g][gg].departments_alias,
                                        category: c,
                                        hover: false,
                                        sex_alias: gendersObj[g][gg].sex_alias,
                                        categories_alias: gendersObj[g][gg].categories_alias}
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
                            state.EU = itemCell.data.eu;
                            delete itemCell.data.eu;

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
                            state.EU = itemCell.data.eu;
                            delete itemCell.data.eu;

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
                            state.EU = itemCell.data.eu;
                            delete itemCell.data.eu;

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
            await axios.get(`${state.SITE_URI}item-${data}`)
                .then(async (response) => {
                    let itemData = await response.data;
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
                            stateItemData.itemId = itemData[el].product_id;
                            stateItemData.itemSizes = [];

                            // Пушим картинки
                            pics.forEach((img, ii) => {
                                if (ii === 0) {
                                    stateItemData.itemPics.push({img: img, clicked: true, video: false})
                                } else if(img !== ' ') {
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

                        }
                        else if (el === 'stars'){

                            itemData[el].forEach(element => {
                                stars[element.reviews_star].push(element.reviews_star)
                            });
                        }
                        else if (el === 'sizes'){

                            itemData[el].forEach(element => {
                                stateItemData.itemSizes.push({sz: element.sizes_number, active: false})
                            });
                        }
                    }

                    state.catalogItemStars = stars;
                    state.catalogItem = stateItemData;
                }).catch(errors => console.log(errors))
        },

        // Получаем отзывы
        async getItemReviewsMutate(state, data){
            await axios.get(`${state.SITE_URI}itemsreview-${data.item}?page=${data.page}`)
                .then(response => {
                    let reviews = response.data;
                    console.log(reviews)
                    state.catalogItemReview = reviews.data;
                    state.catalogItemReviewCount = reviews.total
                })
                .catch(e => console.log(e))
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
                            state.EU = itemCell.data.eu;
                            delete itemCell.data.eu;

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
                            state.EU = itemCell.data.eu;
                            delete itemCell.data.eu;
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
                            state.EU = itemCell.data.eu;
                            delete itemCell.data.eu;
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
                            state.EU = itemCell.data.eu;
                            delete itemCell.data.eu;
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
                            state.EU = itemCell.data.eu;
                            delete itemCell.data.eu;

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
                    state.EU = itemCell.data.eu;
                    delete itemCell.data.eu;

                    // Устанавливаем дату в стейт
                    state.catalogData = itemCell.data;

                    //Получаем общее число товаров для пагинации
                    state.catalogDataCellCount = itemCell.total;
                });
        },

        // Добавляем товары в корзину
        addToCartMutate(state, item) {
            let found = [];
            let notFound = [];

            // Проверяем есть ли в сторадже продукты, которые добавил пользователь
            item.forEach(el => {

                if (state.cart.find(product => (product.id === el.id && product.size === el.size))){
                    found.push(el)
                }else{
                    notFound.push(el)
                }
            });

            // Если есть, то проходимся по уже существующему массиву с корзиной
            // Находим данный товары и увеличиваем его кол-во
            if (found.length) {

                // Проходимся по уже существующему массиву с товарами в корзине
                state.cart.forEach(oldProduct => {

                    // Проходимся по массиву в котором нашли совпадения с уже существующими товарами в сторадже
                    found.forEach(newProduct => {
                        if (oldProduct.id === newProduct.id && oldProduct.size === newProduct.size){
                            oldProduct.count++;
                            state.countCart++;
                        }
                    });

                });
                window.localStorage.setItem('cart', JSON.stringify(state.cart));
                window.localStorage.setItem('countCart', JSON.stringify(state.countCart));
            }
            // Если не нашли совпадения в сторадже, то просто добавляем новые
            if(notFound.length){

                notFound.forEach(el => {
                    state.countCart++;
                    state.cart.push(el)
                });

                window.localStorage.setItem('cart', JSON.stringify(state.cart));
                window.localStorage.setItem('countCart', JSON.stringify(state.countCart));
            }
        },

        // Получаем товары для корзины
        async getProductForCartMutate(state){
            let cardIds = [];

            state.cart.forEach(el => {
                cardIds.push(el.id);
            });

            let unigIds = new Set(cardIds);
                        await axios.get(`${state.SITE_URI}itemscard/${Array.from(unigIds).join(', ')}`)
                .then(response => {

                    let dataCart = state.cart;
                    let data = response.data;

                    data.forEach(el => {
                        el.product_img = el.product_img.split(', ');
                        el.product_img = el.product_img[0];
                    });

                    // Проходимся по данным, которые пришли и ищем совпадения по id и вставляем нашу в корзину
                    // dataCart.forEach(el => {
                    //
                    //     data.forEach(crEl => {
                    //
                    //         if (el.id === crEl.product_id) {
                    //             el.totalCartData = crEl;
                    //         }
                    //         // try{
                    //         //     crEl.product_img = crEl.product_img.split(', ');
                    //         // }catch (e) {
                    //         //     console.log(e)
                    //         // }
                    //
                    //     });
                    // });
                    data.forEach(el => {

                        dataCart.forEach(elCart => {

                            if (el.product_id === elCart.id) {

                                el.id = elCart.id;
                                el.count = elCart.count;
                                el.size = elCart.size;
                                el.price = elCart.price;
                            }
                        })
                    });
                    console.log(data)
                    state.cartProduct = data;
                })
                .catch(e => {
                    console.log(e)
                })
        },

        // Удаляем карточку товара
        removeCardMutate(state, data){

            // Находим в карточке тоавара нужный размер и id и удалаяем
            state.cartProduct.forEach((el, i) => {
                if (el.id === data.id && el.size === data.size) state.cartProduct.splice(i, 1);
            });

            // Находим в карточке тоавара нужный размер и id и удалаяем из localstorage
            state.cart.forEach((el, i) => {
                if (el.id === data.id && el.size === data.size) state.cart.splice(i, 1);
            });

            // Уменьшаем кол-во товара
            if (state.countCart != 0) state.countCart = state.countCart - data.count;

            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('countCart', JSON.stringify(state.countCart));

            state.updatedCart.cart = state.cartProduct;
            state.updatedCart.cartCount = state.countCart;
        },

        totalPriceMutate(state, data){
            state.totalPrice = data;
            window.localStorage.setItem('totalPrice', JSON.stringify(state.totalPrice));
        },

        changeCountCartMutate(state, data){
            // Находим в карточке тоавара нужный размер и id и увеличиваем кол-во
            state.cartProduct.forEach((el, i) => {
                if (el.id === data.id && el.size === data.size) el.count += data.count;
            });

            state.cart.forEach((el, i) => {
                if (el.id === data.id && el.size === data.size) el.count += data.count;
            });

            state.countCart += data.count;
            state.updatedCart.cart = state.cartProduct;
            state.updatedCart.cartCount = state.countCart;

            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('countCart', JSON.stringify(state.countCart));
        },

        customerDataMutate(state, data){
            data.token = state.token;
            state.customerData = data;
        },

        sentDataMutate(state, data){
            let postData = [];
            let localCart = [];

            state.cart.forEach(el => {
                localCart.push({id: el.id, count: el.count, size: el.size, price: el.price})
            });
            console.log(state.customerData)
            // Изменить orderDataMutate, чтобы customerData обновлялась, а не пушилась в массив
            postData.push({customerData: state.customerData, deliveryData: data, orderData: localCart, totalPrice: state.totalPrice});
            axios.post(`${state.SITE_URI}order`, postData)
                .then(response => {
                    state.paySuccess = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },

        GetUserDataMutate(state){
            if (state.token !== null){
                let formData = new FormData();
                formData.append('token', JSON.stringify(state.token));
                axios.post(`${state.SITE_URI}lkind`, formData)
                    .then(res => {
                        console.log(res.data)
                        state.userData = res.data;
                    }).catch(e => console.log(e))
            }
        },

        killPaySuccessMutate(state){
            state.paySuccess = false;
        }
    },
    actions: {
        register({commit}, user){
            return new Promise((resolve, reject) => {
                axios({url: `${URI}register`, data: user, method: 'POST' })
                    .then(resp => {
                        const token = resp.data;
                        localStorage.setItem('token', token);
                        commit('auth_success', token);
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error', err);
                        localStorage.removeItem('token');
                        reject(err)
                    })
            })
        },
        login({commit}, user){
            return new Promise((resolve, reject) => {
                axios({url: `${URI}login`, data: user, method: 'POST' })
                    .then(resp => {
                        const token = resp.data;
                        localStorage.setItem('token', token);
                        commit('auth_success', token);
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error');
                        localStorage.removeItem('token');
                        reject(err)
                    })
            })
        },
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
        },
        addToCart({commit}, data){
            commit('addToCartMutate', data);
        },
        getProductForCart({commit}){
            commit('getProductForCartMutate');
        },
        removeCard({commit}, data){
            commit('removeCardMutate', data);
        },
        totalPrice({commit}, data){
            commit('totalPriceMutate', data);
        },
        changeCountCart({commit}, data){
            commit('changeCountCartMutate', data);
        },
        customerData({commit}, data){
            commit('customerDataMutate', data);
        },
        sentData({commit}, data){
            commit('sentDataMutate', data);
        },
        GetUserData({commit}){
            commit('GetUserDataMutate');
        },
        killPaySuccess({commit}){
            commit('killPaySuccessMutate');
        }
    },
    getters:{
        // Оплата товара успех или нет
        paySuccess: state => {
            return state.paySuccess;
        },
        // Регистрация
        isLoggedIn: state => {
            if (state.token !== null){
                return true;
            }else{
                return false
            }
        },
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
        },
        countCart: state => {
            return state.countCart;
        },
        cart: state => {
            return state.cart;
        },
        cartProduct: state => {
            return state.cartProduct;
        },
        updatedCart: state => {
            return state.updatedCart;
        },
        totalPrice: state => {
            return state.totalPrice;
        },
        customerData: state => {
            return state.customerData;
        },
        adminRawMenu: state => {
            return state.adminRawMenu;
        },
        userData: state => {
            return state.userData;
        },
        EU: state => {
            return state.EU;
        }

    },
}
export default new Vuex.Store({
    modules: {
        store, admin
    }
})
