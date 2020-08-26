<template>
    <div class="admin-main-page">
        <div class="admin-main-page-header">
            <h1 class="admin-h1">главная страница</h1>
            <button class="admin-btn-complete width-300">Сохранить изменения</button>
            <button class="admin-btn-add width-300">
                Добавить блок <img src="../../../img/krest-btn.png" alt="">
            </button>
        </div>
        <div class="admin-main-wrap">
            <div class="admin-main-baner">
                <h2 class="admin-h2">Основной баннер</h2>
                <div class="wrap-main-page width-300">
                    <label for="main-head" class="admin-h3">Заголовок</label>
                    <input type="text" id="main-head" class="input-pale-blu" v-model.trim="head">
                </div>
                <div class="wrap-main-page width-300">
                    <label for="main-minhead" class="admin-h3">Подзаголовок</label>
                    <input type="text" class="input-pale-blu" id="main-minhead" v-model.trim="minihead">
                </div>
                <div class="wrap-main-page width-300">
                    <label for="main-text" class="admin-h3">Текст</label>
                    <input type="text" class="input-pale-blu" id="main-text" v-model.trim="text">
                </div>
                <div class="wrap-main-page width-300">
                    <label for="btn-text" class="admin-h3">Текст кнопки</label>
                    <input type="text" class="input-pale-blu" id="btn-text" v-model.trim="btntext">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Ссылка</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <ul class="wrap-links" v-if="!activeBtn">
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    </ul>
                    <div class="wrap-checkbox">
                        <label for="category">Категория <input type="radio" name="whatList" value="category" v-bind:class="" v-model="whatList" id="category"></label>
                        <label for="product">Товар <input type="radio" name="whatList"value="product" v-model="whatList" id="product"></label>
                    </div>
                </div>
            </div>
            <div class="admin-main-blocks">
                <h2 class="admin-h2">Блок №1</h2>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Заголовок</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Категория</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <ul class="wrap-links" v-if="!activeBtn">
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    </ul>
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Заголовок баннера</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Скидка</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Новая цена</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Текст кнопки</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Ссылка</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <ul class="wrap-links" v-if="!activeBtn">
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    </ul>
                    <div class="wrap-checkbox">
                        <label for="category">Категория <input type="radio" name="whatList" value="category" v-bind:class="" v-model="whatList" ></label>
                        <label for="product">Товар <input type="radio" name="whatList"value="product" v-model="whatList"></label>
                    </div>
                </div>
                <button class="admin-btn-delete width-300">удалить блок</button>
            </div>
            <div class="admin-main-blocks">
                <h2 class="admin-h2">Блок №1</h2>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Заголовок</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Категория</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <ul class="wrap-links" v-if="!activeBtn">
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    </ul>
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Заголовок баннера</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Скидка</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Новая цена</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Текст кнопки</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Ссылка</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <ul class="wrap-links" v-if="!activeBtn">
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    </ul>
                    <div class="wrap-checkbox">
                        <label for="category">Категория <input type="radio" name="whatList" value="category" v-bind:class="" v-model="whatList" ></label>
                        <label for="product">Товар <input type="radio" name="whatList"value="product" v-model="whatList"></label>
                    </div>
                </div>
                <button class="admin-btn-delete width-300">удалить блок</button>
            </div>
            <div class="admin-main-blocks">
                <h2 class="admin-h2">Блок №1</h2>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Заголовок</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Категория</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <ul class="wrap-links" v-if="!activeBtn">
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    </ul>
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Заголовок баннера</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Скидка</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Новая цена</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Текст кнопки</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Ссылка</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <ul class="wrap-links" v-if="!activeBtn">
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    </ul>
                    <div class="wrap-checkbox">
                        <label for="category">Категория <input type="radio" name="whatList" value="category" v-bind:class="" v-model="whatList" ></label>
                        <label for="product">Товар <input type="radio" name="whatList"value="product" v-model="whatList"></label>
                    </div>
                </div>
                <button class="admin-btn-delete width-300">удалить блок</button>
            </div>
            <div class="admin-main-blocks">
                <h2 class="admin-h2">Блок №1</h2>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Заголовок</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Категория</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <ul class="wrap-links" v-if="!activeBtn">
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    </ul>
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Заголовок баннера</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Скидка</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Новая цена</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Текст кнопки</label>
                    <input type="text" class="input-pale-blu">
                </div>
                <div class="wrap-main-page width-300">
                    <label class="admin-h3">Ссылка</label>
                    <div class="wrap-input">
                        <input type="text" class="input-pale-blu" v-model="chosenCat" disabled>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                    </div>
                    <ul class="wrap-links" v-if="!activeBtn">
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                        <li>Мальчики | Верхняя одежда ЗИМА/ОСЕНЬ</li>
                    </ul>
                    <div class="wrap-checkbox">
                        <label for="category">Категория <input type="radio" name="whatList" value="category" v-bind:class="" v-model="whatList" ></label>
                        <label for="product">Товар <input type="radio" name="whatList"value="product" v-model="whatList"></label>
                    </div>
                </div>
                <button class="admin-btn-delete width-300">удалить блок</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AdminMainPage",
        data: () => ({
            head: 'Акция',
            minihead: 'СКИДКА 10%',
            text: 'НА ОСЕННЮЮ КОЛЛЕКЦИЮ',
            btntext: 'ПЕРЕЙТИ В РАЗДЕЛ',
            chosenCat: 'Мальчики | Верхняя одежда ЗИМ',
            activeBtn: true,
            whatList: true
        })
    }
</script>

<style scoped>

</style>
