<template>
    <div class="admin-reviews">
        <AdminTopSide v-bind:H="'отзывы'" v-bind:btn="false"/>
        <div class="admin-reviews-list">
            <div class="list-cell">
                <h1 class="admin-h3">
                    &#8470;
                </h1>
            </div>
            <div class="list-cell">
                <h1 class="admin-h3">Дата/время</h1>
            </div>
            <div class="list-cell">
                <h1 class="admin-h3">ФИО</h1>
            </div>
            <div class="list-cell">
                <h1 class="admin-h3">Товар</h1>
            </div>
        </div>
        <div class="admin-reviews-list">
            <div class="list-cell">
                <input type="text" class="input-pale-blu" value="1" disabled>
            </div>
            <div class="list-cell">
                <input type="text" class="input-pale-blu" value="21.08.2020  21:40" disabled>
            </div>
            <div class="list-cell">
                <input type="text" class="input-pale-blu" value="Иван Иванович Иванов" disabled>
            </div>
            <div class="list-cell">
                <input type="text" class="input-pale-blu" value="Комбинезон LAPPINALLE" disabled>
                <router-link :to="{path: `review-1`}"><img @click="editOrder()" src="../../../img/admin-set.png" alt=""></router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "AdminReviews",
        components: {AdminTopSide}
    }
</script>

<style scoped>

</style>
