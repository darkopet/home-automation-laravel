<template>
  <div>
    <Menu />
    <div class="parent-container">
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
  import Menu from './components/Menu'

  export default {
    data() {
      return {
        //
      }
    },
    components: {
      Menu,
    }
  }
</script>

<style scoped>
  .parent-container {
    margin-top: 15px;
  }
</style>
