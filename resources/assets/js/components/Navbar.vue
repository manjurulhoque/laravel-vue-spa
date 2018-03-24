<template>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Lara-vue-blog</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active">
                    <router-link to="/">Home</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'create-post' }">Create Post</router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>