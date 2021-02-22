import VueRouter from 'vue-router';
import Home from './views/Home';
import Catalog from './views/Catalog';
import Catalogitem from "./views/Catalogitem";
import Contacts from "./views/Contacts";
import Pay from "./views/Pay";
import Delivery from "./views/Delivery";
import Login from "./views/Login";
import Registration from "./views/Registration";
import Reset from "./views/Reset";
import Cart from "./views/Cart";
import Order from "./views/Order";
import ChooseDelivery from "./views/ChooseDelivery";
import ChoosePay from "./views/ChoosePay";
import PaySuccess from "./views/PaySuccess";
import Bookmark from "./views/Bookmark";
import Cabinet from "./views/Cabinet";
import AboutBrand from "./views/AboutBrand";
import AboutTech from "./views/AboutTech";
import Admin from './admin/Admin';
import AdminCategories from "./admin/views/AdminCategories";
import AdminProducts from "./admin/views/AdminProducts";
import AdminMainPage from "./admin/views/AdminMainPage";
import AdminOrders from "./admin/views/AdminOrders";
import AdminUsers from "./admin/views/AdminUsers";
import AdminDelivery from "./admin/views/AdminDelivery";
import ProductCard from "./admin/views/ProductCard";
import Privacy from "./views/Privacy";
import ReturnProduct from "./views/ReturnProduct";
import store from "./store";
import OrderCard from "./admin/views/OrderCard";
import UserCard from "./admin/views/UserCard";
import AdminReviews from "./admin/views/AdminReviews";
import ReviewCard from "./admin/views/ReviewCard";
import PayFail from "./views/PayFail";
import Searching from "./views/Searching";
import AdminNewSizes from "./admin/views/AdminNewSizes";
import UserAccept from "./views/UserAccept";
import AdminNewBrand from "./admin/views/AdminNewBrand";

const routes = [
    {
        path: '/',
        name: 'Home',
        meta: {
            layout: 'Main'
        },
        component: Home,
        beforeEnter: ((to, from, next) => {
             if (store.getters.GetMainPageAdmin === null) {
                 store.dispatch('GetMainPageAdmin')
                     .then(res => {
                         if (res) next();
                     })
                     .catch(e => {
                         console.log(e)
                     })
             }else{
                 next()
             }
        })
    },
    {
        path: '/kontacty',
        name: 'contact',
        meta: { layout: 'Main' },
        component: Contacts
    },
    {
        path: '/oplata',
        name: 'oplata',
        meta: { layout: 'Main' },
        component: Pay
    },
    {
        path: '/dostavka',
        name: 'dostavka',
        meta: { layout: 'Main' },
        component: Delivery
    },
    {
        path: '/privacy',
        name: 'privacy',
        meta: { layout: 'Main' },
        component: Privacy
    },
    {
        path: '/login',
        name: 'login',
        meta: {
            layout: 'Main'
        },
        component: Login,
        beforeEnter: ((to, from, next) =>{
            if (store.getters.isLoggedIn){
                next({name: 'cabinet'});
            }else {
                next();
            }
        })
    },
    {
        path: '/registration',
        name: 'registration',
        meta: {
            layout: 'Main'
        },
        component: Registration
    },
    {
        path: '/cabinet',
        name: 'cabinet',
        meta: {
            layout: 'Main',
            requiresAuth: true
        },
        component: Cabinet,
        beforeEnter: ((to, from, next) =>{
            if(to.matched.some(record => record.meta.requiresAuth)) {
                if (store.getters.isLoggedIn) {
                    next();
                    return
                }
                next('/login')
            } else {
                next()
            }
        })
    },
    {
        path: '/reset',
        name: 'reset',
        meta: { layout: 'Main' },
        component: Reset
    },
    {
        path: '/korzina',
        name: 'cart',
        meta: { layout: 'Main' },
        component: Cart,
        beforeEnter: ((to, from, next) =>{
            if (store.getters.cart.length){
                store.dispatch('getProductForCart')
                    .then(res => {
                        if (res) next();
                    })
            }else {
                next();
            }
        })
    },
    {
        path: '/oformleniezakaza',
        name: 'ordering',
        meta: { layout: 'Main' },
        component: Order
    },
    {
        path: '/vybordostavki',
        name: 'chooseDelivery',
        meta: { layout: 'Main' },
        component: ChooseDelivery,
        beforeEnter: ((to, from, next) =>{
            if (to.name === 'chooseDelivery' && store.getters.customerData.length === 0){
                next({name: 'ordering'});
            } else {
                next();
            }
        })
    },
    {
        path: '/vyboroplaty',
        name: 'choosePay',
        meta: { layout: 'Main' },
        component: ChoosePay,
        beforeEnter: ((to, from, next) =>{
            if (to.name === 'choosePay' && (store.getters.deliveryData === null && store.getters.customerData.length === 0)){
                next({name: 'ordering'});
            } else {
                next();
            }
        })
    },
    {
        path: '/paysuccess',
        name: 'paySuccess',
        meta: { layout: 'Main' },
        component: PaySuccess,
        beforeEnter: ((to, from, next) =>{
            if (to.name === 'paySuccess' && store.getters.payId === false){
                next({name: 'Home'});
            } else {
                next();
            }
        })
    },
    {
        path: '/payfail',
        name: 'PayFail',
        meta: { layout: 'Main' },
        component: PayFail
    },
    {
        path: '/izbrannoe',
        name: 'bookmark',
        meta: { layout: 'Main' },
        component: Bookmark
    },
    {
        path: '/returnproduct',
        name: 'ReturnProduct',
        meta: { layout: 'Main' },
        component: ReturnProduct
    },
    {
        path: '/aboutbrand',
        name: 'AboutBrand',
        meta: { layout: 'Main' },
        component: AboutBrand
    },
    {
        path: '/abouttech',
        name: 'AboutTech',
        meta: { layout: 'Main' },
        component: AboutTech
    },
    {
        path: '/useraccept',
        name: 'UserAccept',
        meta: { layout: 'Main' },
        component: UserAccept
    },
    {
        path: '/searching',
        name: 'searching',
        meta: { layout: 'Main' },
        component: Searching
    },
    {
        path: '/adminalle',
        name: 'admin',
        meta: { layout: 'LoginAdmin'},
        component: Admin,
        children: [
            {
                path: 'categories',
                component: AdminCategories,
                meta: { layout: 'Admin' },
                name: 'AdminCategories',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa)
                            .then((res) => {
                                next()
                            })
                            .catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'products',
                component: AdminProducts,
                meta: { layout: 'Admin' },
                name: 'AdminProducts',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'card-:id',
                component: ProductCard,
                meta: { layout: 'Admin' },
                name: 'ProductCart',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'pages',
                component: AdminMainPage,
                meta: { layout: 'Admin' },
                name: 'AdminMainPage',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'orders',
                component: AdminOrders,
                meta: { layout: 'Admin' },
                name: 'AdminOrders',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'order-:id',
                component: OrderCard,
                meta: { layout: 'Admin' },
                name: 'OrderCard',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'users',
                component: AdminUsers,
                meta: { layout: 'Admin' },
                name: 'AdminUsers',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'user-:id',
                component: UserCard,
                meta: { layout: 'Admin' },
                name: 'UserCard',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'delivery',
                component: AdminDelivery,
                meta: { layout: 'Admin' },
                name: 'AdminDelivery',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'reviews',
                component: AdminReviews,
                meta: { layout: 'Admin' },
                name: 'AdminReviews',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'review-:id',
                component: ReviewCard,
                meta: { layout: 'Admin' },
                name: 'ReviewCard',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'newsizes',
                component: AdminNewSizes,
                meta: { layout: 'Admin' },
                name: 'AdminNewSizes',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            },
            {
                path: 'newbrands',
                component: AdminNewBrand,
                meta: { layout: 'Admin' },
                name: 'AdminNewBrand',
                beforeEnter: ((to, from, next) => {
                    if(to.matched.some(record => record.meta.layout === 'Admin' && store.getters.mamakusa !== null)) {
                        store.dispatch('CheckMamaSe', store.getters.mamakusa).then(() => next()).catch(e => console.log(e))
                    }else{
                        next('/adminalle')
                    }
                })
            }
        ],
    },
    {
        path: '/:gender/item-:number',
        name: 'item',
        meta: { layout: 'Main' },
        component: Catalogitem,
        beforeEnter: ((to, from, next) => {
            store.dispatch('getItemData', to.params.number)
                .then(res => {
                    if (res) next();
                })
        })

    },
    {
        path: '/:gender/:category/item-:number',
        name: 'item',
        meta: { layout: 'Main' },
        component: Catalogitem,
        beforeEnter: ((to, from, next) => {
            store.dispatch('getItemData', to.params.number)
                .then(res => {
                    if (res) next();
                })
        })
    },
    {
        path: '/:gender/:category/:department/item-:number',
        name: 'item',
        meta: { layout: 'Main' },
        component: Catalogitem,
        beforeEnter: ((to, from, next) => {
            store.dispatch('getItemData', to.params.number)
                .then(res => {
                    if (res) next();
                })
        })
    },
    {
        path: '/:gender',
        name: 'gender',
        meta: { layout: 'Main' },
        component: Catalog
    },
    {
        path: '/:gender/:category',
        name: 'category',
        meta: { layout: 'Main' },
        component: Catalog
    },
    {
        path: '/:gender/:category/:department',
        name: 'department',
        meta: { layout: 'Main' },
        component: Catalog
    }

];
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
    scrollBehavior: (to, from, savedPosition) => {
        document.getElementById('app').scrollIntoView();
    }
});
export default router;
