<template>  

  

  <div>


          <section class="container">



            <div class="columns">

              <br><br>
              <div class="column is-3" style="height:90vh;background-image: url(/userimages/background.png);background-repeat: no-repeat;background-size: cover;">
                  <Loader></Loader>
              </div>



              <div class="column is-9" style="padding:5px;">
              <br>
                <div class="box content" style="border: solid gray 2px;box-shadow: 3px 3px 10px #888888;background-color:rgb(240,240,240);padding:5px;">                    
                    

                      <nav class="navbar is-white topNav">
                        <div class="container">
                          <div class="navbar-brand">
                            <a class="navbar-item" href="../">
                            </a>
                            <div class="navbar-burger burger" data-target="topNav">
                              <span></span>
                              <span></span>
                              <span></span>
                            </div>
                          </div>
                          <div id="topNav" class="navbar-menu">

                            <div class="navbar-start">

                                <h2 class="title">Suppliers Table</h2>

                            </div>

                            <div class="navbar-end">
                              <div class="navbar-item">
                                <div class="field is-grouped">
                                  <p class="control" @click="close">
                                    <a class="button is-danger">
                                        <i class="bi bi-x" style="font-size:38px;"></i> Close
                                    </a>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </nav>



                      <MainTable></MainTable>
                      


                      <footer class="footer">
                        <div class="container">
                          <div class="content has-text-centered">
                            <div class="columns is-mobile is-centered">
                              <div class="field is-grouped is-grouped-multiline">
                                <div class="control">
                                  <div class="tags has-addons">
                                    <a class="tag is-link" href="https://github.com/BulmaTemplates/bulma-templates">Developed by</a>
                                    <span class="tag is-light">ElvenVergara</span>
                                  </div>
                                </div>
                                <div class="control">
                                  <div class="tags has-addons">
                                    <a class="tag is-link">Product 8</a>
                                    <span class="tag is-light">2022</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </footer>
                  
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

    import MainTable from '../../Tables/UserTables/supplierstable.vue';

  export default {

      components:{
          Loader,
          MainTable,
      },


      data(){

          return{

      

          }

      },







      //mounted
      //
      //

            async mounted(){

            
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


        close(){

          this.$router.push('/homepage');

        }


      
      }


    //
    //
    // Methods

  };
  

</script>




