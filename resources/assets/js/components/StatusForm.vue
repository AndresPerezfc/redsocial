<template>
  <div>
    <form @submit.prevent="submit" v-if="estaAutenticado">
      <div class="card-body">
        <textarea
          v-model="body"
          class="form-control border-0"
          name="body"
          :placeholder="`¿Qué estas pensando ${usuarioActual.name}?`"
          required
        ></textarea>
      </div>

      <div class="card-footer">
        <button class="btn btn-secondary" id="create-status">
          <i class="fa fa-paper-plane"></i> Publicar estado
        </button>
      </div>
    </form>

    <div v-else class="card-body">
      <a href="/login">Debes estar autenticado</a>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      body: ""
    };
  },

  methods: {
    submit() {
      axios
        .post("/statuses", { body: this.body })
        .then(res => {
          EventBus.$emit("status-created", res.data.data);
          this.body = "";
        })
        .catch(err => {
          console.log(err.response.data);
        });
    }
  }
};
</script>


<style scoped>
</style>>