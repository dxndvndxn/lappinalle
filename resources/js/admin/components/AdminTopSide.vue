<template>
    <div class="admin-header-side">
        <h1 class="admin-h1">{{H}}</h1>
        <button class="admin-btn-complete width-300" v-if="btn">Сохранить изменения</button>
    </div>
</template>

<script>
    export default {
        name: "AdminTopSide",
        props: ['H', 'btn']
    }
</script>

<style scoped>

</style>
