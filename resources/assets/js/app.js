
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueColor from 'vue-color';

import VueSession from 'vue-session';
Vue.use(VueSession);

import VueSignaturePad from 'vue-signature-pad';
Vue.use(VueSignaturePad);

import Buefy from 'buefy';
Vue.use(Buefy, {
  defaultIconPack: 'mdi',
  defaultDateFormatter: (date) => date.toLocaleString("es", { day: "numeric" }) + ' de ' +
                                  date.toLocaleString("es", { month: "long"  }) + ' de ' +
                                  date.toLocaleString("es", { year: "numeric"})
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('slider-picker', VueColor.Slider);
Vue.component('company', require('./components/Company.vue'));
Vue.component('companies', require('./components/Companies.vue'));
Vue.component('postcards', require('./components/Postcards.vue'));
Vue.component('recievers-table', require('./components/RecieversTable.vue'));
Vue.component('postcard-configurator', require('./components/PostcardConfigurator.vue'));
Vue.component('signature-pad', require('./components/SignaturePad.vue'));

Vue.filter('highlight', function(word, query){
  var check = new RegExp(query, "ig");
  return word.toString().replace(check, function(matchedText,a,b){
      return ('<mark>' + matchedText + '</mark>');
  });
});

const app = new Vue({
    el: '#app'
});


// Bulma NavBar Burger Script
document.addEventListener('DOMContentLoaded', function () {
    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

        // Add a click event on each of them
        $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {

                // Get the target from the "data-target" attribute
                let target = $el.dataset.target;
                let $target = document.getElementById(target);

                // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                $el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

            });
        });
    }

});


require('./src/croppie');
require('./main');

require('./bulma-extensions');
