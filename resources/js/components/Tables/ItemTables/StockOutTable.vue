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

        			  <p @click="openmodal('stockout_add','')" class="control" title="Add New Data">
                        <a class="button is-info is-rounded is-small" style="width:170px;">
                            <i class="bi bi-plus" style="font-size:38px;"></i> <b>ADD STOCK OUT</b>
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

								<!-- <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:5%;">
									Action
								</th> -->

								<th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:50%;">
									Stock Out Details
								</th>

								<th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;">
									User Details
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


						  	<!-- <td style="text-align:center;padding:5px;border:solid black 1px;">

						  		<br>
								<div class="dropdown is-hoverable is-up">
									
									<div class="dropdown-trigger">
											
										<i class="bi bi-menu-button-wide-fill" style="font-size:20px;">
										</i>

									</div>


									<div class="dropdown-menu" id="dropdown-menu" role="menu" style="padding: 0px; margin-left:-9px;">
											
											<div class="dropdown-content" style="margin:-20px;width:100px;padding: 0px; margin: 0px;">
												
													<div class="dropdown-item" style="padding:4px;text-align:center;">

								        			    <a @click="openmodal('po_delete',list.id)" class="button is-danger is-small is-rounded" title="Delete">
								        			  		<i class="bi bi-trash3-fill" style="font-size:20px;"></i>
								        			    </a>

													</div>

											</div>

									</div>


									</div>  
								
								</td> -->
						

								<td style="padding-left:5px;border:solid black 1px;font-size:13px;">

							
									Item Name: <b style="font-size:20px;">{{ list.item_name }}</b> <br>
									
									Quantity: <b style="font-size:21px;color:red;">{{ parseInt(list.quantity).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b>

									&nbsp;&nbsp; 

									Unit: <span style="font-size:19px;">{{ list.unit }}</span> 

									<br>

									Stock out type: 

									<b v-if="list.type == '1'" style="font-size:16px;">
										Stock to Storage
									</b> 

									<b v-if="list.type == '2'" style="font-size:16px;">
										Stock to Disposal
									</b> 

									<b v-if="list.type == '3'" style="font-size:16px;">
										Storage to Disposal
									</b> 

									<br>
									
								</td>




								<td style="border:solid black 1px;padding:5px;font-size:13px;">
									
									Supplier: <span style="font-size:19px;">{{ list.supplier_name }}</span> 

									<br>

									Issued By: <b style="font-size:18px;">{{ list.issued_by }}</b>

									<br>

									Date: <b style="font-size:18px;">{{ list.date }}</b>

									<br>

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
			            <label>Stock out type
	      				 <button class="delete is-pulled-right" aria-label="close" @click="type = ''"></button>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='type' style="width:100%;">

				                    <option value="">-- Select --</option>
				                  	<option value="1">Stock to Storage</option>
				                	<option value="2">Stock to Disposal</option>
				                	<option value="3">Storage to Disposal</option>

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





			        <div class="field">
			          <label>Quantity
	      				 <button class="delete is-pulled-right" aria-label="close" @click="quantity = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='quantity' placeholder="Type Here.." class="input" type="number">
			          </div>
			        </div>


			       


			        <div class="field">
			          <label>Unit
	      				 <button class="delete is-pulled-right" aria-label="close" @click="unit = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='unit' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>




			     

			        <div class="field">
			          <label>Supplier
	      				 <button class="delete is-pulled-right" aria-label="close" @click="supplier_name = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='supplier_name' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>



			        <div class="field">
			          <label>Issued By
	      				 <button class="delete is-pulled-right" aria-label="close" @click="issued_by = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='issued_by' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>




		            <div class="field">
			          <label>Date
	      				 <button class="delete is-pulled-right" aria-label="close" @click="date = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='date' placeholder="Type Here.." class="input" type="date">
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
		  <div class="modal-card" style="width:30%;">
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








	<!-- modal start -->

	  <div v-if="selectItem" id="modal-ter" class="modal is-active">
		  <div class="modal-background"></div>
		  <div class="modal-card" style="width:60%;">
	        <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

	    	    	<b style="color:white;font-size:20px;">Select Item</b>

	    	    	<a class="button is-danger is-small" style="float:right;" @click="selectItem = false">
	    	            <i class="bi bi-x" style="font-size:38px;"></i> Close
	    	        </a>

	        </header>

				 		<section class="modal-card-body" style="padding:15px;">
				      		<div>

									<selectItem @transactioncomplete='openAdd'>
									</selectItem>

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
	
    import ControlModal from '../../Modals/ItemsModal/StockOutModal.vue';
    import selectItem from '../../Tables/ItemTables/SelectItemStockOut.vue';
    import Loader from '../../Includes/Loader.vue';
    import { mapState, mapActions, mapMutations } from 'vuex';
    import Localbase from 'localbase';

  export default{

      components:{

	        ControlModal,
	        selectItem,
	        Loader,

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

						item_name: '',
						type:'',
						quantity: '',
				        unit: '',
				        supplier_name: '',
				        issued_by: '',
				        date: '',
						
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
					selectItem: false,
					searchModal: false,

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
	 					



	 					item_name(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						type(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

 						quantity(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

				        unit(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

				        supplier_name(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

				        issued_by(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

				        date(){

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




















      computed:{
        ...mapState('items', ['selectedItemId']),
  	  },













      //mounted
      //
      //

            async mounted(){

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

				axios.post('/getStockOut',{

					// search fields
					// 

						'item_name': this.item_name,
						'type': this.type,
						'quantity': this.quantity,
				        'unit': this.unit,
				        'supplier_name': this.supplier_name,
				        'issued_by': this.issued_by,
				        'date': this.date,

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

            	this.item_name = '';
				this.type = '';
				this.quantity = '';
		        this.unit = '';
		        this.supplier_name = '';
		        this.issued_by = '';
		        this.date = '';

            },







            openAdd(){

            	this.datatopass = {

					'controlheader': 'Add Stock Out',	
					'controltype': 'add',	
				};

				this.ControlModal = true;
				this.selectItem = false;

            	this.changeLoaderState(true);

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

	            	if(type == 'stockout_add') {

						this.selectItem = true;

	            	}

				}

     


            },


      		

    }
  };

</script>