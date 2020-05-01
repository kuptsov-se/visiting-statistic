import Vue from 'vue';
window.Vue = Vue;

import VueGraph from 'vue-graph'
Vue.use(VueGraph);

import VisitingStatistic from "./components/VisitingStatistic";
Vue.component('visiting-statistic', VisitingStatistic);

const app = new Vue({
    el: '#app',
});
