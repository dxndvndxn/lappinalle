<template>
    <div class="admin-main-page">
        <div class="admin-main-page-header">
            <h1 class="admin-h1">главная страница</h1>
            <button class="admin-btn-complete width-300">Сохранить изменения</button>
            <button class="admin-btn-add width-300" @click="uploadMainBaner(null, null, null, false, true)">
                Добавить блок <img src="../../../img/krest-btn.png" alt="">
            </button>
        </div>
        <div class="admin-main-wrap">
            <div class="admin-main-baner">
                <h2 class="admin-h2">Основной баннер</h2>
                <div class="wrap-main-page width-300 admin-cl-lbl-inp">
                    <label for="main-head" class="admin-h3">Главная картинка</label>
                    <img :src="mainpage_main_img" alt="" class="admin-main-img">
                    <label for="loadMainImg" class="admin-btn-add">Добавить изображение <img src="../../../img/purpp-krest.png" alt=""></label>
                    <input type="file" value="Добавить изображение" id="loadMainImg" ref="mainImg" @change="uploadMainBaner(null,null, 1, true)" accept="image/jpeg,image/png">
                </div>
                <div class="wrap-main-page width-300 admin-cl-lbl-inp">
                    <label for="main-head" class="admin-h3">Заголовок</label>
                    <input type="text" id="main-head" class="input-pale-blu" @change="uploadMainBaner('mainpage_main_h1', mainpage_main_h1, 1, false)" v-model.trim="mainpage_main_h1">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label for="main-minhead" class="admin-h3">Подзаголовок</label>
                    <input type="text" class="input-pale-blu" id="main-minhead" @change="uploadMainBaner('mainpage_main_h2', mainpage_main_h2, 1, false)" v-model.trim="mainpage_main_h2">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label for="main-text" class="admin-h3">Текст</label>
                    <input type="text" class="input-pale-blu" id="main-text" @change="uploadMainBaner('mainpage_main_h3', mainpage_main_h3, 1, false)" v-model.trim="mainpage_main_h3">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label for="btn-text" class="admin-h3">Текст кнопки</label>
                    <input type="text" class="input-pale-blu" id="btn-text" @change="uploadMainBaner('mainpage_main_but_text', mainpage_main_but_text, 1, false)" v-model.trim="mainpage_main_but_text">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Ссылка</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" @change="uploadMainBaner('mainpage_main_but_href', mainpage_main_but_href, 1, false)" v-model.trim="mainpage_main_but_href">
                    </div>
                </div>
            </div>
            <div class="admin-main-blocks">
                <h2 class="admin-h2">Блок №1</h2>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Заголовок</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Карусель</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <AdminCrumbs v-bind:lvl="3" @addNewCategory="chooseCategoryCarousel" v-bind:crumbs="getCrumbs"/>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Заголовок баннера</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Скидка</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Новая цена</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Текст кнопки</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Ссылка</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                </div>
                <button class="admin-btn-delete width-300">удалить блок</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import AdminCrumbs from "../components/AdminCrumbs";
    export default {
        name: "AdminMainPage",
        components: {
            AdminCrumbs
        },
        data: () => ({
            // Самый первый блок
            mainpage_main_h1: null,
            mainpage_main_h2: null,
            mainpage_main_h3: null,
            mainpage_main_but_text: null,
            mainpage_main_but_href: null,
            mainpage_main_img: null,


            chosenCat: null,
            activeBtn: true,
            whatList: null
        }),
        methods: {
            async uploadMainBaner(name, value, id, img, addBlock) {
                // this.$Progress.start()
                let formData = new FormData();

                if (addBlock) {
                    formData.append('data', JSON.stringify({addEmptyBlock: true}));

                    axios.post(`${this.URI}mainupd`, formData)
                        .then(res => {
                            console.log(res.data)

                        })
                        .catch(e => console.log(e))
                    return;
                }

                if (img) {
                    let img = this.$refs.mainImg.files[0];
                    let data = {
                        id
                    }

                    formData.append('data', JSON.stringify(data));
                    formData.append('mainpage_main_img', img)
                    axios.post(`${this.URI}mainupd`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(res => {
                        console.log(res.data)
                    })
                    .catch(e => console.log(e))
                }else{

                    let data = {
                        id,
                        [name]: value
                    }

                    formData.append('data', JSON.stringify(data));

                    axios.post(`${this.URI}mainupd`, formData)
                        .then(res => {
                            console.log(res.data)
                        })
                        .catch(e => console.log(e))
                }
            },
            async chooseCategoryCarousel(data){

                let localData = {
                    id,
                    mainpage_block_menu_sex: data.sexId,
                    mainpage_block_menu_dep: data.departId,
                    mainpage_block_menu_cat: data.categId
                }

                let formData = new FormData();
                formData.append('data', JSON.stringify(localData));

                axios.post(`${this.URI}mainupd`, formData)
                    .then(res => {
                        console.log(res.data)
                    })
                    .catch(e => console.log(e))
            }
        },
        created() {
            // this.$Progress.start()
            this.$store.dispatch('GetMainPageAdmin');
            if (this.getCrumbs === null) this.$store.dispatch('getMenuData');
        },
        computed: {
            URI(){
                return this.$store.getters.URI;
            },
            getCrumbs(){
                return this.$store.getters.adminRawMenu;
            },
        }
    }
</script>

<style scoped>

</style>
