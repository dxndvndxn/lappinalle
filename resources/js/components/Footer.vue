<template>
    <div class="footer">
        <dl class="left-foot">
            <dt>Услуги</dt>
            <router-link tag="dd" to="/kontacty"><a href="#">Контакты</a></router-link>
            <router-link tag="dd" to="/oplata"><a href="#">Оплата</a></router-link>
            <router-link tag="dd" to="/dostavka"><a href="#">Доставка</a></router-link>
            <router-link tag="dd" to="/returnproduct"><a href="#">Гарантии и возврат товара</a></router-link>
            <router-link tag="dd" to="/privacy"><a href="#">Политика конфедециальности</a></router-link>
            <router-link tag="dd" to="/useraccept"><a href="#">Пользовательское Соглашение</a></router-link>
        </dl>
        <dl class="right-foot">
            <dt>Каталог</dt>
            <router-link
                v-for="(link, i) in getTopMenu"
                :key="i"
                tag="dd"
                :to="link.url"
            >
                <a href="#">{{link.title}}</a>
            </router-link>
        </dl>
        <div class="bottom-foot">
            <div class="bottom-wrap"><span>{{getYear.getFullYear()}} &copy; LAPPINALLE </span><span>Все права защищены</span></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Footer",
        data: () => ({
          getYear: new Date()
        }),
        computed: {
            // Отдаем мальчки, девочики ..
            getTopMenu(){
                return this.$store.getters.topMenu;
            }
        }
    }
</script>

<style scoped>

</style>
