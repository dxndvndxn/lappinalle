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
import Admin from './admin/Admin';
import AdminCategories from "./admin/views/AdminCategories";
import AdminProducts from "./admin/views/AdminProducts";
import AdminMainPage from "./admin/views/AdminMainPage";
import AdminOrders from "./admin/views/AdminOrders";
import AdminUsers from "./admin/views/AdminUsers";
import AdminDelivery from "./admin/views/AdminDelivery";
import ProductCard from "./admin/views/ProductCard";
import Privacy from "./views/Privacy";
import store from "./store";
import OrderCard from "./admin/views/OrderCard";
import UserCard from "./admin/views/UserCard";
import AdminReviews from "./admin/views/AdminReviews";
import ReviewCard from "./admin/views/ReviewCard";
// export default {
//     mode: 'history',
//     routes: [
//         {
//             path: '/',
//             name: 'Home',
//             meta: {
//                 layout: 'Main',
//                 auth: undefined
//             },
//             component: Home
//         },
//         {
//             path: '/kontacty',
//             name: 'contact',
//             meta: { layout: 'Main' },
//             component: Contacts
//         },
//         {
//             path: '/oplata',
//             name: 'oplata',
//             meta: { layout: 'Main' },
//             component: Pay
//         },
//         {
//             path: '/dostavka',
//             name: 'dostavka',
//             meta: { layout: 'Main' },
//             component: Delivery
//         },
//         {
//             path: '/login',
//             name: 'login',
//             meta: {
//                 layout: 'Main',
//                 auth: false
//             },
//             component: Login
//         },
//         {
//             path: '/registration',
//             name: 'registration',
//             meta: {
//                 layout: 'Main',
//                 auth: false
//             },
//             component: Registration
//         },
//         {
//             path: '/cabinet',
//             name: 'cabinet',
//             meta: {
//                 layout: 'Main',
//                 auth: true
//             },
//             component: Cabinet
//         },
//         {
//             path: '/reset',
//             name: 'reset',
//             meta: { layout: 'Main' },
//             component: Reset
//         },
//         {
//             path: '/korzina',
//             name: 'cart',
//             meta: { layout: 'Main' },
//             component: Cart
//         },
//         {
//             path: '/oformleniezakaza',
//             name: 'ordering',
//             meta: { layout: 'Main' },
//             component: Order
//         },
//         {
//             path: '/vybordostavki',
//             name: 'chooseDelivery',
//             meta: { layout: 'Main' },
//             component: ChooseDelivery
//         },
//         {
//             path: '/vyboroplaty',
//             name: 'choosePay',
//             meta: { layout: 'Main' },
//             component: ChoosePay
//         },
//         {
//             path: '/paysuccess',
//             name: 'paySuccess',
//             meta: { layout: 'Main' },
//             component: PaySuccess
//         },
//         {
//             path: '/izbrannoe',
//             name: 'bookmark',
//             meta: { layout: 'Main' },
//             component: Bookmark
//         },
//         {
//             path: '/:gender',
//             name: 'gender',
//             meta: { layout: 'Main' },
//             component: Catalog
//         },
//         {
//             path: '/:gender/item-:number',
//             name: 'item',
//             meta: { layout: 'Main' },
//             component: Catalogitem
//         },
//         {
//             path: '/:gender/:category/item-:number',
//             name: 'item',
//             meta: { layout: 'Main' },
//             component: Catalogitem
//         },
//         {
//             path: '/:gender/:category/:department/item-:number',
//             name: 'item',
//             meta: { layout: 'Main' },
//             component: Catalogitem
//         },
//         {
//             path: '/:gender/:category',
//             name: 'category',
//             meta: { layout: 'Main' },
//             component: Catalog
//         },
//         {
//             path: '/:gender/:category/:department',
//             name: 'department',
//             meta: { layout: 'Main' },
//             component: Catalog
//         },
//
//     ]
// }
const routes = [
    {
        path: '/',
        name: 'Home',
        meta: {
            layout: 'Main',
            auth: undefined
        },
        component: Home
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
            console.log(store.getters.isLoggedIn)
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
        component: Cart
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
        component: ChoosePay
    },
    {
        path: '/paysuccess',
        name: 'paySuccess',
        meta: { layout: 'Main' },
        component: PaySuccess
    },
    {
        path: '/izbrannoe',
        name: 'bookmark',
        meta: { layout: 'Main' },
        component: Bookmark
    },
    {
        path: '/adminalle',
        name: 'admin',
        meta: { layout: 'Admin' },
        component: Admin,
        children: [
            {
                path: 'categories',
                component: AdminCategories,
                meta: { layout: 'Admin' },
                name: 'AdminCategories'
            },
            {
                path: 'products',
                component: AdminProducts,
                meta: { layout: 'Admin' },
                name: 'AdminProducts'
            },
            {
                path: 'card-:id',
                component: ProductCard,
                meta: { layout: 'Admin' },
                name: 'ProductCart',
            },
            {
                path: 'pages',
                component: AdminMainPage,
                meta: { layout: 'Admin' },
                name: 'AdminMainPage'
            },
            {
                path: 'orders',
                component: AdminOrders,
                meta: { layout: 'Admin' },
                name: 'AdminOrders'
            },
            {
                path: 'order-:id',
                component: OrderCard,
                meta: { layout: 'Admin' },
                name: 'OrderCard'
            },
            {
                path: 'users',
                component: AdminUsers,
                meta: { layout: 'Admin' },
                name: 'AdminUsers'
            },
            {
                path: 'user-:id',
                component: UserCard,
                meta: { layout: 'Admin' },
                name: 'UserCard'
            },
            {
                path: 'delivery',
                component: AdminDelivery,
                meta: { layout: 'Admin' },
                name: 'AdminDelivery'
            },
            {
                path: 'reviews',
                component: AdminReviews,
                meta: { layout: 'Admin' },
                name: 'AdminReviews'
            },
            {
                path: 'review-:id',
                component: ReviewCard,
                meta: { layout: 'Admin' },
                name: 'ReviewCard'
            }
        ]
    },
    {
        path: '/:gender',
        name: 'gender',
        meta: { layout: 'Main' },
        component: Catalog
    },
    {
        path: '/:gender/item-:number',
        name: 'item',
        meta: { layout: 'Main' },
        component: Catalogitem
    },
    {
        path: '/:gender/:category/item-:number',
        name: 'item',
        meta: { layout: 'Main' },
        component: Catalogitem
    },
    {
        path: '/:gender/:category/:department/item-:number',
        name: 'item',
        meta: { layout: 'Main' },
        component: Catalogitem
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
    },

];
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});
export default router;
