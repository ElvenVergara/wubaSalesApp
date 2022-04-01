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

			<div v-if="modalData.controltype == 'add'">

              

              <form v-on:submit.prevent="onSubmit('add')">


		        <label>Item Code: <b style="font-size:25px;">{{ formdata.item_code }}</b></label>


				<div class="field" style="width:100%;">
		            <label>Supplier <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.supplier_id = ''"></a>
		            </label>
			            <div class="control" style="width:100%;">
			              <div class="select" style="width:100%;">

		                	<select v-model='formdata.supplier_id'
		                	 style="width:100%;" required>

			                    <option value="">-- Select --</option>

			                  	<option v-for="list in suppliers" :value="list.id">
			                  		{{ list.company }}
			                  	</option>

			                </select>

		              </div>
		            </div>
	            </div>







	            <div class="field" style="width:100%;">

	            	<label>Category <b style="color:red;">*</b>
			          	<a style="font-size:13px;cursor:pointer;" @click="add_category = true"><b>+ Add</b></a> | 
			          	<a style="font-size:13px;cursor:pointer;" @click="delete_category"><b>x Delete</b></a>
      				 	<a class="delete is-pulled-right" aria-label="close" @click="formdata.category = ''"></a>
		            </label>
			            <div class="control" style="width:100%;">
			              <div class="select" style="width:100%;">

		                	<select v-model='formdata.category' style="width:100%;" required>

			                    <option value="">-- Select --</option>

			                  	<option v-for="list in categories">
			                  		{{ list.category_name }}
			                  	</option>

			                </select>

		              </div>
		            </div>
	            </div>




	            <div class="field">
		          <label>Item Name <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.item_name = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.item_name' placeholder="Type Here.." class="input" type="text" required>
		          </div>
		        </div>





	            <div class="field" style="width:100%;">
		            <label>Unit <b style="color:red;">*</b>
			          	<a style="font-size:13px;cursor:pointer;" @click="add_unit = true"><b>+ Add</b></a> | 
			          	<a style="font-size:13px;cursor:pointer;" @click="delete_unit"><b>x Delete</b></a>
      				 	<a class="delete is-pulled-right" aria-label="close" @click="formdata.unit = ''"></a>
		            </label>
			            <div class="control" style="width:100%;">
			              <div class="select" style="width:100%;">

		                	<select v-model='formdata.unit' style="width:100%;" required>

			                    <option value="">-- Select --</option>

			                  	<option v-for="list in units">
			                  		{{ list.unit_name }}
			                  	</option>

			                </select>

		              </div>
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
		          <label>Seller's Price <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.sellers_price = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.sellers_price' placeholder="Type Here.." class="input" type="number" required>
		          </div>
		        </div>



		        <div class="field" style="width:100%;">

	            	<label>Discountable? <b style="color:red;">*</b></label>
			            <div class="control" style="width:100%;">
			              <div class="select" style="width:100%;">

		                	<select v-model='formdata.discountable' style="width:100%;" required>

			                    <option value="">-- Select --</option>
			                  	<option>Yes</option>
			                  	<option>No</option>

			                </select>

		              </div>
		            </div>
	            </div>



		        <div class="field" v-if="formdata.discountable == 'Yes'">
		          <label>Discount <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.discount = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.discount' placeholder="Type Here.." class="input" type="text" required>
		          </div>
		        </div>



		        <div class="field">
		          <label>VAT <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.vat = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.vat' placeholder="Type Here.." class="input" type="number" required>
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


    		        <label>Item Code: <b style="font-size:25px;">{{ formdata.item_code }}</b></label>


    				<div class="field" style="width:100%;">
    		            <label>Supplier <b style="color:red;">*</b>
          				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.supplier_id = ''"></a>
    		            </label>
    			            <div class="control" style="width:100%;">
    			              <div class="select" style="width:100%;">

    		                	<select v-model='formdata.supplier_id'
    		                	 style="width:100%;" required>

    			                    <option value="">-- Select --</option>

    			                  	<option v-for="list in suppliers" :value="list.id">
    			                  		{{ list.company }}
    			                  	</option>

    			                </select>

    		              </div>
    		            </div>
    	            </div>







    	            <div class="field" style="width:100%;">

    	            	<label>Category <b style="color:red;">*</b>
    			          	<a style="font-size:13px;cursor:pointer;" @click="add_category = true"><b>+ Add</b></a> | 
    			          	<a style="font-size:13px;cursor:pointer;" @click="delete_category"><b>x Delete</b></a>
          				 	<a class="delete is-pulled-right" aria-label="close" @click="formdata.category = ''"></a>
    		            </label>
    			            <div class="control" style="width:100%;">
    			              <div class="select" style="width:100%;">

    		                	<select v-model='formdata.category' style="width:100%;" required>

    			                    <option value="">-- Select --</option>

    			                  	<option v-for="list in categories">
    			                  		{{ list.category_name }}
    			                  	</option>

    			                </select>

    		              </div>
    		            </div>
    	            </div>




    	            <div class="field">
    		          <label>Item Name <b style="color:red;">*</b>
          				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.item_name = ''"></a>
    		          </label>
    		          <div class="control">
    						<input v-model='formdata.item_name' placeholder="Type Here.." class="input" type="text" required>
    		          </div>
    		        </div>





    	            <div class="field" style="width:100%;">
    		            <label>Unit <b style="color:red;">*</b>
    			          	<a style="font-size:13px;cursor:pointer;" @click="add_unit = true"><b>+ Add</b></a> | 
    			          	<a style="font-size:13px;cursor:pointer;" @click="delete_unit"><b>x Delete</b></a>
          				 	<a class="delete is-pulled-right" aria-label="close" @click="formdata.unit = ''"></a>
    		            </label>
    			            <div class="control" style="width:100%;">
    			              <div class="select" style="width:100%;">

    		                	<select v-model='formdata.unit' style="width:100%;" required>

    			                    <option value="">-- Select --</option>

    			                  	<option v-for="list in units">
    			                  		{{ list.unit_name }}
    			                  	</option>

    			                </select>

    		              </div>
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
    		          <label>Seller's Price <b style="color:red;">*</b>
          				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.sellers_price = ''"></a>
    		          </label>
    		          <div class="control">
    						<input v-model='formdata.sellers_price' placeholder="Type Here.." class="input" type="number" required>
    		          </div>
    		        </div>



    		        <div class="field" style="width:100%;">

    	            	<label>Discountable? <b style="color:red;">*</b></label>
    			            <div class="control" style="width:100%;">
    			              <div class="select" style="width:100%;">

    		                	<select v-model='formdata.discountable' style="width:100%;" required>

    			                    <option value="">-- Select --</option>
    			                  	<option>Yes</option>
    			                  	<option>No</option>

    			                </select>

    		              </div>
    		            </div>
    	            </div>


    		        <div class="field" v-if="formdata.discountable == 'yes'">
    		          <label>Discount <b style="color:red;">*</b>
          				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.discount = ''"></a>
    		          </label>
    		          <div class="control">
    						<input v-model='formdata.discount' placeholder="Type Here.." class="input" type="number" required>
    		          </div>
    		        </div>



    		        <div class="field">
    		          <label>VAT <b style="color:red;">*</b>
          				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.vat = ''"></a>
    		          </label>
    		          <div class="control">
    						<input v-model='formdata.vat' placeholder="Type Here.." class="input" type="number" required>
    		          </div>
    		        </div>
    		        


    		       <center>
    				<button type="submit" class="button is-link" style="width:80%;">
    			        	<i class="bi bi-send"></i>&nbsp; Submit Data
    		        </button>
    		       </center>


	            </form>
		
		</div>

	<!-- Edit End -->









	<!-- modal start -->

	  <div v-if="add_category" id="modal-ter" class="modal is-active">
		  <div class="modal-background"></div>
		  <div class="modal-card" style="width:40%;">
	        <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

	    	    	<b style="color:white;font-size:20px;">Add Category</b>

	    	    	<a class="button is-danger is-small" style="float:right;" @click="add_category = false">
	    	            <i class="bi bi-x" style="font-size:38px;"></i> Close
	    	        </a>

	        </header>

			 		<section class="modal-card-body" style="padding:15px;">
			      		<div>
	          				<form v-on:submit.prevent="add_categoryProcess">
									<div class="field">
							          <label>Category Name
					      				 <a class="delete is-pulled-right" aria-label="close" @click="access = ''"></a>
							          </label>
							          <div class="control">
											<input v-model='category_name' placeholder="Type Here.." class="input" type="text">
							          </div>
							        </div>

							   <center>
								<button type="submit" class="button is-link" style="width:80%;">
							        	<i class="bi bi-send"></i>&nbsp; Submit Data
						        </button>
						       </center>

							</form>
        				</div>
					</section>

			</div>
		</div>

	<!-- modal end -->















	<!-- modal start -->

	  <div v-if="add_unit" id="modal-ter" class="modal is-active">
		  <div class="modal-background"></div>
		  <div class="modal-card" style="width:40%;">
	        <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

	    	    	<b style="color:white;font-size:20px;">Add Unit</b>

	    	    	<a class="button is-danger is-small" style="float:right;" @click="add_unit = false">
	    	            <i class="bi bi-x" style="font-size:38px;"></i> Close
	    	        </a>

	        </header>

			 		<section class="modal-card-body" style="padding:15px;">
			      		<div>
          				<form v-on:submit.prevent="add_unitProccess">
								<div class="field">
						          <label>Unit Name
				      				 <a class="delete is-pulled-right" aria-label="close" @click="access = ''"></a>
						          </label>
						          <div class="control">
										<input v-model='unit_name' placeholder="Type Here.." class="input" type="text">
						          </div>
						        </div>

						   <center>
							<button type="submit" class="button is-link" style="width:80%;">
						        	<i class="bi bi-send"></i>&nbsp; Submit Data
					        </button>
					       </center>

						</form>

        				</div>
					</section>

			</div>
		</div>

	<!-- modal end -->








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

                		formdata:{

							discountable: '',
							discount: 0.00,
                			item_code: Math.floor(Math.random() * (99999999 - 10000000 + 1) ) + 10000000,
							supplier_id:'',
							category:'',
							item_name:'',
							unit:'',
							suppliers_price: 0.00,
							sellers_price: 0.00,
							vat: 0.00,

                			 // second
                			 data_id: this.modalData.data_id,
                		},

                		suppliers: {},
                		units: {},
                		categories: {},
                		category_name: '',
                		unit_name: '',
                		add_category: false,
                		add_unit: false,


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

            		//
            		//
            		// get data for edit form
            	
            		this.tablespinner = false;


            		axios.post('/getSuppliersSelect')
	 				.then((response) => {

	 						this.suppliers = response.data;

	 				})
					.catch((error) => this.errors = error.response.data.errors);



					axios.post('/getUnitSelect')
	 				.then((response) => {

	 						this.units = response.data;

	 				})
					.catch((error) => this.errors = error.response.data.errors);



					axios.post('/getItemCategory')
	 				.then((response) => {

	 						this.categories = response.data;

	 				})
					.catch((error) => this.errors = error.response.data.errors);

            },

      //
      //
      //mounted
      





















    methods:{

	   	...mapActions('alerts', ['showToast','showErrors']),
	    ...mapMutations('alerts',['changeLoaderState']),


	    	add_categoryProcess(){
			 	   
			 	   this.changeLoaderState(true);

			 	   axios.post('add_category',{

			 	   		'category_name': this.category_name,

			 	   }).then((response)=> 
			 	   { 

		 	           this.showToast({
		 	                 type: 'success',
		 	                 message: 'Data Submitted.',
		 	           });


		 	            axios.post('/getItemCategory')
		 				.then((response) => {

		 					this.categories = response.data;

		 				})
						.catch((error) => this.errors = error.response.data.errors);


		 	           this.add_category = false;
		 	           this.category_name = '';

			 	       this.changeLoaderState(false);
			 	         
			 	   })
			 	    .catch((error) => {
			 	       this.changeLoaderState(false);
			 	       this.showErrors(error.response.data.errors);
			 	    });

	    	},



	    	  delete_category(){

	    	  		if(this.formdata.category != ''){

	    	  			if(confirm('Are you sure you want to delete this Category?'))
	    	  			{

	    	  				axios.post('delete_category',{

			    	  			name: this.formdata.category,

			    	  		})
							.then((response) => {

								this.showToast({
				 	                 type: 'success',
				 	                 message: 'Data Submitted.',
				 	            });

				 	            axios.post('/getItemCategory')
				 				.then((response) => {

				 					this.categories = response.data;

				 				})
								.catch((error) => this.errors = error.response.data.errors);

				 	           this.formdata.category = '';

					 	       this.changeLoaderState(false);

							})
							.catch((error) => {

					 			this.buttonspinner = false;
								this.$toaster.error(error.response.data.errors.name);

							});

	    	  			}

	    	  		} else {

	    	  				this.showToast({
				 	                 type: 'error',
				 	                 message: 'Error! Select Category Name First.',
				 	        });

	    	  		}

	    	  },



	    	add_unitProccess(){
			 	   
			 	   this.changeLoaderState(true);

			 	   axios.post('add_unit',{

			 	   		'unit_name': this.unit_name,

			 	   }).then((response)=> 
			 	   { 

		 	           this.showToast({
		 	                 type: 'success',
		 	                 message: 'Data Submitted.',
		 	           });


		 	            axios.post('/getUnitSelect')
		 				.then((response) => {

		 						this.units = response.data;

		 				})
						.catch((error) => this.errors = error.response.data.errors);


		 	           this.add_unit = false;
		 	           this.unit_name = '';

			 	       this.changeLoaderState(false);
			 	         
			 	   })
			 	    .catch((error) => {
			 	       this.changeLoaderState(false);
			 	       this.showErrors(error.response.data.errors);
			 	    });

	    	},






	    	delete_unit(){

	    	  		if(this.formdata.unit != ''){

	    	  			if(confirm('Are you sure you want to delete this Unit?'))
	    	  			{

	    	  				axios.post('delete_unit',{

			    	  			name: this.formdata.unit,

			    	  		})
							.then((response) => {

								   this.showToast({
					 	                 type: 'success',
					 	                 message: 'Data Submitted.',
					 	           });


					 	            axios.post('/getUnitSelect')
					 				.then((response) => {

					 						this.units = response.data;

					 				})
									.catch((error) => this.errors = error.response.data.errors);

					 	           this.formdata.unit = '';

						 	       this.changeLoaderState(false);

							})
							.catch((error) => {

					 			this.buttonspinner = false;
								this.$toaster.error(error.response.data.errors.name);

							});

	    	  			}

	    	  		} else {

	    	  				this.showToast({
				 	                 type: 'error',
				 	                 message: 'Error! Select Unit Name First.',
				 	        });

	    	  		}

	    	},





			onSubmit(type){

          		this.changeLoaderState(true);

					if (type == 'add') {

				 	   axios.post('additem',this.$data.formdata).then((response)=> 
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






