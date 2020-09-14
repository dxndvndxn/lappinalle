<template>
    <div class="admin-review-card">
        <AdminTopSide v-bind:H="`ОТЗЫВ №${this.$route.params.id}`" v-bind:btn="true"/>
        <div class="wrap-admin-review-card" v-for="(review, i) in returnGetOneReview">
            <div class="order-cl">
                <div class="wrap-main-page admin-cl-lbl-inp">
                    <label class="admin-h3">ФИО</label>
                    <input type="text" class="input-pale-blu" :value="review.lappiusers_name" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp">
                    <label class="admin-h3">Товар</label>
                    <input type="text" class="input-pale-blu" :value="review.product_title" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp">
                    <label class="admin-h3">Оценка</label>
                    <div class="star-container">
                        <span v-for="item in 5">
                                <svg width="18px" height="17px" viewBox="0 0 18 17">
    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Rounded" transform="translate(-273.000000, -4323.000000)">
            <g id="Toggle" transform="translate(100.000000, 4266.000000)">
                <g id="-Round-/-Toggle-/-star" transform="translate(170.000000, 54.000000)">
                    <g>
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path v-bind:class="+review.reviews_star >= item ? 'filled' : null" d="M12,17.27 L16.15,19.78 C16.91,20.24 17.84,19.56 17.64,18.7 L16.54,13.98 L20.21,10.8 C20.88,10.22 20.52,9.12 19.64,9.05 L14.81,8.64 L12.92,4.18 C12.58,3.37 11.42,3.37 11.08,4.18 L9.19,8.63 L4.36,9.04 C3.48,9.11 3.12,10.21 3.79,10.79 L7.46,13.97 L6.36,18.69 C6.16,19.55 7.09,20.23 7.85,19.77 L12,17.27 Z" id="🔹-Icon-Color"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg>
                            </span>
                    </div>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp">
                    <label class="admin-h3">Дата/время</label>
                    <input type="text" class="input-pale-blu" :value="review.reviews_created" disabled>
                </div>
                <div class="wrap-main-page admin-cl-lbl-inp">
                    <label class="admin-h3">ID пользователя в системе</label>
                    <input type="text" class="input-pale-blu" :value="review.lappiusers_id" disabled>
                </div>
                <button class="admin-btn-complete" @click="ChangeStatusReview(1)">Принять</button>
                <button class="admin-btn-add" @click="ChangeStatusReview(0)">
                    Отклонить
                </button>
            </div>
            <div class="order-cl">
                <div class="review-text admin-cl-lbl-inp width-300">
                    <label class="admin-h3">Текст отзыва</label>
                    <textarea class="input-pale-blu">{{review.reviews_text}}</textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import AdminTopSide from "../components/AdminTopSide";
    export default {
        name: "ReviewCard",
        components: {AdminTopSide},
        created() {
            this.$Progress.start();
            this.$store.dispatch('GetOneReview', this.$route.params.id);
        },
        computed: {
            returnGetOneReview(){
                this.$Progress.finish();
                return this.$store.getters.GetOneReview;
            },
            URI(){
                return this.$store.getters.URI;
            },
        },
        methods: {
            async ChangeStatusReview(status){
                this.$Progress.start()
                await axios.post(`${this.URI}modreview`, {reviews_id: this.$route.params.id, reviews_available: status})
                    .then((res) => {
                        console.log(res.data)
                        this.$Progress.finish()
                    })
                    .catch(e => console.log(e))
            }
        },
    }
</script>

<style scoped>

</style>
