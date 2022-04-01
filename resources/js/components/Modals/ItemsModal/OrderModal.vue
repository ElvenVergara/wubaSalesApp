	<template>

	

	<div>


	 		<b v-if="tablespinner">
		     <center>        
			      <div class="lds-ellipsis">
			        <div></div>
			        <div></div>
			        <div></div>
			        <div></div>
			      </div>
		     </center>
		   </b>



			<!-- Add Start -->

			<div v-if="modalData.controltype == 'edit'" style="font-size:14px;">

	         <form v-on:submit.prevent="onSubmit">

	      		<div class="field">
		          <label>Quantity <b style="color:red;">*</b>
	  				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.quantity = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.quantity' placeholder="Type Here.." class="input is-large" type="number" required autofocus>
		          </div>
		        </div>


		        <center>
					<button type="submit" class="button is-link is-large" style="width:80%;">
				        	<b><i class="bi bi-cart"></i>&nbsp; Update Order</b>
			        </button>
			    </center>

		   	  </form>


	    </div>


	    <!-- Add End -->











































	<!-- Edit Start -->

		<div v-if="modalData.controltype == 'edit'">

	            <form v-on:submit.prevent="onSubmit('edit')">


	            </form>
		
		</div>

	<!-- Edit End -->

	







	</div>


	

</template>





<script type="text/javascript">
	
  import { mapState, mapActions, mapMutations } from 'vuex';

  export default{

      components:{


      },


      props:['modalData'],


    data(){

      return{

				// alert info
				// 
      					
	                tablespinner:false,

                //
      			// alert info



                // variables
                // 

                		formdata: {

							transaction_code: '',
							supplier_id: '',
							item_id: '',
							quantity: 0,
							suppliers_price: 0,
							payment_terms: '',

	            			 // second
	            			 data_id: this.modalData.data_id,
                		},

                		userData: {},
                		items: {},
                		total: 0,


                //
                // variables
                
      }		


    },



      //watch
      //
      //

            watch:{

            	
            },
            	

      //
      //
      //watch


















      	computed: {
        	...mapState('items', ['selectedItemId','transactionCode']),
      	},

























      //mounted
      //
      //

            mounted(){

            		// get data for edit form
            		// 
            		// 
            		
	            		if (this.modalData.controltype == 'edit') {
	            			
        					axios.post('/getQuantityForEdit',{

        						'data_id': this.modalData.data_id,

        					})
			 				.then((response) => {

			 					this.formdata = response.data;

			 				})
							.catch((error) => this.errors = error.response.data.errors);

	            		} 


            		//
            		//
            		// get data for edit form
            		
			 	    this.changeLoaderState(false);

            	
            },

      //
      //
      //mounted
      





















    methods:{

	   	...mapActions('alerts', ['showToast','showErrors']),
	    ...mapMutations('alerts',['changeLoaderState']),


			onSubmit(type){

          	   this.changeLoaderState(true);
							
			   axios.post('edit_order',this.$data.formdata).then((response)=> 
		 	   { 

	 	           	if (response.data == 'good') {

 						this.showToast({
		 	                 type: 'success',
		 	                 message: 'Success! Order Updated.',
		 	            });
 						
		 				this.$emit('transactioncomplete', 'controlmodal');
		 				this.refreshMutation(Math.random().toString(36).slice(2));

 					} else {

 						this.showToast({
		 	                 type: 'error',
		 	                 message: 'Error! Invalid Quantity.',
		 	            });
 					}
	 	           
		 	       this.changeLoaderState(false);

		 	   })
		 	    .catch((error) => {
		 	       this.changeLoaderState(false);
		 	       this.showErrors(error.response.data.errors);
		 	    });


			},



			
    }
  };

</script>






