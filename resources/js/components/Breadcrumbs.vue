<template>
    <div class="crumbs">
        <ul>
            <li v-for="(gen, g) in genderMenu" :key="g+'g'" v-if="gen.url === $route.params.gender">
                <router-link :to="{name: 'gender', params: {gender: gen.url}}">
                    {{gen.title}}
                </router-link>
            </li>
            <li v-for="(categName, categAlias, gg) in getCategoriesAlias" v-if="categAlias === $route.params.category" :key="gg+'gg'">
                <router-link :to="{name: 'category', params: {gender: $route.params.gender, category: categAlias}}">
                    {{categName}}
                </router-link>
            </li>
            <li v-for="(departName, departAlias, ggg) in getDepartmentsAlias" v-if="departAlias === $route.params.department" :key="ggg+'ggg'">
                <router-link :to="{name: 'department', params: {gender: $route.params.gender, category: $route.params.category, department: departAlias}}">
                    {{departName}}
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Breadcrumbs",
        props: ['genderMenu'],
        data: () => ({
           catalogCrumbs: null,
        }),
        computed: {
            getCategoriesAlias(){
                return this.$store.getters.categAlias;
            },
            getDepartmentsAlias(){
                return this.$store.getters.departAlias;
            }
        }
    }
</script>

<style scoped>

</style>
