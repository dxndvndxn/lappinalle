<template>
    <div>
        <div class="wrap-bread">
            <div class="bread container" :id="'sorting'">
                <div></div>
                <Breadcrumbs v-if="media.wind > media.tablet"/>
                <div class="sort">
                    <form>
                        <label for="sort">Сортировать</label>
                        <select name="sort" id="sort" @change="selectSort()" v-model="selected">
                            <option v-for="(sort, s) in sortBy" v-bind:value="sort.value" :key="s">
                                {{sort.value}}
                            </option>
                        </select>
                    </form>
                </div>
                <div class="filter-icon" v-if="media.wind <= media.tablet" @click="showSidebar = !showSidebar">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.2309 3.63636H6.154C5.94998 3.63636 5.75433 3.54058 5.61007 3.37009C5.46581 3.19961 5.38477 2.96837 5.38477 2.72727C5.38477 2.48616 5.46581 2.25493 5.61007 2.08444C5.75433 1.91396 5.94998 1.81818 6.154 1.81818H19.2309C19.4349 1.81818 19.6306 1.91396 19.7749 2.08444C19.9191 2.25493 20.0002 2.48616 20.0002 2.72727C20.0002 2.96837 19.9191 3.19961 19.7749 3.37009C19.6306 3.54058 19.4349 3.63636 19.2309 3.63636Z" fill="white"/>
                        <path d="M3.07693 3.63636H0.769232C0.565219 3.63636 0.369562 3.54058 0.225303 3.37009C0.0810438 3.19961 0 2.96837 0 2.72727C0 2.48616 0.0810438 2.25493 0.225303 2.08444C0.369562 1.91396 0.565219 1.81818 0.769232 1.81818H3.07693C3.28094 1.81818 3.4766 1.91396 3.62086 2.08444C3.76512 2.25493 3.84616 2.48616 3.84616 2.72727C3.84616 2.96837 3.76512 3.19961 3.62086 3.37009C3.4766 3.54058 3.28094 3.63636 3.07693 3.63636Z" fill="white"/>
                        <path d="M13.8462 10.9091H0.769231C0.565218 10.9091 0.369561 10.8133 0.225302 10.6429C0.0810437 10.4724 0 10.2411 0 10C0 9.75892 0.0810437 9.52769 0.225302 9.35721C0.369561 9.18672 0.565218 9.09094 0.769231 9.09094H13.8462C14.0502 9.09094 14.2458 9.18672 14.3901 9.35721C14.5343 9.52769 14.6154 9.75892 14.6154 10C14.6154 10.2411 14.5343 10.4724 14.3901 10.6429C14.2458 10.8133 14.0502 10.9091 13.8462 10.9091Z" fill="white"/>
                        <path d="M6.15384 18.1819H0.769229C0.565217 18.1819 0.369561 18.0861 0.225302 17.9156C0.0810436 17.7451 0 17.5139 0 17.2728C0 17.0317 0.0810436 16.8004 0.225302 16.6299C0.369561 16.4595 0.565217 16.3637 0.769229 16.3637H6.15384C6.35785 16.3637 6.5535 16.4595 6.69776 16.6299C6.84202 16.8004 6.92307 17.0317 6.92307 17.2728C6.92307 17.5139 6.84202 17.7451 6.69776 17.9156C6.5535 18.0861 6.35785 18.1819 6.15384 18.1819Z" fill="white"/>
                        <path d="M4.61537 5.45454C4.15895 5.45454 3.71278 5.29459 3.33329 4.99491C2.95379 4.69524 2.65801 4.2693 2.48334 3.77095C2.30868 3.27261 2.26298 2.72425 2.35202 2.19521C2.44106 1.66617 2.66085 1.18022 2.98359 0.7988C3.30632 0.417384 3.71751 0.157637 4.16516 0.052405C4.61281 -0.0528274 5.07681 0.00118169 5.49849 0.207602C5.92016 0.414023 6.28058 0.763584 6.53415 1.21208C6.78772 1.66058 6.92307 2.18787 6.92307 2.72727C6.92307 3.45059 6.67993 4.14428 6.24716 4.65574C5.81438 5.1672 5.22741 5.45454 4.61537 5.45454ZM4.61537 1.81818C4.46323 1.81818 4.31451 1.8715 4.18801 1.97139C4.06151 2.07128 3.96292 2.21326 3.9047 2.37938C3.84647 2.54549 3.83124 2.72828 3.86092 2.90463C3.8906 3.08097 3.96387 3.24296 4.07144 3.37009C4.17902 3.49723 4.31609 3.58382 4.4653 3.61889C4.61452 3.65397 4.76919 3.63597 4.90974 3.56716C5.0503 3.49835 5.17044 3.38183 5.25496 3.23233C5.33949 3.08284 5.3846 2.90707 5.3846 2.72727C5.3846 2.48617 5.30356 2.25493 5.1593 2.08445C5.01504 1.91396 4.81939 1.81818 4.61537 1.81818Z" fill="white"/>
                        <path d="M15.3846 12.7273C14.9282 12.7273 14.482 12.5673 14.1025 12.2676C13.723 11.968 13.4272 11.542 13.2526 11.0437C13.0779 10.5453 13.0322 9.99697 13.1212 9.46794C13.2103 8.9389 13.4301 8.45295 13.7528 8.07153C14.0755 7.69012 14.4867 7.43037 14.9344 7.32514C15.382 7.21991 15.846 7.27392 16.2677 7.48034C16.6894 7.68676 17.0498 8.03632 17.3034 8.48481C17.5569 8.93331 17.6923 9.4606 17.6923 10C17.6923 10.7233 17.4492 11.417 17.0164 11.9285C16.5836 12.4399 15.9966 12.7273 15.3846 12.7273ZM15.3846 9.09091C15.2325 9.09091 15.0837 9.14423 14.9572 9.24412C14.8307 9.34401 14.7321 9.48599 14.6739 9.65211C14.6157 9.81822 14.6005 10.001 14.6301 10.1774C14.6598 10.3537 14.7331 10.5157 14.8407 10.6428C14.9482 10.77 15.0853 10.8565 15.2345 10.8916C15.3837 10.9267 15.5384 10.9087 15.679 10.8399C15.8195 10.7711 15.9397 10.6546 16.0242 10.5051C16.1087 10.3556 16.1538 10.1798 16.1538 10C16.1538 9.75889 16.0728 9.52766 15.9285 9.35718C15.7843 9.18669 15.5886 9.09091 15.3846 9.09091Z" fill="white"/>
                        <path d="M7.69246 20C7.23604 20 6.78987 19.8401 6.41037 19.5404C6.03088 19.2407 5.73509 18.8148 5.56043 18.3164C5.38577 17.8181 5.34007 17.2697 5.42911 16.7407C5.51815 16.2116 5.73794 15.7257 6.06067 15.3443C6.38341 14.9629 6.7946 14.7031 7.24225 14.5979C7.6899 14.4926 8.1539 14.5467 8.57558 14.7531C8.99725 14.9595 9.35766 15.3091 9.61124 15.7576C9.86481 16.206 10.0002 16.7333 10.0002 17.2727C10.0002 17.9961 9.75702 18.6897 9.32425 19.2012C8.89147 19.7127 8.3045 20 7.69246 20ZM7.69246 16.3637C7.54032 16.3637 7.3916 16.417 7.2651 16.5169C7.1386 16.6168 7.04 16.7587 6.98178 16.9248C6.92356 17.091 6.90833 17.2737 6.93801 17.4501C6.96769 17.6264 7.04095 17.7884 7.14853 17.9156C7.25611 18.0427 7.39317 18.1293 7.54239 18.1644C7.69161 18.1994 7.84627 18.1814 7.98683 18.1126C8.12739 18.0438 8.24753 17.9273 8.33205 17.7778C8.41658 17.6283 8.46169 17.4525 8.46169 17.2727C8.46169 17.0316 8.38065 16.8004 8.23639 16.6299C8.09213 16.4594 7.89647 16.3637 7.69246 16.3637Z" fill="white"/>
                        <path d="M19.2307 10.9091H16.923C16.719 10.9091 16.5234 10.8133 16.3791 10.6429C16.2349 10.4724 16.1538 10.2411 16.1538 10C16.1538 9.75892 16.2349 9.52769 16.3791 9.35721C16.5234 9.18672 16.719 9.09094 16.923 9.09094H19.2307C19.4348 9.09094 19.6304 9.18672 19.7747 9.35721C19.9189 9.52769 20 9.75892 20 10C20 10.2411 19.9189 10.4724 19.7747 10.6429C19.6304 10.8133 19.4348 10.9091 19.2307 10.9091Z" fill="white"/>
                        <path d="M19.2306 18.1819H9.23066C9.02664 18.1819 8.83099 18.0861 8.68673 17.9156C8.54247 17.7451 8.46143 17.5139 8.46143 17.2728C8.46143 17.0317 8.54247 16.8004 8.68673 16.6299C8.83099 16.4595 9.02664 16.3637 9.23066 16.3637H19.2306C19.4347 16.3637 19.6303 16.4595 19.7746 16.6299C19.9188 16.8004 19.9999 17.0317 19.9999 17.2728C19.9999 17.5139 19.9188 17.7451 19.7746 17.9156C19.6303 18.0861 19.4347 18.1819 19.2306 18.1819Z" fill="white"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="catalog container">
            <Sidebar :class="showSidebar ? 'show' : 'hide'" v-bind:showSidebar="showSidebar" @showSaleProducts="showSaleProducts" @showSizeProducts="showSizeProductsPlease" @showCashProducts="showCashProducts" @showBrandProducts="showBrandProducts"/>
            <div class="bread bread-mobile" v-if="media.wind <= media.tablet">
                <div></div>
                <Breadcrumbs/>
                <div></div>
            </div>
            <CatalogCell v-bind:catalogData="returnCatalogData" v-bind:total="catalogTotalPages"/>
        </div>
        <paginate
            v-if="catalogTotalPages && media.wind > media.tablet"
            v-model="updatedPage"
            :page-range="3"
            :page-count="Math.ceil(catalogTotalPages / 30)"
            :click-handler="pageChange"
            :prev-text="'Назад'"
            :next-text="'Следующая страница'"
            :page-class="'pages'"
            :prev-class="'this-page'"
            :next-class="'next-page'"
            :active-class="'sale'"
            :container-class="'pagination'">
        </paginate>
            <paginate
                v-if="catalogTotalPages && media.wind <= media.tablet"
                v-model="updatedPage"
                :page-range="3"
                :break-view-text="''"
                :page-count="Math.ceil(catalogTotalPages / 30)"
                :click-handler="pageChange"
                :prev-text="''"
                :next-text="''"
                :page-class="'pages'"
                :prev-class="'this-page'"
                :next-class="'next-page'"
                :active-class="'sale'"
                :container-class="'pagination'">
            </paginate>
    </div>
</template>

<script>
    import Breadcrumbs from "../components/Breadcrumbs";
    import Sidebar from "../components/Sidebar";
    import CatalogCell from "../components/CatalogCell";
    import axios from 'axios'
    export default {
        name: "Catalog",
        data: () => ({
            sortBy: [{value: 'старые товары', name: 'old'}, {value: 'новые товары', name: 'new'}, {value: 'по нарастающей цене', name: 'low'}, {value: 'по убывающей цене', name: 'high'}],
            selected: 'старые товары',
            pageCatalog: 1,
            whataFunc: null,
            rollbackPage: true,

            // ФИЛЬТР
            // Сортировка
            sort: null,

            // Размеры
            sizes: null,
            sizeStr: null,

            // Цена
            min: null,
            max: null,

            // Скидка
            sale: null,

            // Бренды
            brands: null,
            brandsStr: null,

            // МОБИЛКА
            showSidebar: true

        }),
        metaInfo(){
            return {
                title: "Каталог",
                // meta: [{
                //     name: 'description',
                //     content: this.content,
                // }]
            }
        },
        components: {
            Sidebar, Breadcrumbs, CatalogCell
        },
        methods: {
            InfernalFilterFromDanilkaOnFront(page){
                this.$Progress.start();

                let idsSizes = '';

                let query = ``;

                if (this.brandsStr !== null) query += `${this.brandsStr}`

                if (this.sort !== null) query += `sortBy=${this.sort}&`

                if (this.sizes !== null) {

                    query += this.sizeStr

                    if (this.sizes[0] !== undefined) {
                        if (this.sizes[0][1] !== undefined){

                            this.sizes.forEach(el => {
                                idsSizes +=  el[1].ids.join(',') + ',';
                            });
                        }else{

                            if (this.$route.query.size) {
                                idsSizes = this.sizes.join(',') + ',';
                            }
                        }
                    }else{
                        this.sizes = null;
                    }
                }

                if (this.min !== null && this.max !== null) query += `min=${this.min}&max=${this.max}&`

                if (this.sale) {
                    query += `sale=${this.sale}&`
                }

                let parameters = {
                    page,
                    sort: this.sort === null ? JSON.stringify(this.sort) : this.sort,
                    sizes: (this.sizes !== null && idsSizes !== ``) ? idsSizes : this.sizes,
                    min: JSON.stringify(this.min),
                    max: JSON.stringify(this.max),
                    sale: this.sale ? 1 : JSON.stringify(null),
                    params: this.$route.params,
                    brands: this.brands ? this.brands : JSON.stringify(null)
                }

                this.$store.dispatch('getCatalogData', parameters);
                this.$router.push(`${this.$route.path}?${query}page=${page}`)
                    .catch((e)=>{console.log(e)});
            },

            // Обработчик по нажатию на страницы пагинации
            // Вызываем функцию, которая выводит новые товары
            // Отображаем в урл ЧПУ
            pageChange(page){
                // Присваиваем переменной выбранную страницу по клику на пагинцию
                this.pageCatalog = page;

                this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);
            },

            // ФУНКЦИЯ ДЛЯ КОМПОНЕНТА SIDEBAR
            // Отправляем запрос по фильтру по скидке
            // где sale данные из компонента sidebar
            showSaleProducts(sale){
                this.sale = sale;
                this.pageCatalog = 1;
                this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);
            },

            // ФУНКЦИЯ ДЛЯ КОМПОНЕНТА SIDEBAR
            // Отправляем запрос по фильтру по цене и переходим на первую страницу
            showCashProducts(minmax){
                this.min = minmax.min;
                this.max = minmax.max;

                this.pageCatalog = 1;
                this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);
            },

            // Метод для сортировки
            selectSort(){
                switch (this.selected) {
                    case 'по нарастающей цене':
                        this.sort = 'low';
                        break;
                    case 'по убывающей цене':
                        this.sort = 'high';
                        break;
                    case 'новые товары':
                        this.sort = 'new';
                        break;
                    default:
                        this.sort = null;
                        break;
                }
                this.pageCatalog = 1;
                this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);
            },

            // ФУНКЦИЯ ДЛЯ КОМПОНЕНТА SIDEBAR РАЗМЕРЫ
            showSizeProductsPlease(sizes){
                let queryStr = '';

                sizes.forEach(el => {
                    queryStr += `size=${el[0]}&`
                });

                this.sizes = sizes;
                this.sizeStr = queryStr;

                this.pageCatalog = 1;
                this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);
            },

            showBrandProducts(brands){
                let queryBrands = ''
                let localBrands = ''

                brands.forEach(br => {
                    if (br.brands_name.indexOf("&")) {
                        let splitted = br.brands_name.split('&')
                        let correctBrand = splitted.join('$')
                        queryBrands += `brand=${correctBrand}&`
                        localBrands += `${br.brands_name},`
                    }else{
                        queryBrands += `brand=${br.brands_name}&`
                        localBrands += `${br.brands_name},`
                    }
                })

                this.brandsStr = queryBrands
                this.brands = localBrands

                this.pageCatalog = 1;
                this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);
            }
        },
        async created() {
            // При создании компонента присваиваем текущую страницу для пагинции
            this.pageCatalog = +this.$route.query.page || 1;

            if (this.$route.query.size) {

                    let localSizes = [];

                    if (typeof(this.$route.query.size) !== "object") {
                        localSizes.push(this.$route.query.size)
                    }else{
                        localSizes = this.$route.query.size;
                    }

                    this.sizes = [];

                    await axios.get(`${this.URI}allsizesforsidebar`)
                        .then(res => {

                            res.data.forEach(el => {

                                let findSize = localSizes.find(size => +size == el.sizes_number);

                                if (findSize) this.sizes.push(el.product_id)
                            })

                            let queryStr = '';

                            localSizes.forEach(el => {
                                queryStr += `size=${el}&`
                            });

                            this.sizeStr = queryStr;
                        })
            }

            // Если запрос на sale
            if (this.$route.query.sale) {
                this.sale = this.$route.query.sale;
            }

            // Если запрос на мин макс цену
            if (this.$route.query.min && this.$route.query.max){
                this.min = +this.$route.query.min;
                this.max = +this.$route.query.max;
            }

            // Если запрос на sorting
            if (this.$route.query.sortBy) {
                this.sort = this.$route.query.sortBy;

                // Присваиваем this.selected значение в зависимсоти от URL
                switch (this.sort) {
                    case 'low':
                        this.selected = 'по нарастающей цене';
                        break;
                    case 'high':
                        this.selected = 'по убывающей цене';
                        break;
                    default:
                        this.selected = 'новейшие товары';
                        break;
                }
            }

            if (this.$route.query.brand) {
                this.brandsStr = this.$route.query.brand

                if (Array.isArray(this.$route.query.brand)) {
                    let queryBrands = ``
                    let brands = ``

                    this.$route.query.brand.forEach(brand => {
                        queryBrands += `brand=${brand}&`
                        brands += `${brand},`
                    })

                    this.brandsStr = queryBrands
                    this.brands = brands
                }else{
                    this.brandsStr = `brand=${this.$route.query.brand}&`
                    this.brands = `${this.$route.query.brand},`
                }
            }

            this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);

            // МОБИЛКА
            // Скрываем сайдбар
            if (this.media.wind <= this.media.tablet) this.showSidebar = false;
        },
        watch: {
            $route(to, from){
                console.log(to)
                // Если пришли к страницы гендер
                if (to.name === 'gender' && !this.$route.query.page) {
                    this.pageCatalog = 1;
                    this.sort = null;
                    this.sizes = null;
                    this.min = null;
                    this.max = null;
                    this.sale = null;
                    this.brandsStr = null;
                    this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);
                }

                // категории
                if (to.name === 'category' && !this.$route.query.page) {
                    this.pageCatalog = 1;
                    this.sort = null;
                    this.sizes = null;
                    this.min = null;
                    this.max = null;
                    this.sale = null;
                    this.brandsStr = null;
                    this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);
                }

                // подкатегории
                if (to.name === 'department' && !this.$route.query.page) {
                    this.pageCatalog = 1;
                    this.sort = null;
                    this.sizes = null;
                    this.min = null;
                    this.max = null;
                    this.sale = null;
                    this.brandsStr = null;
                    this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);
                }

                if (to.query.sale) {
                    this.pageCatalog = 1;
                    this.sale = this.$route.query.sale;
                    this.InfernalFilterFromDanilkaOnFront(this.pageCatalog);
                }

                if (to.query.page) {
                    this.InfernalFilterFromDanilkaOnFront(to.query.page);
                }
            }
        },
        computed: {
            // Возвращаем данные по каталогу
            returnCatalogData(){
                if (this.$store.getters.catalogData !== null){
                    this.$Progress.finish();
                    return this.$store.getters.catalogData;
                }
            },

            // Возвращаем данные по кол-во товаров для пагинции
            catalogTotalPages(){
                if (this.$store.getters.catalogDataCellCount !== null) {
                    return this.$store.getters.catalogDataCellCount;
                }
            },

            // Обнавляем текущую страницы с товарами
            updatedPage:{
                get(){
                    return this.pageCatalog;
                },
                set(val){
                    this.pageCatalog = val;
                }
            },
            returnWhataFunc(){
                return this.whataFunc;
            },
            getSizes(){
                return this.$store.getters.filterSizes;
            },
            media(){
                return this.$store.getters.media;
            },
            URI(){
                return this.$store.getters.URI;
            },

        },
    }
</script>

<style scoped>

</style>
