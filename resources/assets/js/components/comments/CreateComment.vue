<template>
    <div class="row">

        <div class="col-md-7">
            <form @submit.prevent="onSubmit">
                <div class="form-group">
                    <input type="text" class="form-control" v-model="name" name="name" autocomplete="off"
                           id="name"
                           placeholder="name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" v-model="email" name="email" autocomplete="off"
                           id="email"
                           placeholder="email">
                </div>
                <div class="form-group">
                        <textarea class="form-control textarea" rows="3" v-model="comment" name="comment" id="comment"
                                  placeholder="comment"></textarea>
                </div>
                <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Create comment</button>
            </form>
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
                comment: '',
                name: '',
                email: ''
            }
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
                        this.$parent.$options.methods.fetchComments(this.id);
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        }
    }
</script>