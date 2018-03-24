import Vue from 'vue'
import Router from 'vue-router'
import Home from '../components/Home.vue'
import SinglePost from '../components/posts/SinglePost.vue'
import CreatePost from '../components/posts/CreatePost.vue'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/posts/create',
            name: 'create-post',
            component: CreatePost
        },
        {
            path: '/posts/:id',
            name: 'single-post',
            props: true,
            component: SinglePost
        }
    ],
    // mode: 'history' // it's not working..why?
})