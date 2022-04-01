<template>
 

    <div>

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

            
          <div class="dropdown is-hoverable is-down">
                    
              <div class="dropdown-trigger">

                <div class="tile is-parent" style="cursor:pointer;">
                  <article class="tile is-child box is-centered" >
                    <p class="title" style="margin-bottom:16px;text-align:center;">
                      <img src="userimages/settings.png" style="width:30px;">
                    </p>
                    <p class="subtitle has-text-centered">Settings</p>
                  </article>
                </div>
              </div>


            <div class="dropdown-menu" id="dropdown-menu" role="menu" style="padding: 0px;">
                  
                  <div class="dropdown-content" style="margin:-20px;width:160px;padding: 0px; margin-top: -10px;margin-left:10px;">
                    
                    <div class="dropdown-item" style="padding:4px;text-align:center;">

                        <a style="width:150px;margin-bottom:5px;" @click="changePage('useraccess')">
                            <i class="bi bi-person" style="font-size:23px;"></i> &nbsp;&nbsp; 
                            <b>USER ACCESS</b>
                        </a>
  
                        <br>

                        <a style="width:150px;" @click="editAccount">
                            <i class="bi bi-person" style="font-size:23px;"></i> &nbsp;&nbsp; 
                            <b>EDIT ACCOUNT</b>
                        </a>

                    </div>
                  </div>
              </div>
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























































    <!-- modal start -->

    <div v-if="editAccountModal" id="modal-ter" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card" style="width:40%;">
          <header class="modal-head" style="background:rgb(0, 53, 170);padding:5px;">

              <b style="color:white;font-size:20px;">Update Account</b>

              <a class="button is-danger is-small" style="float:right;" @click="editAccountModal = false">
                    <i class="bi bi-x" style="font-size:38px;"></i> Close
                </a>

          </header>

            <section class="modal-card-body" style="padding:15px;">
                  <div>

                      <form v-on:submit.prevent="editAccountProccess">


                              <div class="field">
                                <label>Last Name <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.lastname = ''"></a>
                                </label>
                                <div class="control">
                              <input v-model='formdata.lastname' placeholder="Type Here.." class="input" type="text" required>
                                </div>
                              </div>


                              <div class="field">
                                <label>First Name <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.firstname = ''"></a>
                                </label>
                                <div class="control">
                              <input v-model='formdata.firstname' placeholder="Type Here.." class="input" type="text" required>
                                </div>
                              </div>


                              <div class="field">
                                <label>Middle Name <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.middlename = ''"></a>
                                </label>
                                <div class="control">
                              <input v-model='formdata.middlename' placeholder="Type Here.." class="input" type="text" required>
                                </div>
                              </div>


                              <div class="field" style="width:100%;">
                                  <label>Gender <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.gender = ''"></a>
                                  </label>
                                    <div class="control" style="width:100%;">
                                      <div class="select" style="width:100%;">

                                        <select v-model='formdata.gender' style="width:100%;" required>

                                            <option value="">-- Select --</option>
                                            <option value="M">Male</option>
                                          <option value="F">Female</option>

                                        </select>

                                    </div>
                                  </div>
                              </div>


                              <div class="field">
                                <label>Contact Number <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.contact = ''"></a>
                                </label>
                                <div class="control">
                              <input v-model='formdata.contact' placeholder="Type Here.." class="input" type="text" required>
                                </div>
                              </div>


                              <div class="field">
                                <label>Address <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.address = ''"></a>
                                </label>
                                <div class="control">
                              <input v-model='formdata.address' placeholder="Type Here.." class="input" type="text" required>
                                </div>
                              </div>


                              <div class="field">
                                <label>Email Address <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.email = ''"></a>
                                </label>
                                <div class="control">
                              <input v-model='formdata.email' placeholder="Type Here.." class="input" type="email" required>
                                </div>
                              </div>


                              <div class="field">
                                <label>User Name <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.username = ''"></a>
                                </label>
                                <div class="control">
                              <input v-model='formdata.username' placeholder="Type Here.." class="input" type="text" required>
                                </div>
                              </div>  



                              <div class="field">
                                <label>Old Password <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.old_password = ''"></a>
                                </label>
                                <div class="control">
                              <input v-model='formdata.old_password' placeholder="Type Here.." class="input" type="password" minlength="8" required>
                                </div>
                              </div>


                              <div class="field">
                                <label>New Password <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.new_password = ''"></a>
                                </label>
                                <div class="control">
                              <input v-model='formdata.new_password' placeholder="Type Here.." class="input" type="password" minlength="8">
                                </div>
                              </div>



                              <div class="field">
                                <label>Retype New Password <b style="color:red;">*</b>
                                 <a class="delete is-pulled-right" aria-label="close" @click="formdata.retype_new_password = ''"></a>
                                </label>
                                <div class="control">
                              <input v-model='formdata.retype_new_password' placeholder="Type Here.." class="input" type="password" minlength="8">
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


                userData: {},
                editAccountModal: false,

                formdata:{

                    new_password: '',
                    retype_new_password: '',

                },

            }
        },

        components: {
            Loading
        },

        computed:{
            ...mapState('alerts',['LoaderState']),
        },

       async mounted() {

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


              console.log(this.displayNumber(223222.324234723498));
        },

        methods: {

            ...mapActions('alerts', ['showToast','showErrors','checkUserLogin']),
            ...mapActions('items', ['displayNumber']),
            ...mapMutations('alerts',['changeLoaderState']),


            async logout(){
              
                  axios.post('logout').then((response)=> 
                  { 
                      
                      this.$router.push('/');
                        
                  })
                   .catch((error) => {

                      this.changeLoaderState(false);

                      this.showErrors(error.response.data.errors);

                   });

            }, 




            editAccountProccess(){

                if (this.formdata.new_password != '' || this.formdata.retype_new_password != '') {

                    if (this.formdata.new_password === this.formdata.retype_new_password) {

                        axios.post('editAccountProccess', this.$data.formdata).then((response)=> 
                        { 

                            if (response.data == 'bad') {

                                  this.showToast({
                                       type: 'error',
                                       message: 'Error! Old Password is Incorrect.',
                                  });


                            } else {

                                  this.showToast({
                                       type: 'success',
                                       message: 'Data Submitted.',
                                  });   

                                  this.editAccountModal = false;

                            }
    

                        })
                         .catch((error) => {

                            this.changeLoaderState(false);
                            this.showErrors(error.response.data.errors);

                         });  

                    } else {


                        this.showToast({
                               type: 'error',
                               message: 'Error! Password and Retype Password NOT match.',
                         });


                    }

                } else {


                    axios.post('editAccountProccess', this.$data.formdata).then((response)=> 
                    { 

                        if (response.data == 'bad') {

                              this.showToast({
                                   type: 'error',
                                   message: 'Error! Old Password is Incorrect.',
                              });


                        } else {

                              this.showToast({
                                   type: 'success',
                                   message: 'Data Submitted.',
                              });   
                              
                              this.editAccountModal = false;

                        }
                    

                    })
                     .catch((error) => {

                        this.changeLoaderState(false);
                        this.showErrors(error.response.data.errors);

                     });


                }

            },



            async changePage(type) { 

                let access = await axios.post('checkUserAccess',{'access': type})
                                  .then((response)=> {return response.data;})
                                  .catch((error) => {return response.data;});

                if (access == 'bad') {

                          this.showToast({
                               type: 'error',
                               message: 'Sorry! You cannot access this feature.',
                          });

                } else {

                      if(type == 'useraccess') {

                          this.$router.push('/useraccess');

                      }

                  }

                 
            },





            editAccount(){

                  axios.post('/getCurrentUser')
                  .then( async (response) => { 

                      this.formdata = response.data;
                      this.editAccountModal = true;

                  })
                  .catch((error) => {
                      this.changeLoaderState(false);
                      this.showErrors(error.response.data.errors);
                  });


            }



        }



    }

</script>