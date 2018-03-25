<template>
    <div class="single-post">
        <h1>
            {{ post.title }}
        </h1>
        <p class="lead"><i class="fa fa-user"></i> by <a href="">Super User</a>
        </p>
        <hr>
        <p><i class="fa fa-calendar"></i> Posted on August 24, 2014 at 9:00 PM</p>
        <p><i class="fa fa-tags"></i> Tags: <a href=""><span class="badge badge-info">Bootstrap</span></a>
            <a href="">
                <span class="badge badge-info">Web</span>
            </a>
            <a href="">
                <span class="badge badge-info">CSS</span>
            </a>
            <a href="">
                <span class="badge badge-info">HTML</span>
            </a>
        </p>

        <hr>
        <img :src="post.image" class="img-responsive">
        <hr>
        <p>{{ post.body }}</p>
        <br/>
        <create-comment></create-comment>
    </div>
</template>

<script>
    import CreateComment from '../comments/CreateComment.vue';
    export default {
        data() {
            return {
                post: {}
            }
        },
        created() {
            if (this.$route.params.post === undefined) {
                this.$router.push({name: '/'});
            }
            this.post = this.$route.params.post;
        },
        components: {
            CreateComment
        }
    }
</script>