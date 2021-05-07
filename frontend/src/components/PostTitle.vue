<template>
  <div class="row-md bg-white p-2 rounded m-2">
    <div class="col-md-12">
      <h5 class="row justify-content-center">{{ header }}</h5>
      <hr/>
      <div class="row mb-1">
        <div class="col-md d-flex justify-content-center border-secondary border-end">
          Updated at: {{ updatedAt }}
          <!--          TODO: сделать дату в читабельном виде-->
        </div>
        <div class="col-md d-flex justify-content-center border-secondary border-start border-end">
          Created at: {{ createdAt }}
        </div>
        <div class="col-md d-flex justify-content-center border-secondary border-start">
          Author: {{ author.name }}
        </div>
      </div>
      <div class="row mb-1" v-if="isPostOwner">
        <div class="col-12">
          <div class="d-flex justify-content-start">
            <button type="button" class="btn btn-danger  mb-1 me-1" data-bs-toggle="modal"
                    :data-bs-target="'#deleteModal' + id">Delete
            </button>
            <button type="button" class="btn btn-warning  mb-1  me-1">Edit</button>

            <div class="modal fade" :id="'deleteModal' + id" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удалить пост</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Вы действительно хотите этого?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click="deletePost">Да</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from '@/store'
import {deletePost} from '@/api'
// TODO: add Post editing!
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
      type: Object,
      required: true
    },
    id: {
      type: Number,
      required: true
    }
  },
  emits: {
    postDeleted: null
  },
  computed: {
    // return true if user has the post
    isPostOwner() {
      return this.author.id === store.state.user.id
    }
  },
  methods: {
    async deletePost() {
      await deletePost(this.id)
      this.$emit('postDeleted')
    }
  }
}
</script>

<style scoped>

</style>