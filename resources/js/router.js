import Home from './views/Home'
import Catalog from './views/Catalog'


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
    ]
}
