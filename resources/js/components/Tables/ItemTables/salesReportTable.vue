<template>

  

  <div>
    <Loader></Loader>

    <div style="border-top:solid rgb(8,50,150) 1px;border-left:solid rgb(8,50,150) 1px;border-right:solid rgb(8,50,150) 2px;border-bottom:solid rgb(8,50,150) 2px;box-shadow: 1px 2px 3px #888888;">
      

    

    <nav class="panel column is-12" style="overflow-x: auto;padding:0px;background: white;">



      <div style="width:100%;overflow-y:auto;">


      		 	<table style="width:100%;">
                 
      			    <tr>

      				    <td style="padding-top:5px;">

      				     <table style="margin:0x;padding:0px;">
      				     	
      				     	<tr>
      				     		<td style="width:50%;padding: 0px;">
                            <h2 class="title is-4">Filter</h2>
      				     		</td>

      				     		<td style="width:50%;padding: 3px;text-align:right;">
                                	<a @click="print" class="button is-link is-small">
      				                   <i class="bi bi-printer" style="font-size:28px;"></i> &nbsp;&nbsp; <b>Print</b>
      				               </a>
      				     		</td>

      				     	</tr>

      				     </table>



      				     <table style="margin:0x;padding:0px;padding-top:0px;margin-top:-28px;">
      				     	
      				     	<tr>
                      <td style="width:50%;">
                        <div class="field">
		         			          <label><b>Date From:</b>
		         			          </label>
		         			          <div class="control">
		         							<input v-model='datefrom' placeholder="Type Here.." class="input" type="date">
		         			          </div>
		         			        </div>

		         			        <div class="field">
		         			          <label><b>Date To:</b>
		         			          </label>
		         			          <div class="control">
		         							<input v-model='dateto' placeholder="Type Here.." class="input" type="date">
		         			          </div>
		         			        </div>
      				     		</td>

      				     	</tr>
      				     
      				     </table>
         					

      				    </td>




                <td style="width:50%;">
      				    							
      				    <center>
      						<label class="title is-4">Totals</label>
      					</center>

      						<div style="text-align: right;">
      	       					<div class="field">
      	       			          <label><b style="color:red;">Total Sales:</b>
      	       			          </label>
      	       			          <div class="control">
      	       							<b class="title is-3">{{ parseInt(sales).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b>
      	       			          </div>
      	       			        </div>

      	       			        <div class="field">
      	       			          <label><b style="color:red;">Total Profit:</b>
      	       			          </label>
      	       			          <div class="control">
      	       							<b class="title is-3">{{ parseInt(profit).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b>
      	       			          </div>
      	       			        </div>
             			        </div>

      				    </td>

      			  

      			    </tr> 

      			 </table>


          <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" border="2" style="width:100%;">

          	  <tr>


                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:8%;">
                  <input type="number" v-model="quantity" style="width:100%;">
                </th>



                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:40%;">
                  <input type="text" v-model="item_name" style="width:100%;">
                </th>



                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:15%;">
                  <input type="number" v-model="sellers_price" style="width:100%;">
                </th>


                
                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:15%;">
                  <input type="number" v-model="seller_total" style="width:100%;">
                </th>


                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:18%;">
                  <input type="date" v-model="date" style="width:100%;">
                </th>


              </tr> 

              <tr>


                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:8%;">
                  Qty
                </th>



                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:40%;">
                  Item Name
                </th>



                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:15%;">
                  Price
                </th>


                
                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:15%;">
                  TOTAL
                </th>


                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:18%;">
                  Date
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


      <tbody v-else>
            <tr v-for="list,key in alldata">


                <td style="font-size:20px;text-align:center;padding: 0px;">

                   <b>{{ parseInt(list.quantity).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b> <br>
                  
                </td>



                <td style="padding-left:5px;padding: 4px;">

                  <b style="font-size:20px;">{{ list.item_name }}</b>
                  <span style="font-size:12px;">&nbsp;({{ list.discount }}% less)</span>
                  
                </td>




                <td style="font-size:20px;text-align:center;padding: 0px;">

                   <b>₱ {{ parseInt(list.sellers_price).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}/<b style="font-size:13px;">{{ list.unit }}</b></b> <br>
                  
                </td>


                


                <td style="font-size:20px;text-align: right;padding: 0px;padding-right:10px;">

                   <b>₱ {{ parseInt(list.seller_total).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b> <br>
                  
                </td>


                <td style="text-align:center;padding:5px;">


                  <b style="font-size:20px;">{{ list.date }}</b>
                  
                
                </td>


              </tr>

            </tbody>


          </table>


    </div>

                                      
    </nav>


  </div>

















  
  </div>


  

</template>





<script type="text/javascript">
  
    import ControlModal from '../../Modals/ItemsModal/OrderModal.vue';
    import Loader from '../../Includes/Loader.vue';
    import { mapState, mapActions, mapMutations } from 'vuex';
    import Localbase from 'localbase';
    let db = new Localbase('Product8');
        db.config.debug = false;

  export default{

      components:{

          ControlModal,
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
              


        //search

        	datefrom:'',
        	dateto:'',
        	quantity:'',
        	item_name:'',
        	sellers_price:'',
        	seller_total:'',
        	date:'',

        // search



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
            transaction_code: '',
            transaction_total: 0.00,
            transactionData: {},
            sales: 0.00,
            profit: 0.00,

        //
        // Variables
                
      }


    },



      //watch
      //
      //

        watch:{


          	datefrom(){

            	this.gettabledata();

          	},

        	dateto(){

            	this.gettabledata();

          	},

        	quantity(){

            	this.gettabledata();

          	},

        	item_name(){

            	this.gettabledata();

          	},

        	sellers_price(){

            	this.gettabledata();

          	},

        	seller_total(){

            	this.gettabledata();

          	},

        	date(){

            	this.gettabledata();

          	},



        },

      //
      //
      //watch












      computed:{

      },







      //mounted
      //
      //

            async mounted(){

              //get all data for the table
              this.changeLoaderState(false);

              this.gettabledata();


            },

      //
      //
      //mounted
      





















    methods:{

        ...mapActions('alerts', ['showToast','showErrors','checkUserLogin']),
        ...mapMutations('alerts',['changeLoaderState']),


        async gettabledata(pn){

            this.tablespinner = true;

            	await axios.post('/getSalesReport',{

	            		date_from: this.datefrom,
			        	date_to: this.dateto,
			        	quantity: this.quantity,
			        	item_name: this.item_name,
			        	sellers_price: this.sellers_price,
			        	seller_total: this.seller_total,
			        	date: this.date,

			        	'tablenum':	this.tablenum,
			 			'pn':	pn,
			                
	            })
	            .then((response) => {

	                this.alldata = response.data.alldata;
	                this.transaction_total = response.data.total;
	                this.transactionData = response.data.data;
	                this.sales = response.data.sales;
	                this.profit = response.data.profit;
	                this.tablespinner = false;
	            })
	            .catch((error) => {

	              this.tablespinner = false;
	              this.alldata = '';
	              this.showErrors(error.response.data.errors);

	            });


        },




         


      print() {

      	if (this.datefrom != '' && this.dateto != '') {
         	this.$router.push('/printSales/'+this.datefrom+'/'+this.dateto);
      	} else {
      		this.showToast({
                 type: 'error',
                 message: 'Select Date From and Date To First.',
            });
      	}


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


                if(type == 'edit_order') {

                      this.ControlModal = true;

                      this.datatopass = {

                              'controlheader': 'Edit Quantity',  
                              'controltype': 'edit',  
                              'data_id': data,  

                      };



                } else if(type == 'delete_order'){

                    if (confirm('Are you sure you want to Delete this Order?')) {
                        
                        this.changeLoaderState(true);

                        axios.post('/delete_order',{
                            'id': data,
                        })
                        .then((response) => {

                              this.showToast({
                                      type: 'success',
                                      message: 'Order Deleted.',
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