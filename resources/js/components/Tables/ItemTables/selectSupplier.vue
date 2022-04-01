<template>

	

	<div>
		<Loader></Loader>

		<div style="border-top:solid rgb(8,50,150) 1px;border-left:solid rgb(8,50,150) 1px;border-right:solid rgb(8,50,150) 2px;border-bottom:solid rgb(8,50,150) 2px;box-shadow: 1px 2px 3px #888888;">
									
						 					
			 <nav class="panel column is-12" style="overflow-x: auto;">


				<div class="panel-block" style="padding:0px;">
  					  	
  					    <p class='navbar-end pull-right'>

			          		<b style="font-size:20px;margin-right:5px;">Search: &nbsp; </b>
							<input v-model='textSearch' placeholder="Type Here.." class="input" type="text">

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
									User Details
								</th>

								<th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;">
									Contact Details
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
							  		<a @click="select(list.id)" class="button is-link is-rounded is-small" style="width:80px;">
		                              	<b>LOAD</b>
		                            </a> 	
									
								</td>
						

								<td style="padding-left:5px;border:solid black 1px;">

									Status: 
									<b style="font-size:19px;color:red;" v-if="list.status == 'Blocked'">
										{{ list.status }}
									</b>

									<b style="font-size:19px;color:green;" v-else>{{ list.status }}</b>

									<br>
									Full name: <b style="font-size:19px;">{{ list.firstname }} {{ list.middlename }} {{ list.lastname }}</b> <br>
									Gender: <b style="font-size:19px;">{{ list.gender }}</b> <br>
									Company: <b style="font-size:19px;">{{ list.company }}</b> <br>
										
								</td>




								<td style="padding-left:5px;border:solid black 1px;">
									
									Contact: <b style="font-size:19px;">{{ list.contact }}</b> <br>
									Address: <b style="font-size:19px;">{{ list.address }}</b> <br>
									Email: <b style="font-size:19px;">{{ list.email }}</b> <br>
									Username: <b style="font-size:19px;">{{ list.username }}</b> <br>

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
				                  	<option>Active</option>
				                	<option>Not Active</option>
				                	<option>Blocked</option>

				                </select>

			              </div>
			            </div>
		            </div>



			        <div class="field">
			          <label>Last Name
	      				 <button class="delete is-pulled-right" aria-label="close" @click="lastname = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='lastname' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field">
			          <label>First Name
	      				 <button class="delete is-pulled-right" aria-label="close" @click="firstname = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='firstname' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field">
			          <label>Middle Name
	      				 <button class="delete is-pulled-right" aria-label="close" @click="middlename = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='middlename' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field" style="width:100%;">
			            <label>Gender
	      				 <button class="delete is-pulled-right" aria-label="close" @click="gender = ''"></button>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='gender' style="width:100%;">

				                    <option value="">-- Select --</option>
				                  	<option value="M">Male</option>
				                	<option value="F">Female</option>

				                </select>

			              </div>
			            </div>
		            </div>


			        <div class="field">
			          <label>Contact Number
	      				 <button class="delete is-pulled-right" aria-label="close" @click="contact = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='contact' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field">
			          <label>Address
	      				 <button class="delete is-pulled-right" aria-label="close" @click="address = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='address' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field">
			          <label>Company Name
	      				 <button class="delete is-pulled-right" aria-label="close" @click="company = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='company' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field">
			          <label>Email Address
	      				 <button class="delete is-pulled-right" aria-label="close" @click="email = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='email' placeholder="Type Here.." class="input" type="text">
			          </div>
			        </div>


			        <div class="field">
			          <label>User Name
	      				 <button class="delete is-pulled-right" aria-label="close" @click="username = ''"></button>
			          </label>
			          <div class="control">
							<input v-model='username' placeholder="Type Here.." class="input" type="text">
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
	
    import ControlModal from '../../Modals/UsersModal/SuppliersModal.vue';
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

						textSearch: '',
						
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

	 					textSearch(){

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
        ...mapMutations('items',['changeSelectedItem', 'changeTransactionCode']),


		  	async gettabledata(pn){

				this.tablespinner = true;

				axios.post('/getSelectSuppliers',{

						// search fields
						// 
					
							'search': this.textSearch,

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


            select(data){

		    	this.changeSelectedItem(data);
		    	this.changeTransactionCode(Math.floor(Math.random() * (99999999 - 10000000 + 1) ) + 10000000);
		 		this.$emit('transactioncomplete', 'controlmodal');

		    },



      		

    }
  };

</script>