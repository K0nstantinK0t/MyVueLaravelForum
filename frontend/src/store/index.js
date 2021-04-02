import { createStore } from 'vuex'
import * as api from '../api'

const moduleUser = {
  namespaced: true,
  state: () => ({
      name: null
    }),
  // mutations: {
  //  setName
  // },
  getters: {
    isLogged: async function(state, getters, rootState, rootGetters){
      return await rootGetters['API/isValidToken']
    }
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
    },
    deleteToken (state){
      state.token = null
    }
  },
  getters: {
    isValidToken: async function (state){
      return await api.isValidAPIToken(state.token)
    }
  }
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
