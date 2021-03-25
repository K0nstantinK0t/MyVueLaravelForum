import { createStore } from 'vuex'

const moduleUser = {
  namespaced: true,
  state: () => ({
      isLogged: false,
      name: null
    }),
  mutations: {
  },
  getters: {
  }
}
const moduleAPI = {
  namespaced: true,
  state: () => ({
    token: null
  }),
  mutations: {
    changeToken (state, newToken){
      if(!newToken)
        return
      state.token = newToken
    }
  },
  getters: {
  }
}

export default createStore({
  state: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    user: moduleUser,
    API: moduleAPI
  }
})
