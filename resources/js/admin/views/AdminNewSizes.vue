<template>
    <div class="admin-new-smth">
        <AdminTopSide v-bind:H="'РАЗМЕРЫ'"/>
        <AdminAddSmth :myPlaceholder="'Новый размер'" :addFunc="addNewSize" />
        <p v-if="error" class="error-size">Такой размер уже существует</p>
        <!-- <div class="wrap-new-size-grid" v-if="GetAllSizes !== null">
            <span v-for="(sz, i) in GetAllSizes" @dblclick="deleteSizeWithoutSale(sz.sizes_id)" :key="i">
                    {{sz.sizes_number}}
            </span>
        </div> -->
        <GridData :dataGrid="GetAllSizes" :afterDot="'sizes_number'" :id="'sizes_id'" :funcDel="deleteSizeWithoutSale"/>
    </div>
</template>

<script>
    import AdminTopSide from "../components/AdminTopSide";
    import AdminAddSmth from "../components/AdminAddSmth";
    import GridData from "../components/GridData";

    export default {
        name: "AdminNewSizes",
        data: () => ({
            error: false
        }),
        components: {
            AdminTopSide,
            AdminAddSmth,
            GridData
        },
        methods: {
            deleteSizeWithoutSale(szId){
                this.$Progress.start()
                this.$store.dispatch('DeleteNewSize', szId)
                    .then(res => {
                        if (res) {
                            this.$store.dispatch('GetAllSizes');
                        }
                        else this.$Progress.fail()
                    })
            },
            addNewSize(str){
                let findSize = this.GetAllSizes.find(sz => sz.sizes_number == str)

                if (!findSize){
                    this.$Progress.start()
                    this.$store.dispatch('AddNewSize', str)
                        .then(res => {
                            if (res) {
                                this.$store.dispatch('GetAllSizes');
                            }
                            else this.$Progress.fail()
                        })
                }else{
                    this.error = true;
                }
            }
        },
        created() {
            this.$store.dispatch('GetAllSizes');
        },
        computed: {
            GetAllSizes(){
                this.$Progress.finish()
                return this.$store.getters.getAllSizes;
            }
        }
    }
</script>

<style scoped>

</style>
