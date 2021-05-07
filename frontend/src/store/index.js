import {createStore} from 'vuex'

const ROOT_DIRECTORY_ID = 1
const ROOT_DIRECTORY_NAME = 'Root'
const moduleUser = {
    namespaced: true,
    state: () => ({
        isLogged: false,
        name: null,
        id: null
    }),
    mutations: {
        setName(state, newName) {
            state.name = newName
        },
        deleteName(state) {
            state.name = null
        },
        setLoggedStatus(state, newStatus) {
            state.isLogged = newStatus
        },
        setID(state, newID) {
            state.id = newID
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
        setToken(state, newToken) {
            state.token = newToken
        },
        deleteToken(state) {
            state.token = null
        }
    },
    // getters: {
    //   isValidToken: async function (state){
    //     return await api.isValidAPIToken(state.token)
    //   }
    // }
}

const moduleForum = {
    namespaced: true,
    // state: () => ({
    // }),
    // mutations: {
    // },
    // getters: {
    //   }
    // },
    modules: {
        currentDirectory: {
            namespaced: true,
            state: () => ({
                id: ROOT_DIRECTORY_ID,
                name: ROOT_DIRECTORY_NAME
            }),
            getters: {
                id(state) {
                    return state.id
                },
                name(state) {
                    return state.name
                },
            },
            mutations: {
                setID(state, newID) {
                    state.id = newID
                },
                setName(state, newName) {
                    state.name = newName
                }
            }
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
        API: moduleAPI,
        forum: moduleForum
    }
})
