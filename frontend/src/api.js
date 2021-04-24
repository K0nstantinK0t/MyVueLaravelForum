import axios from 'axios'
import store from './store'

// TODO: change host name in "production" version (when run "npm build")
// const HOST_DOMAIN_NAME = window.location.hostname
const HOST_DOMAIN_NAME = 'myforum' // my local host version
const API_HOST_DOMAIN_NAME = `api.${HOST_DOMAIN_NAME}` // this variable keeps a backend host name
                                    // I use a subdomain to divide frontend and backend

// http 401 status  handler - if catch 401 response then delete current token
const UNAUTHORIZED = 401;
axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === UNAUTHORIZED) {
            store.commit('API/deleteToken')
            store.commit('user/setLoggedStatus', false)
            store.commit('user/deleteName')
        }
        return Promise.reject(error)
    }
)


// this function is called every route change by router
export async function callEveryRouteChange()
{
    store.commit('user/setLoggedStatus', await isValidAPIToken(store.state.API.token))
    store.commit('user/setName', await getUserName())
}


async function makeCSRFToken()
{
    await axios.get(`http://${API_HOST_DOMAIN_NAME}/sanctum/csrf-cookie`)
}

// get token from store
function getToken()
{
    return store.state.API.token;
}
// return false if token is invalid and true if token is valid
export async function isValidAPIToken(token)
{
    // optimization: if token doesn't exists then no request
    if(!getToken()){
        return false;
    }

    await makeCSRFToken()
    try {
        const response = await axios.get(`http://${API_HOST_DOMAIN_NAME}/api/isvalidtoken`,{
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
        const result = response.data.result
        return result
    }catch{ // if catch any error like 401 response then token is not valid
        store.commit('API/deleteToken')
        return false
    }
}

export async function registerNewUser(newUser)
{
    await makeCSRFToken()
    const response = await axios.post(`http://${API_HOST_DOMAIN_NAME}/api/register`, newUser)
    const APIToken = response.data.token
    store.commit('API/setToken', APIToken)
    return APIToken
}

export async function authUser(userData)
{
    await makeCSRFToken()
    const response = await axios.post(`http://${API_HOST_DOMAIN_NAME}/api/token`, userData)
    const APIToken = response.data.token
    store.commit('API/setToken', APIToken)
    store.commit('user/setLoggedStatus', true)
    return APIToken
}

export async function logOut()
{
    if(!getToken()){
        return false;
    }
    await makeCSRFToken()
    try {
        const apiToken = store.state.API.token
        await axios.get(`http://${API_HOST_DOMAIN_NAME}/api/logout`, {
            headers: {
                Authorization: `Bearer ${apiToken}`
            }
        })
    }catch {
        // do nothing
    }
    store.commit('API/deleteToken')
    return true
}

export async function getUserName()
{
    if(!getToken()){
        return false;
    }
    await makeCSRFToken()
    try {
        const apiToken = store.state.API.token
        const response = await axios.get(`http://${API_HOST_DOMAIN_NAME}/api/user/name`, {
            headers: {
                Authorization: `Bearer ${apiToken}`
            }
        })
        const name = response.data.name
        return name
    }catch {
        return null
    }
}
