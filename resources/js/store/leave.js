import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import page from './../modules/page';
import page_data from './../modules/leave';

export const store = new Vuex.Store({
	
	modules:{
		page_data,
		page
	},
	state : {		
		app		: js_parent_var.app,
		base_url: js_parent_var.base_url,
		user: js_parent_var.user,
		csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
	}
});