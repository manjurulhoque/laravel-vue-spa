<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" @submit.prevent="onSubmit">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" v-model="name" name="name"
                                       required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" v-model="email" class="form-control" name="email"
                                       required>
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
                                <button type="submit" class="btn btn-primary">
                                    Register
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
                name: '',
                email: '',
                password: '',
            }
        },
        methods: {
            onSubmit() {
                axios.post(url + 'signup', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                }, {
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                })
                    .then(res => {
                        console.log(res);
                        if (!res.data.errors) {
                            this.$router.push({name: 'signin'});
                        }
                    })
                    .catch((error) => console.log(error))
            }
        }
    }
</script>