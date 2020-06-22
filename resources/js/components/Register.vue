<template>
  <div class="parent-container">
    <div class="container">
      <div class="card">
        <div class="card-header">
        Register
        </div>
        <div class="card-body">
          <form action="" @submit.prevent="register">
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
  </div>
</template>
<script>
  export default {
    data() {
      return {
        email: '',
        password: '',
      }
    },
    methods: {
      register() {
        this.$store.dispatch('register', {
          email: this.email,
          password: this.password
        })
        .then(response => {
          this.$router.push({ name: 'home' })
        })
        .catch(error => {
          console.log(error)
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