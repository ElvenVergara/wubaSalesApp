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



		        			  <p @click="openmodal('useraccess_add','')" class="control" title="Add New Data">
	                            <a class="button is-info is-rounded is-small" style="width:150px;">
	                                <i class="bi bi-plus" style="font-size:38px;"></i> <b>ADD DATA</b>
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
									User Type
								</th>

								<th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;">
									Access
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

									<div class="dropdown is-hoverable is-up">
										
										<div class="dropdown-trigger">
											<i class="bi bi-menu-button-wide-fill" style="font-size:20px;">
											</i>
										</div>


										<div class="dropdown-menu" id="dropdown-menu" role="menu" style="padding: 0px; margin-left:-9px;">
												
												<div class="dropdown-content" style="margin:-20px;width:200px;padding: 0px; margin: 0px;">
													
													<div class="dropdown-item" style="padding:4px;text-align:center;">

						        			  			<a @click="openmodal('useraccess_edit',list.id)" class="button is-info is-small is-rounded" title="Update">
						        							<i class="bi bi-pencil-square" style="font-size:20px;"></i>
						        			  			</a>

						        			  			&nbsp;

								        			    <a @click="openmodal('useraccess_delete',list.id)" class="button is-danger is-small is-rounded" title="Delete">
								        			  		<i class="bi bi-trash3-fill" style="font-size:20px;"></i>
								        			    </a>

													</div>
												</div>
										</div>
									</div>  
								
								</td>
						

								<td style="padding-left:5px;border:solid black 1px;">

									<center>
										{{ list.usertype }}
									</center>
										
								</td>




								<td style="padding-left:5px;border:solid black 1px;">
									
									<center>
										{{ list.access }}
									</center>									

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
			            <label>Usertype
	      				 <a class="delete is-pulled-right" aria-label="close" @click="usertype = ''"></a>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='usertype' style="width:100%;">

				                    <option value="">-- Select --</option>
				                  	<option>Admin</option>
				                	<option>Staff</option>
				                	<option>Cashier</option>
				                	<option>Member</option>
				                	<option>Supplier</option>
				                	<option>Customer</option>

				                </select>

			              </div>
			            </div>
		            </div>



			        <div class="field">
			          <label>Access Name
	      				 <a class="delete is-pulled-right" aria-label="close" @click="access = ''"></a>
			          </label>
			          <div class="control">
							<input v-model='access' placeholder="Type Here.." class="input" type="text">
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
	
    import ControlModal from '../../Modals/UsersModal/UserAccessModal.vue';
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

						usertype:'',
						access:'',
						
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
	 					

	 					usertype(){

			 				this.gettabledata(this.heading.currentpagenumber);

	 					},

					
						access(){

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

				axios.post('/getUserAccess',{

						// search fields
						// 
					
							'usertype': this.usertype,
							'access': this.access,

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

            	this.usertype = '';
				this.access = '';

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

		            	if(type == 'useraccess_add') {

		            		this.datatopass = {

								'controlheader': 'Add Access',	
								'controltype': 'add',	
								'data_id': data,	

							};

							this.ControlModal = true;

		            	} else if(type == 'useraccess_edit') {

		        			this.datatopass = {

								'controlheader': 'Update Access',	
								'controltype': 'edit',	
								'data_id': data,	
							};

							this.ControlModal = true;

		            	} else if(type == 'useraccess_delete'){

		            		if (confirm('Are you sure you want to Delete this Access?')) {
		            			
            					this.changeLoaderState(true);

			            		axios.post('/deleteaccess',{
			            			'id': data,
			            		})
				 				.then((response) => {

									  this.showToast({
					                    type: 'success',
					                    message: 'User Access Deleted.',
					                  });

     								  this.gettabledata(this.heading.currentpagenumber);
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