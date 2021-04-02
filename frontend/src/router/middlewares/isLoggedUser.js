import store from '../../store'

export default async function(to, from, next){
    if (! (await store.getters['user/isLogged']))
        next({ name: 'auth' })
    else
        next()
}