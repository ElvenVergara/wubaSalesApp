<template>

  

  <div>
    <Loader></Loader>


    <nav class="navbar is-white" style="padding:0px;margin:0px;">
      <div class="container">

          <div class="navbar-start" style="padding:0px;margin:0px;">

            <div class="navbar-item" style="margin-right: 10px;font-size: 64px;padding: 0px;margin-top: -20px;">
              <b style="color:green;">TOTAL:</b>
            </div>

          </div>
        
          <div class="navbar-end">
            <div class="navbar-item" style="margin-right: 10px;font-size: 64px;padding: 0px;margin-top: -20px;">
              <b>₱ {{ parseInt(transaction_total).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b>
            </div>
          </div>

      </div>
    </nav>




    <div style="border-top:solid rgb(8,50,150) 1px;border-left:solid rgb(8,50,150) 1px;border-right:solid rgb(8,50,150) 2px;border-bottom:solid rgb(8,50,150) 2px;box-shadow: 1px 2px 3px #888888;">
      




        <div style="border:solid rgb(8,50,150) 1px;">

          <table class="table" style="width:100%;">
            
            <tr>

            <th style="padding-top:5px;">
              
                <b style="font-size:15px;color:gray;">Transaction Code: <b style="font-size:25px;color:black;">
                  &nbsp;&nbsp;{{ transactionCode }}</b></b>

            </th>


            <th></th>


            <th style="padding-top:5px;text-align: right;">
              
                <b style="font-size:15px;color:gray;">Customer Name/Number: <b style="font-size:25px;color:black;">
                  &nbsp;&nbsp; {{ transactionData.customer_name_number }}</b></b>

            </th>

            </tr> 


          </table>

          
        </div>


                      
  
    

    <nav class="panel column is-12" style="overflow-x: auto;padding:0px;">



      <div style="width:100%;overflow-y:auto;">


          <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" border="2" style="width:100%;">

              <tr>

                <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:18%;">
                  Action
                </th>


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


                <td style="text-align:center;padding:5px;">


                  <span v-if="lockedStatus == 'unlocked'">

                    <a @click="openmodal('edit_order',list.id)" class="button is-small is-link" style="width:49%;">
                        <i class="bi bi-pencil-square" style="font-size:25px;"></i> &nbsp;Edit
                    </a> 

                    <a @click="openmodal('delete_order', list.id)" class="button is-small is-danger" style="width:49%;margin-left:2%;">
                        <i class="bi bi-trash3-fill" style="font-size:25px;"></i> &nbsp;Delete
                    </a>

                  </span>


                  <span v-else>
                      
                      <a class="button is-small is-danger" style="width:80%;">
                        <i class="bi bi-lock" style="font-size:25px;"></i> &nbsp;<b>Locked</b>
                      </a> 

                  </span>
                  
                
                </td>


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

              </tr>

            </tbody>


          </table>


    </div>

                                      
    </nav>


  </div>

















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

        //
        // Variables
                
      }


    },



      //watch
      //
      //

        watch:{

          refreshTable(){

            this.gettabledata();

          },


          transactionCode(){

            this.gettabledata();

          },


        },

      //
      //
      //watch












      computed:{
        ...mapState('items', ['transactionCode','refreshTable','lockedStatus']),
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
        ...mapMutations('items',['changeTransactionCode']),



        async gettabledata(){

            this.tablespinner = true;

            await axios.post('/getOrders',{

              'transaction_code': this.transactionCode,
                
            })
            .then((response) => {

                this.alldata = response.data.alldata;
                this.transaction_total = response.data.total;
                this.transactionData = response.data.data;
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