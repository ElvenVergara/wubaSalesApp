import Localbase from 'localbase';
import router from 'vue-router';
import axios from 'axios'; 
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ /* options */ });



	export function	changeSelectedItem(state,data){

		state.selectedItemId = data;

	}



	

	export async function changeTransactionCode(state,data){

		state.transactionCode = data;

		  axios.post('/checkTransactionCodeStatus',{

		  		transaction_code: data

		  })
	      .then( async (response) => { 

	          if (response.data == 'Locked') {

			  	  state.lockedStatus = 'locked';

	          } else {

			  	  state.lockedStatus = 'unlocked';

	          };

	      })
	      .catch((error) => {
	      });

	}





	export function	refreshMutation(state,data){

		state.refreshTable = data;

	}