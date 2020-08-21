<template>
    <div>
        <div class="bread container">
            <div></div>
            <Breadcrumbs/>
            <div class="sort">
                <form>
                    <label for="sort">Сортировать</label>
                    <select name="sort" id="sort" @change="selectSort" v-model="selected">
                        <option v-for="(sort, s) in sortBy" v-bind:value="sort.value">
                            {{sort.value}}
                        </option>
                    </select>
                </form>
            </div>
        </div>
        <div class="catalog container">
            <Sidebar @showSaleProducts="showSaleProducts" @showCashProducts="showCashProducts"/>
            <CatalogCell v-bind:catalogData="returnCatalogData" v-bind:total="catalogTotalPages"/>
        </div>
        <paginate
            v-if="catalogTotalPages"
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
            sortBy: [{value: 'новейшие товары', name: 'new'}, {value: 'по нарастающей цене', name: 'low'}, {value: 'по убывающей цене', name: 'high'}],
            selected: 'новейшие товары',
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
              // Присваиваем переменной выбранную страницу по клику на пагинцию
              this.pageCatalog = page;
              this.getCatalogData(this.pageCatalog);
              `this.${func}`();
              this.$router.push(`${this.$route.path}?page=${this.pageCatalog}`)
          },

            // Отправляем запрос по фильтру по скидке
            showSaleProducts(sale){
              this.$Progress.start();
              this.$store.dispatch('showSaleProducts', {page: this.pageCatalog, params: this.$route.params});
              this.$router.push(`${this.$route.path}?sale=${sale}&page=${this.pageCatalog}`).catch(()=>{});
            },

            // Отправляем запрос по фильтру по цене
            showCashProducts(minmax){
              this.$Progress.start();
              minmax.page = this.pageCatalog;
              minmax.params = this.$route.params;
              this.$store.dispatch('showCashProducts', minmax);
              this.$router.push(`${this.$route.path}?min=${minmax.min}&max=${minmax.max}&page=${this.pageCatalog}`).catch(()=>{});
            },

            selectSort(){
              switch (this.selected) {
                  case this.sortBy[0].value:
                      this.getCatalogData(this.pageCatalog);

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

                  case this.sortBy[1].value:
                      this.$Progress.start();
                      this.$store.dispatch('sortByAction', {
                          price: 'low',
                          params: this.$route.params,
                          page: this.pageCatalog
                      });
                      this.$router.push(`${this.$route.path}?sortOrder=${this.sortBy[1].name}&page=${this.pageCatalog}`).catch(()=>{});
                      break;

                  case this.sortBy[2].value:
                      this.$Progress.start();
                      this.$store.dispatch('sortByAction', {price: 'high', params: this.$route.params, page: this.pageCatalog});
                      this.$router.push(`${this.$route.path}?sortOrder=${this.sortBy[2].name}&page=${this.pageCatalog}`).catch(()=>{});
                      break;
              }
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

            // Если запрос на мин макс цену
            if (this.$route.query.min && this.$route.query.max) this.showCashProducts({min: this.$route.query.min, max: this.$route.query.max})

            // Если запрос на sorting
            if (this.$route.query.sortOrder) {
                this.sortBy.forEach(el => {
                    if (el.name === this.$route.query.sortOrder) this.selected = el.value;
                });
                this.selectSort();
            }
        },
        watch: {
            $route(to, from){
                // Если пришли со страницы гендер
                // категории
                // подкатегории
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
                // Если пришли со сорта
                if (from.query.sortOrder === 'low' || from.query.sortOrder ==='high'){
                   this.selected = this.sortBy[0].value;
                }
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
            returnError(){
                this.$Progress.finish();
                return this.$store.getters.errorQuery;
            }
        }
    }
</script>

<style scoped>

</style>
