import Vue from 'vue'
import Vuex from  'vuex'
import axios from 'axios'
Vue.use(Vuex);
// const URI = 'https://lappinalle.ru/api/';
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
        GetAllDeliveries: null,

        // ГЛАВНАЯ
        GetMainPageAdmin: null
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
        },
        GetMainPageAdminMutate(state, data) {
            state.GetMainPageAdmin = data;
        }
    },
    actions: {
        AdminGetAllPrducts({commit}){
            commit('AdminGetAllPrductsMutate');
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
        },

        async GetMainPageAdmin({commit}){
            return new Promise((resolve, reject) => {
                axios.get(`${URI}mainpage`)
                    .then(resp => {
                        console.log(resp.data)
                        commit('GetMainPageAdminMutate', resp.data);
                        resolve(true)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
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
        },
        GetMainPageAdmin: state => {
            return state.GetMainPageAdmin;
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
        payId: JSON.parse(localStorage.getItem('payId') || 'false'),

        // Данные юзера
        userData: null,

        EU: null,

        // Закладки
        bookmarks: JSON.parse(localStorage.getItem('bookmark') || '[]'),
        bookmarkProducts: null,

        // Данные по доставке
        deliveryData: null,

        // результаты поиска
        searchResult: [],

        // Медиа
        tablet: 768,
        mobile: 576,
        wind: window.innerWidth
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
                            activeGen: false,
                            dataForChangeMenu: {}
                        };
                    }

                    // Пушим данным по гендарным различиям
                    for (let i in menu){

                        for (let k of genders){

                            if (k === menu[i].sex_name) {
                                gendersObj[k].push(menu[i]);
                            }

                            if (k === menu[i].sex_name && menu[i].menu_lvlmenu === 1){
                                menuForAdmin[k].dataForChangeMenu.menu_lvl = menu[i].menu_lvlmenu;
                                menuForAdmin[k].dataForChangeMenu.menu_id = menu[i].menu_id;
                                menuForAdmin[k].dataForChangeMenu.menu_sex = menu[i].sex_id;
                                menuForAdmin[k].dataForChangeMenu.menu_alias = menu[i].sex_alias;
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
                                        categories_alias: gendersObj[g][gg].categories_alias
                                    }
                                    );
                                    menuForAdmin[g][c].push({
                                        department: gendersObj[g][gg].departments_name,
                                        category: c,
                                        activeCateg: false,
                                        categories_alias: gendersObj[g][gg].categories_alias,
                                        departments_alias: gendersObj[g][gg].departments_alias,
                                        departments_id: gendersObj[g][gg].departments_id,
                                        categories_id: gendersObj[g][gg].categories_id,
                                        menu_id: gendersObj[g][gg].menu_id,
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
            let params = null;
            switch (Object.keys(data.params).length) {
                case 1:
                    params = data.params.gender + '/' + 'null' + '/' + 'null';
                    break;
                case 2:
                    params = data.params.gender + '/' + data.params.category + '/' + 'null';
                    break;
                case 3:
                    params = data.params.gender + '/' + data.params.category + '/' + data.params.department;
                    break;
            }

            await axios.get(`${state.SITE_URI}filter/${params}/${data.sort}/${data.sale}/${data.min}/${data.max}/${data.sizes}?page=${data.page}`)
                .then(response => {

                    // Получаем данные для отображения товаров в каталоге по гендеру
                    let itemCell = response.data;

                    // Устанавливаем min и max
                    state.filterMin = itemCell.min;
                    state.filterMax = itemCell.max;

                    // Удаляем свойства из объекта
                    delete itemCell.min;
                    delete itemCell.max;

                    state.EU = itemCell.eu;
                    delete itemCell.eu;

                    // Создаем массив для размеров и пушим все размеры
                    let localSize = [];
                    itemCell.sizes.forEach(el => localSize.push(el.sizes_number));

                    // Выбираем уникальные размеры
                    let sortSizes = new Set(localSize);
                    let totalSizes = {};

                    // let sizesForOneProduct = [];
                    // Проходимся по объекту с уникальынми размерами
                    // делаем ключом каждый размер и создаем пустой массив
                    // в forEach условие при котором сравниваем размеры их исходного массив с данными с i, которая является ключом из уникального объекта с размерами
                    // если так, то пушим id продуктов

                    for (let i of sortSizes) {
                        totalSizes[i] = {
                            active: false,
                            ids: []
                        };
                        itemCell.sizes.forEach(el => {

                            if (el.sizes_number === i) {
                                totalSizes[i].ids.push(el.product_id)
                            }
                        })
                    }

                    // Устанаваливаем размеры
                    state.filterSizes = totalSizes;
                    delete itemCell.sizes;

                    itemCell.myData.data.forEach(el => {
                        if (state.wind > state.tablet){
                            el.activeIconT = false;
                            el.activeIconB = false;
                        }else{
                            el.activeIconT = true
                            el.activeIconB = true;
                        }
                        el.activeTshirt = false;
                        el.activeBook = false;
                    })

                    // Устанавливаем дату в стейт
                    state.catalogData = itemCell.myData.data;

                    // Получаем общее число товаров для пагинации
                    state.catalogDataCellCount = itemCell.myData.total;
                });
        },

        // Получаем дату для конкретного товара
        getItemDataMutate(state, data){
            state.catalogItemStars = data.stars;
            state.catalogItem = data.stateItemData;
        },

        // Получаем отзывы
        async getItemReviewsMutate(state, data){
            await axios.get(`${state.SITE_URI}itemsreview-${data.item}?page=${data.page}`)
                .then(response => {
                    let reviews = response.data;

                    state.catalogItemReview = reviews.data;
                    state.catalogItemReviewCount = reviews.total
                })
                .catch(e => console.log(e))
        },

        // Добавляем товары в корзину
        addToCartMutate(state, item) {
            let found = [];
            let notFound = [];

            // Проверяем есть ли в сторадже продукты, которые добавил пользователь
            item.forEach(el => {

                // if (state.cart.find(product => (product.id === el.id && product.size === el.size))){
                //     found.push(el)
                // }else{
                //     notFound.push(el)
                // }
                if (!state.cart.find(product => (product.id === el.id && product.size === el.size))){
                    notFound.push(el)
                }
            });

            // Если есть, то проходимся по уже существующему массиву с корзиной
            // Находим данный товары и увеличиваем его кол-во
            if (found.length) {

                // Проходимся по уже существующему массиву с товарами в корзине
                // state.cart.forEach(oldProduct => {
                //
                //     // Проходимся по массиву в котором нашли совпадения с уже существующими товарами в сторадже
                //     found.forEach(newProduct => {
                //
                //         if (oldProduct.id === newProduct.id && oldProduct.size === newProduct.size){
                //             oldProduct.count++;
                //             state.countCart++;
                //         }
                //     });
                //
                // });
                // window.localStorage.setItem('cart', JSON.stringify(state.cart));
                // window.localStorage.setItem('countCart', JSON.stringify(state.countCart));
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

                    let totalDataCart = [];
                    data.forEach(el => {

                        dataCart.forEach(elCart => {

                            if (el.product_id === elCart.id) {
                                totalDataCart.push(
                                    {
                                        id: elCart.id,
                                        count: elCart.count,
                                        price: elCart.price,
                                        size: elCart.size,
                                        catalog_size_id: elCart.catalog_size_id,
                                        product_description: el.product_description,
                                        product_id: el.product_id,
                                        product_img: el.product_img,
                                        product_price: elCart.price,
                                        product_title: el.product_title
                                    })
                            }
                        })
                    });

                    state.cartProduct = totalDataCart;
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
            window.localStorage.setItem('customerData', JSON.stringify(state.customerData));
        },

        async sentDataMutate(state, payName){
            let postData = [];
            let localCart = [];

            state.cart.forEach(el => {
                localCart.push({id: el.id, count: el.count, size: el.size, price: el.price, catalog_size_id: el.catalog_size_id})
            });

            state.customerData.paymentName = payName;
            let localTotalPrice = state.totalPrice;

            if (state.deliveryData.deliveryName === 'postman' && state.totalPrice < 2000) {
               localTotalPrice = state.totalPrice + 300;
            }

            postData.push({customerData: state.customerData, deliveryData: state.deliveryData, orderData: localCart, totalPrice: localTotalPrice});

           if (payName === 'Сбербанк'){

               let dataPay = {
                   amount: localTotalPrice,
               }

               postData.push(dataPay)
               let formData = new FormData();
               formData.append('data', JSON.stringify(postData));

               await axios.post(`${state.SITE_URI}payment`, formData, {
                   headers: {
                       "Content-Type": "application/x-www-form-urlencoded"
                   }})
                   .then(res => {
                       console.log(res.data, 'НАЛИМКА БЕКЕНДЕР')
                       state.payId = res.data.id;
                       // window.localStorage.setItem('payId', JSON.stringify(state.payId))
                       // window.location = res.data.formUrl;
                    })
                   .catch(e => {
                       console.log(e)
                   })
           }
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
            state.payId = false;
            window.localStorage.removeItem('payId');
            window.localStorage.removeItem('customerData');
        },

        // Добавляем закладку
        AddBookmarkMutate(state, id){
            state.bookmarks.push(id);
            window.localStorage.setItem('bookmark', JSON.stringify(state.bookmarks));
        },

        // Получаем продукты для избранного
        async BookmarkProductsMutate(state){
            if (state.bookmarks.length) {
                await axios.get(`${state.SITE_URI}bookmark/${state.bookmarks.join(',')}`)
                    .then(res => {
                        state.EU = res.data.eu;
                        state.bookmarkProducts = res.data.products;
                    })
            }
        },

        RemoveBookmarkMutate(state, id) {
            state.bookmarks = state.bookmarks.filter(el => el !== id);
            window.localStorage.setItem('bookmark', JSON.stringify(state.bookmarks));
        },

        // Данные по доставке
        DeliveryDataMutate(state, deliveryData){
            state.deliveryData = deliveryData;
        },

        // Сменяем статус заказа
        async ChangeStatusOrderMutate(state){
            let data = [];
            let localCart = [];

            state.cart.forEach(el => {
                localCart.push({id: el.id, count: el.count, size: el.size, price: el.price})
            });
            let customerData = window.localStorage.getItem('customerData');
            data.push({customerData: JSON.parse(customerData), orderData: localCart, id: state.payId});

            let formData = new FormData();
            formData.append('data', JSON.stringify(data));

            axios.post(`${state.SITE_URI}changestatus`, formData)
                .then(res => {
                    console.log(res.data);
                    if (res.data) {
                        window.localStorage.removeItem('cart');
                        window.localStorage.removeItem('totalPrice');
                        state.countCart = 0;
                        window.localStorage.removeItem('countCart');
                        state.cartProduct = null;
                    }
                })
                .catch(e => console.log(e))
        },

        // Убиваем данные по товару
        DestroyCatalogItemMutate(state){
            state.catalogItem = null;
        },

        SearchResultMutate(state, data){
            state.searchResult = data;
        }

    },
    actions: {
        SearchProduct({commit}, word){
            return new Promise((resolve, reject) => {
                axios.post(`${URI}search`, {search: word})
                    .then(res => {
                        commit('SearchResultMutate', res.data)
                        resolve(true)
                    })
                    .catch(e => {
                        reject(false)
                    })
            })
        },
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
                        if (resp.data !== 0) {
                            const token = resp.data;
                            localStorage.setItem('token', token);
                            commit('auth_success', token);
                            resolve(resp)
                        }else{
                            reject(false)
                        }
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
            return new Promise((resolve, reject) => {
                axios.get(`${URI}item-${data}`)
                    .then((response) => {
                        let itemData = response.data;
                        console.log(itemData)
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
                        for (let el in itemData) {

                            if (el == 0) {
                                stateItemData.itemTitle = itemData[el].product_title;
                                stateItemData.itemPrice = itemData[el].product_price;
                                pics = itemData[el].product_img.split(',');
                                stateItemData.itemPics = [];
                                stateItemData.itemId = itemData[el].product_id;
                                stateItemData.itemSizes = [];
                                stateItemData.sex_alias = itemData[el].sex_alias;

                                // Пушим картинки
                                pics.forEach((img, ii) => {
                                    if (ii === 0) {
                                        stateItemData.itemPics.push({img: img, clicked: true, video: false})
                                    } else if (img !== ' ') {
                                        stateItemData.itemPics.push({img: img, clicked: false, video: false})
                                    }
                                });

                                // Если видео, то ставим его первым в массив с картинками, ставим ему ckicked true, скороее всего будет добавляться картинка как превье этого видео
                                if (itemData[el].product_video !== null) {
                                    stateItemData.itemPics[0].clicked = false;
                                    stateItemData.itemPics.unshift({video: itemData[el].product_video, clicked: true});
                                }

                                // Если sale
                                if (itemData[el].product_old_price !== null) stateItemData.oldPrice = itemData[el].product_old_price;
                                else stateItemData.oldPrice = false;

                                stateItemData.itemDesc = itemData[el].product_description;
                                stateItemData.itemPrice = itemData[el].product_price;

                                stateItemData.sizeWithoutSale = itemData[el].product_sizes_without_sale !== null ? itemData[el].product_sizes_without_sale.split(',') : [];
                            } else if (el === 'stars') {

                                itemData[el].forEach(element => {
                                    stars[element.reviews_star].push(element.reviews_star)
                                });
                            } else if (el === 'sizes') {

                                itemData[el].forEach(element => {
                                    stateItemData.itemSizes.push({sz: element.sizes_number, active: false, catalog_size_id: element.catalog_size_id})
                                });
                            }
                        }
                        stateItemData.relatedProducts = itemData.relatedProducts;
                        stateItemData.eu = itemData.eu;
                        commit('getItemDataMutate', {stars: stars, stateItemData: stateItemData});
                        resolve(true);
                    }).catch(errors => {
                        reject(false)
                        console.log(errors)
                    })
            })
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
        sentData({commit}, payName){
            commit('sentDataMutate', payName);
        },
        GetUserData({commit}){
            commit('GetUserDataMutate');
        },
        killPaySuccess({commit}){
            commit('killPaySuccessMutate');
        },
        AddBookmark({commit}, id){
            commit('AddBookmarkMutate', id)
        },
        BookmarkProducts({commit}){
            commit('BookmarkProductsMutate');
        },
        RemoveBookmark({commit}, id){
            commit('RemoveBookmarkMutate', id);
        },
        DeliveryData({commit}, deliveryData){
            return new Promise((resolve, reject) => {
                commit('DeliveryDataMutate', deliveryData);
                resolve(true)
            })
        },
        ChangeStatusOrder({commit}){
            commit('ChangeStatusOrderMutate');
        },
        DestroyCatalogItem({commit}){
            commit('DestroyCatalogItemMutate');
        },
        CheckAmount({commit}, check){
            return new Promise((resolve, reject) => {
                let formData = new FormData;
                formData.append('data', JSON.stringify(check));
                axios.post(`${URI}check-amount-catalog_size_id`, formData)
                    .then(res => {
                        resolve(res.data)
                    })
                    .catch(e => console.log(e))
            })
        }
    },
    getters:{
        // Оплата товара успех или нет
        payId: state => {
            return state.payId;
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
        },
        media: state => {
            return {
                tablet: state.tablet,
                mobile: state.mobile,
                wind: state.wind
            }
        },
        bookmarks: state => {
            return state.bookmarks;
        },
        bookmarkProducts: state => {
            return state.bookmarkProducts;
        },
        deliveryData: state => {
            return state.deliveryData;
        },
        searchResult: state => {
            return state.searchResult;
        }

    },
}
export default new Vuex.Store({
    modules: {
        store, admin
    }
})
