import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home'

import isLoggedUser from "./middlewares/isLoggedUser"
import isUnloggedUser from "./middlewares/isUnloggedUser"

/* NOTE
* Every route where stands "beforeEnter: isUnloggedUser/isLoggedUser"
* will send request to backend to know authed user or not.
* This bad affects the performance
* but if you know other way to do it, please report me
* */

const routes = [
  {
    path: '/',
    name: 'home',
    beforeEnter: isUnloggedUser,
    component: Home

  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About')
  },
  {
    path: '/auth',
    name: 'auth',
    beforeEnter: isUnloggedUser,
    component: () => import(/* webpackChunkName: "auth" */ '../views/Auth')
  },
  {
    path: '/registration',
    name: 'registration',
    beforeEnter: isUnloggedUser,
    component: () => import(/* webpackChunkName: "registration" */ '../views/Registration')
  },
  {
    path: '/forum',
    name: 'forum',
    beforeEnter: isLoggedUser,
    component: () => import(/* webpackChunkName: 'forum*/ '../views/Forum')
  },
  {
    path: '/logout',
    name: 'logout',
    beforeEnter: isLoggedUser,
    component: () => import(/* webpackChunkName: 'logout*/ '../views/LogOut')
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
