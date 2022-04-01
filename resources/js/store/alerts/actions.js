import Localbase from 'localbase';
import router from 'vue-router';
import axios from 'axios'; 
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ /* options */ });




export function showToast({}, data){

	toaster.show(data.message, {
          type: data.type,
          position: 'top',
    });

};





export function showErrors({}, data){

	  let err = data;

	  var txt = "";
	  var x;
	  for (x in err) {
	      txt += "- "+ err[x] + "<br>";
	  }

	  toaster.show(txt, {
          type: 'error',
          position: 'top',
      });

};


	




export async function checkUserLogin({commit,dispatch}, data){

	    await axios.post('/checkUserLogin')
      .then( async (response) => { 

          if (response.data != '') {

		  	  await commit('changeLoginState', true);

              await db.collection('users')
                 .doc('1')
                 .set({user: response.data});

          } else {
		  	  await commit('changeLoginState', false);
          };

      })
      .catch((error) => {
		  commit('changeLoaderState', false);
      });


};