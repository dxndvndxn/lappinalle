<template>
    <div class="admin-reviews">
        <AdminTopSide v-bind:H="'отзывы'"/>
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
        <div class="admin-reviews-list" v-for="(review, i) in returnGetAllReviews">
            <div class="list-cell">
                <input type="text" class="input-pale-blu" :value="review.reviews_id" disabled>
            </div>
            <div class="list-cell">
                <input type="text" class="input-pale-blu" :value="review.reviews_created" disabled>
            </div>
            <div class="list-cell">
                <input type="text" class="input-pale-blu" :value="review.lappiusers_name" disabled>
            </div>
            <div class="list-cell">
                <input type="text" class="input-pale-blu" :value="review.product_title" disabled>
                <router-link :to="{path: `review-${review.reviews_id}`}"><img src="../../../img/admin-set.png" alt=""></router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "AdminReviews",
        components: {AdminTopSide},
        created() {
            this.$Progress.start();
            this.$store.dispatch('GetAllReviews');
        },
        computed: {
            returnGetAllReviews(){
                this.$Progress.finish();
                return this.$store.getters.GetAllReviews;
            }
        }
    }
</script>

<style scoped>

</style>
