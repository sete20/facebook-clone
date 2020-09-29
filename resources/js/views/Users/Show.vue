<template>
  <div
    class="flex flex-col items-center"
    v-if="status.user === 'success' && user"
  >
    <div v-if="status.posts === 'loading'">Loading posts...</div>

    <div v-else-if="posts.length < 1">No posts found. Get started...</div>

    <Post
      v-else
      v-for="(post, postKey) in posts.data"
      :key="postKey"
      :post="post"
    />
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

  mounted() {
    this.$store.dispatch("fetchUser", this.$route.params.userId);
    this.$store.dispatch("fetchUserPosts", this.$route.params.userId);
  },

  computed: {
    ...mapGetters({
      user: "user",
      posts: "posts",
      status: "status",
      friendButtonText: "friendButtonText",
    }),
  },
};
</script>

<style scoped>
</style>
