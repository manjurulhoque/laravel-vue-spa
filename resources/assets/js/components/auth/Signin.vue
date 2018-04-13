<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" @submit.prevent="onSubmit">

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" v-model="email" class="form-control" name="email"
                                       required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" v-model="password" class="form-control"
                                       name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" v-model="remember" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const url = 'http://localhost:8000/api/v1/';
    import axios from 'axios';

    export default {
        data() {
            return {
                email: '',
                password: '',
                remember: ''
            }
        },
        methods: {
            onSubmit() {
                axios.post(url + 'signin', {
                    email: this.email,
                    password: this.password,
                    remember: this.remember
                }, {
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                })
                    .then(res => {
                        const token = res.data.token;
                        console.log(res.data.user);
                        const base64Url = token.split('.')[1];
                        const base64 = base64Url.replace('-', '+').replace('_', '/');
                        localStorage.setItem('token', token);
                        localStorage.setItem('user', JSON.stringify(res.data.user));
                        if (!res.data.errors) {
                            this.$router.push({name: 'Home'});
                        }
                    })
                    .catch((error) => console.log(error))
            }
        }
    }
</script>