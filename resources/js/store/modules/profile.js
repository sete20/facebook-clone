const state = {
    user: null,
    userStatus: null,
    friendButtonText: null
};

const getters = {
    user: state => {
        return state.user;
    },
    friendButtonText: state => {
        return state.friendButtonText;
    },
    friendship: state => {
        return state.user.data.attributes.friendship;
    }
};

const actions = {
    fetchUser({
        commit,
        dispatch
    }, userId) {
        commit('setUserStatus', 'loading');

        axios.get('/api/users/' + userId)
            .then(res => {
                commit('setUser', res.data);
                commit('setUserStatus', 'success');
                dispatch('setFriendButton');
            })
            .catch(error => {
                commit('setUserStatus', 'error');
            });
    },
    sendFriendRequest({
        commit,
        state
    }, friendId) {
        commit('setButtonText', 'Loading');
        axios.post('/api/friend-request', {
                'friend_id': friendId
            })
            .then(res => {
                commit('setButtonText', 'Pending Friend Request');
            })
            .catch(error => {
                commit('setButtonText', 'add Friend ');
            });
    },
    setFriendButton({
        commit,
        getters
    }) {
        if (getters.friendship === null) {
            commit('setButtonText', 'add Friend ');
        } else if (getters.friendship.data.attributes.confirmed_at === null) {
            commit('setButtonText', 'Pending Friend Request');
        }
    },


};

const mutations = {
    setUser(state, user) {

        state.user = user;
    },
    setUserStatus(state, status) {
        state.userStatus = status;
    },
    setButtonText(state, text) {
        state.friendButtonText = text;
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
}
