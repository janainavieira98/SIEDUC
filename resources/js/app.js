import Vue from 'vue';
import VueSelect from 'vue-select';
import MaskedInput from 'vue-text-mask';
import PhoneInput from './components/PhoneInput';
import SelectMultiple from './components/SelectMultiple';
import SidebarCard from './components/SidebarCard';
import CreateClassroom from './pages/CreateClassroom';

require('./bootstrap');

Vue.component('v-select', VueSelect);
Vue.component('masked-input', MaskedInput);
Vue.component('phone-input', PhoneInput);
Vue.component('sidebar-card', SidebarCard);
Vue.component('select-multiple', SelectMultiple);
Vue.component('create-classroom', CreateClassroom);

if (window.innerWidth >= 768) {
    const mainContentNode = document.querySelector('.main-content');
    const sidebarNode = document.querySelector('.sidebar');
    if (sidebarNode && mainContentNode) {
        new Popper(mainContentNode, sidebarNode, {
            placement: 'right',
            positionFixed: true,
        });
    }
}

const app = new Vue({
    el: '#app',
});
