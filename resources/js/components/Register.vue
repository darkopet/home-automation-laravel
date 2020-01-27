<template>
  <div class="parent-container">
    <div class="container">
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
    components: {
    },
    methods: {
      register() {
        var app = this
        this.$auth.register({
          data: {
            email: app.email,
            password: app.password
          },
          success: function() {
            alert('Registered !')
          },
          error: function() {
            alert('Error')
          }, 
          remember: false,
          fetchUser: true
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