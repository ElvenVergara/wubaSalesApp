/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import { createApp } from "vue";
import router from './components/router';
import Home from './components/DefaultPages/Home';
import store from './store';

import axios from 'axios';
import VueAxios from 'vue-axios';
import Toaster from "@meforma/vue-toaster";
import VueLoading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

createApp({

	components:{
		Home
	}

})
.use(router)
.use(store)
.use(VueAxios, axios)
.use(Toaster)
.use(VueLoading)
.mount('#app');



 
