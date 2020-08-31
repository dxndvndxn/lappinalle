<template>
    <div class="admin-crumbs">
        <ul v-if="lvl === 3">
            <li v-for="(crmb, i) in crumbs" v-if="crmb.menu_lvlmenu === 3" @click="chooseCategory(crmb.sex_id, crmb.categories_id, crmb.departments_id)">
                {{crmb.sex_name}} | {{crmb.categories_name}} | {{crmb.departments_name}}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "AdminCrumbs",
        props: ['lvl', 'crumbs'],
        data: () => ({

        }),
        methods: {
            chooseCategory(sexId, categId, departId){
                this.$emit('addNewCategory', {sexId, categId, departId});
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
