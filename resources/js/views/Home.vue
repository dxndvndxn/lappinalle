<template>
    <div class="home">
        <div class="home-baner">
            <img :src="mainPic" alt="">
            <div class="baner-block">
                <h1>{{mainBanerH1}}</h1>

                <h2>{{mainBanerH2}}</h2>

                <h3>{{mainBanerCollect}}</h3>
                <button class="btn" id="btnMain">
                    <router-link :to="{path: 'malchiki/verhodejda-zima'}">
                        {{mainBanerBtn}}
                    </router-link>
                </button>
            </div>
        </div>
        <div class="home-conveyor home-baner" v-for="(data, index, i) in sliderBanersData" :key="i">
            <div class="home-slider" v-if="data.name === 'Slider'">
                <h1 class="h-30">{{data.h1}}</h1>
                <carousel :nav="true" :dots="false" :lazyLoad="true" v-if="media.wind > media.tablet">
                    <div class="slide-wrap" v-for='(img, ii) in data.sliderData' :key="ii">
                        <router-link :to="img.sliderLink" class="img-container">
                            <img :src="img.sliderImg" alt="">
                        </router-link>
                        <span class="slide-title">{{img.sliderTitle}}</span>
                        <span class="slide-price">{{img.sliderPrice}} ₽</span>
                    </div>
                </carousel>
                <carousel class="carousel-mobile" :nav="false" :dots="false" :lazyLoad="true" :loop="true" :margin="50" :autoWidth="true" :items="1" v-else>
                    <div class="slide-wrap" v-for='(img, ii) in data.sliderData' :key="ii">
                        <router-link :to="img.sliderLink" class="img-container">
                            <img :src="img.sliderImg" alt="">
                        </router-link>
                        <span class="slide-title">{{img.sliderTitle}}</span>
                        <span class="slide-price">{{img.sliderPrice}} ₽</span>
                    </div>
                </carousel>
            </div>
            <div class="sale-baner" v-if="data.name === 'Baner'" v-bind:class="data.banerData.fllReverse ? 'fl-reverse' : null">
                <img :src="data.img" alt="" v-if="media.wind > media.tablet">
                <div class="wrap-img" v-else>
                    <img :src="data.img" alt="">
                    <button class="btn">
                        <router-link :to="{path: data.banerData.link}">
                            {{data.banerData.btn}}
                        </router-link>
                    </button>
                </div>
                <div class="baner" >
                    <div class="baner-title">
                        <h1>{{data.banerData.h1}}</h1>
                        <span>{{'-' + data.banerData.sale + '%'}}</span>
                    </div>
                    <div class="baner-sale">
                        <div class="sale-was">
                            {{data.banerData.price}} ₽
                        </div>
                        <div class="sale-now">
                            {{data.banerData.price - ((data.banerData.sale / 100) *data.banerData.price)}} ₽
                        </div>
                    </div>
                    <button class="btn" v-if="media.wind > media.tablet">
                        <router-link :to="{path: data.banerData.link}">
                            {{data.banerData.btn}}
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
        computed: {
            media(){
                return this.$store.getters.media;
            }
        }
    }
</script>
