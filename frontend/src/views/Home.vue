<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1>Добро пожаловать!</h1>
        <p class="fs-3">
          Это тестовый сайт, написанный мной. <br/>
          Он посвящён форуму. <br/>
          Прежде чем вы сможете его опробовать, <router-link to="/auth" class="link-info">авторизуйтесь
          </router-link> или <router-link to="/registration" class="link-info">зарегистрируйтесь</router-link>.
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Home',
  components: {
  }
}
</script>


