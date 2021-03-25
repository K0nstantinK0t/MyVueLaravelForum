<template>
  <div class="container">
    <h1>Типо тут будет форум</h1>
    <h6>Стили потом добавлю</h6>
  </div>
</template>

<script>
export default {
name: "Forum",
  created() {
    console.log(this.$store.state.API.token)
  }
}
</script>

<style scoped>

</style>