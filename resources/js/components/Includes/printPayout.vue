<template>  

  

  <div>


      <nav style="font-weight: bold;font-family: arial narrow;font-size:20px;">


                <center>
                    
                    <h1 class="title is-4">
                      Product 8 Payout Report
                    </h1>
                    <b>From: <b style="color:red;font-size:20px;">{{ date_from }}</b> to <b style="color:red;font-size:20px;">{{ date_to }}</b> </b>

                    <br>

                    <b>Supplier: <b style="font-size:20px;">{{ supplier }}</b> &nbsp;&nbsp;&nbsp;</b>
                    <b>Total Sales: <b style="font-size:20px;">{{ parseInt(total_sales).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b> </b>

                </center>


          
          <div v-if="supplier_id != '0'" v-for="data in alldata" style="padding:10px;">
              
              <h1 class="title is-5" style="margin: 0px;">
                  {{ data.title }}
              </h1>

              <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" border="2" style="width:100%;margin:0px;">


                   <tr>

                     <th style="font-size:15px;background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:8%;">
                       Qty
                     </th>



                     <th style="font-size:15px;background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:40%;">
                       Item Name
                     </th>



                     <th style="font-size:15px;background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:15%;">
                       Price
                     </th>


                     
                     <th style="font-size:15px;background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:15%;">
                       TOTAL
                     </th>


                     <th style="font-size:15px;background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:18%;">
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


                   <td v-else-if="data.orders == ''" colspan='11'>

                     <center>
                       <h1>No Data Found</h1>
                     </center>

                   </td>


           <tbody v-else>
                 <tr v-for="list,key in data.orders">


                     <td style="font-size:15px;text-align:center;padding: 0px;">

                        <b>{{ parseInt(displaylist.quantity).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b> <br>
                       
                     </td>



                     <td style="padding-left:5px;padding: 0px;">

                       <b style="font-size:15px;">{{ list.item_name }}</b>
                       <span style="font-size:12px;">&nbsp;({{ list.discount }}% less)</span>
                       
                     </td>




                     <td style="font-size:15px;text-align:center;padding: 0px;">

                        <b>₱ {{ parseInt(list.sellers_price).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")}}/<b style="font-size:13px;">{{ list.unit }}</b></b> <br>
                       
                     </td>


                     


                     <td style="font-size:15px;text-align: right;padding: 0px;padding-right:0px;">

                        <b>₱ {{ parseInt(list.seller_total).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b> <br>
                       
                     </td>


                     <td style="text-align:center;padding:0px;">


                       <b style="font-size:15px;">{{ list.date }}</b>
                       
                     
                     </td>


                   </tr>

                 </tbody>


               </table>


               <h1 class="title is-4" style="text-align:right;padding:0px;margin:0px;">
                  <span style="font-size:13px;color:red;">Total Sales:</span> ₱ {{ parseInt(data.sum).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}
              </h1>


          </div>



          <table v-else class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" border="2" style="width:100%;margin:0px;">


                     <tr>

                       <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:40%;">
                         Supplier
                       </th>



                       <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:15%;">
                         Date From
                       </th>



                       <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:15%;">
                         Date To
                       </th>


                       
                       <th style="background: rgb(8,50,150);font-family:Calibri;font-weight: normal;color:white;padding:0px;text-align:center;width:15%;">
                         Total Sales
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


                       <td style="font-size:16px;text-align:center;padding: 0px;">

                          <b>{{ list.supplier }}</b>
                         
                       </td>


                       <td style="padding-left:5px;padding: 4px;text-align:center;">

                         <b style="font-size:16px;">{{ list.from }}</b>
                         
                       </td>


                       <td style="padding-left:5px;padding: 4px;text-align:center;">

                         <b style="font-size:16px;">{{ list.to }}</b>
                         
                       </td>


                       <td style="padding-right:5px;padding: 4px;text-align:right;">

                         <b style="font-size:16px;">₱ {{ parseInt(list.sum).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b>
                         
                       </td>

                     </tr>

                   </tbody>


            </table>



          <div style="padding:0;margin:0px;text-align: right;">
               <b class="title is-4">Issued By: {{ issued_by }}</b>
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

              alldata: {},
              total_sales: 0.00,
              date_from:'',
              date_to:'',
              supplier_id:'',
              issued_by:'',
              supplier:'',

          }

      },







      //mounted
      //
      //

            async mounted(){

                this.date_from = this.$route.params.from;
                this.date_to = this.$route.params.to;
                this.supplier_id = this.$route.params.id;

                await axios.post('/getPayoutReport',{

                      supplier: this.supplier_id,
                      date_from: this.date_from,
                      date_to: this.date_to,
                          
                  })
                  .then((response) => {

                      this.alldata = response.data.alldata;
                      this.total_sales = response.data.total_sales;
                      this.supplier = response.data.supplier;
                      this.tablespinner = false;
                      this.issued_by = response.data.issued_by;

                      setTimeout(() => {
                        window.print();

                        window.history.back();

                      }, 3000);

                  })
                  .catch((error) => {

                    this.tablespinner = false;
                    this.alldata = '';
                    this.showErrors(error.response.data.errors);

                  });

            
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
        ...mapActions('items', ['displayNumber']),
        ...mapMutations('alerts',['changeLoaderState']),

      }


    //
    //
    // Methods

  };
  

</script>




