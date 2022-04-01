<template>

	<div>

    <div style="height:100vh;background-image: url(/userimages/background.png);background-repeat: no-repeat;background-position: center;background-size: cover;">

     <br>

          <section class="hero">
              <div class="hero-body">
                  <div class="container has-text-centered">
                      <div class="column is-4 is-offset-4">
                          
                          <div class="box" style="border:solid white;box-shadow: 1px 2px 13px #888888;">

                          

                     <center>
                        <b style="font-size:35px;color:black;"><i class="bi"></i>PRODUCT 8</b>
                     </center>

                      <br>

                      <form v-on:submit.prevent="onSubmit">

                            <div class="field">

                                <div class="control">
                                    <input style="border:solid gray 1px;" v-model='list.username' class="input is-medium" type="text" placeholder="Type your Username" autofocus required>
                                </div>

                            </div>


                            <div class="field">

                                <div class="control">
                                    <input style="border:solid gray 1px;" v-model='list.password' class="input is-medium" type="password" placeholder="Type your Password" required>
                                </div>

                            </div>


                            <button type="submit" class="button is-block is-info is-medium is-fullwidth">
                              Login
                            </button>

                      </form>

                        
                        </div>
                          
                      </div>
                  </div>
              </div>
          </section>
       

    </div>

    


  </div>

</template>


<script>

  import { mapState, mapActions, mapMutations } from 'vuex';
  import Localbase from 'localbase';
  let db = new Localbase('Product8');
      db.config.debug = false;
  
export default {

  components: {
  },

  data(){

    return {

      list:{
        username:'',
        password:'',
      },

    }


  },



  watch:{


  },





  async mounted() {

        axios.post('/checkUserLogin')
        .then( async (response) => { 

            if (response.data != '') {
                if (window.location.pathname == '/') {
                    this.$router.push('/homepage');
                }
            } else {

                  this.$router.push('/');
            };

        })
        .catch((error) => {
            this.changeLoaderState(false);
            this.showErrors(error.response.data.errors);
        });

    
  },





  methods: {

    ...mapActions('alerts', ['showToast','showErrors','checkUserLogin']),
    ...mapMutations('alerts',['changeLoaderState']),


      onSubmit(){

        this.changeLoaderState(true);

        axios.post('loginme',this.$data.list).then( async (response)=> 
        {

            if (response.data == 'nouser') {

                this.showToast({
                    type: 'error',
                    message: 'Error! Invalid Username or Password.',
                });

            } else if (response.data == 'blocked'){

                this.showToast({
                    type: 'error',
                    message: 'Sorry, your account was BLOCKED by the admin.',
                });

            } else {

                this.$router.push('homepage');

            }

            this.changeLoaderState(false);

        })
         .catch((error) => {
            this.changeLoaderState(false);
            this.showErrors(error.response.data.errors);
         });



      },
     
      

  },
  
}
</script>
