<template>
  <div class="container-fluid text-dark p-md-5">
    <div class="row-md ">
      <div class="col-md-12">
        <div class="row-md m-2">
          <a class="btn btn-primary" data-bs-toggle="collapse" href="#postForm" role="button" aria-expanded="false" aria-controls="collapseExample">
            Add new post
          </a>
        </div>
        <div class="row-md m-2">
          <div class="collapse" id="postForm">
            <form class="text-white bg-secondary p-2 rounded" action="#" @submit.prevent="onAddNewPost">
              <div class="alert alert-danger p-0 pt-2" v-if="errors.length">
                <ul v-for="(error, id) in errors" :key="id">
                  {{error}}
                </ul>
              </div>
              <div class="mb-1">
                <label for="header" class="form-label">Header</label>
                <input type="text" class="form-control" id="header" v-model="inputData.header" maxlength="64"/>
              </div>
              <div class="mb-1">
                <label for="content" class="form-label">Content</label>
                <!--TODO: delete token-->
                <editor api-key="44vn0fh2ddbm8iz6fsa4nrqm1z71wuacrhh39xwmfgh28xdk" id="content" v-model="inputData.content">
                </editor>

              </div>
              <button type="submit" class="btn btn-success">Create</button>
            </form>
          </div>
        </div>

        <div class="row-md bg-white p-2 rounded m-2">
          <div class="col-md-12">
            <h5 class="row justify-content-center">Header</h5>
            <hr/>
            <div class="row ">
                <div class="col-md d-flex justify-content-center border-secondary border-end">Updated at: 21.13.1233</div>
                <div class="col-md d-flex justify-content-center border-secondary border-start border-end">Created at: 12.12.2131</div>
                <div class="col-md d-flex justify-content-center border-secondary border-start">Author: 11111111</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'
import {validatePostData} from "@/validation";
// TODO: REALIZE ALL
export default {
  name: "Forum",
  data: function (){
    return {
      inputData: {
        header: null,
        content: null
      },
      errors: []
    }
  },
  components: {
    'editor': Editor
  },
  methods: {
    onAddNewPost()
    {
      this.errors = validatePostData(this.inputData);
      if (this.errors.length)
        return

    }
  }
}
</script>

<style scoped>

</style>