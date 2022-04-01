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
		          <label>Transation Code</label>
		          <div class="control">
						<b style="font-size:18px;color:gray;">{{ transactionCode }}</b>
		          </div>
		        </div>


		        <div class="field">
		          <label>Company Name</label>
		          <div class="control">
						<b style="font-size:18px;">{{ userData.company }}</b>
		          </div>
		        </div>


		        <div class="field">
		          <label>Supplier's Name: </label>
		          <div class="control">
						<b style="font-size:18px;">{{ userData.firstname }} {{ userData.middlename }} {{ userData.lastname }}</b>
		          </div>
		        </div>



		       	<div class="field" style="width:100%;">
		            <label>Select Item <b style="color:red;">*</b>
		            </label>
			            <div class="control" style="width:100%;">
			              <div class="select" style="width:100%;">

		                	<select v-model='formdata.item_id' style="width:100%;" required>

			                    <option value="">-- Select --</option>

			                  	<option v-for="list,key in items" :value="list.id">
			                  		{{ list.item_name }}
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


		        <div class="field">
		          <label>Supplier's Price <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.suppliers_price = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.suppliers_price' placeholder="Type Here.." class="input" type="number" required>
		          </div>
		        </div>


		        <div class="field">
		          <label>Total Amount</label>
		          <div class="control">
						<b style="font-size:18px;">{{ total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")  }}</b>
		          </div>
		        </div>



		        <div class="field" style="width:100%;">
		            <label>Payment Terms <b style="color:red;">*</b>
		            </label>
			            <div class="control" style="width:100%;">
			              <div class="select" style="width:100%;">

		                	<select v-model='formdata.payment_terms' style="width:100%;" required>

			                    <option value="">-- Select --</option>
			                  	<option>Cash</option>
			                  	<option>Check</option>

			                </select>

		              </div>
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

            	"formdata.item_id"(){

					axios.post('/getSuppliersPrice',{

						'id': this.formdata.item_id,

					})
	 				.then((response) => {

	 					this.formdata.suppliers_price = response.data;

	 				})
					.catch((error) => this.errors = error.response.data.errors);

					this.total = this.formdata.quantity * this.formdata.suppliers_price;

            	},




            	"formdata.quantity"(){

					this.total = this.formdata.quantity * this.formdata.suppliers_price;

            	},


            	"formdata.suppliers_price"(){

					this.total = this.formdata.quantity * this.formdata.suppliers_price;

            	}
            		
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



					axios.post('/getSuppliersItem',{

						'data_id': this.selectedItemId,

					})
	 				.then((response) => {

	 					this.items = response.data;

	 				})
					.catch((error) => this.errors = error.response.data.errors);



					axios.post('/getSupplier',{

						'data_id': this.selectedItemId,

					})
	 				.then((response) => {

	 					this.userData = response.data;

	 				})
					.catch((error) => this.errors = error.response.data.errors);



            		//
            		//
            		// get data for edit form
            		
            		this.formdata.transaction_code = this.transactionCode;
            		this.formdata.supplier_id = this.selectedItemId;
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

				 	   axios.post('addPO',this.$data.formdata).then((response)=> 
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



            generatePass(){

      			this.tempPass = Math.floor(Math.random() * (999999 - 100000 + 1) ) + 100000;

      		}

			
    }
  };

</script>






