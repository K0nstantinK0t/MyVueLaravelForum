<template>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <router-link :to="{name: 'home'}" class="navbar-brand">My Forum</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <router-link :to="{name: 'about'}"  class="nav-link">О нас</router-link>
            </li>
            <li class="nav-item dropdown">
              <template v-if="!userIsLogged">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Профиль
              </a>
              </template>
              <template v-else>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ userName }}
              </a>
              </template>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                <template v-if="!userIsLogged">
                  <li>
                    <router-link class="dropdown-item" :to="{name: 'auth'}">Войти</router-link>
                  </li>
                  <li>
                    <router-link class="dropdown-item" :to="{name: 'registration'}">Зарегистрироваться</router-link>
                  </li>
                </template>
                <template v-else>
                  <li>
                    <router-link class="dropdown-item" :to="{name: 'logout'}">Log Out</router-link>
                  </li>
                </template>
              </ul>
            </li>
          </ul>
        </div>
      </div>
  </nav>
</template>

<script>

import store from '@/store'

export default {
  name: "NavBar",
  data: function (){
    return {
      userIsLogged: false,
      userName: null
    }
  },
  async created(){
    this.checkUserIsLogged()
  },
  methods: {
    checkUserIsLogged(){
      this.userIsLogged = store.state.user.isLogged
    }
  },
  watch:{
    $route (){
      this.checkUserIsLogged()
    },
    userIsLogged(status){
      if(status)
        this.userName = store.state.user.name
      else
        this.userName = null
    }
  }
}
</script>

<style scoped>

</style>