<template>
    <div class="container bookmark">
        <div class="bookmark-header h1-m50">
            <Back v-bind:color="'grey'" v-bind:word="'Назад'"/><h1 class="h1-bold-grey">Результаты поиска</h1>
        </div>
        <CatalogCell v-bind:catalogData="returnSearchResult"/>
    </div>
</template>

<script>
    import CatalogCell from "../components/CatalogCell";
    import Back from "../components/Back";
    export default {
        name: "Searching",
        components: {
            CatalogCell, Back
        },
        computed: {
            returnSearchResult(){
                if (this.$store.getters.searchResult.length) {
                    this.$Progress.finish();
                    return this.$store.getters.searchResult;
                }
            }
        }
    }
</script>

<style scoped>

</style>
