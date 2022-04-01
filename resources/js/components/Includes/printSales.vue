<template>  

  

  <div>


      <nav style="font-weight: bold;font-family: arial narrow;font-size:20px;">


                <center>
                    
                    <h1 class="title is-3">
                      Product 8 Sales Report
                    </h1>
                    <b>From: {{ date_from }} to {{ date_to }}</b>

                    <br>

                    <b>Total Sales: <b style="font-size:30px;">{{ parseInt(sales).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b> &nbsp;&nbsp;&nbsp; Total Profit: <b style="font-size:30px;">{{ parseInt(profit).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b></b>

                </center>


        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" border="2" style="width:100%;">
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


                <td style="font-size:17px;text-align:center;padding: 0px;">

                   <b>{{ parseInt(list.quantity).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b> <br>
                  
                </td>



                <td style="padding:0px;">

                  &nbsp;<b style="font-size:17px;">{{ list.item_name }}</b>
                  <span style="font-size:10px;">&nbsp;({{ list.discount }}% less)</span>
                  
                </td>




                <td style="font-size:17px;text-align:center;padding: 0px;">

                   <b>₱ {{ parseInt(list.sellers_price).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}/<b style="font-size:13px;">{{ list.unit }}</b></b> <br>
                  
                </td>


                


                <td style="font-size:17px;text-align: right;padding: 0px;padding-right:10px;">

                   <b>₱ {{ parseInt(list.seller_total).toFixed(2).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") }}</b> <br>
                  
                </td>


                <td style="text-align:center;padding:0px;">


                  <b style="font-size:17px;">{{ list.date }}</b>
                  
                
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
              transaction_total: 0.00,
              transactionData: {},
              sales: 0.00,
              profit: 0.00,
              date_from:'',
              date_to:'',
              issued_by:'',

          }

      },







      //mounted
      //
      //

            async mounted(){

                let pn = '';

                this.date_from = this.$route.params.from,
                this.date_to = this.$route.params.to,

                await axios.post('/getSalesReport',{

                      date_from: this.$route.params.from,
                      date_to: this.$route.params.to,
                      'tablenum': 99999,
                      'pn': pn,
                          
                  })
                  .then((response) => {

                      this.alldata = response.data.alldata;
                      this.transaction_total = response.data.total;
                      this.transactionData = response.data.data;
                      this.sales = response.data.sales;
                      this.profit = response.data.profit;
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


                axios.post('/getdataforreceipt',{

                    transaction_code : this.$route.params.code,

                }).then((response)=> 
                {

                  this.list = response.data.transactionData;
                  this.orders = response.data.ordersData;

                  
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




