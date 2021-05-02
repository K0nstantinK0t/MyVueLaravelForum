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
            <form class="text-white bg-secondary p-2 rounded">
              <div class="mb-1">
                <label for="header" class="form-label">Header</label>
                <input type="text" class="form-control" id="header"/>
              </div>
              <div class="mb-1">
                <label for="message" class="form-label">Content</label>
                <!--TODO: delete token-->
                <editor api-key="44vn0fh2ddbm8iz6fsa4nrqm1z71wuacrhh39xwmfgh28xdk" id="message">

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

// TODO: REALIZE ALL
export default {
  name: "Forum",
  components: {
    'editor': Editor
  }
}
</script>

<style scoped>

</style>