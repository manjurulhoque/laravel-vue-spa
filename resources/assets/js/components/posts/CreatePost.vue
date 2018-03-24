<template>
    <div class="create-post">
        <form role="form" @submit.prevent="onSubmit" id="contact-form" class="contact-form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="title" name="title" autocomplete="off"
                               id="Name"
                               placeholder="Title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control textarea" rows="3" v-model="body" name="body" id="Message"
                                  placeholder="Body"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn main-btn">Create Post</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    const url = 'http://localhost:8000/api/v1/';
    import axios from 'axios';
    export default {
        data() {
            return {
                title: '',
                body: ''
            }
        },
        methods: {
            onSubmit() {
                axios.post(url + 'posts', {title: this.title, body: this.body})
                    .then(response => {
                        this.$router.push({name: 'Home'});
                    })
                    .catch((error) => console.log(error))
            },
            clearFields() {
                this.title = '';
                this.body = '';
            }
        }
    }
</script>

<style>
    .contact-form {
        margin-top: 15px;
    }

    .contact-form .textarea {
        min-height: 220px;
        resize: none;
    }

    .form-control {
        box-shadow: none;
        border-color: #eee;
        height: 49px;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #00b09c;
    }

    .main-btn {
        background: #00b09c;
        border-color: #00b09c;
        color: #fff;
    }

    .main-btn:hover {
        background: #00a491;
        color: #fff;
    }
</style>