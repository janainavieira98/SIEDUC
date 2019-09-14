import Vue from 'vue'
import MaskedInput from 'vue-text-mask'
import PhoneInput from "./components/PhoneInput";
import SidebarCard from "./components/SidebarCard";

require('./bootstrap');

Vue.component('masked-input', MaskedInput);
Vue.component('phone-input', PhoneInput);
Vue.component('sidebar-card', SidebarCard);

if (window.innerWidth >= 768) {
    new Popper(document.querySelector('.main-content'), document.querySelector('.sidebar'), {
        placement: 'right',
        positionFixed: true
    })
}

const app = new Vue({
    el: '#app',
});
