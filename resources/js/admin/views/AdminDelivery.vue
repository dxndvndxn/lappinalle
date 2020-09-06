<template>
    <div class="admin-delivery">
        <AdminTopSide v-bind:H="'Страница доставки'" v-bind:btn="true"/>
        <h2 class="admin-h2">Доступные варианты доставки</h2>
        <div class="delivery-vars">
            <div class="delivery-var" v-for="(del, i) in deliveries">
                <input type="checkbox" v-bind:class="del.show ? 'active-size' : null" @change="changeDel(i, del.delId)">
                <label>{{del.name}}</label>
            </div>
        </div>
    </div>
</template>

<script>
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "AdminDelivery",
        components: {AdminTopSide},
        data: () =>({
            deliveries: [
                {
                    name: 'Курьерская доставка по СПБ',
                    show: true,
                    delId: 1,
                },
                {
                    name: 'СДЭК',
                    show: true,
                    delId: 2
                },
                {
                    name: 'ПЭК',
                    show: true,
                    delId: 3,
                },
                {
                    name: 'Почта России',
                    show: false,
                    delId: 4
                },
            ],
            changedDeliveries: []
        }),
        methods: {
            changeDel(i, delId){
                this.deliveries[i].show = !this.deliveries[i].show;

                // Находим есть ли уже такой элемент в массиве
                let isThereDel = this.changedDeliveries.find(el => el === delId);

                // Если есть, то удаляем
                // нету - добавляем, на выходе получается массив с id, которые нужно поменять
                if (isThereDel) {
                    this.changedDeliveries = this.changedDeliveries.filter(el => el !== isThereDel);
                }else {
                    this.changedDeliveries.push(delId);
                }

            }
        }
    }
</script>

<style scoped>

</style>
