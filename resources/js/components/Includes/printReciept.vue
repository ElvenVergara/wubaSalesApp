<template>  

  

  <div>


         <nav class="panel" style="font-weight: bold;font-family: arial narrow;font-size:20px;">


                 <div style="color:black;padding:5px;text-align:center;font-size:20px;">


                 <p style="border-bottom:solid black 1px;padding:3px;">PRODUCT 8 </p>
                 <p style="border-bottom:solid black 1px;padding:3px;">Statement of Account</p>


                 <p style="padding:3px;">* * * * TRANSACTION CODE:  &nbsp; {{ list.transaction_code }} * * * * </p>
                 <p style="padding:3px;text-align:center;">Sold To: {{ list.customer_name_number }}</p>


                 <table style="width:100%;">

                       <tr>
                           <td style="width:50%;">

                                <p style="padding:2px;text-align:left;">{{ list.date }}</p>

                           </td>

                           <td style="width:50%;">

                               <p style="text-align:right;padding:3px;">BILL #: {{ list.id }}</p>

                           </td>

                       </tr>

                 </table>


                 <table style="width:100%;font-size:20px;font-weight: bold;font-family: arial narrow;">
                       
                     <tr v-for="order in orders" style="padding-top:5px;">

                           <td style="text-transform:capitalize;width:30%;">
                               <span>{{ order.quantity }}<br></span>
                           </td>

                           <td style="text-transform:capitalize;padding-left:3px;width:40%;">
                               <span>{{ order.item_name }}<br></span>
                           </td>

                           <td style="text-align:center;text-align:right;width:30%;">
                               <span> {{ order.sellers_price }} <br></span>
                           </td>      

                     </tr>

                 </table>






                 <table style="width:100%;margin-bottom: 10px;border-top:solid black 1px;font-family: arial narrow;">
                       
                     <tr>
                       
                           <td style="text-align:center;width:8%;">Paid:</td>
                           <td style="width:50%;"> {{ parseInt(list.total_payment).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</td>
                           <td style="text-align:center;width:8%;">Total</td>
                           <td style="text-align:right;width:20%;font-size:25px;"> {{ list.total_amount }}</td>
           
                     </tr>


                     <tr>
                       
                           <td style="text-align:center;width:8%;"></td>
                           <td style="width:50%;"></td>
                           <td style="text-align:center;width:8%;">Change:</td>
                           <td style="text-align:right;width:20%;"> {{ parseInt(list.total_change).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</td>

                     </tr>

                 </table>





                 <table style="width:100%;margin-bottom: 10px;font-family: arial narrow;">
                       
                     <tr>
                       
                           <td style="text-align:center;width:50%;color:transparent;"></td>
                           <td style="text-align:center;text-transform:capitalize;width:50%;">{{ list.issued_by }}</td>
           
                     </tr>


                     <tr>
                       
                           <td style="text-align:center;width:50%;"></td>
                           <td style="text-align:center;width:50%;text-align:center;border-top:solid black 1px;">Cashier</td>

                     </tr>

                 </table>




                 <p style="text-align:center;font-weight:bold;font-size:20px;">

                   "THIS DOCUMENT IS NOT VALID FOR CLAIM OF INPUT TAX"

                 </p>



             


             </div>



                      
                  
               </nav>

          


        

  </div>
  

</template>




<script type="text/javascript">
       
    import { mapState, mapActions, mapMutations } from 'vuex';

  export default {

      components:{

      },


      data(){

          return{

              list: {},
              orders: {},

          }

      },







      //mounted
      //
      //

            async mounted(){

                axios.post('/getdataforreceipt',{

                    transaction_code : this.$route.params.code,

                }).then((response)=> 
                {

                  this.list = response.data.transactionData;
                  this.orders = response.data.ordersData;

                      setTimeout(() => {
                        window.print();

                            window.history.back();

                      }, 2000);

                })
                  .catch((error) => this.errors = error.response.data.errors);
            
            },

      //
      //
      //mounted
      










      //watch
      //
      //

            watch:{


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
      
      }


    //
    //
    // Methods

  };
  

</script>




