<template>
 

    <div>

        <div class="vld-parent">
            <loading :active="LoaderState"
                     :can-cancel="true"
                     :on-cancel="onCancel"
                     :loader="loader"
                     :color="color"
                     :backgroundColor="backgroundColor"
                     :opacity="opacity"
                     :width="width"
                     :is-full-page="fullPage"/>
        </div>


        <br>
          <h1 class="title is-2" style="color:white;border-bottom: solid white 3px;font-family:arial;">PRODUCT <b style="color: red;text-shadow: 1px 0px 2px white;">8</b></h1>


          <div class="tile is-parent" style="margin:0px;padding:0px;">
            <article class="tile is-child is-centered">
              <p class="title" style="margin-bottom:16px;text-align:center;">
                <img src="userimages/users.png" style="width:100px;">
              </p>
              <p class="subtitle has-text-centered" style="color:white;font-size:25px;">
                Welcome {{ usertype }}!
              </p>
            </article>
          </div>

          

          <br><br>

          <div class="tile is-ancestor">

            <div class="tile is-parent" style="cursor:pointer;">
              <article class="tile is-child box is-centered" @click="changePage('settings')">
                <p class="title" style="margin-bottom:16px;text-align:center;">
                  <img src="userimages/settings.png" style="width:30px;">
                </p>
                <p class="subtitle has-text-centered">Settings</p>
              </article>
            </div>

            <div class="tile is-parent" style="cursor:pointer;">
              <article class="tile is-child box is-centered" @click="logout" style="background-color:red;" id="btnPanel">
                <p class="title" style="margin-bottom:18px;text-align:center;">
                  <img src="userimages/logout.png" style="width:30px;">
                </p>
                <p class="subtitle has-text-centered" style="color:white;">Log-out</p>
              </article>
            </div>

          </div>

          

    </div>





</template>

<script>

    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    import { mapState, mapActions, mapMutations } from 'vuex';
    import { useRoute } from 'vue-router';

    export default {
        data() {   
            return {
                fullPage: true,
                loader: 'dots',
                color: 'white',
                backgroundColor: 'black',
                opacity: 0.7,
                width: 100,
                usertype: '',
            }
        },

        components: {
            Loading
        },

        computed:{
            ...mapState('alerts',['LoaderState']),
        },

        mounted() {

              axios.post('/checkUserLogin')
              .then( async (response) => { 

                  if (response.data != '') {

                        this.usertype = response.data;

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


            logout(){

                  axios.post('logout').then((response)=> 
                  { 

                      this.$router.push('/');
                        
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




        }



    }

</script>