<template>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Lara-vue-blog</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active">
                    <router-link to="/">Home</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'create-post' }">Create Post</router-link>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li v-if="!hasToken">
                    <router-link to="/signup">Signup</router-link>
                </li>
                <li v-if="!hasToken">
                    <router-link to="/signin">Signin</router-link>
                </li>
                <li class="dropdown" v-if="hasToken">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ user.name }}
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Page 1-1</a></li>
                        <li><a href="#">Page 1-2</a></li>
                        <li><a @click="logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                user: '',
                token: '',
                hasToken: false,
                hasUser: false
            }
        },
        created() {
            this.fetchUser();
            this.fetchToken();
        },
        methods: {
            logout(){
                localStorage.removeItem('token');
                this.$router.push({name: 'signin'});
            },
            fetchUser() {
                const u = localStorage.getItem('user');
                if (u) {
                    this.user = JSON.parse(u);
                    this.hasUser = true;
                } else {
                    this.user = '';
                }
            },
            fetchToken() {
                const token = localStorage.getItem('token');
                if (token) {
                    this.token = token;
                    this.hasToken = true;
                }
                else {
                    this.token = '';
                }
            }
        }
    }
</script>