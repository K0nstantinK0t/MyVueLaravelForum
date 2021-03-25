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
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" v-model="input.password">
          </div>
          <input type="submit" class="btn btn-primary" value="Submit" />
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import {registrationNewUser} from "@/api";
import {validateRegistrationData} from "@/validation";
import router from "@/router";

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
    onSubmit: function (){
      this.errors = validateRegistrationData(this.input)
      if(this.errors.length)
        return
      registrationNewUser(this.input).then(tokenForAPI => {
        this.$store.commit('API/changeToken', tokenForAPI)
        router.push({name: 'forum'})
      }).catch( () => {
        this.errors.push('Ошибка! Введите корректные данные!')
      })
    }
  }
}
</script>

<style scoped>

</style>