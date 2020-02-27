<template>
  <div @click="redireccionarInvitado">
    <div class="card mb-3 border-0 shadow-sm" v-for="status in statuses" v-bind:key="status.id">
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
        <button
          class="btn btn-link btn-sm"
          v-if="status.is_liked"
          dusk="unlike-btn"
          @click="unlike(status)"
        >
          <i class="fa fa-thumbs-up"></i>
          <strong>Te gusta</strong>
        </button>

        <button class="btn btn-link btn-sm" v-else dusk="like-btn" @click="like(status)">
          <i class="far fa-thumbs-up"></i> Me gusta
        </button>
        <div class="mr-2">
          <i class="far fa-thumbs-up"></i>
          <span dusk="list-count">{{status.likes_count}}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      statuses: []
    };
  },
  mounted() {
    axios
      .get("/statuses")
      .then(res => {
        this.statuses = res.data.data;
      })
      .catch(err => {
        console.log(err.response.data);
      });
    EventBus.$on("status-created", status => {
      this.statuses.unshift(status);
    });
  },
  methods: {
    like(status) {
      axios.post(`/statuses/${status.id}/likes`).then(res => {
        status.is_liked = true;
        status.likes_count++;
      });
    },
    unlike(status) {
      axios.delete(`/statuses/${status.id}/likes`).then(res => {
        status.is_liked = false;
        status.likes_count--;
      });
    }
  }
};
</script>


<style scoped>
</style>