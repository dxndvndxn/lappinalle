<template>
    <div class="home" v-if="GetMainPageAdmin !== null">
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
        <div class="home-conveyor home-baner" v-for="(block, i) in GetMainPageAdmin[1]" :key="i">
            <div class="home-slider">
                <h1 class="h-30">{{block.block_carousel_h1}}</h1>
                <carousel :nav="true" :dots="false" :lazyLoad="true" v-if="media.wind > media.tablet">
                    <div class="slide-wrap" v-for='(img, ii) in block.block_carousel' :key="ii">
                        <router-link :to="{path: `${block.alias}/item-${img.product_id}`}" class="img-container">
                            <img :src="img.product_img.split(',')[0]" alt="">
                        </router-link>
                        <span class="slide-title">{{img.product_title}}</span>
                        <span class="slide-price" :class="img.product_sale !== 0 ? 'sale' : null">{{parseInt(img.product_price) * parseInt(block.eu)}} ₽</span>
                    </div>
                </carousel>
                <carousel class="carousel-mobile" :nav="false" :dots="false" :lazyLoad="true" :loop="true" :margin="50" :autoWidth="true" :items="1" v-else>
                    <div class="slide-wrap" v-for='(img, ii) in block.block_carousel' :key="ii">
                        <router-link :to="{path: `${block.alias}/item-${img.product_id}`}" class="img-container">
                            <img :src="img.product_img.split(',')[0]" alt="">
                        </router-link>
                        <span class="slide-title">{{img.product_title}}</span>
                        <span class="slide-price" :class="img.product_sale !== 0 ? 'sale' : null">{{parseInt(img.product_price) * parseInt(block.eu)}} ₽</span>
                    </div>
                </carousel>
            </div>
                <div class="sale-baner" v-bind:class="((i + 1) % 2) === 0 ? 'fl-reverse' : null">
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
                        <span>{{block.block_sale}}</span>
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
    </div>
</template>

<script>
    import carousel from 'vue-owl-carousel'
    export default {
        name: 'Home',
        components: {carousel},
        data: () =>({
            mainPic: '../../img/main-banet.png',
            mainBanerH1: 'Распродажа',
            mainBanerH2: 'Скидки до 25%',
            mainBanerCollect: 'На осеннюю коллекцию',
            mainBanerBtn: 'Перейти в раздел',
            sliderBanersData: [
                {
                    name: 'Slider',
                    h1: 'Новинки для мальчиков',
                    sliderData: [
                        { sliderImg: '../../../img/malchiki1.jpg', sliderLink: 'malchiki/item-4', sliderTitle: 'Комплект LAPPINALLE', sliderPrice: '5760'},
                        { sliderImg: '../../../img/malchiki2.jpg', sliderLink: 'malchiki/item-9', sliderTitle: 'Комплект JONATHAN STAR', sliderPrice: '5760'},
                        { sliderImg: '../../../img/malchiki3.jpg', sliderLink: 'malchiki/item-12', sliderTitle: 'Комбинезон LAPPINALLE', sliderPrice: '4680'},
                        { sliderImg: '../../../img/malchiki4.jpg', sliderLink: 'malchiki/item-18', sliderTitle: 'Комбинезон RASAVIL', sliderPrice: '4140'},
                        { sliderImg: '../../../img/malchiki4.jpg', sliderLink: 'malchiki/item-18', sliderTitle: 'Комбинезон RASAVIL', sliderPrice: '4140'},
                        { sliderImg: '../../../img/malchiki4.jpg', sliderLink: 'malchiki/item-18', sliderTitle: 'Комбинезон RASAVIL', sliderPrice: '4140'},
                        { sliderImg: '../../../img/malchiki4.jpg', sliderLink: 'malchiki/item-18', sliderTitle: 'Комбинезон RASAVIL', sliderPrice: '4140'},
                        { sliderImg: '../../../img/malchiki4.jpg', sliderLink: 'malchiki/item-18', sliderTitle: 'Комбинезон RASAVIL', sliderPrice: '4140'},
                    ]
                },
                {
                    name: 'Baner',
                    img: '../../../img/img_2-item-14.png',
                    banerData: {h1: 'Комбинезон "DREAMLAND"', sale: 25, price: 7200, btn: 'Подробнее', flReverse: false, link: 'malchiki/item-15' }
                },
                {
                    name: 'Slider',
                    h1: 'Новинки для девочек',
                    sliderData: [
                        { sliderImg: '../../../img/devochki1.jpg', sliderLink: 'devochki/item-6', sliderTitle: 'Комплект LAPPINALLE', sliderPrice: '5760'},
                        { sliderImg: '../../../img/devochki2.jpg', sliderLink: 'devochki/item-10', sliderTitle: 'Комплект JONATHAN STAR', sliderPrice: '5670'},
                        { sliderImg: '../../../img/devochki3.jpg', sliderLink: 'devochki/item-11', sliderTitle: 'Комплект (курточка MOTIONS, п/к DREAMLAND)', sliderPrice: '5670'},
                        { sliderImg: '../../../img/devochki4.jpg', sliderLink: 'devochki/item-8', sliderTitle: 'Комплект LAPPINALLE', sliderPrice: '6750'},
                    ]
                },
                {
                    name: 'Baner',
                    img: '../../../img/item-14/img_1-item-14.png',
                    banerData: {h1: 'Комбинезон "DREAMLAND"', sale: 25, price: 7200, btn: 'Подробнее', fllReverse: true, link: 'devochki/item-14'}
                }
            ]

        }),
        created() {
            if (this.GetMainPageAdmin === null) this.$store.dispatch('GetMainPageAdmin')
        },

        computed: {
            media(){
                return this.$store.getters.media;
            },
            GetMainPageAdmin(){
                return this.$store.getters.GetMainPageAdmin;
            }
        }
    }
</script>
