<template>
  <div id="nav">
      <div id="logo">
        <router-link v-if="loggedIn" :to="{ name: 'home' }">Home Automation</router-link>
        <router-link v-else :to="{ name: 'login' }">Home Automation</router-link>
      </div>
      <div id="menu">
          <ul>
              <li v-if="loggedIn"><router-link :to="{ name: 'home' }">Dashboard</router-link></li>
              <li v-if="loggedIn"><router-link :to="{ name: 'add-device' }">Add device</router-link></li>
              <li v-if="loggedIn"><router-link :to="{ name: 'logout' }">Logout</router-link></li>
              <li v-if="!loggedIn"><router-link :to="{ name: 'login' }">Login</router-link></li>
              <li v-if="!loggedIn"><router-link :to="{ name: 'register' }">Register</router-link></li>
          </ul>
      </div>
  </div>
</template>

<script>
export default {
  computed: {
      loggedIn() {
          return this.$store.getters.isLogged
      }
  }
}
</script>

<style lang="scss" scoped>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    #nav {
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid black;
    }

    #menu ul {
        display: flex;
        justify-content: space-between;
    }

    #menu ul li {
        list-style-type: none;
        margin-right: 20px;
    }

    #menu ul li a, #logo a {
        text-decoration: none;
        color: black;
        &:hover {
            color: gray;
        }
    }
</style>