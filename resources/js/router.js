import { createRouter, createWebHistory } from 'vue-router';

import PhotoList from './pages/PhotoList.vue';
import PhotoDetail from './pages/PhotoDetail.vue';
import Login from './pages/Login.vue';
import SystemError from './pages/errors/System.vue';
import NotFound from './pages/errors/NotFound.vue';

import store from './store';

const routes = [
    { path: '/', component: PhotoList, 
      props: route => {
        const page = route.query.page
        return { page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1 }
      } 
    },
    { path: '/photos/:id', component: PhotoDetail, 
      props: true},
    { path: '/login', component: Login,
      beforeEnter (to, from, next) {
        if (store.getters['auth/check']) {
            next('/')
        } else {
            next()
        }
      } 
    }, 
    { path: '/500', component: SystemError },
    { path: '/:catchAll(.*)', component: NotFound },
]

const router = createRouter({
    history: createWebHistory(),
    scrollBehavior() {
      return { x: 0, y: 0 }
    },
    routes,
});

export default router