<template>
    <div>
        <div class="row">
            <div class="col-md-10">
                <h1>All posts</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" v-for="(post, index) in posts">
                <h1>
                    <router-link :to="{ name: 'single-post', params: { id: post.id, post: post }}">{{ post.title }}
                    </router-link>
                </h1>
                <p class="lead"><i class="fa fa-user"></i> by <a href="">Super User</a>
                </p>
                <hr>
                <p><i class="fa fa-calendar"></i> Posted on {{ post.created_at }}</p>
                <p>
                    <i class="fa fa-tags"></i> Tags:
                    <a href="">
                        <span class="badge badge-info">{{ post.category.name }}</span>
                    </a>
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
        created() {
            axios.get(url + 'posts')
                .then(response => {
                    this.posts = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        computed: {}
    }
</script>