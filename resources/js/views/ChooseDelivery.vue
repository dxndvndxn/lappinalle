<template>
    <div class="chozen-delivery container">
        <div class="chozen-delivery-header h1-m50">
            <Back v-bind:color="'grey'" v-bind:word="'Контактная информация'"/><h1 class="h1-bold-grey">Способ доставки</h1>
        </div>
        <div class="chozen-delivery-img chozen-imgs" v-if="returnDeliveries !== null">
            <img :src="del.delImg" v-for="(del, i) in deliveries" v-if="returnDeliveries[i].delivery_confirm === 1" v-bind:class="del.delChooze ? 'chozenImg' : null" alt="" @click="clickDel(i)">
        </div>
        <form @submit.prevent="toPay" class="chozen-delivery-fill">
            <div class="fill-inputs" v-if="deliveries[chozenDel].delivery_name === 'post-russia'">
                <div class="input-wrap">
                    <input type="text" class="classic-input" :class="{invalid: ($v.city.$dirty && !$v.city.required) || ($v.city.$dirty && !$v.city.maxLength)}" v-model.trim="city" placeholder="Город" autocomplete="on">
                    <small v-if="$v.city.$dirty && !$v.city.required" class="small-invalid">Поле Город должно быть заполнено</small>
                    <small v-if="$v.city.$dirty && !$v.city.maxLength" class="small-invalid">Поле Город заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" :class="{invalid: ($v.street.$dirty && !$v.street.required) || ($v.street.$dirty && !$v.street.maxLength)}" v-model.trim="street" placeholder="Улица" autocomplete="on">
                    <small v-if="$v.street.$dirty && !$v.street.required" class="small-invalid">Поле Улица должно быть заполнено</small>
                    <small v-if="$v.street.$dirty && !$v.street.maxLength" class="small-invalid">Поле Улица заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="house" :class="{invalid: ($v.house.$dirty && !$v.house.required) || ($v.house.$dirty && !$v.house.maxLength)}" placeholder="Дом" autocomplete="on">
                    <small v-if="$v.house.$dirty && !$v.house.required" class="small-invalid">Поле Дом должно быть заполнено</small>
                    <small v-if="$v.house.$dirty && !$v.house.maxLength" class="small-invalid">Поле Дом заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="corps" :class="{invalid: $v.corps.$dirty && !$v.corps.maxLength}" placeholder="Корпус" autocomplete="on">
                    <small v-if="$v.corps.$dirty && !$v.corps.maxLength" class="small-invalid">Поле Корпус заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="apart" :class="{invalid: ($v.apart.$dirty && !$v.apart.required) || ($v.apart.$dirty && !$v.apart.maxLength)}" placeholder="Квартира" autocomplete="on">
                    <small v-if="$v.apart.$dirty && !$v.apart.required" class="small-invalid">Поле Квартира должно быть заполнено</small>
                    <small v-if="$v.apart.$dirty && !$v.apart.maxLength" class="small-invalid">Поле Квартира заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                 <input type="number" class="classic-input" v-model.trim="indexPost" :class="{invalid: ($v.indexPost.$dirty && !$v.indexPost.required) || ($v.indexPost.$dirty && !$v.indexPost.maxLength)}" placeholder="Индекс" autocomplete="on">
                    <small v-if="$v.indexPost.$dirty && !$v.indexPost.required" class="small-invalid">Поле Индекс должно быть заполнено</small>
                    <small v-if="$v.indexPost.$dirty && !$v.indexPost.maxLength" class="small-invalid">Поле Индекс заполнено не корректно</small>
                </div>
                <div class="accept-checkbox">
                    <label>
                        <router-link :to="{name: 'UserAccept'}">
                            Выражаю согласие с условиями
                            политики конфиденциальности
                            и пользовательского соглашения
                        </router-link>
                    </label>
                    <input v-model.trim="checkAgree" type="checkbox" @click="checkAgree = !checkAgree"
                           v-bind:class="checkAgree ? 'active-size' : null">
                </div>
                <small v-if="$v.checkAgree.$dirty && !$v.checkAgree.required" class="small-invalid">Пожалуйста, подтвердите согласие с условиями политики конфиденциальности и пользовательского соглашения</small>
            </div>
            <div class="fill-inputs" v-if="deliveries[chozenDel].delivery_name === 'postman'">
                <div class="input-wrap">
                    <input type="text" class="classic-input" :class="{invalid: ($v.street.$dirty && !$v.street.required) || ($v.street.$dirty && !$v.street.maxLength)}" v-model.trim="street" placeholder="Улица" autocomplete="on">
                    <small v-if="$v.street.$dirty && !$v.street.required" class="small-invalid">Поле Улица должно быть заполнено</small>
                    <small v-if="$v.street.$dirty && !$v.street.maxLength" class="small-invalid">Поле Улица заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="house" :class="{invalid: ($v.house.$dirty && !$v.house.required) || ($v.house.$dirty && !$v.house.maxLength)}" placeholder="Дом" autocomplete="on">
                    <small v-if="$v.house.$dirty && !$v.house.required" class="small-invalid">Поле Дом должно быть заполнено</small>
                    <small v-if="$v.house.$dirty && !$v.house.maxLength" class="small-invalid">Поле Дом заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="corps" :class="{invalid:$v.corps.$dirty && !$v.corps.maxLength}" placeholder="Корпус" autocomplete="on">
                    <small v-if="$v.corps.$dirty && !$v.corps.maxLength" class="small-invalid">Поле Корпус заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="apart" :class="{invalid: ($v.apart.$dirty && !$v.apart.required) || ($v.apart.$dirty && !$v.apart.maxLength)}" placeholder="Квартира" autocomplete="on">
                    <small v-if="$v.apart.$dirty && !$v.apart.required" class="small-invalid">Поле Квартира должно быть заполнено</small>
                    <small v-if="$v.apart.$dirty && !$v.apart.maxLength" class="small-invalid">Поле Квартира заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <textarea class="classic-input comment-postman" v-model.trim="commentForPostman" :class="{invalidComment: $v.commentForPostman.$dirty && !$v.commentForPostman.maxLength }" placeholder="Комментарий" autocomplete="on">

                    </textarea>
                    <small v-if="$v.commentForPostman.$dirty && !$v.commentForPostman.maxLength" class="small-invalid">Поле Квартира заполнено не корректно</small>
                </div>
                <div class="accept-checkbox">
                    <label>
                        <router-link :to="{name: 'UserAccept'}">
                            Выражаю согласие с условиями
                            политики конфиденциальности
                            и пользовательского соглашения
                        </router-link>
                    </label>
                    <input v-model.trim="checkAgree" type="checkbox" @click="checkAgree = !checkAgree"
                           v-bind:class="checkAgree ? 'active-size' : null">
                </div>
                <small v-if="$v.checkAgree.$dirty && !$v.checkAgree.required" class="small-invalid">Пожалуйста, подтвердите согласие с условиями политики конфиденциальности и пользовательского соглашения</small>
            </div>
            <div class="fill-inputs" v-if="deliveries[chozenDel].delivery_name === 'sdek'">
                <div class="input-wrap">
                    <input type="text" class="classic-input" :class="{invalid: ($v.city.$dirty && !$v.city.required) || ($v.city.$dirty && !$v.city.maxLength)}" v-model.trim="city" placeholder="Город" autocomplete="on">
                    <small v-if="$v.city.$dirty && !$v.city.required" class="small-invalid">Поле Город должно быть заполнено</small>
                    <small v-if="$v.city.$dirty && !$v.city.maxLength" class="small-invalid">Поле Город заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" :class="{invalid: ($v.street.$dirty && !$v.street.required) || ($v.street.$dirty && !$v.street.maxLength)}" v-model.trim="street" placeholder="Улица" autocomplete="on">
                    <small v-if="$v.street.$dirty && !$v.street.required" class="small-invalid">Поле Улица должно быть заполнено</small>
                    <small v-if="$v.street.$dirty && !$v.street.maxLength" class="small-invalid">Поле Улица заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="house" :class="{invalid: ($v.house.$dirty && !$v.house.required) || ($v.house.$dirty && !$v.house.maxLength)}" placeholder="Дом" autocomplete="on">
                    <small v-if="$v.house.$dirty && !$v.house.required" class="small-invalid">Поле Дом должно быть заполнено</small>
                    <small v-if="$v.house.$dirty && !$v.house.maxLength" class="small-invalid">Поле Дом заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="corps" :class="{invalid: $v.corps.$dirty && !$v.corps.maxLength}" placeholder="Корпус" autocomplete="on">
                    <small v-if="$v.corps.$dirty && !$v.corps.maxLength" class="small-invalid">Поле Корпус заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="apart" :class="{invalid: ($v.apart.$dirty && !$v.apart.required) || ($v.apart.$dirty && !$v.apart.maxLength)}" placeholder="Квартира" autocomplete="on">
                    <small v-if="$v.apart.$dirty && !$v.apart.required" class="small-invalid">Поле Квартира должно быть заполнено</small>
                    <small v-if="$v.apart.$dirty && !$v.apart.maxLength" class="small-invalid">Поле Квартира заполнено не корректно</small>
                </div>
                <!-- <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="passportData" :class="{invalid: ($v.passportData.$dirty && !$v.passportData.required) || ($v.passportData.$dirty && !$v.passportData.validFormat)}" placeholder="Серия и номер паспорта" autocomplete="on">
                    <small v-if="$v.passportData.$dirty && !$v.passportData.required" class="small-invalid">Серия и номер паспорта должно быть заполнено</small>
                    <small v-else-if="$v.passportData.$dirty && !$v.passportData.validFormat" class="small-invalid">Серия и номер паспорта должны быть в формате 1234 567890</small>
                </div> -->
                <div class="wrap-checkbox">
                    <label for="adress">До адреса <input type="radio" id="adress" name="whatList" value="До адреса" v-model="whereGet" ></label>
                    <label for="stock">До пункта выдачи <input type="radio" id="stock" name="whatList" value="До пункта выдачи" v-model="whereGet"></label>
                    <small v-if="$v.whereGet.$dirty && !$v.whereGet.required" class="small-invalid">Пожалуйста, укажите способ доставки</small>
                </div>
                <div class="accept-checkbox">
                    <label>
                        <router-link :to="{name: 'UserAccept'}">
                            Выражаю согласие с условиями
                            политики конфиденциальности
                            и пользовательского соглашения
                        </router-link>
                    </label>
                    <input v-model.trim="checkAgree" type="checkbox" @click="checkAgree = !checkAgree"
                           v-bind:class="checkAgree ? 'active-size' : null">
                </div>
                <small v-if="$v.checkAgree.$dirty && !$v.checkAgree.required" class="small-invalid">Пожалуйста, подтвердите согласие с условиями политики конфиденциальности и пользовательского соглашения</small>
            </div>
            <div class="fill-inputs" v-if="deliveries[chozenDel].delivery_name === 'pek'">
                <div class="input-wrap">
                    <input type="text" class="classic-input" :class="{invalid: ($v.city.$dirty && !$v.city.required) || ($v.city.$dirty && !$v.city.maxLength)}" v-model.trim="city" placeholder="Город" autocomplete="on">
                    <small v-if="$v.city.$dirty && !$v.city.required" class="small-invalid">Поле Город должно быть заполнено</small>
                    <small v-if="$v.city.$dirty && !$v.city.maxLength" class="small-invalid">Поле Город заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" :class="{invalid: ($v.street.$dirty && !$v.street.required) || ($v.street.$dirty && !$v.street.maxLength)}" v-model.trim="street" placeholder="Улица" autocomplete="on">
                    <small v-if="$v.street.$dirty && !$v.street.required" class="small-invalid">Поле Улица должно быть заполнено</small>
                    <small v-if="$v.street.$dirty && !$v.street.maxLength" class="small-invalid">Поле Улица заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="house" :class="{invalid: ($v.house.$dirty && !$v.house.required) || ($v.house.$dirty && !$v.house.maxLength)}" placeholder="Дом" autocomplete="on">
                    <small v-if="$v.house.$dirty && !$v.house.required" class="small-invalid">Поле Дом должно быть заполнено</small>
                    <small v-if="$v.house.$dirty && !$v.house.maxLength" class="small-invalid">Поле Дом заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="corps" :class="{invalid: $v.corps.$dirty && !$v.corps.maxLength}" placeholder="Корпус" autocomplete="on">
                    <small v-if="$v.corps.$dirty && !$v.corps.maxLength" class="small-invalid">Поле Корпус заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="apart" :class="{invalid: ($v.apart.$dirty && !$v.apart.required) || ($v.apart.$dirty && !$v.apart.maxLength)}" placeholder="Квартира" autocomplete="on">
                    <small v-if="$v.apart.$dirty && !$v.apart.required" class="small-invalid">Поле Квартира должно быть заполнено</small>
                    <small v-if="$v.apart.$dirty && !$v.apart.maxLength" class="small-invalid">Поле Квартира заполнено не корректно</small>
                </div>
                <div class="input-wrap">
                    <input type="text" class="classic-input" v-model.trim="passportData" :class="{invalid: ($v.passportData.$dirty && !$v.passportData.required) || ($v.passportData.$dirty && !$v.passportData.validFormat)}" placeholder="Серия и номер паспорта" autocomplete="on">
                    <small v-if="$v.passportData.$dirty && !$v.passportData.required" class="small-invalid">Серия и номер паспорта должно быть заполнено</small>
                    <small v-else-if="$v.passportData.$dirty && !$v.passportData.validFormat" class="small-invalid">Серия и номер паспорта должны быть в формате 1234 567890</small>
                </div>
                <div class="wrap-checkbox">
                    <label for="adress">До адреса <input type="radio" id="adress" name="whatList" value="До адреса" v-model="whereGet" ></label>
                    <label for="stock">До пункта выдачи <input type="radio" id="stock" name="whatList" value="До пункта выдачи" v-model="whereGet"></label>
                    <small v-if="$v.whereGet.$dirty && !$v.whereGet.required" class="small-invalid">Пожалуйста, укажите способ доставки</small>
                </div>
                <div class="accept-checkbox">
                    <label>
                        <router-link :to="{name: 'UserAccept'}">
                            Выражаю согласие с условиями
                            политики конфиденциальности
                            и пользовательского соглашения
                        </router-link>
                    </label>
                    <input v-model.trim="checkAgree" type="checkbox" @click="checkAgree = !checkAgree"
                           v-bind:class="checkAgree ? 'active-size' : null">
                </div>
                <small v-if="$v.checkAgree.$dirty && !$v.checkAgree.required" class="small-invalid">Пожалуйста, подтвердите согласие с условиями политики конфиденциальности и пользовательского соглашения</small>
            </div>
            <div class="chozen-delivery-text">
                <p>
                    {{deliveries[chozenDel].delText}}
                </p>
<!--                <div class="chozen-delivery-price" v-if="deliveries[chozenDel].delivery_name === 'postman'">-->
<!--                    Стоимость доставки:-->
<!--                    <span v-if="$store.getters.totalPrice >= deliveries[chozenDel].freeShip">0 &#8381;</span>-->
<!--                    <span v-else>{{deliveries[chozenDel].delPrice + ' &#8381;'}} </span>-->
<!--                </div>-->
<!--                <div class="chozen-delivery-total" v-if="deliveries[chozenDel].delivery_name === 'postman'">-->
<!--                    Итоговая стоимость: <span>{{$store.getters.totalPrice >= 2000 ? $store.getters.totalPrice : $store.getters.totalPrice + 300}} &#8381;</span>-->
<!--                </div>-->
            </div>
            <div class="chozen-delivery-btn">
                <button class="classic-btn-sz btn">следующий шаг</button>
            </div>
        </form>
    </div>
</template>

<script>
    import Back from "../components/Back";
    import {required, maxLength, minLength} from 'vuelidate/lib/validators';
    export default {
        name: "ChooseDelivery",
        components: {Back},
        data: () => ({
            deliveries: [
                {
                    delivery_name: 'postman',
                    delImg: '../img/postman-icon.png',
                    delText: 'БЕСПЛАТНАЯ КУРЬЕРСКАЯ ДОСТАВКА ПО САНКТ-ПЕТЕРБУРГУ В ПРЕДЕЛАХ КАД ПРИ ЗАКАЗЕ НА СУММУ ОТ 2000 РУБ. ПРИ ЗАКАЗЕ НА СУММУ МЕНЕЕ 2000 РУБ, ОТКАЗЕ ОТ ЗАКАЗА ИЛИ ВЫКУПЕ ЗАКАЗА НА СУММУ МЕНЕЕ 2000 РУБ, СТОИМОСТЬ КУРЬЕРСКОЙ ДОСТАВКИ СОСТАВИТ 300 РУБ.',
                    delPrice: 300,
                    delChooze: true,
                    freeShip: 2000
                },
                {
                    delivery_name: 'post-russia',
                    delImg: '../img/post-icon.png',
                    delText: 'ПО РОССИИ ДОСТАВКА ПОЧТОЙ РОССИИ ЗАКАЗОВ ОТ 2000 РУБ. ПРИ ЗАКАЗЕ НА СУММУ ОТ 5000 РУБ ДОСТАВКА ПО РОССИИ ПОЧТОЙ РОССИИ БЕСПЛАТНАЯ (ЗА ИСКЛЮЧЕНИЕМ ДОСТАВКИ В ТРУДНОДОСТУПНЫЕ РАЙОНЫ, ОПЛАЧИВАЕМЫЕ ПО ИНДИВИДУАЛЬНЫМ ТАРИФАМ).ПРИ ЗАКАЗЕ НА СУММУ МЕНЕЕ 2000 РУБ, ПОМИМО ПОЧТОВЫХ РАСХОДОВ, ОПЛАЧИВАЮТСЯ КУРЬЕРСКИЕ УСЛУГИ В РАЗМЕРЕ 300 РУБ.',
                    delPrice: null,
                    delChooze: false
                },
                {
                    delivery_name: 'sdek',
                    delImg: '../img/sdek-icon.png',
                    delText: 'При выборе доставки до пункта выдачи детали сообщит менеджер.',
                    delPrice: null,
                    delChooze: false
                },
                {
                    delivery_name: 'pek',
                    delImg: '../img/pek-icon.png',
                    delText: 'Доставка ПЭК действительна при сумме заказа от 2000 рублей. При выборе доставки до пункта выдачи детали сообщит менеджер.',
                    delPrice: null,
                    delChooze: false
                },
            ],
            city: null,
            house: null,
            apart: null,
            corps: null,
            street: null,
            indexPost: null,
            passportData: null,
            chozenDel: 0,
            whereGet: null,
            commentForPostman: null,
            checkAgree: null
        }),
        metaInfo(){
            return {
                title: "Выбор доставки"
            }
        },
        validations: {
            city: {
                required,
                maxLength: maxLength(50)
            },
            street: {
                required,
                maxLength: maxLength(100)
            },
            house: {
                required,
                maxLength: maxLength(20)
            },
            corps: {
                maxLength: maxLength(20)
            },
            apart: {
                required,
                maxLength: maxLength(20)
            },
            indexPost: {
                required,
                maxLength: maxLength(6)
            },
            passportData: {
                required,
                validFormat: val => /^\d{4} \d{6}$/.test(val),
            },
            whereGet: {
                required
            },
            commentForPostman: {
                maxLength: maxLength(150)
            },
            checkAgree: {
                required
            }
        },
        methods: {
            clickDel(i){
                this.chozenDel = i;
                this.deliveries.forEach(el => el.delChooze = false);
                this.deliveries[i].delChooze = true;
            },
            toPay(){
                if (this.$v.checkAgree.$invalid){
                    this.$v.$touch()
                    return;
                }
                if (this.$v.corps.$invalid){
                    this.$v.$touch();
                    return;
                }
                if (this.$v.commentForPostman.$invalid){
                    this.$v.$touch();
                    return;
                }
                if (this.$v.checkAgree.$invalid || !this.checkAgree){
                    this.$v.$touch();
                    return;
                }
                if (this.deliveries[this.chozenDel].delivery_name === 'post-russia'){
                    if (this.$v.city.$invalid || this.$v.street.$invalid || this.$v.house.$invalid || this.$v.apart.$invalid || this.$v.indexPost.$invalid){
                        this.$v.$touch();
                        return;
                    }
                }
                if (this.deliveries[this.chozenDel].delivery_name === 'postman'){
                    if (this.$v.street.$invalid || this.$v.house.$invalid || this.$v.apart.$invalid) {
                        this.$v.$touch();
                        return;
                    }
                }
                if (this.deliveries[this.chozenDel].delivery_name === 'sdek') {
                    if (this.$v.city.$invalid || this.$v.street.$invalid || this.$v.house.$invalid || this.$v.apart.$invalid){
                        this.$v.$touch();
                        return;
                    }
                }
                if (this.deliveries[this.chozenDel].delivery_name === 'pek') {
                    if (this.$v.city.$invalid || this.$v.street.$invalid || this.$v.house.$invalid || this.$v.apart.$invalid) {
                        this.$v.$touch();
                        return;
                    }
                }
                if (this.deliveries[this.chozenDel].delivery_name === 'pek' && this.$v.passportData.$invalid){
                    this.$v.$touch();
                    return;
                }
                if ((this.deliveries[this.chozenDel].delivery_name === 'pek' || this.deliveries[this.chozenDel].delivery_name === 'sdek') && this.$v.whereGet.$invalid){
                    this.$v.$touch();
                    return;
                }
                else {
                    let data = {
                        city: this.city,
                        house: this.house,
                        apart: this.apart,
                        corps: this.corps,
                        street: this.street,
                        indexPost: this.indexPost,
                        deliveryName: this.deliveries[this.chozenDel].delivery_name,
                        passportData: this.passportData,
                        whereGet: this.whereGet,
                        comment: this.commentForPostman
                    };
                    this.$store.dispatch('DeliveryData', data).then(() => this.$router.push({name: 'choosePay'}));
                }
            }
        },
        created(){
            this.$Progress.start();
            this.$store.dispatch('GetAllDeliveries');
            this.$store.dispatch('GetUserData');
        },
        computed: {
            returnDeliveries(){
                this.$Progress.finish();
                return this.$store.getters.GetAllDeliveries;
            },
            getUserData(){
                return this.$store.getters.userData;
            },
        },
        watch:{
            getUserData(user){
                if (user !== null){
                    this.city = user[0][4]
                    this.street = user[0][5]
                    this.house = user[0][6]
                    this.corps = user[0][7]
                    this.apart = user[0][8]
                    this.indexPost = user[0][9]
                    this.$Progress.finish()
                }
            }
        }
    }
</script>

<style scoped>

</style>
