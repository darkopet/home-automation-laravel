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
          <td><button @click="changeStatus(device.id, !device.status)" class="btn btn-danger">Change Status</button></td>
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
      fetchDevices() {
        axios.get('/devices').then(res => {
          res.data.devices.forEach(device => {
            this.devices.push(device);
          });

        }).catch(err => {
          console.log(err);
        });
      },
      changeStatus(id, status) {
        let stat = status ? 1 : 0;
        axios.get('/devices/'+id+'/status/'+stat).then(res => {
          this.devices.find(d => d.id == id).status = status;
          console.log(res.data);
        }).catch(err => {
          console.log(err);
        });
      }
    },
    created() {
      this.fetchDevices();
    },
    components: {
      
    }
  }
</script>