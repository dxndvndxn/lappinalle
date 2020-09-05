<template>
    <div class="admin-crumbs">
        <ul v-if="lvl === 3">
            <li v-for="(crmb, i) in crumbs" v-if="crmb.menu_lvlmenu === 3" @click="chooseCategory(crmb.sex_id, crmb.categories_id, crmb.departments_id)">
                {{crmb.sex_name}} | {{crmb.categories_name}} | {{crmb.departments_name}}
            </li>
        </ul>
        <ul v-if="sizes">
            <li v-for="(sz, i) in sizes" @click="chooseSize(sz.sizes_number, sz.sizes_id)">
                {{sz.sizes_number}}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "AdminCrumbs",
        props: ['lvl', 'crumbs', 'sizes'],
        data: () => ({

        }),
        methods: {
            chooseCategory(sexId, categId, departId){
                this.$emit('addNewCategory', {sexId, categId, departId});
                this.$emit('addNewCategoryForFresh', {sexId, categId, departId})
            },
            chooseSize(size, sizeId){
                this.$emit('addNewSize', {size, sizeId})
            }
        }
        // created() {
        //     if (this.getCrumbs === null) this.$store.dispatch('getMenuData');
        // },
        // computed: {
        //     getCrumbs(){
        //         return this.$store.getters.adminRawMenu;
        //     }
        // }
    }
</script>

<style scoped>

</style>
