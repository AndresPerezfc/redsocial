<template>
  <div>
    <form @submit.prevent="submit">
      <div class="card-body">
        <textarea
          v-model="body"
          class="form-control border-0"
          name="body"
          placeholder="Ingrese estado"
        ></textarea>
      </div>

      <div class="card-footer">
        <button class="btn btn-secondary" id="create-status">Publicar estado</button>
      </div>
    </form>
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
          EventBus.$emit("status-created", res.data);
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