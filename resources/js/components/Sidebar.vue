<template>
    <div class="catalog-sidebar">
        <ul v-if="$route.params.gender && getSidebar" class="sidebar-category">

            <li v-for="(aliasData, alias, i) in getSidebar[$route.params.gender]" :key="i" v-if="aliasData.show_category || alias === 'sex_name'">
                <router-link :to="{name: 'gender', params: {gender: $route.params.gender}}" v-if="alias === 'sex_name'">
                    {{aliasData}}
                </router-link>
                <router-link :to="{name: 'category', params: {gender: $route.params.gender, category: aliasData.category_alias}}" v-if="aliasData.show_category">
                    <span @click="showDepartments(aliasData.category_alias, $route.params.gender)" v-bind:class="$route.params.gender && $route.params.category ? 'gender-h' : null">{{aliasData.category_name}}</span>
                    <ul class="sidebar-depart">
                        <li v-for="(depart, i) in aliasData.departments" v-if="depart.depart_show">
                            <router-link :to="{name: 'department', params: {gender: $route.params.gender, category: aliasData.category_alias, department: depart.depart_alias}}">
                                {{depart.depart_name}}
                            </router-link>
                        </li>
                    </ul>
                </router-link>
            </li>
        </ul>
        <div class="sidebar-sizing">
            <span>Размер</span>
            <form @submit="">
                <input type="button" v-for="(size, s) in sizing"
                       v-bind:value="size.val"
                       v-bind:name="size.name"
                       @click="size.active = !size.active"
                       v-bind:class="size.active ? 'active-size' : null">
            </form>
        </div>
        <div class="sidebar-price">
            <span class="price">
                Цена
            </span>
            <form>
                <label for="min">От</label><input type="number" id="min" min="1"><span>&#8381;</span>
                <label for="max">До</label><input type="number" id="max" min="1"><span>&#8381;</span>
            </form>
        </div>
        <div class="sidebar-sale">
            <form action="">
                <label for="sale">Распродажа</label><input type="checkbox" v-model="checkSale" v-bind:class="checkSale ? 'active-size' : null" id="sale">
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Sidebar",
        data: () => ({
            sizing: [
                {val: 92, name: 'sizeForShirts', active: false},
                {val: 94, name: 'sizeForShirts', active: false},
                {val: 104, name: 'sizeForShirts', active: false},
                {val: 111, name: 'sizeForShirts', active: false},
                {val: 125, name: 'sizeForShirts', active: false},
                {val: 122, name: 'sizeForShirts', active: false},
                ],
            checkSale: null
        }),
        computed: {
            getSidebar(){
                return this.$store.getters.mySidebar;
            }
        },
        methods:{
            showDepartments(categoryAlias, gen){
                this.$store.dispatch('showDepartments', {categoryAlias, gen});
            }
        },
        watch:{
            getSidebar(newVal, oldVal){
                this.$store.dispatch('showDepartAfterUpdated', {categoryAlias: this.$route.params.category, gen: this.$route.params.gender, newSidebar: newVal})
            },
            // $route(to,from){
            //     if (to.name === 'gender' || from.name === 'category') {
            //         this.$store.dispatch('backToCategory', {gen: this.$route.params.gender})
            //     }
            //     if (to.name === 'category' || to.name === 'department' || to.name === 'item') {
            //         console.log('hi mark')
            //         this.$store.dispatch('showDepartments',{categoryAlias: this.$route.params.category, gen: this.$route.params.gender});
            //     }
            //
            // }
        }
    }
</script>

<style scoped>

</style>
