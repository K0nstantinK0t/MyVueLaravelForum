<template>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <router-link :to="{name: 'home'}" class="navbar-brand">My Forum</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto">
<!--            <li class="nav-item">-->
<!--              <router-link :to="{name: 'forum'}"  class="nav-link">Форум</router-link>-->
<!--            </li>-->
            <li class="nav-item">
              <router-link :to="{name: 'about'}"  class="nav-link">О нас</router-link>
            </li>
<!--            <li class="nav-item dropdown">-->
<!--              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--                Профиль-->
<!--              </a>-->
<!--  &lt;!&ndash;            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">&ndash;&gt;-->
<!--  &lt;!&ndash;              <li><a class="dropdown-item text-light" href="#">Action</a></li>&ndash;&gt;-->
<!--  &lt;!&ndash;              <li><a class="dropdown-item text-light" href="#">Another action</a></li>&ndash;&gt;-->
<!--  &lt;!&ndash;              <li><hr class="dropdown-divider text-light"></li>&ndash;&gt;-->
<!--  &lt;!&ndash;              <li><a class="dropdown-item text-light" href="#">Something else here</a></li>&ndash;&gt;-->
<!--  &lt;!&ndash;            </ul>&ndash;&gt;-->
<!--              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">-->
<!--                <li><router-link class="dropdown-item" :to="{name: 'auth'}">Войти</router-link></li>-->
<!--                <li><router-link class="dropdown-item" :to="{name: 'registration'}">Зарегистрироваться</router-link></li>-->
<!--              </ul>-->
<!--            </li>-->
          </ul>
        </div>
      </div>
  </nav>
</template>

<script>
export default {
  name: "NavBar"
}
</script>

<style scoped>

</style>