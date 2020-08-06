<template>
    <div class="footer">
        <dl class="left-foot">
            <dt>Услуги</dt>
            <router-link tag="dd" to="/contacts"><a href="#">Контакты</a></router-link>
            <router-link tag="dd" to="payndelivery"><a href="#">Оплата и доставка</a></router-link>
            <router-link tag="dd" to="/guaranteenreturn"><a href="#">Гарантии и возврат товара</a></router-link>
            <router-link tag="dd" to="/confidential"><a href="#">Политика конфедециальности</a></router-link>
        </dl>
        <dl class="right-foot">
            <dt>Каталог</dt>
            <router-link tag="dd" to="/malchiki"><a href="#">Мальчки</a></router-link>
            <router-link tag="dd" to="/devochki"><a href="#">Девочки</a></router-link>
        </dl>
        <div class="bottom-foot">
            <div class="bottom-wrap"><span>2020 &copy; LAPPINALLE </span><span>Все права защищены</span></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Footer"
    }
</script>

<style scoped>

</style>
