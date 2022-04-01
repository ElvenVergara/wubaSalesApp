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

              
        },

        methods: {
  


        }



    }

</script>