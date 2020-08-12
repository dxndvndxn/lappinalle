<template>
    <div>
        <div class="bread container">
            <div></div>
            <Breadcrumbs v-bind:genderMenu="genderMenu"/>
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
            <CatalogCell/>
        </div>
    </div>
</template>

<script>
    import Breadcrumbs from "../components/Breadcrumbs";
    import Sidebar from "../components/Sidebar";
    import CatalogCell from "../components/CatalogCell";
    export default {
        name: "Catalog",
        data: () => ({
            sortBy: [{name: "по популярности", value: 'popular'},{name: 'по цене', value: 'price'}],
            selected: ''
        }),
        components: {
            Sidebar, Breadcrumbs, CatalogCell
        },
        computed: {
            genderMenu(){
                return this.$store.getters.topMenu;
            },
        }
    }
</script>

<style scoped>

</style>
