<template>  

  

  <div>


          <section class="container">



            <div class="columns">

              <br><br>
              <div class="column is-3" style="height:90vh;background-image: url(/userimages/background.png);background-repeat: no-repeat;background-size: cover;">
                  <Loader></Loader>
              </div>



              <div class="column is-9" style="padding:0px;">
              <br>
                <div class="box content" style="border: solid gray 2px;box-shadow: 3px 3px 10px #888888;background-color:rgb(240,240,240)">                    
                    <div class="tile is-ancestor">

                      <div class="tile is-parent" style="margin-top: inherit;">
                        <div class="tile is-child box" id="btnHome" @click="changePage('pos')">

                            <p class="title" style="text-align:center;">
                                <img src="userimages/pos.png" style="margin-top:6px;width:250px;">
                              </p>
                              <p class="subtitle has-text-centered">POS</p>                       
                              <br><br>
                        </div>
                      </div>

                      <div class="tile is-8 is-vertical">
                        <div class="tile is-child">
                            
                            <div class="tile is-ancestor" style="padding:0px;">

                              

                              <div class="tile is-parent" style="margin:0px;">
                                <article class="tile is-child box is-centered" id="btnHome" @click="changePage('items')">
                                  <p class="title" style="margin-bottom:10px;text-align:center;">
                                    <img src="userimages/items.png" style="width:160px;">
                                  </p>
                                  <p class="subtitle has-text-centered">Items</p>
                                </article>
                              </div>

                              <div class="tile is-parent" style="margin:0px;">
                                <article class="tile is-child box is-centered" id="btnHome" @click="changePage('stockin')">
                                  <p class="title" style="margin-bottom:10px;text-align:center;">
                                    <img src="userimages/stockin.png" style="width:100px;">
                                  </p>
                                  <p class="subtitle has-text-centered">Stock In</p>
                                </article>
                              </div>

                              <div class="tile is-parent" style="margin:0px;">
                                <article class="tile is-child box is-centered" id="btnHome" @click="changePage('stockout')">
                                  <p class="title" style="margin-bottom:10px;text-align:center;">
                                    <img src="userimages/stockout.png" style="width:100px;">
                                  </p>
                                  <p class="subtitle has-text-centered">Stock Out</p>
                                </article>
                              </div>

                            </div>


                            <div class="tile is-ancestor" style="padding:0px;">


                              <div class="tile is-parent" style="margin:0px;">
                                <article class="tile is-child box is-centered" id="btnHome" @click="changePage('purchaseorder')">
                                  <p class="title" style="margin-bottom:15px;text-align:center;">
                                    <img src="userimages/po.png" style="width:100px;">
                                  </p>
                                  <p class="subtitle has-text-centered" style="font-size:17px;">Purchase Order</p>
                                </article>
                              </div>

                              <div class="tile is-parent">
                                <article class="tile is-child box is-centered" id="btnHome" @click="changePage('salesreport')">
                                  <p class="title" style="margin-bottom:10px;text-align:center;">
                                    <img src="userimages/salesreport.png" style="width:110px;">
                                  </p>
                                  <p class="subtitle has-text-centered">Sales Report</p>
                                </article>
                              </div>

                              <div class="tile is-parent">
                                <article class="tile is-child box is-centered" id="btnHome" @click="changePage('payout')">
                                  <p class="title" style="margin-bottom:13px;text-align:center;">
                                    <img src="userimages/payout.png" style="width:100px;">
                                  </p>
                                  <p class="subtitle has-text-centered">Payout</p>
                                </article>
                              </div>

                            </div>

                        </div>
                    
                      </div>
                      



                    </div>


                    <div class="tile is-ancestor" style="position: relative;left: 94px;width: 80%;">

                      <div class="tile is-parent">
                        <article class="tile is-child box is-centered" id="btnHome" @click="changePage('users')">
                          <p class="title" style="margin-bottom:20px;text-align:center;">
                            <img src="userimages/users.png" style="width:100px;">
                          </p>
                          <p class="subtitle has-text-centered">Users</p>
                        </article>
                      </div>

                      <div class="tile is-parent">
                        <article class="tile is-child box is-centered" id="btnHome" @click="changePage('suppliers')">
                          <p class="title" style="margin-bottom:18px;text-align:center;">
                            <img src="userimages/suppliers.png" style="width:80px;">
                          </p>
                          <p class="subtitle has-text-centered">Suppliers</p>
                        </article>
                      </div>

                

                      <div class="tile is-parent">
                        <article class="tile is-child box is-centered" id="btnHome" @click="changePage('customers')">
                          <p class="title" style="margin-bottom:33px;text-align:center;">
                            <img src="userimages/customers.png" style="width:110px;">
                          </p>
                          <p class="subtitle has-text-centered">Customers</p>
                        </article>
                      </div>

                      <div class="tile is-parent">
                        <article class="tile is-child box is-centered" id="btnHome" @click="changePage('userlogs')" style="padding-top:30px;">
                          <p class="title" style="margin-bottom:33px;text-align:center;">
                            <img src="userimages/userlogs.png" style="width:120px;">
                          </p>
                          <p class="subtitle has-text-centered">Userlogs</p>
                        </article>
                      </div>

                    </div>






                  
                </div>
              </div>
            </div>
          </section>

          


        

  </div>
  

</template>




<script type="text/javascript">
       
    import { mapState, mapActions, mapMutations } from 'vuex';
    import Loader from '../../Includes/ControlPanel.vue';
    import Localbase from 'localbase';
    let db = new Localbase('Product8');
        db.config.debug = false;

  export default {

      components:{
          Loader
      },


      data(){

          return{

      

          }

      },







      //mounted
      //
      //

            async mounted(){

                this.changeLoaderState(false);
              
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


      
      }


    //
    //
    // Methods

  };
  

</script>




<style type="text/css" scoped>

    #btnHome {

        cursor: pointer;
        border:solid black 2px;
        background-color: rgb(192,238,243);

    }

    #btnHome:hover {
      box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 30px 0 rgba(0,0,0,0.19);
    }





    #btnPanel {

        cursor: pointer;
        border:solid white 1px;
        background-color: rgb(192,238,243);

    }

    #btnPanel:hover {
      box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 30px 0 rgba(0,0,0,0.19);
    }

    .subtitle {

        font-weight: bold;
        color:black;
        font-size: 19px;

    }

</style>