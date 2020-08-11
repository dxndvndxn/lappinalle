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
            <Sidebar :side="sidebar"/>
            <CatalogCell/>
        </div>
    </div>
</template>

<script>
    import Breadcrumbs from "../components/Breadcrumbs";
    import Sidebar from "../components/Sidebar";
    import CatalogCell from "../components/CatalogCell";
    import { mapGetters } from 'vuex';
    export default {
        name: "Catalog",
        data: () => ({
            sortBy: [{name: "по популярности", value: 'popular'},{name: 'по цене', value: 'price'}],
            selected: ''
        }),
        components: {
            Breadcrumbs, Sidebar, CatalogCell
        },
        computed: {
            genderMenu(){
                return this.$store.getters.topMenu;
            },
            ...mapGetters(['sidebar']),
        }
    }
</script>

<style scoped>

</style>
