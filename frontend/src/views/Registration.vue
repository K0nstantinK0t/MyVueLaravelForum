<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1>Регистрация</h1>
        <div class="alert alert-danger p-0 pt-2" v-if="errors.length">
          <ul v-for="(error, id) in errors" v-bind:key="id">
            {{error}}
          </ul>
        </div>
        <form action="#" @submit.prevent="onSubmit">
          <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" v-model="input.name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" v-model="input.email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Пароль (минимальная длина 8 символов)</label>
            <input type="password" class="form-control" id="password" v-model="input.password">
          </div>
          <input type="submit" class="btn btn-primary" value="Submit" />
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import {registerNewUser} from "@/api"
import {validateRegistrationData} from "@/validation"
import router from "@/router"

export default {
  name: "Registration",
  data(){
    return {
      input: {
        name: null,
        email: null,
        password: null
      },
      errors: []
    }
  },
  methods: {
     async onSubmit(){
      this.errors = validateRegistrationData(this.input)
      if(this.errors.length)
        return
      try {
        await registerNewUser(this.input)
        router.push({name: 'forum'})
      }catch{
        this.errors.push('Ошибка! Введите корректные данные!')
      }
    }
  }
}
</script>

<style scoped>

</style>