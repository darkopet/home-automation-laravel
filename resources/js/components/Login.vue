<template>
  <div class="container">
      <div v-if="has_error" class="alert alert-danger">Wrong credentials</div>
      <div class="card">
        <div class="card-header">
          Login
        </div>
        <div class="card-body">
          <form action="" @submit.prevent="login">
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" v-model="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" v-model="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        email: '',
        password: '',
        has_error: false
      }
    },
    methods: {
      login() {
        this.$store.dispatch('retrieveToken', {
          email: this.email,
          password: this.password
        })
        .then(response => {
          this.$router.push({ name: 'home' })
        })
        .catch(error => {
          this.has_error = true
        })
      }
    }
  }
</script>

<style scoped>
  .parent-container {
    margin-top: 15px;
  }
</style>