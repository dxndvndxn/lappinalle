<template>
    <div class="catalog-sidebar">
        {{getSidebar}}
        {{sidebar}}
        {{side}}
        <dl>
            <dt class="sidebar-gender"><router-link :to="{name: 'gender', params: {gender: $route.params.gender}}"></router-link></dt>
        </dl>
    </div>
</template>

<script>
    export default {
        name: "Sidebar",
        props: ['sidebar'],
        data: () => ({
            side: null
        }),
        computed: {
            getSidebar(){
                this.side = this.$store.getters.sidebar;
                console.log(this.side, 'Hi Mark');
                return this.side;
            },
            watch: {
                side(val){
                    this.side = val;
                }
            }
        }
    }
</script>

<style scoped>

</style>
