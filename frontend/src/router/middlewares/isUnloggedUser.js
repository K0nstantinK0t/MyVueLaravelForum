import store from '../../store'

export default function(to, from, next){
    if (store.state.user.isLogged)
        next({ name: 'forum' })
    else
        next()
}