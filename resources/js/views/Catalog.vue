<template>
    <div>
        <div class="bread container">
            <div></div>
            <Breadcrumbs/>
            <div class="sort">
                <form>
                    <label for="sort">Сортировать</label>
                    <select name="sort" id="sort" v-model="selected">
                        <option disabled value="">выбрать</option>
                        <option v-for="(sort, s) in sortBy" v-bind:value="sort.value">
                            {{sort.name}}
                        </option>
                    </select>
                </form>
            </div>
        </div>
        <div class="catalog container">
            <Sidebar @showSaleProducts="showSaleProducts"/>
            <CatalogCell v-bind:catalogData="returnCatalogData"/>
        </div>
        <paginate
            v-model="updatedPage"
            :page-count="catalogTotalPages / 30"
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
    import Pagination from "../components/Pagination";
    export default {
        name: "Catalog",
        data: () => ({
            sortBy: [{name: "по популярности", value: 'popular'},{name: 'по цене', value: 'price'}],
            selected: '',
            pageCatalog: 1

        }),
        components: {
            Sidebar, Breadcrumbs, CatalogCell, Pagination
        },
        methods: {
            // Метод который отпралвяет запрос на полечение данных
          getCatalogData(page){
              this.$Progress.start();
              this.$store.dispatch('getCatalogData', {page, params: this.$route.params});
          },

            // Обработчик по нажатию на страницы в каталоге
            // Вызываем функцию, которая выводит новые товары
            // Отображаем в урл ЧПУ
          pageChange(page){
              // Присваиваем переменной выбранную таблицу по клику на пагинцию
              this.pageCatalog = page;
              this.getCatalogData(this.pageCatalog);
              this.$router.push(`${this.$route.path}?page=${this.pageCatalog}`)
          },
            showSaleProducts(sale){
              this.$Progress.start();
              this.$store.dispatch('showSaleProducts', {page: this.pageCatalog, params: this.$route.params});
              this.$router.push(`${this.$route.path}?sale=${sale}&page=${this.pageCatalog}`).catch(()=>{});
            }
        },
        created() {
            // При создании компонента присваиваем текущую страницу для пагинции
            this.pageCatalog = +this.$route.query.page || 1;

            // Если запрос на sale
            if (this.$route.query.sale) this.showSaleProducts(this.$route.query.sale);
            else{
                // Вызываем данные просто по каталогу если нету query sale
                this.getCatalogData(this.pageCatalog);
            }
        },
        watch: {
            $route(to, from){
                if (to.name === 'gender' && !this.$route.query.page) {
                    this.pageCatalog = 1;
                    this.getCatalogData(this.pageCatalog);
                }
                if (to.name === 'category' && !this.$route.query.page) {
                    this.pageCatalog = 1;
                    this.getCatalogData(this.pageCatalog);
                }
                if (to.name === 'department' && !this.$route.query.page) {
                    this.pageCatalog = 1;
                    this.getCatalogData(this.pageCatalog);
                }
            }
        },
        computed: {
            // Возвращаем данные по каталогу
            returnCatalogData(){
                this.$Progress.finish();
                if (this.$store.getters.catalogData !== null) return this.$store.getters.catalogData;
                else return false;
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
            returnError(){
                this.$Progress.finish();
                return this.$store.getters.errorQuery;
            }
        }
    }
</script>

<style scoped>

</style>
