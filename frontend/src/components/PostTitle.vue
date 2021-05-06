<template>
  <div class="row-md bg-white p-2 rounded m-2">
    <div class="col-md-12">
      <h5 class="row justify-content-center">{{ header }}</h5>
      <hr/>
      <div class="row ">
        <div class="col-md d-flex justify-content-center border-secondary border-end">
          Updated at: {{ updatedAt }}
        </div>
        <div class="col-md d-flex justify-content-center border-secondary border-start border-end">
          Created at: {{ createdAt }}
        </div>
        <div class="col-md d-flex justify-content-center border-secondary border-start">
          Author: {{ author }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// TODO: realize component
export default {
  name: "PostTitle",
  props: {
    header: {
      type: String,
      required: true
    },
    updatedAt: {
      type: String,
      required: true
    },
    createdAt: {
      type: String,
      required: true
    },
    author: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>

</style>