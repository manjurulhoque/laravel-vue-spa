<template>
    <div>
        <div class="row">
            <div class="col-md-10">
                <h1>All posts related to {{ category.name }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" v-for="(post, index) in posts">
                <h1>
                    <router-link :to="{ name: 'single-post', params: { id: post.id, post: post }}">
                        {{ post.title }}
                    </router-link>
                </h1>
                <p class="lead"><i class="fa fa-user"></i> by <a href="">Super User</a>
                </p>
                <hr>
                <p><i class="fa fa-calendar"></i> Posted on {{ post.created_at }}</p>

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
    const url = 'http://localhost:8000/api/v1/';
    export default {
        data() {
            return {
                posts: {},
                category: {}
            }
        },
        created() {
            axios.get(url + `categories/${this.$route.params.id}`)
                .then(res => {
                    this.posts = res.data.posts;
                    this.category = res.data.category;
                })
                .catch(err => console.log(err));
        },
    }
</script>