import Vue from 'vue'
import Router from 'vue-router'

import Home from './views/Home.vue'
import Login from './views/Login.vue'
import Dashboard from './views/Dashboard.vue'
import Logout from './views/Logout.vue'
import StatisticPyatorochkaCron from './views/StatisticPyatorochkaCron.vue'

Vue.use(Router)

export default new Router({
	mode: 'history',
	base: process.env.BASE_URL,
	routes: [

		{
			path: '/',
			name: 'home',
			component: Home,
		},
		{
			path: '/login',
			name: 'login',
			component: Login,
		meta: {
			Breadcrumb: [
				{
					name: 'Login',
					iconClasses: 'fas fa-key',
					path: '/login',
					pathClass: '',
				}
			]
		}
		},
		{
			path: '/dashboard',
			name: 'dashboard',
			component: Dashboard,
		meta: {
			Breadcrumb: [
				{
					name: 'Dashboard',
					iconClasses: 'fas fa-chart-area',
					path: '/dashboard',
					pathClass: '',
				}
			]
		}
	},
	{
		path: '/statistic/pyatorochka/cron',
		name: 'StatisticPyatorochkaCron',
		component: StatisticPyatorochkaCron,
		meta: {
			hideSkeleton: true
		}
	},
	{
		path: '/logout',
		name: 'logout',
		component: Logout,
		meta: {
			Breadcrumb: []
		}
	},
	]
})
