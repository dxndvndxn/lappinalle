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
                <carousel :nav="true" :dots="false" :lazyLoad="true">
                    <div class="slide-wrap" v-for='(img, ii) in data.sliderData' :key="ii">
                        <router-link :to="img.sliderLink">
                            <img :src="img.sliderImg" alt="">
                        </router-link>
                        <span class="slide-title">{{img.sliderTitle}}</span>
                        <span class="slide-price">{{img.sliderPrice}} &#8381;</span>
                    </div>
                </carousel>
            </div>
            <div class="sale-baner" v-if="data.name === 'Baner'" v-bind:class="data.banerData.fllReverse ? 'fl-reverse' : null">
                <img :src="data.img" alt="">
                <div class="baner" >
                    <div class="baner-title">
                        <h1>{{data.banerData.h1}}</h1>
                        <span>{{'-' + data.banerData.sale + '%'}}</span>
                    </div>
                    <div class="baner-sale">
                        <div class="sale-was">
                            {{data.banerData.price}}
                        </div>
                        <div class="sale-now">
                            {{data.banerData.price - ((data.banerData.sale / 100) *data.banerData.price)}} &#8381;
                        </div>
                    </div>
                    <button class="btn">
                        {{data.banerData.btn}}
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
            mainBanerH1: 'Акция',
            mainBanerH2: 'Скидка 10%',
            mainBanerCollect: 'На осеннюю коллекцию',
            mainBanerBtn: 'Перейти в раздел',
            sliderBanersData: [
                {
                    name: 'Slider',
                    h1: 'Новинки для мальчиков',
                    sliderData: [
                        { sliderImg: '../../../img/malchiki1.jpg', sliderLink: 'malchiki/verhnjaodejda/kurtrko/item-1', sliderTitle: 'Комбинезон Lappinalle', sliderPrice: '5400'},
                        { sliderImg: '../../../img/malchiki2.jpg', sliderLink: 'malchiki/verhnjaodejda/kurtrko/item-1', sliderTitle: 'Комбинезон Lappinalle', sliderPrice: '5400'},
                        { sliderImg: '../../../img/malchiki3.jpg', sliderLink: 'malchiki/verhnjaodejda/kurtrko/item-1', sliderTitle: 'Комбинезон Lappinalle', sliderPrice: '5400'},
                        { sliderImg: '../../../img/malchiki4.jpg', sliderLink: 'malchiki/verhnjaodejda/kurtrko/item-1', sliderTitle: 'Комбинезон Lappinalle', sliderPrice: '5400'},
                    ]
                },
                {
                    name: 'Baner',
                    img: '../../../img/baner-main.png',
                    banerData: {h1: 'Распродажа', sale: 35, price: 3000, btn: 'Подробнее', flReverse: false, }
                },
                {
                    name: 'Slider',
                    h1: 'Новинки для девочек',
                    sliderData: [
                        { sliderImg: '../../../img/devochki1.jpg', sliderLink: 'malchiki/verhnjaodejda/kurtrko/item-1', sliderTitle: 'Комбинезон Lappinalle', sliderPrice: '5400'},
                        { sliderImg: '../../../img/devochki2.jpg', sliderLink: 'malchiki/verhnjaodejda/kurtrko/item-1', sliderTitle: 'Комбинезон Lappinalle', sliderPrice: '5400'},
                        { sliderImg: '../../../img/devochki3.jpg', sliderLink: 'malchiki/verhnjaodejda/kurtrko/item-1', sliderTitle: 'Комбинезон Lappinalle', sliderPrice: '5400'},
                        { sliderImg: '../../../img/devochki4.jpg', sliderLink: 'malchiki/verhnjaodejda/kurtrko/item-1', sliderTitle: 'Комбинезон Lappinalle', sliderPrice: '5400'},
                    ]
                },
                {
                    name: 'Baner',
                    img: '../../../img/baner-main.png',
                    banerData: {h1: 'Распродажа', sale: 35, price: 3000, btn: 'Подробнее', fllReverse: true}
                }
            ]

        })
    }
</script>
