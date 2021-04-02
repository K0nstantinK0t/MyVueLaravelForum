import axios from 'axios'
import store from './store'

// TODO: change host name in "production" version
// const HOST_NAME = window.location.hostname

const HOST_NAME = 'myforum' // my local host version
const API_HOST = `api.${HOST_NAME}`

// http 401 status  handler - if catch 401 response then delete current token
const UNAUTHORIZED = 401;
axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === UNAUTHORIZED) {
            store.commit('API/deleteToken')
        }
        return Promise.reject(error)
    }
)

async function makeCSRFToken(){
    await axios.get(`http://${API_HOST}/sanctum/csrf-cookie`)
}


// return false if token is invalid and true if token is valid
export async function isValidAPIToken(token)
{
    await makeCSRFToken()
    try {
        const response = await axios.post(`http://${API_HOST}/api/isvalidtoken`, null, {
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

export async function registrationNewUser(newUser)
{
    await makeCSRFToken()
    const response = await axios.post(`http://${API_HOST}/api/register`, newUser)
    const APIToken = response.data.token
    store.commit('API/changeToken', APIToken)
    return APIToken
}

export async function authUser(userData)
{
    await makeCSRFToken()

    const response = await axios.post(`http://${API_HOST}/api/token`, userData)
    const APIToken = response.data.token
    store.commit('API/changeToken', APIToken)
    return APIToken
}

export async function logOut()
{
    await makeCSRFToken()
    try {
        const apiToken = store.state.API.token
        await axios.get(`http://${API_HOST}/api/logout`, {
            headers: {
                Authorization: `Bearer ${apiToken}`
            }
        })
    }finally {
        store.commit('API/deleteToken')
    }
    return true
}