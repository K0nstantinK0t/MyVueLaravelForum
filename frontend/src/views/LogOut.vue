<template>
  <div class="d-flex justify-content-center">
    <h1>
      Выход из системы...
    </h1>
  </div>
</template>

<script>
import {logOut} from "@/api"
import router from "@/router"

export default {
  name: "LogOut",
  async created(){
    await logOut()
    router.push({name: 'home'})
  }
}
</script>

<style scoped>

</style>