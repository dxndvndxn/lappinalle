<template>
    <div class="crumbs">
        {{$route.params.gender}}
        {{$route.params.category}}
<!--        {{$route.params.department}}-->
        <ul>
            <li v-for="(gen, g) in genderMenu" :key="g+'g'" v-if="gen.url === $route.params.gender">
                <router-link :to="{name: 'gender', params: {gender: gen.url}}">
                    {{gen.title}}
                </router-link>
            </li>
<!--            <li v-for="(data, categ, g) in catNdepart[$store.getters.gen]" v-if="$route.params.category && data[0].categories_alias == $route.params.category" :key="g+'c'">-->
<!--                {{data[0]}}-->
<!--                {{data[1]}}-->
<!--            </li>-->
<!--            <li v-for="(data, categ, g) in catNdepart" v-if="$route.params.category" :key="g+'c'">-->
<!--                {{data.categories_alias}}-->
<!--&lt;!&ndash;                <span v-for="(d, k) in data" v-if="d[0].categories_alias === $route.params.category">&ndash;&gt;-->
<!--&lt;!&ndash;                    {{d[0].categories_alias}}&ndash;&gt;-->
<!--&lt;!&ndash;                </span>&ndash;&gt;-->
<!--            </li>-->
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Breadcrumbs",
        props: ['genderMenu'],
        data: () => ({
           catalogCrumbs: null,
        })
    }
</script>

<style scoped>

</style>
