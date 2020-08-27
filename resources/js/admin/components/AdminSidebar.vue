<template>
    <div class="admin-sidebar__tabs">
        <ul class="admin-sidebar__tab">
            <li v-for="(tab, i) in tabs" @click="clickTab(i)" v-bind:class="tab.active ? 'active-admin-tab' : null">
                <router-link :to="{name: tab.path}" exact-active-class="active-admin-tab">
                    {{tab.name}}
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "AdminSidebar",
        data: () => ({
            tabs: [
                {name: 'Категории', path: 'AdminCategories', active: true},
                {name: 'Товары', path: 'AdminProducts', active: false},
                {name: 'Главная', path: 'AdminMainPage', active: false},
                {name: 'Доставка', path: 'AdminDelivery', active: false},
                {name: 'Заказы', path: 'AdminOrders', active: false},
                {name: 'Пользователи', path: 'AdminUsers', active: false},
            ]
        }),
        methods: {
            clickTab(i){
                this.tabs.forEach(el => el.active = false);
                this.tabs[i].active = true;
            }
        }
    }
</script>

<style>

</style>
