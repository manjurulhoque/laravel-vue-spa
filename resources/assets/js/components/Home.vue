<template>
    <div>
        <navbar></navbar>
        <div class="container">
            <Posts></Posts>
        </div>
    </div>
</template>

<script>
    import Posts from './posts/Posts.vue'
    export default {
        components: {Posts}
    }
</script>