<template>
    <div v-if="returnCatalogData !== null && returnCatalogData.length">
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
            <Sidebar/>
            <CatalogCell v-bind:catalogData="returnCatalogData"/>
        </div>
        <Pagination/>
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
            selected: ''
        }),
        components: {
            Sidebar, Breadcrumbs, CatalogCell, Pagination
        },
        methods: {
          getCatalogData(){
              this.$store.dispatch('getCatalogData', this.$route.params);
          }
        },
        beforeMount() {
            this.$Progress.start();
            this.getCatalogData();
        },
        watch: {
            $route(to, from){
                if (to.name === 'gender') {
                    this.$Progress.start();
                    this.getCatalogData();
                }
                if (to.name === 'category') {
                    this.$Progress.start();
                    this.getCatalogData();
                }
            }
        },
        computed: {
            returnCatalogData(){
                this.$Progress.finish();
                return this.$store.getters.catalogData;
            }
        }
    }
</script>

<style scoped>

</style>
