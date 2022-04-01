import { createRouter, createWebHistory } from "vue-router";


// default pages

	import Home from '../DefaultPages/Home';
	import Login from '../DefaultPages/Login';

// default pages






// user pages

	import homepage from '../Pages/UserPages/homepage.vue';
	import users from '../Pages/UserPages/users.vue';
	import suppliers from '../Pages/UserPages/suppliers';
	import customers from '../Pages/UserPages/customers';
	import useraccess from '../Pages/UserPages/useraccess';
	import userlogs from '../Pages/UserPages/userlogs';

// user pages





// items pages

	import items from '../Pages/ItemsPages/items';
	import purchaseOrder from '../Pages/ItemsPages/purchaseOrder';
	import stockin from '../Pages/ItemsPages/stockin';
	import stockout from '../Pages/ItemsPages/stockout';
	import pos from '../Pages/ItemsPages/pos';
	import salesReport from '../Pages/ItemsPages/salesReport';
	import payoutReport from '../Pages/ItemsPages/payoutReport';

// items pages





	import NotFound from '../DefaultPages/error';
	import printReciept from '../Includes/printReciept.vue';
	import printSales from '../Includes/printSales.vue';
	import printPayout from '../Includes/printPayout.vue';

const routes = [
	


	// default pages

		{
			path: '/',
			component: Home,
		},

	// default pages








	// user pages

		{
			path: '/homepage',
			component: homepage,
		},


		{
			path: '/users',
			component: users,
		},


		{
			path: '/suppliers',
			component: suppliers,
		},


		{
			path: '/customers',
			component: customers,
		},


		{
			path: '/useraccess',
			component: useraccess,
		},

	// user pages











	// items pages

		{
			path: '/items',
			component: items,
		},


		{
			path: '/purchaseOrder',
			component: purchaseOrder,
		},


		{
			path: '/stockin',
			component: stockin,
		},



		{
			path: '/stockout',
			component: stockout,
		},




		{
			path: '/pos',
			component: pos,
		},



		{ 
  		  	path: '/salesreport',
  		  	name: 'salesReport', 
  		  	component: salesReport 
  		},



  		{ 
  		  	path: '/payout',
  		  	name: 'payoutReport', 
  		  	component: payoutReport 
  		},



  		{ 
  		  	path: '/userlogs',
  		  	name: 'userlogs', 
  		  	component: userlogs 
  		},


	// items pages






	// will match everything and put it under `$route.params.pathMatch`
  		{ 
  		  	path: '/:pathMatch(.*)*',
  		  	name: 'NotFound', 
  		  	component: NotFound 
  		},




  		{ 
  		  	path: '/printReciept/:code',
  		  	name: 'printReciept', 
  		  	component: printReciept 
  		},





  		{ 
  		  	path: '/printSales/:from/:to',
  		  	name: 'printSales', 
  		  	component: printSales 
  		},



  		{ 
  		  	path: '/printPayout/:from/:to/:id',
  		  	name: 'printPayout', 
  		  	component: printPayout 
  		},


];


export default createRouter({

	history: createWebHistory(process.env.BASE_URL),
	routes  

});