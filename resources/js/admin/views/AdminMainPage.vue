<template>
    <div class="admin-main-page">
        <div class="admin-main-page-header">
            <h1 class="admin-h1">главная страница</h1>
            <button class="admin-btn-complete width-300">Сохранить изменения</button>
            <button class="admin-btn-add width-300" @click="uploadMainBaner(null, null, null, false, null,true)">
                Добавить блок <img src="../../../img/krest-btn.png" alt="">
            </button>
        </div>
        <div class="admin-main-wrap" v-if="GetMainPageAdmin !== null">
            <div class="admin-main-baner">
                <h2 class="admin-h2">Основной баннер</h2>
                <div class="wrap-main-page width-300 admin-cl-lbl-inp">
                    <label for="main-head" class="admin-h3">Главная картинка</label>
                    <img :src="mainpage_main_img" alt="" class="admin-main-img">
                    <label for="loadMainImg" class="admin-btn-add">Добавить изображение <img src="../../../img/purpp-krest.png" alt=""></label>
                    <input type="file" value="Добавить изображение" id="loadMainImg" ref="mainImg" @change="uploadMainBaner(null,null, 1, true, null,false)" accept="image/jpeg,image/png">
                </div>
                <div class="wrap-main-page width-300 admin-cl-lbl-inp">
                    <label for="main-head" class="admin-h3">Заголовок</label>
                    <input type="text" id="main-head" class="input-pale-blu" @change="uploadMainBaner('mainpage_main_h1', mainpage_main_h1, 1, null, null,false)" v-model.trim="mainpage_main_h1">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label for="main-minhead" class="admin-h3">Подзаголовок</label>
                    <input type="text" class="input-pale-blu" id="main-minhead" @change="uploadMainBaner('mainpage_main_h2', mainpage_main_h2, 1, null,null,false)" v-model.trim="mainpage_main_h2">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label for="main-text" class="admin-h3">Текст</label>
                    <input type="text" class="input-pale-blu" id="main-text" @change="uploadMainBaner('mainpage_main_h3', mainpage_main_h3, 1, null,null,false)" v-model.trim="mainpage_main_h3">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label for="btn-text" class="admin-h3">Текст кнопки</label>
                    <input type="text" class="input-pale-blu" id="btn-text" @change="uploadMainBaner('mainpage_main_but_text', mainpage_main_but_text, 1, null,false)" v-model.trim="mainpage_main_but_text">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Ссылка</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" @change="uploadMainBaner('mainpage_main_but_href', mainpage_main_but_href, 1, null,false)" v-model.trim="mainpage_main_but_href">
                    </div>
                </div>
            </div>
            <div class="admin-main-blocks" v-if="blocks !== null" v-for="(block, i) in blocks">
                <h2 class="admin-h2">Блок №{{blockNumber + i}}</h2>
                <div class="wrap-main-page width-300 admin-cl-lbl-inp">
                    <label for="main-head" class="admin-h3">Картинка банера</label>
                    <img :src="block.block_img" alt="" class="admin-main-img">
                    <label :for="'blockImg'+ block.block_id" class="admin-btn-add">Добавить изображение <img src="../../../img/purpp-krest.png" alt=""></label>
                    <input type="file" value="Добавить изображение" :id="'blockImg' + block.block_id" ref="blockImg" @change="uploadMainBaner(null,null, block.block_id, true, i,false)" accept="image/jpeg,image/png">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Заголовок</label>
                    <input type="text" v-model.lazy="blocks[i].block_carousel_h1" @change="uploadMainBaner('mainpage_name', blocks[i].block_carousel_h1, block.block_id, false, i,false)" class="input-pale-blu">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Карусель</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu"
                               v-for="(current, i) in getCrumbs"
                               :value="current.sex_name + (current.categories_name !== null ? ' | ' + current.categories_name : '') + (current.departments_name !== null ? ' | ' + current.departments_name : '')"
                               v-if="((current.sex_id == block.block_sex) && (current.categories_id == block.block_cat) && (current.departments_id == block.block_dep))"
                               disabled>
                        <input type="text" class="input-pale-blu" v-if="block.block_sex == null && block.block_cat == null && block.block_dep == null">
                        <button class="btn-admin-arrow" @click="GetActiveBlock(i, block.block_id)" v-bind:class="block.active ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <AdminCrumbs v-if="block.active" v-bind:lvl="'all'" @addNewCategory="chooseCategoryCarousel" v-bind:crumbs="getCrumbs"/>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Заголовок баннера</label>
                    <input type="text" class="input-pale-blu" v-model.lazy="blocks[i].block_h1" @change="uploadMainBaner('mainpage_block_h1', blocks[i].block_h1, block.block_id, false, i,false)">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Скидка</label>
                    <input type="text" class="input-pale-blu" v-model.lazy="blocks[i].block_sale" @change="uploadMainBaner('mainpage_block_sale', blocks[i].block_sale, block.block_id, false, i,false)">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Новая цена</label>
                    <input type="text" class="input-pale-blu" v-model.lazy="blocks[i].block_price" @change="uploadMainBaner('mainpage_block_price', blocks[i].block_price, block.block_id, false, i,false)">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Текст кнопки</label>
                    <input type="text" class="input-pale-blu" v-model.lazy="blocks[i].block_but_text" @change="uploadMainBaner('mainpage_block_but_text', blocks[i].block_but_text, block.block_id, false, i,false)">
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Ссылка</label>
                    <input type="text" class="input-pale-blu" v-model.lazy="blocks[i].block_but_href" @change="uploadMainBaner('mainpage_block_but_href', blocks[i].block_but_href, block.block_id, false, i,false)">
                </div>
                <button class="admin-btn-delete width-300" @click="DeleteBlock(block.block_id)">удалить блок</button>
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

            // Остальные блоки
            blocks: null,
            blockModel: {},

            // Активный блок
            activeId: null,

            // Счет блоков
            blockNumber: 1
        }),
        methods: {
            async uploadMainBaner(name, value, id, img, i, addBlock) {
                this.$Progress.start()
                let formData = new FormData();

                // Добавление пустого блока
                if (addBlock) {
                    formData.append('data', JSON.stringify({addEmptyBlock: true}));

                    axios.post(`${this.URI}mainupd`, formData)
                        .then(res => {

                            this.$store.dispatch('GetMainPageAdmin')
                                .then(res => {
                                    if (res) this.$Progress.finish()
                                })
                                .catch(e => this.$Progress.fail())
                        })
                        .catch(e => console.log(e))
                    return;
                }

                // Добавление картинки
                if (img) {

                    let img = null;

                    // Если изменятся главная картинка
                    if (this.$refs.mainImg.files[0] !== undefined) {
                        img = this.$refs.mainImg.files[0];
                    }

                    // Если изменяются остальные блоки
                    if (i !== null) {
                        if (this.$refs.blockImg[i].files[0] !== undefined) {
                            img = this.$refs.blockImg[i].files[0];
                        }
                    }

                    let data = {
                        id,
                        nameImg: i !== null ? this.blocks[i].block_img : this.mainpage_main_img
                    }

                    formData.append('data', JSON.stringify(data));
                    formData.append('mainpage_main_img', img);

                    axios.post(`${this.URI}mainupd`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(res => {
                        console.log(res.data)
                        this.$store.dispatch('GetMainPageAdmin')
                            .then(res => {
                                if (res) this.$Progress.finish()
                            })
                            .catch(e => this.$Progress.fail())
                    })
                    .catch(e => console.log(e))
                }
                // Если изменяются строковые значения
                else{

                    let data = {
                        id,
                        [name]: value
                    }

                    formData.append('data', JSON.stringify(data));

                    axios.post(`${this.URI}mainupd`, formData)
                        .then(res => {
                            this.$Progress.finish()
                        })
                        .catch(e => console.log(e))
                }
            },

            // Выбор категории
            async chooseCategoryCarousel(data){
                let localData = {
                    id: this.activeId,
                    mainpage_block_sex: data.sexId,
                    mainpage_block_dep: data.departId,
                    mainpage_block_cat: data.categId
                }

                let formData = new FormData();
                formData.append('data', JSON.stringify(localData));

                this.$Progress.start()
                axios.post(`${this.URI}mainupd`, formData)
                    .then(res => {
                        this.$store.dispatch('GetMainPageAdmin')
                            .then(res => {
                                if (res) this.$Progress.finish()
                            })
                            .catch(e => this.$Progress.fail())
                    })
                    .catch(e => console.log(e))
            },

            // Получаем активный ID
            GetActiveBlock(i, id) {
                this.activeId = id;
                this.blocks[i].active = !this.blocks[i].active;
            },

            // Удаление блока
            DeleteBlock(id){
                let data = {
                    id,
                    removeBlock: true
                }
                let formData = new FormData();
                formData.append('data', JSON.stringify(data));
                axios.post(`${this.URI}mainupd`, formData)
                .then(res => {
                    if (res.data) {
                        this.$store.dispatch('GetMainPageAdmin')
                            .then(res => {
                                console.log(res.data)
                                if (res) this.$Progress.finish()
                            })
                            .catch(() => this.$Progress.fail())
                    }
                })
                .catch(()=> this.$Progress.fail())
            }
        },
        created() {
            this.$Progress.start()
            this.$store.dispatch('GetMainPageAdmin')
            .then(res => {
                if (res) this.$Progress.finish()
            })
            .catch(e => this.$Progress.fail())
            if (this.getCrumbs === null) this.$store.dispatch('getMenuData');
        },
        watch: {
            GetMainPageAdmin(newValue){
                 // Главный банер
                 this.mainpage_main_img = newValue[0][0];
                 this.mainpage_main_h1 = newValue[0][1];
                 this.mainpage_main_h2 = newValue[0][2];
                 this.mainpage_main_h3 = newValue[0][3];
                 this.mainpage_main_but_text = newValue[0][4];
                 this.mainpage_main_but_href = newValue[0][5];

                 this.blocks = newValue[1];

            },
            blocks(newValue) {
                this.blocks = newValue;
            }
        },
        computed: {
            URI(){
                return this.$store.getters.URI;
            },
            getCrumbs(){
                return this.$store.getters.adminRawMenu;
            },
            GetMainPageAdmin: {
                get(){
                    return this.$store.getters.GetMainPageAdmin;
                },
                set(val){
                    return val;
                }
            }
        }
    }
</script>

<style scoped>

</style>
