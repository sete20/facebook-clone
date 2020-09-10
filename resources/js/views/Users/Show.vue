<<template>
    <div class="flex flex-col items-center ">
       <div class="relative mb-8">
        <div class="z-10 h-64 overflow-hidden w-100">
            <img src="https://i.pinimg.com/564x/94/f2/17/94f2173d535f6d049c5e27e120e50e33.jpg"class="object-cover w-full">
         </div>
         <div class="absolute bottom-0 left-0 z-20 flex items-center ml-12 -mb-8 ">
             <div class="w-32 ">
            <img src="http://abderlrhman-portfolio.site/img/about/about-1.jpg" alt="profile image for user" class="object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg">
             </div>
             <p class="ml-4 text-2xl text-gray-100 ">{{user.data.attributes.name}}</p>
         </div>
         <div class="absolute bottom-0 right-0 z-20 flex items-center mb-4 mr-12 ">
             <button class="py-1 bg-gray-400 rounded px3"
             @click="$store.dispatch('sendFriendRequest',$route.params.userId)">
              {{ friendButtonText }}
             </button>
         </div>
       </div>
       <p v-if="postLoading">Loading Posts ......</p>
         <Post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post"/>
         <p v-if="! postLoading && posts.data.length < 1"> No Posts Yet. Get Starting !</p>

    </div>

</template>
<script>
import Post from "../../components/Post";
import { mapGetters } from "vuex";
export default {
  name: "Show",
  components: {
    Post,
  },
  data: () => {
    return {
      posts: null,

      postLoading: true,
    };
  },
  mounted() {
    this.$store.dispatch("fetchUser", this.$route.params.userId);
    axios
      .get("/api/users/" + this.$route.params.userId)
      .then((res) => {
        this.user = res.data;
      })
      .catch((error) => {
        console.log("unable to fatch");
      })
      .finally(() => {
        this.userLoading = false;
      });
    axios
      .get("/api/users/" + this.$route.params.userId + "/posts")
      .then((res) => {
        this.posts = res.data;
      })
      .catch((error) => {
        cosole.log("unable to facth post");
      })
      .finally(() => {
        this.postLoading = false;
      });
  },
  computed: {
    ...mapGetters({
      user: "user",
      // posts: 'posts',
      // status: 'status',
      friendButtonText: "friendButtonText",
    }),
  },
};
</script>
<style scoped>
</style>
