<template>
  <div class="admin-new-smth">
      <AdminTopSide v-bind:H="'Бренды'"/>
      <AdminAddSmth :myPlaceholder="'Новый бренд'" :addFunc="addNewBrand" />
      <p v-if="error" class="error-size">Такой бренд уже существует</p>
      <!-- <div class="wrap-new-size-grid" v-if="getAllBrands !== null">
            <span v-for="(br, i) in getAllBrands" :key="i">
                    {{br.brands_name}}
            </span>
      </div> -->
      <GridData :dataGrid="getAllBrands" :afterDot="'brands_name'" :id="'brands_id'" :funcDel="deleteBrand"/>
  </div>
</template>

<script>
import AdminTopSide from "../components/AdminTopSide";
import AdminAddSmth from "../components/AdminAddSmth";
import GridData from "../components/GridData";

export default {
    name: 'AdminNewBrand',
    data: () => ({
        error: false
    }),
    components: { AdminTopSide, AdminAddSmth, GridData },
    created() {
        this.$store.dispatch('getAllBrands')
    },
    methods: {
        addNewBrand(newBrand){
            let findBrand = this.getAllBrands.find(brand => brand.brands_name == newBrand)

            if (findBrand) {
                this.error = true
                return
            }else {
                this.error = false
            }
            this.$Progress.start()
            this.$store.dispatch('ManageBrand', {newBrand, add: true})
                .then(res => {
                    if (res) {
                        this.$store.dispatch('getAllBrands')
                    }else{
                        this.$Progress.fail()
                    }
                })
        },
        deleteBrand(id){
            this.$Progress.start()
            this.$store.dispatch('ManageBrand', {id, add: false})
                .then(res => {
                    if (res) {
                        this.$store.dispatch('getAllBrands')
                    }else{
                        this.$Progress.fail()
                    }
                })
        }
    },
    computed: {
        getAllBrands(){
            this.$Progress.finish()
            return this.$store.getters.allBrands;
        }
    }
}
</script>

<style>

</style>