<template>
 <div class="container">
   <div class="row justify-content-center">
     <div class="col-md-6">
       <h1>Авторизация</h1>
       <div class="alert alert-danger p-0 pt-2" v-if="errors.length">
         <ul v-for="(error, id) in errors" :key="id">
           {{error}}
         </ul>
       </div>
       <form action="#" @submit.prevent="onSubmit">
         <div class="mb-3">
           <label for="email" class="form-label">Email</label>
           <input type="email" class="form-control" id="email" v-model="inputData.email">
         </div>
         <div class="mb-3">
           <label for="password" class="form-label">Пароль</label>
           <input type="password" class="form-control" id="password" v-model="inputData.password">
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
       </form>
     </div>
   </div>
 </div>
</template>

<script>
import {authUser} from "@/api"
import router from "@/router"
import {validateAuthData} from "@/validation"

export default {
  name: "Auth",
  data: function (){
    return {
      inputData: {
        email: null,
        password: null
      },
      errors: []
    }
  },
  methods: {
    async onSubmit() {
      this.errors = validateAuthData(this.inputData)
      if (this.errors.length)
        return
      try {
        await authUser(this.inputData)
        router.push({name: 'forum'})
      } catch {
        this.errors.push('Ошибка! Введите корректные данные!')
      }
    }
  }
}
</script>

<style scoped>

</style>