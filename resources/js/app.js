require('./bootstrap');

import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';

import api from './services/api';

// Components
import TeamForm from './components/TeamForm.vue';
import TeamsTable from './components/TeamsTable.vue';
import LeaguesTable from './components/LeaguesTable.vue';
import LeagueForm from './components/LeagueForm.vue';
import SeasonsTable from './components/SeasonsTable.vue';
import SeasonForm from './components/SeasonForm.vue';

Vue.use(BootstrapVue);

Vue.prototype.$http = api;

const app = new Vue({
    el: '#app',
    components: {
        TeamForm,
        TeamsTable,
        LeaguesTable,
        LeagueForm,
        SeasonsTable,
        SeasonForm
    }
});