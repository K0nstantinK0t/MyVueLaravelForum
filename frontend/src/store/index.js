import { createStore } from 'vuex'

const moduleUser = {
  namespaced: true,
  state: () => ({
    isLogged: false,
    name: null
  }),
  mutations: {
    setName(state, newName) {
      state.name = newName
    },
    deleteName(state){
      state.name = null
    },
    setLoggedStatus(state, newStatus) {
      state.isLogged = newStatus
    }
  },
  // getters: {
  // }
}

const moduleAPI = {
  namespaced: true,
  state: () => ({
    token: null
  }),
  mutations: {
    setToken (state, newToken){
      state.token = newToken
    },
    deleteToken (state){
      state.token = null
    }
  },
  // getters: {
  //   isValidToken: async function (state){
  //     return await api.isValidAPIToken(state.token)
  //   }
  // }
}

export default createStore({
  // place for global state
  //
  // state: {
  // },
  // mutations: {
  // },
  // actions: {
  // },
  modules: {
    user: moduleUser,
    API: moduleAPI
  }
})
