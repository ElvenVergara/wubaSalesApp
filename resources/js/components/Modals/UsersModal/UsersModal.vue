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
		            <label>Status <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.status = ''"></a>
		            </label>
			            <div class="control" style="width:100%;">
			              <div class="select" style="width:100%;">

		                	<select v-model='formdata.status' style="width:100%;" required>

			                    <option value="">-- Select --</option>
			                  	<option>Active</option>
			                	<option>Not Active</option>
			                	<option>Blocked</option>

			                </select>

		              </div>
		            </div>
	            </div>





	            <div class="field" style="width:100%;">
		            <label>Usertype <b style="color:red;">*</b>
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

			                </select>

		              </div>
		            </div>
	            </div>



		        <div class="field">
		          <label>Last Name <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.lastname = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.lastname' placeholder="Type Here.." class="input" type="text" required>
		          </div>
		        </div>


		        <div class="field">
		          <label>First Name <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.firstname = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.firstname' placeholder="Type Here.." class="input" type="text" required>
		          </div>
		        </div>


		        <div class="field">
		          <label>Middle Name <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.middlename = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.middlename' placeholder="Type Here.." class="input" type="text" required>
		          </div>
		        </div>


		        <div class="field" style="width:100%;">
		            <label>Gender <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.gender = ''"></a>
		            </label>
			            <div class="control" style="width:100%;">
			              <div class="select" style="width:100%;">

		                	<select v-model='formdata.gender' style="width:100%;" required>

			                    <option value="">-- Select --</option>
			                  	<option value="M">Male</option>
			                	<option value="F">Female</option>

			                </select>

		              </div>
		            </div>
	            </div>


		        <div class="field">
		          <label>Contact Number <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.contact = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.contact' placeholder="Type Here.." class="input" type="text" required>
		          </div>
		        </div>


		        <div class="field">
		          <label>Address <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.address = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.address' placeholder="Type Here.." class="input" type="text" required>
		          </div>
		        </div>


		        <div class="field">
		          <label>Email Address <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.email = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.email' placeholder="Type Here.." class="input" type="email" required>
		          </div>
		        </div>


		        <div class="field">
		          <label>User Name <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.username = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.username' placeholder="Type Here.." class="input" type="text" required>
		          </div>
		        </div>	



		        <div class="field">
		          <label>Password <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.password = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.password' placeholder="Type Here.." class="input" type="password" minlength="8" required>
		          </div>
		        </div>


		        <div class="field">
		          <label>Retype Password <b style="color:red;">*</b>
      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.retype_password = ''"></a>
		          </label>
		          <div class="control">
						<input v-model='formdata.retype_password' placeholder="Type Here.." class="input" type="password" minlength="8" required>
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
			            <label>Status <b style="color:red;">*</b>
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.status = ''"></a>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='formdata.status' style="width:100%;" required>

				                    <option value="">-- Select --</option>
				                  	<option>Active</option>
				                	<option>Not Active</option>
				                	<option>Blocked</option>

				                </select>

			              </div>
			            </div>
		            </div>





		            <div class="field" style="width:100%;">
			            <label>Usertype <b style="color:red;">*</b>
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

				                </select>

			              </div>
			            </div>
		            </div>



			        <div class="field">
			          <label>Last Name <b style="color:red;">*</b>
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.lastname = ''"></a>
			          </label>
			          <div class="control">
							<input v-model='formdata.lastname' placeholder="Type Here.." class="input" type="text" required>
			          </div>
			        </div>


			        <div class="field">
			          <label>First Name <b style="color:red;">*</b>
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.firstname = ''"></a>
			          </label>
			          <div class="control">
							<input v-model='formdata.firstname' placeholder="Type Here.." class="input" type="text" required>
			          </div>
			        </div>


			        <div class="field">
			          <label>Middle Name <b style="color:red;">*</b>
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.middlename = ''"></a>
			          </label>
			          <div class="control">
							<input v-model='formdata.middlename' placeholder="Type Here.." class="input" type="text" required>
			          </div>
			        </div>


			        <div class="field" style="width:100%;">
			            <label>Gender <b style="color:red;">*</b>
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.gender = ''"></a>
			            </label>
				            <div class="control" style="width:100%;">
				              <div class="select" style="width:100%;">

			                	<select v-model='formdata.gender' style="width:100%;" required>

				                    <option value="">-- Select --</option>
				                  	<option value="M">Male</option>
				                	<option value="F">Female</option>

				                </select>

			              </div>
			            </div>
		            </div>


			        <div class="field">
			          <label>Contact Number <b style="color:red;">*</b>
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.contact = ''"></a>
			          </label>
			          <div class="control">
							<input v-model='formdata.contact' placeholder="Type Here.." class="input" type="text" required>
			          </div>
			        </div>


			        <div class="field">
			          <label>Address <b style="color:red;">*</b>
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.address = ''"></a>
			          </label>
			          <div class="control">
							<input v-model='formdata.address' placeholder="Type Here.." class="input" type="text" required>
			          </div>
			        </div>


			        <div class="field">
			          <label>Email Address <b style="color:red;">*</b>
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.email = ''"></a>
			          </label>
			          <div class="control">
							<input v-model='formdata.email' placeholder="Type Here.." class="input" type="email" required>
			          </div>
			        </div>


			        <div class="field">
			          <label>User Name <b style="color:red;">*</b>
	      				 <a class="delete is-pulled-right" aria-label="close" @click="formdata.username = ''"></a>
			          </label>
			          <div class="control">
							<input v-model='formdata.username' placeholder="Type Here.." class="input" type="text" required>
			          </div>
			        </div>	



			        <div class="field">
			          <a @click="generatePass" class="button is-success is-small">Generate Temp Password </a> 
			          <span style="color:red;font-size:10px;">
			          	Optional</span>
			          <div class="control">
			            <input class="input" type="text" placeholder="Generate password..." v-model='tempPass' disabled>
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

                			status:'',
							usertype:'',
							lastname:'',
							firstname:'',
							middlename:'',
							gender:'',
							contact:'',
							gender:'',
							address:'',
							email:'',
							username:'',
							password: '',
							retype_password: '',

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
	            			
        					axios.post('/getdataforedit',{

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

						 if(this.formdata.password === this.formdata.retype_password && this.formdata.retype_password != '')	{

						 	   axios.post('adduser',this.$data.formdata).then((response)=> 
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

						 } else {

						 	 this.changeLoaderState(false);
			 				 this.showToast({
		 	                        type: 'error',
		 	                        message: 'Password and Retype Password NOT Match.',
		 	                 });

						 }

								
					} else if (type == 'edit') {

						this.formdata.password = this.tempPass;
							
						axios.post('/edituser',this.$data.formdata)
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






