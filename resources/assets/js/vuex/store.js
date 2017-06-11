/**
 * Created by yangchunrun on 17/3/2.
 */
import Vue from 'vue';
import Vuex from 'vuex';
import * as actions from './actions.js';
import * as mutations from './mutations.js';

Vue.use(Vuex);

const state = {

};

export default new Vuex.Store({
    state,
    actions,
    mutations
});