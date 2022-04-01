<template>  

  <div>


    
        <div class="box content" style="border: solid gray 2px;box-shadow: 3px 3px 10px #888888;background-color:rgb(240,240,240);padding:5px;">                    
            

              <nav class="navbar" style="border-bottom:solid gray 1px;">
                   

                    <div class="navbar-start">

                        <h2>Product 8 POS - <b style="text-transform: capitalize;">{{ usertype }}</b></h2>

                    </div>

                    <div class="navbar-end">
                        <p class="control" @click="close">
                          <a class="button is-danger">
                              <i class="bi bi-x" style="font-size:38px;"></i> Close
                          </a>
                        </p>
                    </div>


              </nav>


              






              <div class="columns">

                <br><br>
                <div class="column is-9">

                    <div class="box content" style="border: solid gray 2px;box-shadow: 3px 3px 10px #888888;background-color:rgb(240,240,240);padding:5px;">                    
                          
                          <MainTable></MainTable>
                        
                      
                    </div>

                </div>



                <div class="column is-3" style="padding-left:0px;">

                    <div class="box" style="border: solid gray 2px;box-shadow: 3px 3px 10px #888888;margin-left:0px;padding:5px;">                    
                        
                        <center>
                            
                            <a class="button" @click="openmodal('search_item')" style="width:100%;height:100px;background-color:rgb(33,89,104);color:white;">
                                <i class="bi bi-plus" style="font-size:60px;"></i> <b> SEARCH ITEM </b>
                            </a>



                            <a class="button is-warning" @click="openmodal('return_item')" style="width:47%;margin-top:10px;">
                                <i class="bi bi-arrow-90deg-left" style="font-size:20px;"></i> &nbsp;&nbsp;<b style="font-size: 13px;"> Return Item </b>
                            </a>

                            &nbsp;

                            <a @click="openmodal('add_customer')" class="button is-info" style="width:47%;margin-top:10px;">
                                <i class="bi bi-person" style="font-size:20px;"></i> &nbsp;&nbsp;<b style="font-size: 13px;"> Add Customer </b>
                            </a>
                            

                            <a @click="openmodal('save_transaction')" class="button is-link" style="width:47%;margin-top:10px;">
                                <i class="bi bi-save" style="font-size:30px;"></i> &nbsp;&nbsp;<b> Save </b>
                            </a>

                            &nbsp;

                            <a @click="openmodal('cancel_transaction')" class="button is-danger" style="width:47%;margin-top:10px;">
                                <i class="bi bi-trash3-fill" style="font-size:30px;"></i> &nbsp;&nbsp;<b> Cancel </b>
                            </a>

                        </center>
                                        
                    </div>




                    <div class="box" style="border: solid gray 2px;box-shadow: 3px 3px 10px #888888;margin-left:0px;margin-top:0px;padding:10px;">                    
                        
                        <center>

                      
                            <a @click="openmodal('all_transactions')" class="button is-primary" style="width:100%;margin-top:5px;margin-bottom:5px;">
                                <i class="bi bi-book" style="font-size:30px;"></i> &nbsp;&nbsp;<b> All Transactions </b>
                            </a>


                            <a @click="openmodal('saved_transactions')" class="button is-link" style="width:100%;margin-top:5px;margin-bottom:5px;">
                                <i class="bi bi-cart" style="font-size:30px;"></i> &nbsp;&nbsp;<b> Saved Transactions </b>
                            </a>

                            
                            <a @click="openmodal('add_payment')" class="button" style="width:100%;height:100px;background-color:rgb(33,89,104);color:white;">
                                <i class="bi bi-credit-card" style="font-size:60px;"></i> &nbsp;&nbsp;<b>  PAYMENT </b>
                            </a>

                        </center>
                                        
                    </div>


                  
                </div>
              </div>
              
        </div>  






    <!-- modal start -->

    <div v-if="selectItem" id="modal-ter" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card" style="width:80%;">
          <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

              <b style="color:white;font-size:20px;">Select Item</b>

              <a class="button is-danger is-small" style="float:right;" @click="selectItem = false">
                    <i class="bi bi-x" style="font-size:38px;"></i> Close
              </a>

          </header>

            <section class="modal-card-body" style="padding:15px;">
                  <div>

                  <selectItem @transactioncomplete='closemodal'>
                  </selectItem>

                  </div>
            </section>

      </div>
    </div>

    <!-- modal end -->
















    <!-- modal start -->

    <div v-if="savedTransactions" id="modal-ter" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card" style="width:80%;">
          <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

              <b style="color:white;font-size:20px;">Saved Transactions</b>

              <a class="button is-danger is-small" style="float:right;" @click="savedTransactions = false">
                    <i class="bi bi-x" style="font-size:38px;"></i> Close
                </a>

          </header>

            <section class="modal-card-body" style="padding:15px;">
                  <div>

                  <savedTransactions @transactioncomplete='closemodal'>
                  </savedTransactions>

                  </div>
            </section>

      </div>
    </div>

    <!-- modal end -->









    <!-- modal start -->

    <div v-if="allTransactions" id="modal-ter" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card" style="width:80%;">
          <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

              <b style="color:white;font-size:20px;">All Transactions</b>

              <a class="button is-danger is-small" style="float:right;" @click="allTransactions = false">
                    <i class="bi bi-x" style="font-size:38px;"></i> Close
                </a>

          </header>

            <section class="modal-card-body" style="padding:15px;">
                  <div>

                  <allTransactions @transactioncomplete='closemodal'>
                  </allTransactions>

                  </div>
            </section>

      </div>
    </div>

    <!-- modal end -->






    <!-- modal start -->

    <div v-if="returnItem" id="modal-ter" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card" style="width:30%;">
          <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

              <b style="color:white;font-size:20px;">Return Item</b>

              <a class="button is-danger is-small" style="float:right;" @click="returnItem = false">
                    <i class="bi bi-x" style="font-size:38px;"></i> Close
                </a>

          </header>

            <section class="modal-card-body" style="padding:15px;">
                  <div>

                      <form v-on:submit.prevent="returnItemProccess">

                          <div class="field">
                            <label>Enter Transaction Code<b style="color:red;">*</b>
                           <a class="delete is-pulled-right" aria-label="close" @click="transaction_code = ''"></a>
                            </label>
                            <div class="control">
                          <input v-model='transaction_code' placeholder="Type Here.." class="input is-large" type="text" required autofocus>
                            </div>
                          </div>

                          <center>
                          <button type="submit" class="button is-link is-large" style="width:80%;">
                                  <b><i class="bi bi-send"></i>&nbsp; Get Transaction</b>
                              </button>
                          </center>

                      </form>

                  </div>
            </section>

      </div>
    </div>

    <!-- modal end -->


    


    <!-- modal start -->

    <div v-if="addCustomer" id="modal-ter" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card" style="width:30%;">
          <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

              <b style="color:white;font-size:20px;">Add Customer</b>

              <a class="button is-danger is-small" style="float:right;" @click="addCustomer = false">
                    <i class="bi bi-x" style="font-size:38px;"></i> Close
                </a>

          </header>

            <section class="modal-card-body" style="padding:15px;">
                <div>

                    <form v-on:submit.prevent="addCustomerProcess">

                        <div class="field">
                          <label>Customer Name <b style="color:red;">*</b>
                           <a class="delete is-pulled-right" aria-label="close" @click="customer.name = ''"></a>
                          </label>
                          <div class="control">
                        <input v-model='customer.name' placeholder="Type Here.." class="input" type="text" required>
                          </div>
                        </div>


                        <div class="field">
                          <label>Address <b style="color:red;">*</b>
                           <a class="delete is-pulled-right" aria-label="close" @click="customer.address = ''"></a>
                          </label>
                          <div class="control">
                        <input v-model='customer.address' placeholder="Type Here.." class="input" type="text" required>
                          </div>
                        </div>


                       <center>
                        <button type="submit" class="button is-link" style="width:80%;">
                            <i class="bi bi-send"></i>&nbsp; Submit Data
                        </button>
                       </center>

                    </form>

                </div>
            </section>

      </div>
    </div>

    <!-- modal end -->











    <!-- modal start -->

    <div v-if="addPayment" id="modal-ter" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card" style="width:30%;">
          <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

              <b style="color:white;font-size:20px;">Add Payment</b>

              <a class="button is-danger is-small" style="float:right;" @click="addPayment = false">
                    <i class="bi bi-x" style="font-size:38px;"></i> Close
                </a>

          </header>

            <section class="modal-card-body" style="padding:15px;">
                <div>

                    <form v-on:submit.prevent="addPaymentProcess">



                        <div class="field" v-if="addDiscount">
                           <a class="button is-danger is-small" @click="removeDiscount">
                              <b>Cancel Discount?</b>
                           </a>
                        </div>


                        <div class="field">
                          <label>Total Cost: &nbsp; 
                          <span style="font-size:35px;font-weight:bold;">₱ {{ parseInt(totalCost).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</span></label>
                        </div>


                        <div class="field">
                          <label>Payment: <b style="color:red;">*</b>
                           <a class="delete is-pulled-right" aria-label="close" @click="payment.pay = ''"></a>
                          </label>
                          <div class="control">
                        <input v-model='payment.pay' id="payment" placeholder="Type Here.." class="input is-large" type="number" step="0.01" required autofocus>
                          </div>
                        </div>



                        <div class="field">
                          <label>Change: &nbsp; 
                          <span style="font-size:35px;font-weight:bold;">₱ {{ parseInt(change).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</span></label>
                        </div>


                       <center>

                        <a @click="applyDiscount" class="button is-link" style="width:100%;margin-top:5px;margin-bottom:5px;">
                            <i class="bi bi-cart" style="font-size:30px;"></i> &nbsp;&nbsp;<b> Apply Discount </b>
                        </a>

                        <button type="submit" class="button" style="margin-top:5px;width:100%;height:100px;background-color:rgb(33,89,104);color:white;">
                             <i class="bi bi-credit-card" style="font-size:60px;"></i> &nbsp;&nbsp;<b style="font-size:25px;">  Pay Order </b>
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
       
    import { mapState, mapActions, mapMutations } from 'vuex';
    import Loader from '../../Includes/ControlPanel.vue';
    import Localbase from 'localbase';
    let db = new Localbase('Product8');
        db.config.debug = false;

    import MainTable from '../../Tables/ItemTables/OrderTable.vue';
    import selectItem from '../../Tables/ItemTables/SelectItemPOS.vue';
    import savedTransactions from '../../Tables/ItemTables/savedTransactions.vue';
    import allTransactions from '../../Tables/ItemTables/allTransactions.vue';

  export default {

      components:{
          Loader,
          MainTable,
          selectItem,
          savedTransactions,
          allTransactions,
      },


      data(){

          return{

            usertype: '',
            selectItem: false,
            returnItem: false,
            savedTransactions: false,
            allTransactions: false,
            addCustomer: false,
            addPayment: false,
            addDiscount: false,

            transaction_code: '',


            customer: {

                name: '',
                address: '',

            },

            payment: {

                pay: '',

            },


            totalCost: 0,
            change: 0,
            discount: 0.00,
            discounted: 0.00,

          }

      },







      //mounted
      //
      //

            async mounted(){

                axios.post('/checkUserLogin')
                .then( async (response) => { 

                    if (response.data != '') {

                          this.usertype = response.data;

                    } else {
                          this.$router.push('/');
                    };

                })
                .catch((error) => {
                    this.changeLoaderState(false);
                    this.showErrors(error.response.data.errors);
                });
                
                this.getTransactionCode();

              
            },

      //
      //
      //mounted
      





      computed:{
        ...mapState('items', ['transactionCode']),
      },




      //watch
      //
      //

            watch:{

                "payment.pay"(){

                    let change = this.payment.pay - parseFloat(this.totalCost);

                    console.log(this.payment.pay);
                    console.log(change);

                    if (change < 0) {

                        this.change = 0;

                    } else {

                        this.change = change;

                    }

                    console.log(this.change);

                },



                async discount(){

                   let total = await axios.post('getTotalCostNumber',{
                      'transaction_code': this.transactionCode
                    })
                    .then( async (response) => 
                    { 

                          return this.totalCost = response.data;
                                            
                    });


                    let discount = await this.discount * parseFloat(total);


                    let totalCost = await parseFloat(total) - discount;

                    if (parseFloat(totalCost) < 0) {

                       this.totalCost = parseFloat(total);

                    } else {

                       this.totalCost = parseFloat(totalCost);

                    }


                    let change = this.payment.pay - parseFloat(this.totalCost);

                    if (change < 0) {

                        this.change = 0;

                    } else {

                        this.change = change;

                    }


                }

            },

      //
      //
      //watch






    // Methods
    // 
    // 
      
      methods:{

        ...mapActions('alerts', ['showToast','showErrors','checkUserLogin']),
        ...mapMutations('alerts',['changeLoaderState']),
        ...mapMutations('items',['changeTransactionCode', 'refreshMutation']),


        applyDiscount(){

            this.discount = 0.05;
            this.addDiscount = true;

        },


        removeDiscount(){

            this.discount = 0.00;
            this.addDiscount = false;

        },

        getTransactionCode(){

            axios.post('getTransactionCode',{
                'testCode': Math.random().toString(36).slice(2),
            }).then((response)=> 
            { 

                this.changeTransactionCode(response.data);
                this.refreshMutation(response.data);

            })
           .catch((error) => {
              this.changeLoaderState(false);
              this.showErrors(error.response.data.errors);
           });

        },





        addCustomerProcess(){

            this.customer.transaction_code = this.transactionCode;

            axios.post('addCustomer',this.$data.customer).then((response)=> 
            { 

                this.showToast({
                  type: 'success',
                  message: 'Customer Added.',
                });

                this.refreshMutation(Math.random().toString(36).slice(2));
                this.addCustomer = false;

                this.customer.name = '';
                this.customer.address = '';

            })
           .catch((error) => {
              this.changeLoaderState(false);
              this.showErrors(error.response.data.errors);
           });

        },


        changePage(page){

            axios.post('checkUserAccess',{

                    'access': page,

            }).then((response)=> 
            { 

                if (response.data == 'good') {
                  this.$router.push('/'+page);
                } else {

                  this.showToast({
                    type: 'error',
                    message: 'Opps! You Cannot Access this feature.',
                  });

                }
                  
            })
           .catch((error) => {

              this.changeLoaderState(false);
              this.showErrors(error.response.data.errors);

           });
              

        },



        returnItemProccess(){

            axios.post('checkTransactionCode',{

                'transaction_code': this.transaction_code,

            }).then((response)=> 
            { 

                if (response.data == 'bad') {
                  
                    this.showToast({
                      type: 'error',
                      message: 'No Transaction Found.',
                    });

                } else {

                    this.showToast({
                      type: 'success',
                      message: 'Transaction Found.',
                    });

                    this.returnItem = false;

                    this.changeTransactionCode(response.data);
                    this.refreshMutation(response.data);
                    this.transaction_code = '';

                }
                  
            })
             .catch((error) => {

                this.changeLoaderState(false);
                this.showErrors(error.response.data.errors);

             });

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

                if(type == 'search_item') {

                    this.selectItem = true;
 
                } else if(type == 'discount'){

                    axios.post('getTotalCost',{
                      'transaction_code': this.transactionCode
                    })
                    .then( async (response)=> 
                    { 

                        if (response.data == 0) {

                            this.showToast({
                                   type: 'error',
                                   message: 'Error! Must have a Order to Pay.',
                             });

                        } else {

                            this.addDiscount = true;
                            this.totalCost = response.data;

                        }
                      
                    })
                     .catch((error) => {

                        this.changeLoaderState(false);
                        this.showErrors(error.response.data.errors);

                     });
                    

                } else if (type == 'return_item') {

                    this.returnItem = true;

                } else if (type == 'save_transaction') {

                    if (confirm('Are you sure you want to save this transaction?')) {


                        axios.post('save_transaction',{
                          'transaction_code': this.transactionCode
                        })
                        .then( async (response)=> 
                        { 

                             this.showToast({
                                   type: 'success',
                                   message: 'Transaction Saved.',
                             }); 

                             this.getTransactionCode();
                          
                        })
                         .catch((error) => {

                            this.changeLoaderState(false);
                            this.showErrors(error.response.data.errors);

                         });


                    }


                } else if (type == 'saved_transactions') {

                    this.savedTransactions = true;

                } else if (type == 'all_transactions') {

                    this.allTransactions = true;

                } else if (type == 'cancel_transaction') {

                    if (confirm('Are you sure you want to CANCEL this Transaction?')) {

                        axios.post('cancel_transaction',{
                          'transaction_code': this.transactionCode
                        })
                        .then( async (response)=> 
                        { 

                             this.showToast({
                                   type: 'success',
                                   message: 'Transaction Deleted.',
                             }); 

                             this.getTransactionCode();
                          
                        })
                       .catch((error) => {

                          this.changeLoaderState(false);
                          this.showErrors(error.response.data.errors);

                       });

                    }


                } else if (type == 'add_customer') {

                   this.addCustomer = true;

                } else if (type == 'add_payment') {

                    axios.post('getTotalCostNumber',{
                      'transaction_code': this.transactionCode
                    })
                    .then( async (response)=> 
                    { 

                        if (response.data == 0) {

                            this.showToast({
                                   type: 'error',
                                   message: 'Error! Must have a Order to Pay.',
                             });

                        } else {

                            this.addPayment = await true;
                            this.totalCost = await response.data;
                            await document.getElementById('payment').focus();

                        }
                      
                    });

                }

            }

        },


        close(){

          this.$router.push('/homepage');

        },



        closemodal(data){

            if (data == 'selectItem') {
              this.selectItem = false;
            } else if (data == 'savedTransactions') {
              this.savedTransactions = false;
              this.allTransactions = false;
            }

        },



        addPaymentProcess(){

            if (this.payment.pay <= 0) {

                 this.showToast({
                       type: 'error',
                       message: 'Error! Invalid Payment.',
                 }); 

            } else if (this.payment.pay < this.totalCost) {

                this.showToast({
                       type: 'error',
                       message: 'Error! Not Enough Payment.',
                 }); 

            } else {

                axios.post('paymentProcess',{
                  'transaction_code': this.transactionCode,
                  'payment': this.payment.pay,
                  'discount': this.discount,
                })
                .then( async (response)=> 
                { 

                    if (response.data == 'good') {

                        this.payment.pay = '';
                        this.discount = 0.00;
                        this.addDiscount = false;

                        this.addPayment = false;

                        if (confirm('Transaction Done! Print Receipt?')) {

                            this.$router.push('/printReciept/'+this.transactionCode);

                        } else {

                          await this.showToast({
                               type: 'success',
                               message: 'Success! Transaction Done.',
                          });

                          this.getTransactionCode(response.data);
                          this.refreshMutation(response.data);

                        }

                       

                    } else {

                        this.showToast({
                               type: 'error',
                               message: 'Error! Invalid Payment.',
                        });

                    }



                  
                })
                 .catch((error) => {

                    this.changeLoaderState(false);
                    this.showErrors(error.response.data.errors);

                 });

            }

        }


      
      }


    //
    //
    // Methods

  };
  

</script>




