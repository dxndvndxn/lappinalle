import Home from './views/Home'
import Catalog from './views/Catalog'
import Catalogitem from "./views/Catalogitem";
import Contacts from "./views/Contacts";
import Pay from "./views/Pay";


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
        },
        {
            path: '/:gender/:category/:department/item-*',
            name: 'item',
            meta: { layout: 'Main' },
            component: Catalogitem
        }

    ]
}
