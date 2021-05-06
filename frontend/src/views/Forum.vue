<template>
  <div class="container-fluid text-dark p-md-5">
    <div class="row-md ">
      <div class="col-md-12">
        <div class="row-md m-2">
          <a class="btn btn-primary" data-bs-toggle="collapse" href="#postForm" role="button" aria-expanded="false"
             aria-controls="collapseExample">
            Add new post
          </a>
        </div>
        <div class="row-md m-2">
          <div class="collapse" id="postForm">
            <form class="text-white bg-secondary p-2 rounded" action="#" @submit.prevent="onAddNewPost">
              <div class="alert alert-danger p-0 pt-2" v-if="errors.length">
                <ul v-for="(error, id) in errors" :key="id">
                  {{ error }}
                </ul>
              </div>
              <div class="mb-1">
                <label for="header" class="form-label">Header</label>
                <input type="text" class="form-control" id="header" v-model="inputData.header" maxlength="64"/>
              </div>
              <div class="mb-1">
                <label for="content" class="form-label">Content</label>
                <editor api-key="" id="content"
                        v-model="inputData.content">
                </editor>

              </div>
              <button type="submit" class="btn btn-success">Create</button>
            </form>
          </div>
        </div>

        <!-- TODO: create directory markup-->

        <!-- Post markup-->
        <post-title v-for="post in directory.posts"
                    :key="post.id"
                    :header="post.header"
                    :updatedAt="post.updated_at"
                    :createdAt="post.created_at"
                    :author="post.author.name"
        />

      </div>
    </div>
  </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'
import {validatePostData} from "@/validation"
import {createNewPost} from "@/api"
import {getDirectory} from "@/api"
import store from '@/store'
import PostTitle from "@/components/PostTitle";
// TODO: REALIZE ALL
export default {
  name: "Forum",
  data: function () {
    return {
      inputData: {
        header: null,
        content: null
      },
      errors: [],
      directory: {
        posts: [],
        childDirectories: []
      }
    }
  },
  async created(){
    await this.updateDirectory()
  },
  methods: {
    async onAddNewPost() {
      this.errors = validatePostData(this.inputData);
      if (this.errors.length)
        return
      await createNewPost(store.getters['forum/currentDirectory/id'], this.inputData)
      await  this.updateDirectory()
    },
    async updateDirectory() {
      const directory = await getDirectory(store.getters['forum/currentDirectory/id'])
      this.directory.posts = directory.posts
      this.directory.childDirectories = directory.child_directories
      console.log(directory)
    }
  },
  components: {
    'editor': Editor,
    'PostTitle': PostTitle
  }
}
</script>

<style scoped>

</style>