<template>
    <div class="admin-delivery">
        <AdminTopSide v-bind:H="'Страница доставки'" v-bind:btn="true"/>
        <h2 class="admin-h2">Доступные варианты доставки</h2>
        {{returnDeliveries}}
        <div class="delivery-vars">
            <div class="delivery-var" v-for="(del, i) in returnDeliveries">
                <input type="checkbox" v-bind:class="del.delivery_confirm ? 'active-size' : null" @change="changeDel(i, del.delivery_id)">
                <label>{{del.delivery_name}}</label>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "AdminDelivery",
        components: {AdminTopSide},
        data: () =>({

        }),
        methods: {
            async changeDel(i, delId){
                this.$Progress.start();
                this.returnDeliveries[i].delivery_confirm = this.returnDeliveries[i].delivery_confirm === 1 ? 0 : 1;

               await axios.post(`${this.URI}deladmin`, {id: delId})
                    .then(res => {
                        this.$Progress.finish();
                        console.log(res.data);
                    })
                    .catch(e => console.log(e))
            }
        },
        created() {
            this.$Progress.start();
            this.$store.dispatch('GetAllDeliveries');
        },
        computed: {
            returnDeliveries(){
                this.$Progress.finish();
                return this.$store.getters.GetAllDeliveries;
            },
            URI(){
                return this.$store.getters.URI;
            },
        }
    }
</script>

<style scoped>

</style>
