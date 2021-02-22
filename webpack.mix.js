const routesJSON = require('./routesJSON.json')
const mix = require('laravel-mix')
const PrerenderSpaPlugin = require('prerender-spa-plugin')
const path = require('path')
const Renderer = PrerenderSpaPlugin.PuppeteerRenderer

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({ processCssUrls: false, extractVueStyles: 'public/css/app.css' })
    .copyDirectory('resources/img', 'public/img')
    .copyDirectory('resources/fonts', 'public/fonts')
    .copyDirectory('public/css', 'public/static/css')
    .copyDirectory('public/js', 'public/static/js')
    .copyDirectory('public/img', 'public/static/img')
    .copyDirectory('public/fonts', 'public/static/fonts');

// mix.browserSync('lappinalle.test');

// routesJSON.unshift('/')
// const addHydration = html => html
//     .replace('href="../css/app.css"', 'href="../../css/app.css"')
//     .replace('src="../js/app.js"', 'src="../../js/app.js"')

// const postProcessRoute = (route) => {
//     // eslint-disable-next-line no-param-reassign
//     route.html = addHydration(route.html);
//     return route;
// };
// mix.webpackConfig({
//     plugins: [
//         new PrerenderSpaPlugin({
//             staticDir: path.join(__dirname, 'public/static'),
//             outputDir: path.join(__dirname, 'public'),
//             routes: routesJSON,
//             renderer: new Renderer({
//                 // renderAfterDocumentEvent: 'renderer-ready',
//                 renderAfterTime: 15000
//             }),
//             postProcess: postProcessRoute
//             // server: {
//             //     proxy: {
//             //         'api': {
//             //             target: 'https://lappinalle.ru/',
//             //             secure: false,
//             //             changeOrigin: true
//             //         }
//             //     }
//             // }
//         })
//     ]
// });


// ПРЕРЕНДЕРИНГ ГЛАВНОЙ
let strYa = `(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(67481440, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            ecommerce:"dataLayer"
        });`
let strGo = `window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-ZGES78VPZ0');`

// const addHydration = html => html
//     .replace('href="../css/app.css"', 'href="css/app.css"')
//     .replace('src="../js/app.js"', 'src="js/app.js"')
//     .replace('href="../img/favicon.svg"', 'href="img/favicon.svg"')
//     .replace('src="fri"', 'src="https://app.frisbie.me/api/messageus/9d3c0fc3-a9e5-45db-cac6-08d852310b77"')
//     .replace("console.log('Ya')", strYa)
//     .replace("console.log('Go')", strGo)
//     .replace('src="Go"', 'src="https://www.googletagmanager.com/gtag/js?id=G-ZGES78VPZ0"')
//
// const postProcessRoute = (route) => {
//     route.html = addHydration(route.html);
//     return route;
// };
//
// mix.webpackConfig({
//     plugins: [
//         new PrerenderSpaPlugin({
//             staticDir: path.join(__dirname, 'public/static'),
//             outputDir: path.join(__dirname, 'public'),
//             routes: ['/'],
//             renderer: new Renderer({
//                 renderAfterTime: 20000
//                 // renderAfterDocumentEvent: 'renderer-ready'
//             }),
//             postProcess: postProcessRoute,
//             server: {
//                 proxy: {
//                     'api': {
//                         target: 'https://lappinalle.ru/',
//                         secure: false,
//                         changeOrigin: true
//                     }
//                 }
//             }
//         })
//     ]
// });
