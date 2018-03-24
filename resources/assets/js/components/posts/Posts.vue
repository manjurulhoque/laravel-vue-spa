<template>
    <div>
        <div class="row">
            <div class="col-md-10">
                <h1>All posts</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" v-for="(post, index) in posts">
                <h1><a href="">{{ post.title }}</a></h1>
                <p class="lead"><i class="fa fa-user"></i> by <a href="">Super User</a>
                </p>
                <hr>
                <p><i class="fa fa-calendar"></i> Posted on August 24, 2014 at 9:00 PM</p>
                <p><i class="fa fa-tags"></i> Tags: <a href=""><span class="badge badge-info">Bootstrap</span></a>
                    <a
                            href=""><span class="badge badge-info">Web</span></a> <a href=""><span
                            class="badge badge-info">CSS</span></a>
                    <a href=""><span class="badge badge-info">HTML</span></a>
                </p>

                <hr>
                <img src="http://placehold.it/900x300" class="img-responsive">
                <hr>
                <p>{{ post.body }}</p>
                <br/>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    const url = 'http://localhost:8000/api/v1/';
    export default {
        data() {
            return {
                posts: {}
            }
        },
        mounted() {
            axios.get(url + 'posts')
                .then(response => {
                    this.posts = response.data

                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
</script>