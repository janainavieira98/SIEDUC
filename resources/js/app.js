import Vue from 'vue'
import MaskedInput from 'vue-text-mask'
import PhoneInput from "./components/PhoneInput";

require('./bootstrap');

Vue.component('masked-input', MaskedInput)
Vue.component('phone-input', PhoneInput)

const app = new Vue({
    el: '#app',
});
