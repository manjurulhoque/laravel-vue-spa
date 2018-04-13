import Vue from 'vue'
import Router from 'vue-router'
import Home from '../components/Home.vue'
import SinglePost from '../components/posts/SinglePost.vue'
import CreatePost from '../components/posts/CreatePost.vue'
import Signup from '../components/auth/Signup.vue'
import Signin from '../components/auth/Signin.vue'
import PostsByCategory from '../components/categories/PostsByCategory.vue'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/signup',
            name: 'signup',
            component: Signup
        },
        {
            path: '/signin',
            name: 'signin',
            component: Signin
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
        },
        {
            path: '/categories/show/:id',
            name: 'categories-show',
            props: true,
            component: PostsByCategory
        }
    ],
    // mode: 'history' // it's not working..why?
})