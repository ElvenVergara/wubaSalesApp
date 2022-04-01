<template>

	

	<div>
		<Loader></Loader>

		<div style="border-top:solid rgb(8,50,150) 1px;border-left:solid rgb(8,50,150) 1px;border-right:solid rgb(8,50,150) 2px;border-bottom:solid rgb(8,50,150) 2px;box-shadow: 1px 2px 3px #888888;">
									
						 					
			 <nav class="panel column is-12" style="overflow-x: auto;">


				<div class="panel-block" style="padding:0px;margin:0px;">
  					  	
  					<p class='navbar-end pull-right'>

		          		<b style="font-size:20px;margin-right:5px;">Search: &nbsp; </b>
						<input v-model='textSearch' placeholder="Type Here.." id="search" class="input" type="text" autofocus>

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
									Select
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


						  	<td style="text-align:center;padding-top:5px;border:solid black 1px;">

						  		<br>
						  		<a @click="select(list.id)" class="button is-link" style="width:80px;height:80px;">
	                              	<b>SELECT</b>
	                            </a> 	
								
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


									&nbsp;&nbsp; Discount: <span style="font-size:19px;">{{ list.discount }}%</span> 

									&nbsp;&nbsp; 

									VAT: <span style="font-size:19px;">{{ list.vat }}%</span>

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

	  	<div v-if="AddQuantity" id="modal-ter" class="modal is-active">
		  <div class="modal-background"></div>
		  <div class="modal-card" style="width:30%;">
	        <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

	    	    	<b style="color:white;font-size:20px;">Input Quantity</b>

	    	    	<a class="button is-danger is-small" style="float:right;" @click="AddQuantity = false">
	    	            <i class="bi bi-x" style="font-size:38px;"></i> Close
	    	        </a>

	        </header>

				 		<section class="modal-card-body" style="padding:15px;">
				      		<div>

              				  <form v-on:submit.prevent="add_order">

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
								        	<b><i class="bi bi-cart"></i>&nbsp; Add Order</b>
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
				
					searchModal: false,
					suppliers: {},
					units: {},
					categories: {},
					formdata: {
						item_id: '',
						quantity: '',
					},
					AddQuantity: false,

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
             	let search = document.getElementById('search').focus();

            },

      //
      //
      //mounted
      











    computed:{
        ...mapState('items', ['transactionCode']),
    },









    methods:{

        ...mapActions('alerts', ['showToast','showErrors','checkUserLogin']),
        ...mapMutations('alerts',['changeLoaderState', 'refreshMutation']),
        ...mapMutations('items',['refreshMutation']),



		  	async gettabledata(pn){

				this.tablespinner = true;

				axios.post('/getSelectItemPOS',{

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

		    	this.formdata.item_id = data;
		    	this.AddQuantity = true;

		    },



		    add_order(){

		    	this.formdata.transaction_code = this.transactionCode;

		    	axios.post('/add_order',this.$data.formdata)
 				.then((response) => {

 					if (response.data == 'good') {

 						this.showToast({
		 	                 type: 'success',
		 	                 message: 'Success! Order Added.',
		 	            });
 						
		    			this.AddQuantity = false;
		 				this.$emit('transactioncomplete', 'selectItem');
		 				this.refreshMutation(Math.random().toString(36).slice(2));

 					} else {

 						this.showToast({
		 	                 type: 'error',
		 	                 message: 'Error! Invalid Quantity.',
		 	            });
 					}
					

 				})
				.catch((error) => {

					this.tablespinner = false;
                	this.showErrors(error.response.data.errors);

				});

		    }

      		

    }
  };

</script>