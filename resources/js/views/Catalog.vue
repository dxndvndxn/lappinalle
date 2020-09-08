<template>
    <div>
        <div class="bread container">
            <div></div>
            <Breadcrumbs/>
            <div class="sort">
                <form>
                    <label for="sort">Сортировать</label>
                    <select name="sort" id="sort" @change="selectSort(true)" v-model="selected">
                        <option v-for="(sort, s) in sortBy" v-bind:value="sort.value">
                            {{sort.value}}
                        </option>
                    </select>
                </form>
            </div>
        </div>
        <div class="catalog container">
            <Sidebar @showSaleProducts="showSaleProducts" @hideSaleProducts="hideSaleProducts" @showSizeProducts="showSizeProductsPlease" @showCashProducts="showCashProducts"/>
            <CatalogCell v-bind:catalogData="returnCatalogData" v-bind:total="catalogTotalPages"/>
        </div>
        <paginate
            v-if="catalogTotalPages"
            v-model="updatedPage"
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
    </div>
</template>

<script>
    import Breadcrumbs from "../components/Breadcrumbs";
    import Sidebar from "../components/Sidebar";
    import CatalogCell from "../components/CatalogCell";
    export default {
        name: "Catalog",
        data: () => ({
            sortBy: [{value: 'новейшие товары', name: 'new'}, {value: 'по нарастающей цене', name: 'low'}, {value: 'по убывающей цене', name: 'high'}],
            selected: 'новейшие товары',
            pageCatalog: 1,
            whataFunc: null,
            rollbackPage: true

        }),
        components: {
            Sidebar, Breadcrumbs, CatalogCell
        },
        methods: {
            // Метод который отпралвяет запрос на полечение данных
            getCatalogData(page){
                this.$Progress.start();
                this.$store.dispatch('getCatalogData', {page, params: this.$route.params});
                this.$router.push(`${this.$route.path}?page=${this.updatedPage}`).catch(()=>{});
            },

            // Обработчик по нажатию на страницы пагинации
            // Вызываем функцию, которая выводит новые товары
            // Отображаем в урл ЧПУ
            pageChange(page){
                // Присваиваем переменной выбранную страницу по клику на пагинцию
                this.pageCatalog = page;

                switch (this.returnWhataFunc) {
                    case 'sort':
                        this.selectSort(false);
                        break;
                    case 'sale':
                        this.filterSalePagination();
                        break;
                    case 'cash':
                        this.filterCashPagination();
                        break;
                    case 'size':
                        this.filterSizePagination();
                        break;
                    default:
                        this.getCatalogData(this.updatedPage)
                }
            },

            // ФУНКЦИЯ ДЛЯ ПАГИНАЦИИ ПО ФИЛЬТРУ CASH
            filterCashPagination(){
                let minmax = {
                    min: this.$route.query.min,
                    max: this.$route.query.max
                };
                this.$Progress.start();
                minmax.page = this.updatedPage;
                minmax.params = this.$route.params;
                this.$store.dispatch('showCashProducts', minmax);
                this.$router.push(`${this.$route.path}?min=${minmax.min}&max=${minmax.max}&page=${this.updatedPage}`).catch(()=>{});
            },

            // ФУНКЦИЯ ДЛЯ ПАГИНАЦИИ ПО ФИЛЬРУ SALE
            filterSalePagination(){
                this.$Progress.start();
                this.$store.dispatch('showSaleProducts', {page: this.updatedPage, params: this.$route.params});
                this.$router.push(`${this.$route.path}?sale=${this.$route.query.sale}&page=${this.updatedPage}`).catch(()=>{});
            },

            // ФУНКЦИЯ ДЛЯ ПАГИНАЦИИ ПО ФИЛЬТРУ SIZES
            filterSizePagination(){
                // console.log(this.$route.query.size);
                // console.log(this.getSizes);
                // let data = {sizes: sizes, params: this.$route.params, page: this.updatedPage};
                // this.$store.dispatch('showSizeProducts', data);
                // this.$router.push(`${this.$route.path}?${queryStr}page=${this.updatedPage}`);
            },

            // ФУНКЦИЯ ДЛЯ КОМПОНЕНТА SIDEBAR
            // Если убрали sale, то отправляем на главную страницу каталогов в зависимости от параметров
            hideSaleProducts(sale){
              this.pageCatalog = 1;
              this.whataFunc = null;
              this.getCatalogData(this.updatedPage)
            },

            // ФУНКЦИЯ ДЛЯ КОМПОНЕНТА SIDEBAR
            // Отправляем запрос по фильтру по скидке
            // где sale данные из компонента sidebar
            showSaleProducts(sale){
                this.pageCatalog = 1;
                this.whataFunc = 'sale';
                this.$Progress.start();
                this.$store.dispatch('showSaleProducts', {page: this.pageCatalog, params: this.$route.params});
                this.$router.push(`${this.$route.path}?sale=${sale}&page=1`).catch(()=>{});
            },

            // ФУНКЦИЯ ДЛЯ КОМПОНЕНТА SIDEBAR
            // Отправляем запрос по фильтру по цене и переходим на первую страницу
            showCashProducts(minmax){
                this.pageCatalog = 1;
                this.whataFunc = 'cash';
                minmax.page = this.updatedPage;
                minmax.params = this.$route.params;
                this.$store.dispatch('showCashProducts', minmax);
                this.$router.push(`${this.$route.path}?min=${minmax.min}&max=${minmax.max}&page=1`).catch(()=>{});
                this.$Progress.start();
            },

            // Метод для сортировки
            selectSort(rollbackPage){

              switch (this.selected) {

                  // Если новейшие товары
                  case this.sortBy[0].value:

                      // Вызываем общую функцию по выдаче товаров
                      this.getCatalogData(this.updatedPage);

                      // Определяем куда пушить
                      switch (Object.keys(this.$route.params).length) {
                          case 1:
                              this.$router.push({name: 'gender'});
                              break;
                          case 2:
                              this.$router.push({name: 'category'});
                              break;
                          case 3:
                              this.$router.push({name: 'department'});
                              break;
                      }
                      break;

                  // Если от маленько цены
                  case this.sortBy[1].value:
                      if (rollbackPage) this.pageCatalog = 1;
                      this.whataFunc = 'sort';
                      this.$Progress.start();
                      this.$store.dispatch('sortByAction', {
                          price: 'low',
                          params: this.$route.params,
                          page: this.pageCatalog
                      });
                      this.$router.push(`${this.$route.path}?sortOrder=${this.sortBy[1].name}&page=${this.updatedPage}`).catch(()=>{});
                      break;

                  // Если от большой цены
                  case this.sortBy[2].value:
                      if (rollbackPage) this.pageCatalog = 1;
                      this.whataFunc = 'sort';
                      this.$Progress.start();
                      this.$store.dispatch('sortByAction', {price: 'high', params: this.$route.params, page: this.pageCatalog});
                      this.$router.push(`${this.$route.path}?sortOrder=${this.sortBy[2].name}&page=${this.updatedPage}`).catch(()=>{});
                      break;
              }
            },

            // ФУНКЦИЯ ДЛЯ КОМПОНЕНТА SIDEBAR
            showSizeProductsPlease(sizes){
                let queryStr = '';

                sizes.forEach(el => {
                    queryStr += `size=${el[0]}&`
                });
                this.$Progress.start();
                this.pageCatalog = 1;
                if (sizes.length) {
                    this.whataFunc = 'size';
                    let data = {sizes: sizes, params: this.$route.params, page: this.updatedPage};
                    this.$store.dispatch('showSizeProducts', data);
                    this.$router.push(`${this.$route.path}?${queryStr}page=1`).catch(() => {
                    });
                }else{
                    this.getCatalogData(1)
                }
                // try {
                //     let queryStr = '';
                //
                //     sizes.forEach(el => {
                //         queryStr += `size=${el[0]}&`
                //     });
                //     console.log(queryStr)
                //     this.$Progress.start();
                //     this.pageCatalog = 1;
                //     if (sizes.length) {
                //         console.log('HI')
                //         this.whataFunc = 'size';
                //         let data = {sizes: sizes, params: this.$route.params, page: this.updatedPage};
                //         this.$store.dispatch('showSizeProducts', data);
                //         this.$router.push(`${this.$route.path}?${queryStr}page=1`).catch(()=>{});
                //     }
                // }catch (e) {
                //     console.log(e)
                // }
            }
        },
        created() {
            // При создании компонента присваиваем текущую страницу для пагинции
            this.pageCatalog = +this.$route.query.page || 1;

            // Если запрос на sale
            if (this.$route.query.sale) {
                this.filterSalePagination();
            }

            // Если запрос на мин макс цену
            else if (this.$route.query.min && this.$route.query.max){
                this.filterCashPagination();
            }

            // Если запрос на sorting
            else if (this.$route.query.sortOrder) {
                this.sortBy.forEach(el => {
                    if (el.name === this.$route.query.sortOrder) this.selected = el.value;
                });
                this.selectSort();
            }

            else{
                // Вызываем данные просто по каталогу если нету query sale
                this.getCatalogData(this.pageCatalog);
            }
        },
        watch: {
            $route(to, from){
                // Если пришли к страницы гендер
                if (to.name === 'gender' && !this.$route.query.page) {
                    console.log('Hi Watch gender')
                    this.pageCatalog = 1;
                    this.whataFunc = null;
                    this.getCatalogData(this.pageCatalog);
                }

                // категории
                if (to.name === 'category' && !this.$route.query.page) {
                    console.log('Hi Watch category')
                    this.pageCatalog = 1;
                    this.whataFunc = null;
                    this.getCatalogData(this.pageCatalog);
                }

                // подкатегории
                if (to.name === 'department' && !this.$route.query.page) {
                    console.log('Hi Watch department')
                    this.pageCatalog = 1;
                    this.whataFunc = null;
                    this.getCatalogData(this.pageCatalog);
                }

                // if (this.$route.query.page){
                //     this.pageCatalog = +this.$route.query.page;
                // }
            }
        },
        computed: {
            // Возвращаем данные по каталогу
            returnCatalogData(){
                this.$Progress.finish();
                if (this.$store.getters.catalogData !== null) return this.$store.getters.catalogData;
            },

            // Возвращаем данные по кол-во товаров для пагинции
            catalogTotalPages(){
              return this.$store.getters.catalogDataCellCount;
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
            }

        }
    }
</script>

<style scoped>

</style>
