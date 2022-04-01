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

			<div v-if="modalData.controltype == 'add'" style="font-size:14px;">



	         <form v-on:submit.prevent="onSubmit('add')">


		        <div class="field">
		          <label>Item Name</label>
		          <div class="control">
						<b style="font-size:18px;">{{ itemData.item_name }}</b>
		          </div>
		        </div>



		        <div class="field">
		          <label>Company</label>
		          <div class="control">
						<b style="font-size:18px;">{{ itemData.company }}</b>
		          </div>
		        </div>




		        <div class="field">
		          <label>Stock Count </label>
		          <div class="control">
						<b style="font-size:23px;">{{ parseInt(stock).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b>
		          </div>
		        </div>




		        <div class="field">
		          <label>Storage Count </label>
		          <div class="control">
						<b style="font-size:23px;">{{ parseInt(storage).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b>
		          </div>
		        </div>




	         	<div class="field" style="width:100%;">
		            <label>Select Stock Out Type <b style="color:red;">*</b>
		            </label>
			            <div class="control" style="width:100%;">
			              <div class="select" style="width:100%;">

		                	<select v-model='formdata.type' style="width:100%;" required>

			                    <option value="">-- Select --</option>

			                  	<option value="1">
			                  		Stock to Storage
			                  	</option>

			                  	<option value="2">
			                  		Stock to Disposal
			                  	</option>

			                  	<option value="3">
			                  		Storage to Disposal
			                  	</option>

			                </select>

		              </div>
		            </div>
	            </div>



		        <div class="field">
		          <label>Quantity <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.quantity = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.quantity' placeholder="Type Here.." class="input" type="number" required>
		          </div>
		        </div>



		        <center>
					<button type="submit" class="button is-link" style="width:80%;">
				        	<i class="bi bi-send"></i>&nbsp; Submit Data
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

                			type: '',
							quantity: 0,

	            			 // second
	            			 data_id: this.modalData.data_id,
                		},

                		itemData: {},
                		items: {},
                		total: 0,
                		storage: 0,
                		stock: 0,


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
	            			
        					axios.post('/getItemForEdit',{

        						'data_id': this.modalData.data_id,

        					})
			 				.then((response) => {

			 						this.formdata = response.data;

			 				})
							.catch((error) => this.errors = error.response.data.errors);

	            		} 



	     
					axios.post('/getItemForEdit',{

						'data_id': this.selectedItemId,

					})
	 				.then((response) => {

	 					this.itemData = response.data;
	 					this.stock = response.data.stock;
	 					this.storage = response.data.storage;
	 					this.formdata.item_id = response.data.id;

	 				})
					.catch((error) => this.errors = error.response.data.errors);



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

					if (type == 'add') {

				 	   		axios.post('add_stockout',this.$data.formdata).then((response)=> 
					 	   { 

					 	   	   if (response.data == 'bad') {

					 	   	   		this.showToast({
					 	                 type: 'error',
					 	                 message: 'Error! Invalid Input.',
					 	            });

					 	   	   } else {

					 	   	   		this.showToast({
					 	                 type: 'success',
					 	                 message: 'Data Submitted.',
					 	            });

			 				   		this.$emit('transactioncomplete', 'controlmodal');

					 	   	   }
				 	           
				 	           
					 	       this.changeLoaderState(false);

					 	   })
					 	    .catch((error) => {
					 	       this.changeLoaderState(false);
					 	       this.showErrors(error.response.data.errors);
				 	    });

								
					} else if (type == 'edit') {

							
						axios.post('updateitem',this.$data.formdata).then((response)=> 
				 	   { 

			 	           this.showToast({
			 	                 type: 'success',
			 	                 message: 'Data Submitted.',
			 	           });
			 	           
				 	       this.changeLoaderState(false);
		 				   this.$emit('transactioncomplete', 'controlmodal');

				 	   })
				 	    .catch((error) => {
				 	       this.changeLoaderState(false);
				 	       this.showErrors(error.response.data.errors);
				 	    });

					}

			},



       
			
    }
  };

</script>






