import Home from './views/Home'
import Catalog from './views/Catalog'
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

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Home',
            meta: { layout: 'Main'},
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
            path: '/login',
            name: 'login',
            meta: { layout: 'Main' },
            component: Login
        },
        {
            path: '/registration',
            name: 'registration',
            meta: { layout: 'Main' },
            component: Registration
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
            component: ChooseDelivery
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

    ]
}
