<template>
    <div class="container">

      <div v-if="has_success" class="alert alert-success">Device successfully deleted !</div>
      <div v-if="has_error" class="alert alert-danger" style="padding-bottom: 0">
        <p>Ops, something went wrong :(</p>
      </div>

      <table class="table">
        <tr>
          <th>Nazwa</th>
          <th>Pin</th>
          <th>Status</th>
          <th>Akcja</th>
        </tr>
        <tr v-for="device in devices" :key="device.id">
          
          <td>{{device.name}}</td>
          <td>{{device.pin}}</td>
          <td v-if="device.status == 0">Wyłączony</td>
          <td v-if="device.status == 1">Włączony</td>
          <td>
            <button @click="changeStatus(device)" class="btn btn-warning">Change Status</button>
            <button @click="deleteDevice(device)" class="btn btn-danger">Delete</button>
          </td>
        
        </tr>
      </table>
    </div>
</template>
<script>

  export default {
    data() {
      return {
        devices: [],
        has_success: false,
        has_error: false,
      }
    },
    methods: {
      changeStatus(device) {
        this.$store.dispatch('changeDeviceState', device)
        .then(response => {
          !this.devices[this.devices.indexOf(device)].status
        })
        .catch(err => {
          console.log('nie ok', err)
        })
      },
      deleteDevice(device) {
        this.$store.dispatch('deleteDevice', device)
        .then(response => {
          //this.devices.splice(this.devices.indexOf(device), 1)
          this.has_success = true
        })
        .catch(error => {
          this.has_error = true
        })
      }
    },
    created() {
      this.$store.dispatch('retrieveDevices')
      .then(response => {
        this.devices = response.data.devices
      })
      .catch(error => {
        if(error.response.status == 401) this.$router.push({ name: 'logout' })
      })
    },
    components: {
      
    }
  }
</script>

<style scoped>
  .btn {
    padding: 2px 7px;
  }
</style>