<template>
 <div class="container">
   <div class="row justify-content-center">
     <div class="col-md-6">
       <h1>Авторизация</h1>
       <div class="mb-3">
         <label for="email" class="form-label">Email</label>
         <input type="email" class="form-control" id="email">
       </div>
       <div class="mb-3">
         <label for="password" class="form-label">Пароль</label>
         <input type="password" class="form-control" id="password">
       </div>
       <button type="submit" class="btn btn-primary">Submit</button>
     </div>
   </div>
 </div>
</template>

<script>
export default {
  name: "Auth"
}
</script>

<style scoped>

</style>