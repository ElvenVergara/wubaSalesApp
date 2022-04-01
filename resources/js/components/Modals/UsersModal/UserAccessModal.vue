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


					<div class="field" style="width:100%;">
			            <label>Usertype
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.usertype = ''"></a>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='formdata.usertype' style="width:100%;" required>

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
		          <label>Access Name <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.access = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.access' placeholder="Type Here.." class="input" type="text" required>
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


					<div class="field" style="width:100%;">
				            <label>Usertype
		      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.usertype = ''"></a>
				            </label>
					            <div class="control" style="width:100%;">
					              <div class="select" style="width:100%;">

				                	<select v-model='formdata.usertype' style="width:100%;" required>

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
			          <label>Access Name <b style="color:red;">*</b>
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.access = ''"></a>
			          </label>
			          <div class="control">
							<input v-model='formdata.access' placeholder="Type Here.." class="input" type="text" required>
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

							usertype:'',
							access:'',
				
                			 // second
                			 data_id: this.modalData.data_id,
                		},

                		tempPass: '',


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
	            			
        					axios.post('/getAccessforEdit',{

        						'id': this.modalData.data_id,

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

					 	   axios.post('addaccess',this.$data.formdata).then((response)=> 
					 	   { 

					 	        if (response.data == 'not match') {

					 	             this.showToast({
					 	                 type: 'error',
					 	                 message: 'Password and Retype Password NOT MATCH',
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
							
						axios.post('/editaccess',this.$data.formdata)
		 				.then((response) => {

		 						this.$emit('transactioncomplete', 'controlmodal');
		 						
		 						this.showToast({
		 	                        type: 'success',
		 	                        message: 'Data Submitted.',
		 	                 	});
						 	    
						 	    this.changeLoaderState(false);

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






