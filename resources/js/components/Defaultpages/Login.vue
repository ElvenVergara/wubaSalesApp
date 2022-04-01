
<template>

		<router-link to="/">Home</router-link>
	    <router-link to="/page">Page</router-link>
        <button class="fa fa-book btn btn-primary" @click="increment">count is: {{ count }}</button>

</template>


<script>

import { mapState, mapActions } from 'vuex';

export default {

  data(){

    return {

      pagespinner:true,

      list:{
        username:'',
        password:'',
      },

      errors:{

      },

      loginBanner: false,
      buttonspinner: false,
      bannerMessage:'',

    }


  },


  computed:{
    ...mapState('test', ['timestamp']),
  },

  mounted() {

    this.showAlert();

  },

  methods: {

    ...mapActions('test', ['showAlert']),

    increment() {
      this.count++;
    }
  },
  
}
</script>

