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
                <button type="button" v-for="(el, size, s) in localSizes"
                       :key="s"
                       @click="clickSize(size)"
                       v-bind:class="el.active ? 'active-size' : null">
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
        <div v-if="showSidebar" class="sidebar-brands">
            <span class="brands">
                Бренды
            </span>
            <ul class="brands-list" @mouseover="showScroll = true"  @mouseleave="showScroll = false" v-bind:class="showScroll ? 'showScroll' : null">
                <li v-for="(brand, i) in sideBarBrands" :key="i">
                    {{brand.brands_name}} <input type="checkbox" class="brands__btn" v-bind:class="brand.active ? 'active-size' : null" @change='clickBrand(i)'>
                </li>
            </ul>
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
            sizesArr: null,
            localSizes: null,
            showScroll: false
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
            },
            // Возвращаем данные по каталогу
            sideBarBrands:{
                get(){
                    if (this.$store.getters.filterBrands !== null){
                        return this.$store.getters.filterBrands;
                    }
                },
                set(value){
                    return value 
                }
            }
        },
        created(){
            this.checkSale = this.$route.query.sale ? this.$route.query.sale : false;
            this.min = this.$route.query.min ? this.$route.query.min : null;
            this.max = this.$route.query.max ? this.$route.query.max : null;

            this.$store.dispatch('showDepartAfterUpdated', {categoryAlias: this.$route.params.category, gen: this.$route.params.gender, newSidebar: this.getSidebar})
        },
        methods:{
            clickBrand(i){
                this.sideBarBrands[i].active = !this.sideBarBrands[i].active
                let pickedBrands = this.sideBarBrands.filter(br => br.active)
                this.$emit('showBrandProducts', pickedBrands)
            },
            showDepartments(categoryAlias, gen){
                this.$store.dispatch('showDepartments', {categoryAlias, gen});
            },
            // Фильтруем по sale
            showSales(){
                if (this.checkSale){
                    this.$emit('showSaleProducts', this.checkSale);
                } else{
                    this.$emit('showSaleProducts', this.checkSale);
                }
            },
            clickSize(size){
                this.localSizes[size].active = !this.localSizes[size].active;
                this.sizesArr = Object.entries(this.localSizes).filter(el => el[1].active === true);
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
            getSizes(sizes){
                if (this.$route.query.size !== undefined) {
                    if (typeof(this.$route.query.size) !== "object") {

                        for (let sz in sizes) {

                            if (sz === this.$route.query.size) sizes[sz].active = true;
                        }
                    }else{

                        for (let sz in sizes) {

                            this.$route.query.size.forEach(el => {

                                if (sz === el) sizes[sz].active = true;
                            })
                        }
                    }
                    this.localSizes = sizes;
                }else{
                    this.localSizes = sizes;
                }
            },
            checkSale(val){
                this.checkSale = val;
            },
            sideBarBrands(activeBrands){
                // if (this.$route.query.brand) {
                // console.log(this.$route.query.brand)
                // if (Array.isArray(this.$route.query.brand)) {
                //   this.$route.query.brand.forEach(queryBrand => {
                //       let searchedBrand = this.brands.findIndex(brand => brand.name == queryBrand)
                //       this.brands[searchedBrand].active = !this.brands[searchedBrand].active
                //   })
                // }else{
                //   let searchedBrand = this.brands.findIndex(brand => brand.name == this.$route.query.brand)
                //   this.brands[searchedBrand].active = !this.brands[searchedBrand].active
                // }
                // }
                if (this.$route.query.brand){
                    console.log(this.$route.query.brand);
                    if(Array.isArray(this.$route.query.brand)){
                        activeBrands.forEach((brand, i) => {
                            activeBrands[i].active = false

                            if (brand.brands_name.indexOf("&")){
                                let splitted = brand.brands_name.split('&')
                                let correctBrand = splitted.join('$')
                                let searchedBrand = this.$route.query.brand.find(queryBrand => queryBrand == correctBrand)
                                if (searchedBrand) activeBrands[i].active = true
                            }

                            let searchedBrand = this.$route.query.brand.find(queryBrand => queryBrand == brand.brands_name)
                            if (searchedBrand){
                                activeBrands[i].active = true
                            } 
                        })
                        this.sideBarBrands = activeBrands
                        console.log(this.sideBarBrands)
                    }else{
                        if (this.$route.query.brand.indexOf("$")) {
                            let splitted = this.$route.query.brand.split('$')
                            let correctBrand = splitted.join('&')

                            let findedBrand = activeBrands.findIndex(br => br.brands_name == correctBrand)
                            activeBrands[findedBrand].active = !activeBrands[findedBrand].active
                        }else{
                            let findedBrand = activeBrands.findIndex(br => br.brands_name == this.$route.query.brand)
                            activeBrands[findedBrand].active = !activeBrands[findedBrand].active
                        }
                        this.sideBarBrands = activeBrands
                    }
                }
            }

        }
    }
</script>

<style scoped>

</style>
