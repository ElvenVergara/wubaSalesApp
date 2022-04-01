<template>

	

	<div>
		<Loader></Loader>

		<div style="border-top:solid rgb(8,50,150) 1px;border-left:solid rgb(8,50,150) 1px;border-right:solid rgb(8,50,150) 2px;border-bottom:solid rgb(8,50,150) 2px;box-shadow: 1px 2px 3px #888888;">
									
						 					
			 <nav class="panel column is-12" style="overflow-x: auto;">


				<div class="panel-block" style="padding:0px;">
  					  	
  					    <p class='navbar-end pull-right'>


							  <p @click="searchModal = true" class="control" title="Search">
	                            <a class="button is-link is-rounded is-small" style="width:150px;">
	                                <i class="bi bi-search" style="font-size:23px;"></i> &nbsp;&nbsp; <b>SEARCH</b>
	                            </a>
	                          </p>

		        			  &nbsp;

		        			  <p @click="openmodal('item_add','')" class="control" title="Add New Data">
	                            <a class="button is-info is-rounded is-small" style="width:150px;">
	                                <i class="bi bi-plus" style="font-size:38px;"></i> <b>ADD ITEM</b>
	                            </a>
	                          </p>

		        			
		        			 
  					    </p>


  					</div>



				<div style="border:solid rgb(8,50,150) 1px;">

					<table class="table" style="width:100%;">
						
					  <tr>

						<th style="padding:3px;">
							
							<div class="field">
			  		         <div class="control">
			  		           <div class="select">

			  		             <select v-model="tablenum">
			  		               <option>10</option>
			  		               <option>25</option>
			  		               <option>50</option>
			  		               <option>100</option>
			  		             </select>

			  		           </div>
			  		         </div>
			  		       </div>

						</th>


						<th style="text-align:center;padding-top:10px;">
			    			<b> {{ footer.numberofresults }}</b> &nbsp; Result(s) <b></b>
						</th>


						<th style="padding-top:10px;">
							
					  		<p class='navbar-end pull-right'>
						      Page &nbsp;<b>{{ heading.currentpagenumber }}</b>&nbsp; of &nbsp; <b>{{ heading.totalpagenumber }} &nbsp;&nbsp;</b>
						    </p>

						</th>

					  </tr> 


					</table>

					
				</div>





			<div style="width:100%;overflow-x:auto;overflow-y:auto;">


					<table class="table is-hoverable" border="2" style="width:100%;">

							<tr>

								<th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:5%;">
									Action
								</th>

								<th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:50%;">
									Item Details
								</th>

								<th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;">
									Price Details
								</th>

							</tr> 


							<td v-if="tablespinner" colspan='11'>
							     <center>        
								      <div class="lds-ellipsis">
								        <div></div>
								        <div></div>
								        <div></div>
								        <div></div>
								      </div>
							     </center>
						    </td>


							<td v-else-if="alldata == ''" colspan='11'>

								<center>
									<h1>No Data Found</h1>
					    		</center>

							</td>


					
						<tr v-else v-for="list,key in alldata">


						  	<td style="text-align:center;padding:5px;border:solid black 1px;">

						  		<br>
								<div class="dropdown is-hoverable is-up">
									
									<div class="dropdown-trigger">

											
										<i class="bi bi-menu-button-wide-fill" style="font-size:20px;">
											
										</i>


									</div>


									<div class="dropdown-menu" id="dropdown-menu" role="menu" style="padding: 0px; margin-left:-9px;">
											
											<div class="dropdown-content" style="margin:-20px;width:200px;padding: 0px; margin: 0px;">
												
													<div class="dropdown-item" style="padding:4px;text-align:center;">

						        			  			<a @click="openmodal('item_edit',list.id)" class="button is-info is-small is-rounded" title="Update">
						        							<i class="bi bi-pencil-square" style="font-size:20px;"></i>
						        			  			</a>

						        			  			&nbsp;

								        			    <a @click="openmodal('item_delete',list.id)" class="button is-danger is-small is-rounded" title="Delete">
								        			  		<i class="bi bi-trash3-fill" style="font-size:20px;"></i>
								        			    </a>

													</div>

											</div>

									</div>


									</div>  
								
								</td>
						

								<td style="padding-left:5px;border:solid black 1px;font-size:13px;">



									

									Status: 
									<b style="font-size:19px;color:red;" v-if="list.status == 'Out of Stock'">
										{{ list.status }}
									</b>

									<b style="font-size:19px;color:green;" v-else>{{ list.status }}</b>

									&nbsp;&nbsp; 

									Code: <b style="font-size:19px;color:gray;">{{ list.item_code }}</b>
									<br>


									Item name: <b style="font-size:25px;">{{ list.item_name }}</b> <br>
									

									Category: <span style="font-size:19px;">{{ list.category }}</span> 

									&nbsp;&nbsp; 

									Unit: <span style="font-size:19px;">{{ list.unit }}</span>

									<br>
									 

									Supplier: <span style="font-size:19px;">{{ list.company }}</span>
									<br>
										
								</td>




								<td style="border:solid black 1px;padding:1px;font-size:13px;">


									&nbsp;&nbsp; Discount: <span style="font-size:19px;">{{ list.discount * 100 }}%</span> 

									&nbsp;&nbsp; 

									VAT: <span style="font-size:19px;">{{ list.vat * 100 }}%</span>

									<br>

									<table border="2" style="margin:0px;width:100%;margin-bottom:5px;">
										<tr>
											<td style="text-align:center;background-color:rgb(52,136,136);color:white;padding:0px;border:solid black 1px;width:50%;">Supplier's Price</td>
											<td style="text-align:center;background-color:rgb(52,136,136);color:white;padding:0px;border:solid black 1px;">Seller's Price</td>
										</tr>

										<tr style="font-size:19px;">
											<td style="text-align:center;padding:0px;border:solid black 1px;">₱ {{ parseInt(list.suppliers_price).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</td>
											<td style="text-align:center;padding:0px;border:solid black 1px;">₱ {{ parseInt(list.sellers_price).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</td>
										</tr>
									</table>
									
									<table border="2" style="margin:0px;width:100%;">
										<tr>
											<td style="text-align:center;background-color:rgb(52,136,136);color:white;padding:0px;border:solid black 1px;width:50%;">Stock</td>
											<td style="text-align:center;background-color:rgb(52,136,136);color:white;padding:0px;border:solid black 1px;">
											Purchase Order
											</td>
										</tr>

										<tr style="font-size:19px;">
											<td style="text-align:center;padding:0px;border:solid black 1px;">{{ parseInt(list.stock).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</td>
											<td style="text-align:center;padding:0px;border:solid black 1px;">{{ parseInt(list.storage).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</td>
										</tr>
									</table>

								</td>

							</tr>

					</table>


		</div>


			<div class="columns">
						
					<div class="column is-10">
							
	  						<div class="buttons has-addons">			

	  							  <span class="button is-info" @click='gettabledata(footer.previews)' v-if="footer.previews != ''"><i class='fa fa-arrow-left'></i> &nbsp; Prev</span>
	  							 	
	  							   <span v-for='left in footer.leftsidenumbers'>

	  							  	<span class="button is-light" @click='gettabledata(left)' v-if="left != ''">{{ left }}</span>

	  							  </span>

	  							  <span class="button is-black">{{ footer.currentpage }}</span>

	  							  <span v-for='right in footer.rightsidenumbers'>

	  							  	<span class="button is-light" @click='gettabledata(right)' v-if="right != ''">{{ right }}</span>

	  							  </span>
	  		
	  							  <span class="button is-info" @click='gettabledata(footer.next)' v-if="footer.next != ''"> Next &nbsp;<i class='fa fa-arrow-right'></i></span>

	  						</div>

					</div>

					<div class="column is-2">

						<input type="number" class="input" style="border:solid black 1px;" v-model='gotopage' placeholder="Page">

				  </div>

			</div>


												  					  
		</nav>


	   </div>













  <!-- modal start -->

  <div v-if="searchModal"  id="modal-ter" class="modal is-active is-pulled-left" style="width:27%;">
	  <div class="modal-card" style="width:100%;">
	    <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

		    	<b style="color:white;font-size:20px;">SEARCH</b>

		    	<a class="button is-danger is-small" style="float:right;" @click="searchModal = false">
		            <i class="bi bi-x" style="font-size:38px;"></i> Close
		        </a>

		    	<a class="button is-danger is-small is-rounded" @click="clearall" style="float:right;margin-right:5px;">
		            <b>Clear Fields</b>
		        </a>
	    </header>

	 		<section class="modal-card-body" style="padding:10px;">
	      		<div>



	      			<div class="field" style="width:100%;">
			            <label>Status
	      				 <button class="delete is-pulled-right" aria-label="close" @click="status = ''"></button>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='status' style="width:100%;">

				                    <option value="">-- Select --</option>
				                  	<option>Available</option>
				                	<option>Out of Stock</option>

				                </select>

			              </div>
			            </div>
		            </div>



			        <div class="field">
			          <label>Item Code
	      				 <button class="delete is-pulled-right" aria-label="close" @click="item_code = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='item_code' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field" style="width:100%;">
			            <label>Category
	      				 <button class="delete is-pulled-right" aria-label="close" @click="category = ''"></button>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='category' style="width:100%;">

				                    <option value="">-- Select --</option>
				                  	<option v-for="list in categories">
				                  		{{ list.category_name }}
				                  	</option>

				                </select>

			              </div>
			            </div>
		            </div>


			        <div class="field">
			          <label>Item Name
	      				 <button class="delete is-pulled-right" aria-label="close" @click="item_name = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='item_name' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field" style="width:100%;">
			            <label>Unit
	      				 <button class="delete is-pulled-right" aria-label="close" @click="unit = ''"></button>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='unit' style="width:100%;">

				                    <option value="">-- Select --</option>
				                  	<option v-for="list in units">
				                  		{{ list.unit_name }}
				                  	</option>

				                </select>

			              </div>
			            </div>
		            </div>


			        <div class="field" style="width:100%;">
			            <label>Supplier
	      				 <button class="delete is-pulled-right" aria-label="close" @click="company = ''"></button>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='company' style="width:100%;">

				                    <option value="">-- Select --</option>
				                  	<option v-for="list in suppliers">
				                  		{{ list.company }}
				                  	</option>

				                </select>

			              </div>
			            </div>
		            </div>




		            <div class="field" style="width:100%;">
			            <label>Discountable
	      				 <button class="delete is-pulled-right" aria-label="close" @click="discountable = ''"></button>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='discountable' style="width:100%;">

				                    <option value="">-- Select --</option>
				                  	<option>Yes</option>
				                  	<option>No</option>

				                </select>

			              </div>
			            </div>
		            </div>



			        <div class="field">
			          <label>Discount
	      				 <button class="delete is-pulled-right" aria-label="close" @click="discount = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='discount' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field">
			          <label>Supplier's Price
	      				 <button class="delete is-pulled-right" aria-label="close" @click="suppliers_price = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='suppliers_price' placeholder="Type Here.." class="input" type="number">
			          </div>
			        </div>


			        <div class="field">
			          <label>Seller's Price
	      				 <button class="delete is-pulled-right" aria-label="close" @click="sellers_price = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='sellers_price' placeholder="Type Here.." class="input" type="number">
			          </div>
			        </div>	



			        <div class="field">
			          <label>Stock
	      				 <button class="delete is-pulled-right" aria-label="close" @click="stock = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='stock' placeholder="Type Here.." class="input" type="number">
			          </div>
			        </div>				





			        <div class="field">
			          <label>Purchase Order
	      				 <button class="delete is-pulled-right" aria-label="close" @click="storage = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='storage' placeholder="Type Here.." class="input" type="number">
			          </div>
			        </div>

				</div>
			</section>

		</div>
	</div>

	<!-- modal end -->
























	<!-- modal start -->

	  <div v-if="ControlModal" id="modal-ter" class="modal is-active">
		  <div class="modal-background"></div>
		  <div class="modal-card" style="width:40%;">
	        <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

	    	    	<b style="color:white;font-size:20px;">{{ datatopass.controlheader }}</b>

	    	    	<a class="button is-danger is-small" style="float:right;" @click="ControlModal = false">
	    	            <i class="bi bi-x" style="font-size:38px;"></i> Close
	    	        </a>

	        </header>

				 		<section class="modal-card-body" style="padding:15px;">
				      		<div>

									<ControlModal :modalData="datatopass"
								 				   @transactioncomplete='closemodal'>
									</ControlModal>

	        				</div>
						</section>

			</div>
		</div>

	<!-- modal end -->
















	<!-- print start -->

			<Print style="visibility: hidden;" 
							v-if="printmodalopenclose" 
							:dataforform="datatopass"
	 					  @transactioncomplete='closemodal'>
			</Print>

	<!-- print end -->




  
  </div>


	

</template>





<script type="text/javascript">
	
    import ControlModal from '../../Modals/ItemsModal/ItemsModal.vue';
    import Loader from '../../Includes/Loader.vue';
    import { mapState, mapActions, mapMutations } from 'vuex';
    import Localbase from 'localbase';

  export default{

      components:{

	        ControlModal,
	        Loader,
	        // Print

      },


     props:[],


    data(){

      return{



                //table
                //
    
		 			alldata:{},
					tablenum:10,						    
					heading:{},
					footer:'',
					gotopage: '',
					tablespinner:true,

				//
				//table
							


				//search input
				//

						status: '',
						item_code: '',
						company: '',
						category: '',
						item_name: '',
						unit: '',
						suppliers_price: '',
						sellers_price: '',
						vat: '',
						discountable: '',
						discount: '',
						stock: '',
						storage: '',
						
				//
				//search input
								


				//forupdatingdata
				//
					
					ControlModal:false,
					printmodalopenclose:false,

					datatopass:{	

							controlheader:'',
							controltype:'',
							data_id:'',

					},

					forrefresh:'',

				//
				//forupdatingdata
				

				// Variables
				//
				
					modaltype: this.dataformodal,
					searchModal: false,
					suppliers: {},
					units: {},
					categories: {},

				//
				// Variables
								
      }


    },



    	//watch
      	//
      	//

            watch:{


					tablenum(){

		 				this.gettabledata(this.heading.currentpagenumber);

 					},


 					// search variables
 					//
	 					

	 					status(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						item_code(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						company(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						category(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						item_name(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						unit(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						suppliers_price(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						sellers_price(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						vat(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						discountable(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						discount(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						stock(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						storage(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},



		
 					//
 					// search variables
 					


 					gotopage(){

		 				this.gettabledata(this.gotopage);

 					},


 					dataformodal(){

		 				this.gettabledata(this.heading.currentpagenumber);

 					},



            },

      //
      //
      //watch





















      //mounted
      //
      //

            async mounted(){

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


                //get all data for the table
             	this.gettabledata(this.heading.currentpagenumber);
             	this.changeLoaderState(false);

            },

      //
      //
      //mounted
      





















    methods:{

        ...mapActions('alerts', ['showToast','showErrors','checkUserLogin']),
        ...mapMutations('alerts',['changeLoaderState']),



		  	async gettabledata(pn){

				this.tablespinner = true;

				axios.post('/getItems',{

						// search fields
						// 
					
							'status': this.status,
							'item_code': this.item_code,
							'company': this.company,
							'category': this.category,
							'item_name': this.item_name,
							'unit': this.unit,
							'suppliers_price': this.suppliers_price,
							'sellers_price': this.sellers_price,
							'vat': this.vat,
							'discountable': this.discountable,
							'discount': this.discount,
							'stock': this.stock,
							'storage': this.storage,

		 				//
		 				// search fields
		 				

		 				'tablenum':	this.tablenum,
		 				'pn':	pn,

 				})
 				.then((response) => {

						this.alldata = response.data.alldata;
		 				this.heading = response.data.heading;
		 				this.footer = response.data.footer;
						this.tablespinner = false;


 				})
				.catch((error) => {

					this.tablespinner = false;
                	this.showErrors(error.response.data.errors);

				});


		    },




         


            closemodal(modalname) {

				if (modalname == 'controlmodal') {

    				this.ControlModal = false;

    				this.datatopass = {

        						'controlheader': '',	
        						'controltype': '',	
        						'data_id': '',	

						};

					// function with the callback from the table
     				this.gettabledata(this.heading.currentpagenumber);

        		}

            	
            },




            clearall(){

            	this.status =  '';
				this.item_code =  '';
				this.company =  '';
				this.category =  '';
				this.item_name =  '';
				this.unit =  '';
				this.suppliers_price =  '';
				this.sellers_price =  '';
				this.vat =  '';
				this.discountable =  '';
				this.discount =  '';
				this.stock =  '';
				this.storage =  '';

            },
     

            	

            async openmodal(type, data) { 

            	let access = await axios.post('checkUserAccess',{'access': type})
            					        .then((response)=> {return response.data;})
				             			.catch((error) => {return response.data;});

				if (access == 'bad') {

					   this.showToast({
		 	                 type: 'error',
		 	                 message: 'Sorry! You cannot access this feature.',
		 	           });

				} else {

		            	if(type == 'item_add') {

		            		this.datatopass = {

								'controlheader': 'Add Item',	
								'controltype': 'add',	
								'data_id': data,	

							};

							this.ControlModal = true;

		            	} else if(type == 'item_edit') {

		        			this.datatopass = {

								'controlheader': 'Update Item',	
								'controltype': 'edit',	
								'data_id': data,	
							};

							this.ControlModal = true;

		            	} else if(type == 'item_delete'){

		            		if (confirm('Are you sure you want to Delete this Item?')) {
		            			
            					this.changeLoaderState(true);

			            		axios.post('/deleteitem',{
			            			'id': data,
			            		})
				 				.then((response) => {

									  if (response.data == 'bad') {

									  	  this.showToast({
						                    type: 'error',
						                    message: 'The Item must be out of stock.',
						                  });

									  } else {

									  	  this.showToast({
						                    type: 'success',
						                    message: 'User Deleted.',
						                  });

	     								  this.gettabledata(this.heading.currentpagenumber);

									  }

						              this.changeLoaderState(false);

				 				})
								.catch((error) => {
									  this.changeLoaderState(false);
					                  this.showErrors(error.response.data.errors);
								});


		            		}

		            	}

				}

     


            },


      		

    }
  };

</script>