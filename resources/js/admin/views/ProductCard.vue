<template>
    <div class="admin-product-card">
        <div class="admin-product-card-header">
            <div class="wrap-card-header">
                <h1 class="admin-h1">Карточка товара</h1>
                <span class="card-name">{{nameProduct}}</span>
            </div>
            <button class="admin-btn-complete width-300">Сохранить изменения</button>
        </div>
        <div class="admin-product-card-desc">
            <div class="wrap-card-desc">
                <h1 class="admin-h3">Описание товара</h1>
                <textarea placeholder="Введите текст" class="input-transp"></textarea>
            </div>
            <div class="wrap-card-price">
                <h1 class="admin-h3">Цена</h1>
                <input type="text" class="input-transp" v-model.trim="priceProduct">
                <h1 class="admin-h3">Цена со скидкой</h1>
                <input type="text" class="input-transp" v-model.trim="saleProduct">
            </div>
            <div class="wrap-card-sizes">
                <h1 class="admin-h3">Доступные размеры</h1>
                <div class="size-grid">
                    <span v-for="(sz, i) in sizes">
                        {{sz}}
                    </span>
                </div>
                <div class="wrap-newsize">
                    <input type="number" placeholder="Новый размер" class="input-transp" v-model.number="newSize"><button @click="addSize" class="btn-admin-purpp"><img src="../../../img/whiteplus.png" alt=""></button>
                </div>
            </div>
        </div>
        <div class="admin-product-photos-rew">
            <div class="admin-photos">
                <h1 class="admin-h3">Фотографии</h1>
                <form @submit.prevent="">
                    <div class="uploaded-content">
                        <img :src="img.img" v-for="(img, i) in loadedImg" @click="clickImg(i)" v-bind:class="img.active ? 'puprr-border' : 'unctive-blu-img'" alt="">
                    </div>
                    <div class="wrap-load">
                        <label for="loadImg" class="admin-btn-add">Добавить изображение <img src="../../../img/purpp-krest.png" alt=""></label>
                    </div>
                    <div class="wrap-load">
                        <label for="loadVid" class="admin-btn-add">Добавить видео <img src="../../../img/purpp-krest.png" alt=""></label>
                    </div>
                    <button class="admin-btn-complete">выбрать обложкой</button>
                    <input type="file" value="Добавить изображение" id="loadImg" ref="img" @change="loadImg()" multiple accept="image/jpeg,image/png">
                    <input type="file" value="Добавить видео" id="loadVid" ref="vid" @change="loadVid()" accept="video/*">
                </form>
                <div class="admin-main-photo">
                    <img :src="mainImg" alt="">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductCart",
        data: () => ({
            nameProduct: 'Комбинезон LAPPINALLE',
            priceProduct: 5000,
            saleProduct: null,
            sizes: [],
            newSize: null,
            mainImg: null,
            loadedImg: []
        }),
        methods: {
            addSize(){
                if (this.newSize) this.sizes.push(this.newSize)
            },
            loadImg(){
                let reader  = new FileReader();
                reader.readAsDataURL(this.$refs.img.files[0]);
                reader.addEventListener("load", function () {
                    this.loadedImg.push({active: false, img: reader.result});
                }.bind(this), false);
            },
            loadVid(){

            }
        }
    }
</script>

<style scoped>

</style>
