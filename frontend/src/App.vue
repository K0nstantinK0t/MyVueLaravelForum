<template>
  <nav-bar></nav-bar>
  <div id="wrapper">
    <router-view  class="text-light pt-2"/>
  </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'

export default {
  name: 'App',
  components: {
    NavBar
  }
}
</script>
<style scoped>
  #wrapper {
    background: #1a202c url("./assets/background.jpg");
    background-size: 100%;
    /* stretch to full screen height  56px - NavBar height*/
    min-height: calc(100vh - 56px);
  }
</style>
