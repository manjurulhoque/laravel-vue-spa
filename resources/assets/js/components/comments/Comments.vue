<template>
    <div>
        <div class="comments-container">
            <h1>Comments ({{ comments.length }}) </h1>
            <ul id="comments-list" class="comments-list">
                <li v-for="(comment, index) in comments" :key="index">
                    <div class="comment-main-level">
                        <div class="comment-avatar">
                            <img src="https://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt="">
                        </div>
                        <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name by-author">
                                    <a href="http://creaticode.com/blog">{{ comment.name }}</a>
                                </h6>
                                <span>{{ comment.created_at }}</span>
                                <i class="fa fa-reply"></i>
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="comment-content">{{ comment.comment }}</div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-7">
                <form @submit.prevent="onSubmit">
                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               v-model="name"
                               name="name"
                               autocomplete="off"
                               id="name"
                               placeholder="name">
                    </div>
                    <div class="form-group">
                        <input type="email"
                               class="form-control"
                               v-model="email"
                               name="email"
                               autocomplete="off"
                               id="email"
                               placeholder="email">
                    </div>
                    <div class="form-group">
                        <textarea
                                class="form-control textarea"
                                rows="3"
                                v-model="comment"
                                name="comment"
                                id="comment"
                                placeholder="comment">
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Create comment
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    const url = 'http://localhost:8000/api/v1/';
    import axios from 'axios';

    export default {
        props: ['id'],
        data() {
            return {
                comments: '',
                comment: '',
                name: '',
                email: ''
            }
        },
        created() {
            this.fetchComments();
        },
        methods: {
            onSubmit() {
                axios.post(url + `comments/${this.id}`, {name: this.name, email: this.email, comment: this.comment})
                    .then(res => {
                        this.$router.push(
                            {
                                name: 'single-post',
                                params: {id: this.id},
                            });
                        this.name = '';
                        this.email = '';
                        this.comment = '';
                        this.fetchComments();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            fetchComments() {
                axios.get(url + `comments/${this.id}`)
                    .then(response => {
                        this.comments = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
</script>

<style scoped>
    * {
        margin: 0;
        padding: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    a {
        color: #03658c;
        text-decoration: none;
    }

    ul {
        list-style-type: none;
    }

    .comments-container {
        width: 768px;
    }

    .comments-container h1 {
        font-size: 36px;
        color: #283035;
        font-weight: 400;
    }

    .comments-container h1 a {
        font-size: 18px;
        font-weight: 700;
    }

    .comments-list {
        margin-top: 30px;
        position: relative;
    }

    /**
     * Lineas / Detalles
     -----------------------*/
    .comments-list:before {
        content: '';
        width: 2px;
        height: 100%;
        background: #c7cacb;
        position: absolute;
        left: 32px;
        top: 0;
    }

    .comments-list:after {
        content: '';
        position: absolute;
        background: #c7cacb;
        bottom: 0;
        left: 27px;
        width: 7px;
        height: 7px;
        border: 3px solid #dee1e3;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
    }

    .reply-list:before, .reply-list:after {
        display: none;
    }

    .reply-list li:before {
        content: '';
        width: 60px;
        height: 2px;
        background: #c7cacb;
        position: absolute;
        top: 25px;
        left: -55px;
    }

    .comments-list li {
        margin-bottom: 15px;
        display: block;
        position: relative;
    }

    .comments-list li:after {
        content: '';
        display: block;
        clear: both;
        height: 0;
        width: 0;
    }

    .reply-list {
        padding-left: 88px;
        clear: both;
        margin-top: 15px;
    }

    /**
     * Avatar
     ---------------------------*/
    .comments-list .comment-avatar {
        width: 65px;
        height: 65px;
        position: relative;
        z-index: 99;
        float: left;
        border: 3px solid #FFF;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .comments-list .comment-avatar img {
        width: 100%;
        height: 100%;
    }

    .reply-list .comment-avatar {
        width: 50px;
        height: 50px;
    }

    .comment-main-level:after {
        content: '';
        width: 0;
        height: 0;
        display: block;
        clear: both;
    }

    /**
     * Caja del Comentario
     ---------------------------*/
    .comments-list .comment-box {
        width: 680px;
        float: right;
        position: relative;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15);
        -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15);
    }

    .comments-list .comment-box:before, .comments-list .comment-box:after {
        content: '';
        height: 0;
        width: 0;
        position: absolute;
        display: block;
        border-width: 10px 12px 10px 0;
        border-style: solid;
        border-color: transparent #FCFCFC;
        top: 8px;
        left: -11px;
    }

    .comments-list .comment-box:before {
        border-width: 11px 13px 11px 0;
        border-color: transparent rgba(0, 0, 0, 0.05);
        left: -12px;
    }

    .reply-list .comment-box {
        width: 610px;
    }

    .comment-box .comment-head {
        background: #FCFCFC;
        padding: 10px 12px;
        border-bottom: 1px solid #E5E5E5;
        overflow: hidden;
        -webkit-border-radius: 4px 4px 0 0;
        -moz-border-radius: 4px 4px 0 0;
        border-radius: 4px 4px 0 0;
    }

    .comment-box .comment-head i {
        float: right;
        margin-left: 14px;
        position: relative;
        top: 2px;
        color: #A6A6A6;
        cursor: pointer;
        -webkit-transition: color 0.3s ease;
        -o-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }

    .comment-box .comment-head i:hover {
        color: #03658c;
    }

    .comment-box .comment-name {
        color: #283035;
        font-size: 14px;
        font-weight: 700;
        float: left;
        margin-right: 10px;
    }

    .comment-box .comment-name a {
        color: #283035;
    }

    .comment-box .comment-head span {
        float: left;
        color: #999;
        font-size: 13px;
        position: relative;
        top: 1px;
    }

    .comment-box .comment-content {
        background: #FFF;
        padding: 12px;
        font-size: 15px;
        color: #595959;
        -webkit-border-radius: 0 0 4px 4px;
        -moz-border-radius: 0 0 4px 4px;
        border-radius: 0 0 4px 4px;
    }

    .comment-box .comment-name.by-author, .comment-box .comment-name.by-author a {
        color: #03658c;
    }

    /** =====================
     * Responsive
     ========================*/
    @media only screen and (max-width: 766px) {
        .comments-container {
            width: 480px;
        }

        .comments-list .comment-box {
            width: 390px;
        }

        .reply-list .comment-box {
            width: 320px;
        }
    }
</style>