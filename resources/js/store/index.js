import { createStore } from 'vuex';

import auth from './auth';
import error from './error';
import message from './message';

const store = createStore({
    modules: {
        auth, 
        error,
        message
    }
})

export default store
