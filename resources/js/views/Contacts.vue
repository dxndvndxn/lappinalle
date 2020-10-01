<template>
    <div class="contacts">
        <h1 class="h-30" v-if="media.wind > media.tablet">Контакты</h1>
        <div class="wrap-h" v-else>
            <Back v-bind:color="'grey'" v-bind:word="'Назад'"/>
            <h1 class="h-30">Контакты</h1>
        </div>
        <form v-on:submit.prevent="sentMessage">
            <div class="contact">
                <div class="call">
                    <a href=" https://wa.me/+79213294015">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 71 70">
                            <image id="e65c5be7773ae91757512b34777ead72" xlink:href="data:img/png;base64,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"/>
                        </svg>
                        +7 (921) 329-40-15
                    </a>
                </div>
                <div class="mail">
                    <a href="mailto:info@lappinalle.com">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 68 50">
                            <image id="_167-1671539_envelope-svg-png-icon-free-download-e-mail" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEQAAAAyCAYAAADlaH1uAAAFnUlEQVRogeWbCWwVRRjHf601eKQRNaJWjRoSb0FFPBE1HuABWpt4FgOKCYh4tmgMKorGKIhA0KiomKAiBEWUxAsUlXohKIIH8T4wFtGKR0UrxQz5b13HmX373u6+vtp/0nQ73+w3s9/OfMd/tmU3j38H4SLgAmBvoJzOgQ3AR8CDwL3miSv02PfJIJ0Rh+inDzDIGKSmExsjjFrgOWOQG3N0/BDYGtiyuPNLHa3Al8AewGYe5WMq5DOiYJzMeZJXdjw7bEQLsA4YCtwZ0W83Y5Dfc7z9c2XdQcAvGUy2WBgMTM0x1rpyPWwumP31HrBTBzXGZGBajH6tdng1e2yRp/P+wHLgiBQmWCyYHfAMMNIz3lLg43CDbRCzWo4CbvUoMM61ATizAxijClgC9PfIHwB6AWvDjbZBqvT7WqAuYrCZwJXJ5pspems19/AMMk4O1mDXsMA2yJ/AVrq+AxgYMWsjv7v0bEE18BawjUc+DBil6wo9cxtcKXrYyT4tK3/hUT5cfTYpfP6p4irgCY/CZuCEIEUXNtid4tQsy+VQX/HIT1WusmOxn97CXcB4j8w4zv2A+bmUxC3ifgWOliNyIYhABxfwIElRBjwFXOzR8zzQE/g8zjj5VrXGEV3jkW0LLNYeLha2V+gc4BnvfqCfks9YKKTMvw043bX/BLOH64tgkCCSHOCR1xVStBbKe8wFDgK+8chvV3aYFWoUSbbz6D9DUTBvJCGC3lUEavDIR8pwaUegy4HZHtl38mNzClWelBlrErEy3SMfqD3eLeE4ASZGVKuL5dyXJBkgLarwfOB6j6yH9nqvBPrLtdou88hniPVak2CMtoHSwljgbI8us0LeljPOF92U5/iy5ltEUaSCtMnkmVoJjR75nIi37ELPHDXJhcDo5NP+B1mw60u1l9/0yI0fmBRDT7Uct8v//AwcK7Y8VWR13PA9cBjwiEd+qbJLH66IqElWKg1fmMXEsz5/qY1wtgPkG3aw2s0KmuC551klYl+nPM82FONAaqyikAvm4ZYpBUerwudjDNVwksjizJCFQUwi9hDwvsJhpfKUI4EfHP2DCNQQUQeZsn6Ervsq51gRQQ0WjIq0FQKvKScw2AfYAjhN7fsC8xxV8c76sdEqIwX+xpDcL4f6TNYZy7i0Jp/2CnkxZIwAx4euG1WUzYqh61ttqbDztXWjummoo70gpGmQuQqFNuY52s6ymCsbn4Q4ljDMKlvv6D9VBV1ipGWQRz2ZpAmRQzz3DJNvaLLa52tL/ei4p1H8hguPRzDssZGGQczbOcfRvlpnOM0R95rw2l0rxmSdx4j3XBtxz4KIqGXOYA7Pc/7/QlKnOtGzf9crMXO9ZRtNMX1KGNPFhbg4j0Vy5ivz1LkRSVbITRE5Q9+4HGYCTPCQyuUqG3YpRHWhBjF7/zqPrFrOrxioV65jw5wtvSGeN3ODjIig+40feLJIxghgSv8XHO1VWild8lGWr0HMJwVTPLLRWVSfMXGiSgAb3SMoTifyMUhNxCcFU0TUtCdMRFvlGN/wMy+lbZB+EcTurCxqigJgwvuhjrwGhXNXgvgfxDFIH5XdLixUDlEqWKUI58IpEWR4G3IZ5EDgVY/sA0+q3t5YYdVPYdRa50VlcQwSdNoTeN2jeHWJf0m0IIJ4Ntt7jK7/ss+NbINsKr6yUnHcFbL+UHoclV6XAmboUMuFGxQxsc997dT9U/ESpozv6lFmiJ7PStwYASYpHxnlkE3TC/8K2D1otA3SVWyUzXMGODnpyVg74GqxcoMdQ98D/BZuMAbZPPS377NLcyJ2nD7N7IgYonPfesdZc/gb3S4V+hjGtz3CBumtk7eO+J8SzfJ5LTkO31uMQR4GLsmhcC99fPJ/x+xyVa2lHjGKAbOK6swK+Un5/mPKPTojDIdbC6z5G5bPBaPj63KNAAAAAElFTkSuQmCC"/>
                        </svg>
                        info@lappinalle.com
                    </a>
                </div>
            </div>
            <div class="email">
                <div class="wrap-email">
                    <div class="input-wrap">
                        <input type="text" class="classic-input" :class="{invalid: ($v.fio.$dirty && !$v.fio.required) || ($v.fio.$dirty && !$v.fio.minLength) || ($v.fio.$dirty && !$v.fio.maxLength)}" v-model.trim="fio" placeholder="ФИО" autocomplete="on">
                        <small v-if="$v.fio.$dirty && !$v.fio.required" class="small-invalid">Поле ФИО должно быть заполнено</small>
                        <small v-else-if="($v.fio.$dirty && !$v.fio.minLength) || ($v.fio.$dirty && !$v.fio.maxLength) " class="small-invalid">Поле ФИО заполнено не корректно</small>
                    </div>
                    <div class="input-wrap">
                        <input type="email" class="classic-input" :class="{invalid: ($v.email.$dirty && !$v.email.required) || ($v.email.$dirty && !$v.email.email)}" v-model.trim="email" placeholder="E-mail" autocomplete="on">
                        <small v-if="$v.email.$dirty && !$v.email.email" class="small-invalid">Поле E-mail заполнено не корректно</small>
                        <small v-else-if="$v.email.$dirty && !$v.email.required" class="small-invalid">Поле E-mail должно быть заполнено</small>
                    </div>
                    <button class="btn" v-if="media.wind > media.tablet">Отправить</button>
                </div>
                <div class="wrap-textarea">
                    <textarea v-model.trim="text" :class="{invalidComment: ($v.text.$dirty && !$v.text.required) || ($v.text.$dirty && !$v.text.maxLength)}" placeholder="Текст сообщения"></textarea>
                    <small v-if="$v.text.$dirty && !$v.text.maxLength" class="small-invalid">Поле Текст заполнено не корректно</small>
                    <small v-else-if="$v.text.$dirty && !$v.text.required" class="small-invalid">Поле Текст должно быть заполнено</small>
                    <button class="btn" v-if="media.wind < media.tablet">Отправить</button>
                </div>
            </div>
            <p class="reviewleave-success" v-if="successSent">
                Ваше письмо успешно отправлено.
            </p>
            <div class="wrap-text">
                <p>
                    ИП И. ЖУРАВЛЕВА:
                    <br>
                    Санкт-Петербург, Старопутиловский вал, дом 6, литер А
                    <br>
                    Номер расчетного счета: 40802810355000078566
                    <br>
                    Наименование банка: ПАО Сбербанк
                    <br>
                    Корреспондентский счет: 30101810500000000653
                    <br>
                    БИК: 044030653
                </p>
            </div>
        </form>
    </div>
</template>

<script>
    import {email, required, minLength, maxLength} from 'vuelidate/lib/validators'
    import axios from 'axios';
    import Back from "../components/Back";
    export default {
        name: "Contacts",
        components: {
            Back
        },
        data: () => ({
            fio: null,
            email: null,
            text: null,
            successSent: false
        }),
        validations: {
            fio: {
                required,
                minLength: minLength(2),
                maxLength: maxLength(30)
            },
            email: {
                email, required
            },
            text: {
                required,
                maxLength: maxLength(250)
            }
        },
        methods: {
            sentMessage(){
                if (this.$v.$invalid){
                    this.$v.$touch();
                    return;
                }
                this.$Progress.start();
                let formData = new FormData();
                formData.append('mail', JSON.stringify({mailer_name: this.fio, mailer_email: this.email, mailer_text: this.text}));
                axios.post(`${this.URI}mailer`, formData)
                    .then(res => {
                        this.$Progress.finish();
                        this.successSent = true;
                    })
                    .catch(e => console.log(e))
            }
        },
        created() {
            this.$Progress.start();
        },
        mounted() {
            this.$Progress.finish();
        },
        computed: {
            URI(){
                return this.$store.getters.URI;
            },
            media(){
                return this.$store.getters.media;
            }
        }
    }
</script>

<style scoped>

</style>
