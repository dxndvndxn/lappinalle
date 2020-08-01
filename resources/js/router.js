import Home from './views/Home'
import Boys from './views/Boys'
import Girls from './views/Girls'


export default {
    mode: 'history',
    routes: [{
        path: '/',
        meta: { layout: 'Main'},
        component: Home
    },
    {
        path: '/malchiki',
        meta: { layout: 'Main'},
        component: Boys
    },
    {
        path: '/devochki',
        meta: { layout: 'Main'},
        component: Girls
    }
    ]
}