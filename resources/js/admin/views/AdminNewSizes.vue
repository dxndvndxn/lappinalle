<template>
    <div class="admin-new-sizes">
        <AdminTopSide v-bind:H="'РАЗМЕРЫ'"/>
        <div class="wrap-add-new-sizes width-300">
            <input type="text" placeholder="Новый размер" v-model.trim="newsize" class="input-transp">
            <button @click="addNewSize" class="input-transp"><img src="../../../img/krest-btn.png"></button>
        </div>
        <p v-if="error" class="error-size">Такой размер уже существует</p>
        <div class="wrap-new-size-grid" v-if="GetAllSizes !== null">
            <span v-for="(sz, i) in GetAllSizes" @dblclick="deleteSizeWithoutSale(sz.sizes_id)">
                            {{sz.sizes_number}}
            </span>
        </div>
    </div>
</template>

<script>
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "AdminNewSizes",
        data: () => ({
           newsize: null,
            error: false
        }),
        components: {
            AdminTopSide
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
            addNewSize(){
                let findSize = this.GetAllSizes.find(sz => sz.sizes_number == this.newsize)

                if (!findSize){
                    this.$Progress.start()
                    this.$store.dispatch('AddNewSize', this.newsize)
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
