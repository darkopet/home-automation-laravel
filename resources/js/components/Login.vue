<template>
    <div class="container">
        <form action="" @submit.prevent="login">
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
        //
    },
    methods: {
      login() {
        var app = this
        this.$auth.login({
          params: {
            email: app.email,
            password: app.password
          },
          success: function() {
            alert('Logged !')
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