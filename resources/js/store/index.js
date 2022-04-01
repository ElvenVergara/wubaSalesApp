import { createStore, createLogger } from 'vuex'

import alerts from './alerts';
import items from './items';

export default createStore({
   modules: {

       alerts,
       items,
        
   },
});


