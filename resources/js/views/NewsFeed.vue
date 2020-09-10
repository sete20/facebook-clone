<template>
    <div class="flex flex-col items-center py-4">
        <NewPost />
        <p class="loading" style="
        text-align: center;
  border: 13px solid blue; /* Light grey */
  border-top: 13px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  margin-top:175px;
  animation: spin 2s linear infinite;
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}" v-if="loading"> </p>
        <Post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post"/>
    </div>
</template>

<script>
    import NewPost from '../components/NewPost';
    import Post from '../components/Post';

    export default {
        name: "NewsFeed",

        components: {
            NewPost,
            Post,
        },
        data() {
            return {
                posts:null,
                loading:true
            }
        },

        mounted(){
            axios.get('/api/posts')
            .then( res => {
                this.posts = res.data;
                this.loading=false;
            })
            .catch(error => {
               cosole.log('unable to facth post');
                this.loading=false;

            });
        }
    }
</script>

<style scoped>

</style>
