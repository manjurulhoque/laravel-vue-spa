<template>
    <div class="create-post">
        <form role="form" @submit.prevent="onSubmit" id="contact-form" class="contact-form"
              enctype="multipart/form-data">
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
                        <select class="form-control" name="category_id" v-model="category_id" required>
                            <option v-for="(cat, index) in categories" :value="cat.id">{{ cat.name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" accept="image/*" ref="file" class="form-control" @change="onFileChange">
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
                body: '',
                image: '',
                category_id: 1,
                categories: {}
            }
        },
        created() {
            this.fetchCategories();
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            onSubmit() {
                const token = localStorage.getItem('token');
                axios.post(url + 'posts?token=' + token, {
                    title: this.title,
                    body: this.body,
                    category_id: this.category_id,
                    image: this.image
                })
                    .then(res => {
                        if (!res.data.errors) {
                            this.$router.push({name: 'Home'});
                        }
                    })
                    .catch((error) => console.log(error))
            },
            clearFields() {
                this.title = '';
                this.body = '';
            },
            fetchCategories() {
                axios.get(url + 'categories')
                    .then(res => this.categories = res.data)
                    .catch(err => console.log(err))
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