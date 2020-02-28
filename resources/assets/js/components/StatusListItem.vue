<template>
  <div class="card mb-3 border-0 shadow-sm">
    <div class="card-body d-flex flex-column">
      <div class="d-flex align-items-center mb-3">
        <img
          class="rounded mr-3 shadow-sm"
          width="40"
          src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y"
          alt
        />
        <div>
          <h5 class="mb-1" v-text="status.user_name">Nombre de usuario</h5>
          <div class="small text-muted" v-text="status.ago">Hace una hora</div>
        </div>
      </div>
      <p class="card-text text-secondary" v-text="status.body"></p>
    </div>

    <div class="card-footer p-2 d-flex justify-content-between align-items-center">
      <like-btn :status="status"></like-btn>
      <div class="mr-2">
        <i class="far fa-thumbs-up"></i>
        <span dusk="list-count">{{status.likes_count}}</span>
      </div>
    </div>

    <div class="card-footer">
      <div v-for="comment in comments" v-bind:key="comment.id" class="mb-2">
        <img
          class="rounded shadow-sm float-left mr-2"
          width="32px"
          :src="comment.user_avatar"
          :alt="comment.user_name"
        />
        <div class="card border-0 shadow-sm">
          <div class="card-body p-2 text-secondary">
            <a href="#">
              <strong>{{comment.user_name}}</strong>
            </a>
            {{comment.body}}
          </div>
        </div>
      </div>

      <form @submit.prevent="addComment" v-if="estaAutenticado">
        <div class="d-flex align-items-center">
          <img
            class="rounded shadow-sm float-left mr-2"
            width="32px"
            src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y"
          />
          <div class="input-group">
            <textarea
              class="form-control border-0 shadow-sm"
              name="comment"
              v-model="newComment"
              rows="1"
              placeholder="Escribe un comentario aquí..."
            ></textarea>
            <div class="input-group-append">
              <button class="btn btn-secondary" dusk="comment-btn">Enviar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import LikeBtn from "./LikeBtn";
export default {
  props: {
    status: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      newComment: "",
      comments: this.status.comments
    };
  },
  components: {
    LikeBtn
  },
  methods: {
    addComment() {
      axios
        .post(`/statuses/${this.status.id}/comments`, { body: this.newComment })
        .then(res => {
          this.newComment = "";
          this.comments.push(res.data.data);
        })
        .catch(err => {
          console.log(err.response.data);
        });
    }
  }
};
</script>

<style>
</style>