<template>
    <div class="home" v-if="GetMainPageAdmin !== null">
        <div class="lappi-header__wrap" v-if="media.wind > media.tablet">
            <img src="/img/lappi_header.png" alt="Финская одежда" class="lappi_header">
        </div>
        <div class="home-baner">
            <img :src="GetMainPageAdmin[0][0]" alt="">
            <div class="baner-block">
                <h1>{{GetMainPageAdmin[0][1]}}</h1>

                <h2>{{GetMainPageAdmin[0][2]}}</h2>

                <h3>{{GetMainPageAdmin[0][3]}}</h3>
                <button class="btn" id="btnMain">
                    <router-link :to="GetMainPageAdmin[0][5]">
                        {{GetMainPageAdmin[0][4]}}
                    </router-link>
                </button>
            </div>
        </div>
        <div class="home-baner">
            <div class="relate-links">
                <router-link :to="{path: '/aboutbrand'}" class="relate-link__link">
                    <span>О нас</span>
                </router-link>
                <router-link :to="{path: '/abouttech'}" class="relate-link__link">
                    <span>О технологиях</span>
                </router-link>
            </div>
        </div>
        <div class="home-conveyor home-baner" v-for="(block, i) in GetMainPageAdmin[1]" :key="i">
            <div class="home-slider">
                <h1 class="h-30">{{block.block_carousel_h1}}</h1>
                <carousel :nav="true" :dots="false" :lazyLoad="true" v-if="media.wind > media.tablet">
                    <div class="slide-wrap" v-for='(img, ii) in block.block_carousel' :key="ii">
                        <router-link :to="{path: `${block.alias}/item-${img.product_id}`}" class="img-container">
                            <img v-if="img.product_img !== null" :src="img.product_img.split(',')[0]" alt="">
                        </router-link>
                        <span class="slide-title">{{img.product_title}}</span>
                        <span class="slide-price" :class="img.product_sale !== 0 ? 'sale' : null">{{parseInt(img.product_price) * parseInt(block.eu)}} ₽</span>
                    </div>
                </carousel>
                <carousel class="carousel-mobile" :nav="false" :dots="false" :lazyLoad="true" :loop="true" :margin="50" :autoWidth="true" :items="1" v-else>
                    <div class="slide-wrap" v-for='(img, ii) in block.block_carousel' :key="ii">
                        <router-link :to="{path: `${block.alias}/item-${img.product_id}`}" class="img-container">
                            <img v-if="img.product_img !== null" :src="img.product_img.split(',')[0]" alt="">
                        </router-link>
                        <span class="slide-title">{{img.product_title}}</span>
                        <span class="slide-price" :class="img.product_sale !== 0 ? 'sale' : null">{{parseInt(img.product_price) * parseInt(block.eu)}} ₽</span>
                    </div>
                </carousel>
            </div>
            <div class="sale-baner" v-bind:class="((i + 1) % 2) === 0 && media.wind > media.tablet ? 'fl-reverse' : null">
                <img :src="block.block_img" alt="" v-if="media.wind > media.tablet">
                <div class="wrap-img" v-else>
                    <img :src="block.block_img" alt="">
                    <button class="btn">
                        <router-link :to="{path: block.block_but_href}">
                            {{block.block_but_text}}
                        </router-link>
                    </button>
                </div>
                <div class="baner">
                    <div class="baner-title">
                        <h1>{{block.block_h1}}</h1>
                        <span>-{{block.block_sale}}%</span>
                    </div>
                    <div class="baner-sale">
                        <div class="sale-was">
                            {{block.block_price}} ₽
                        </div>
                        <div class="sale-now">
                            {{Math.ceil(block.block_price - ((block.block_sale / 100) * block.block_price))}} ₽
                        </div>
                    </div>
                    <button class="btn" v-if="media.wind > media.tablet">
                        <router-link :to="{path: block.block_but_href}">
                            {{block.block_but_text}}
                        </router-link>
                    </button>
                </div>
            </div>
        </div>
        <div class="home-baner" v-if='GetMainPageAdmin[0][6] !== null && GetMainPageAdmin[0][6] !== ""'>
            <div class="home-video">
                <iframe width="100%" height="500" :src="GetMainPageAdmin[0][6]" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</template>

<script>
    import carousel from 'vue-owl-carousel'
    export default {
        name: 'Home',
        components: {carousel},
        data:() => ({
            title: null
        }),
        metaInfo(){
            return {
                title: 'Lappinalle - Детская одежды из Финляндии',
                meta: [
                    {
                        name: 'description',
                        content: 'Магазин детской одежды из Финляндии',
                    },
                    { 
                        name: 'keywords', 
                        content: 'детская одежда, одежда из Финляндии, детская одежда из Финляндии'
                    },
                ]
            }
        },
        created() {
            this.$Progress.start();
        },
        computed: {
            media(){
                return this.$store.getters.media;
            },
            GetMainPageAdmin(){
                this.$Progress.finish();
                return this.$store.getters.GetMainPageAdmin;
            }
        }
    }
</script>
