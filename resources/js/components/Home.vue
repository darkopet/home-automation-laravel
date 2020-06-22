<template>
    <div class="container">
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
            <button @click="changeStatus(device.id, !device.status)" class="btn btn-warning">Change Status</button>
            <button class="btn btn-danger">Delete</button>
          </td>
        
        </tr>
      </table>
    </div>
</template>
<script>

  export default {
    data() {
      return {
        devices: []
      }
    },
    methods: {
      changeStatus(id, status) {
        status = status ? 1 : 0;
        this.$store.dispatch('changeDeviceState', {id, status})
        .then(response => {
          this.devices.find(d => d.id === id).status = status
        })
        .catch(err => {
          console.log('nie ok', err)
        })
      }
    },
    created() {
      this.$store.dispatch('retrieveDevices')
      .then(response => {
        this.devices = response.data.devices
      })
    },
    components: {
      
    }
  }
</script>