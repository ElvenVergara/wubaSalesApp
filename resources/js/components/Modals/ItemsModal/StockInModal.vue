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
		          <label>Item Name</label>
		          <div class="control">
						<b style="font-size:18px;">{{ poData.item_name }}</b>
		          </div>
		        </div>



		        <div class="field">
		          <label>Company</label>
		          <div class="control">
						<b style="font-size:18px;">{{ poData.company }}</b>
		          </div>
		        </div>



		        <div class="field">
		          <label>Supplier Name</label>
		          <div class="control">
						<b style="font-size:18px;">{{ poData.supplier_name }}</b>
		          </div>
		        </div>


		        <div class="field">
		          <label>Storage Count </label>
		          <div class="control">
						<b style="font-size:23px;">{{ parseInt(remaining_count).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b>
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

							quantity: 0,

	            			 // second
	            			 data_id: this.modalData.data_id,
                		},

                		poData: {},
                		items: {},
                		total: 0,
                		remaining_count: '',


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



	     
					axios.post('/getPOofTheItem',{

						'data_id': this.selectedItemId,

					})
	 				.then((response) => {

	 					this.poData = response.data;
	 					this.remaining_count = response.data.remaining_count;
				 	   	this.formdata.po_id = response.data.id;

	 				})
					.catch((error) => this.errors = error.response.data.errors);



            		//
            		//
            		// get data for edit form
            		
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

				 	   if (this.formdata.quantity <= this.remaining_count && this.formdata.quantity > 0) {

				 	   		axios.post('add_stockin',this.$data.formdata).then((response)=> 
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

				 	   } else {

				 	   		this.showToast({
			 	                 type: 'error',
			 	                 message: 'Error! Invalid Input.',
			 	            });
							this.changeLoaderState(false);

				 	   }

								
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


			
    }
  };

</script>






