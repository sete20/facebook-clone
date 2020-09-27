const state = {
    posts: null,
    postsStatus: null,
    postMessage: '',

};

const getters = {
    posts: state => {
        return state.posts;
    },
    newsStatus: state => {
        return {
            postsStatus: state.postsStatus,
        }
    },
    postMessage: state => {
        return state.postMessage;
    }

};

const actions = {
    fetchNewsPosts({
        commit,
        state
    }) {
        commit('setPostsStatus', 'loading');

        axios.get('/api/posts')
            .then(res => {
                commit('setPosts', res.data);
                commit('setPostsStatus', 'success');
            })
            .catch(error => {
                commit('setPostsStatus', 'error');
            });

    },
    postMessage({
        commit,
        state
    }) {
        commit('setPostsStatus', 'loading');

        axios.post('/api/posts', {
                body: state.postMessage
            })
            .then(res => {
                commit('pushPost', res.data);
                commit('setPostsStatus', 'success');
                commit('updateMessage', '');
            })
            .catch(error => {});
    },

};

const mutations = {
    setPosts(state, posts) {
        state.posts = posts;
    },
    setPostsStatus(state, status) {
        state.postsStatus = status;
    },
    updateMessage(state, message) {
        state.postMessage = message;
    },
    pushPost(state, post) {
        state.posts.data.unshift(post);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
}
