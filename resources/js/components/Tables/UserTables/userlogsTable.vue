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

								<th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:50%;">
									Log Details
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

								<td style="padding-left:5px;border:solid black 1px;">

									Usertype: <b style="font-size:17px;">{{ list.usertype }}</b><br>

									User: <b style="font-size:17px;">{{ list.user }}</b> <br>
									Date/Time: <b style="font-size:17px;">{{ getTimeDate(list.created_at) }}</b>
										
								</td>




								<td style="padding-left:5px;border:solid black 1px;">
									
									Activity: <b style="font-size:17px;">{{ list.activity }}</b> <br>
									Content: <b style="font-size:17px;">{{ list.content }}</b>
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
			            <label>User type
	      				 <button class="delete is-pulled-right" aria-label="close" @click="usertype = ''"></button>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='usertype' style="width:100%;">

				                    <option value="">-- Select --</option>
				                  	<option>Admin</option>
				                	<option>Staff</option>
				                	<option>Cashier</option>
				                	<option>Member</option>

				                </select>

			              </div>
			            </div>
		            </div>



			        <div class="field">
			          <label>User
	      				 <button class="delete is-pulled-right" aria-label="close" @click="user = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='user' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field">
			          <label>Created at
	      				 <button class="delete is-pulled-right" aria-label="close" @click="created_at = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='created_at' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field">
			          <label>Activity
	      				 <button class="delete is-pulled-right" aria-label="close" @click="activity = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='activity' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			     
			        <div class="field">
			          <label>Content
	      				 <button class="delete is-pulled-right" aria-label="close" @click="content = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='content' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        
				</div>
			</section>

		</div>
	</div>

	<!-- modal end -->









  
  </div>


	

</template>





<script type="text/javascript">
	
    import Loader from '../../Includes/Loader.vue';
    import { mapState, mapActions, mapMutations } from 'vuex';
    import Localbase from 'localbase';

  export default{

      components:{

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

					usertype: '',
					user: '',
					created_at: '',
					activity: '',
					content: '',
						
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

						user(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						created_at(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						activity(){

		 					this.gettabledata(this.heading.currentpagenumber);

 						},

						content(){

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


        	getTimeDate(time){

        		let text = time;
					text = text.split(".");
				    text = text[0].replace("T"," ");

				return text;

        	},



		  	async gettabledata(pn){

             	this.tablespinner = true;

				axios.post('/getUserlogs',{

						// search fields
						// 
					
							'usertype': this.usertype,
							'user': this.user,
							'created_at': this.created_at,
							'activity': this.activity,
							'content': this.content,
						
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

             		this.changeLoaderState(false);
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
				this.user = '';
				this.created_at = '';
				this.activity = '';
				this.content = '';

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

		            	if(type == 'customer_add') {

		            		this.datatopass = {

								'controlheader': 'Add Supplier',	
								'controltype': 'add',	
								'data_id': data,	

							};

							this.ControlModal = true;

		            	} else if(type == 'customer_block') {


		            		if (confirm('Are you sure you want to block this User?')) {

            					this.changeLoaderState(true);

		            			axios.post('blockUser',{'id': data})
			            		.then((response)=> 
					            { 

								      this.showToast({
					                    type: 'success',
					                    message: 'Success! User Blocked.',
					                  });

     								  this.gettabledata(this.heading.currentpagenumber);
					                  this.changeLoaderState(false);
					            })
					             .catch((error) => {

					                this.changeLoaderState(false);
					                this.showErrors(error.response.data.errors);

					             });

		            		}

		            	} else if(type == 'customer_edit') {

		        			this.datatopass = {

								'controlheader': 'Update Supplier',	
								'controltype': 'edit',	
								'data_id': data,	
							};

							this.ControlModal = true;

		            	} else if(type == 'customer_delete'){

		            		if (confirm('Are you sure you want to Delete this User?')) {
		            			
            					this.changeLoaderState(true);

			            		axios.post('/deleteuser',{
			            			'id': data,
			            		})
				 				.then((response) => {

									  this.showToast({
					                    type: 'success',
					                    message: 'User Deleted.',
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