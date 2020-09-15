<template>
    <div class="catalog-sidebar">
        <ul v-if="($route.params.gender && getSidebar) && (media.wind > media.tablet)" class="sidebar-category">

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
        <div v-if="showSidebar" class="sidebar-sizing">
            <span>Размер</span>
            <div class="sizing-cell">
                <button type="button" v-for="(el, size, s) in getSizes"
                       @click="clickSize(size)"
                       v-bind:class="el.active ? 'active-size' : null" :datatype="s">
                    {{size}}
                </button>
            </div>
        </div>
        <div v-if="showSidebar" class="sidebar-price">
            <span class="price" v-if="(media.wind > media.tablet)">
                Цена
            </span>
            <span class="price" v-else>
                Цена от - до
            </span>
            <form>
                <label for="min" v-if="(media.wind > media.tablet)">От</label><input type="number" @focusout="showProductsByCashMin(min)" v-model.number="min" id="min" :placeholder="getMinMax.min"><span v-if="(media.wind > media.tablet)">&#8381;</span>
                <label for="max" v-if="(media.wind > media.tablet)">До</label><input type="number" @focusout="showProductsByCashMax(max)" v-model.number="max" id="max" :placeholder="getMinMax.max"><span v-if="(media.wind > media.tablet)">&#8381;</span>
            </form>
        </div>
        <div v-if="showSidebar" class="sidebar-sale">
            <form>
                <label for="sale">Распродажа</label><input type="checkbox" @change="showSales"  v-model="checkSale" v-bind:class="checkSale ? 'active-size' : null" id="sale">
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Sidebar",
        props: ['showSidebar'],
        data: () => ({
            checkSale: false,
            min: null,
            max: null,
            sizesArr: null
        }),
        computed: {
            getSidebar(){
                return this.$store.getters.mySidebar;
            },
            getMinMax(){
                return this.$store.getters.minMax;
            },
            getSizes(){
                return this.$store.getters.filterSizes;
            },
            media(){
                return this.$store.getters.media;
            }
        },
        created(){
            this.checkSale = this.$route.query.sale ? this.$route.query.sale : false;
            this.min = this.$route.query.min ? this.$route.query.min : null;
            this.max = this.$route.query.max ? this.$route.query.max : null;
            this.$store.dispatch('showDepartAfterUpdated', {categoryAlias: this.$route.params.category, gen: this.$route.params.gender, newSidebar: this.getSidebar})
        },
        methods:{
            showDepartments(categoryAlias, gen){
                this.$store.dispatch('showDepartments', {categoryAlias, gen});
            },
            // Фильтруем по sale
            showSales(){
                if (this.checkSale){
                    this.$emit('showSaleProducts', this.checkSale);
                } else{
                    this.$emit('hideSaleProducts',this.checkSale);
                }
            },
            clickSize(size){
                this.getSizes[size].active = !this.getSizes[size].active;
                this.sizesArr = Object.entries(this.getSizes).filter(el => el[1].active === true);
                this.$emit('showSizeProducts', this.sizesArr);
            },
            // Фильтруем по cash
            showProductsByCashMin(min){
                if (min < this.getMinMax.min){
                    return this.min = null;
                }else if (min > this.getMinMax.max){
                    return this.min = null;
                }else{
                    this.min = min;
                    if (this.max) this.$emit('showCashProducts', {min: this.min, max: this.max})
                }
            },
            // Фильтруем по cash
            showProductsByCashMax(max){
                if (max < this.getMinMax.min){
                    return this.max = null;
                }else if (max > this.getMinMax.max){
                    return this.max = null;
                }else{
                    this.max = max;
                    if (this.min) this.$emit('showCashProducts', {min: this.min, max: this.max})
                }
            }
        },
        watch:{
            getSidebar(newVal, oldVal){
                this.$store.dispatch('showDepartAfterUpdated', {categoryAlias: this.$route.params.category, gen: this.$route.params.gender, newSidebar: newVal})
            },
            $route(to, from){
                if (from.query.sale){
                    this.checkSale = false;
                }
                if (to.query.sale){
                    this.checkSale = true;
                }
                if (from.query.min || from.query.max){
                    this.min = null;
                    this.max = null;
                }
            },
            checkSale(val){
                this.checkSale = val;
            }
        }
    }
</script>

<style scoped>

</style>
