<template>
    <div class="container">
      <div v-if="has_success" class="alert alert-success">Device successfully added !</div>
      <div v-if="has_error" class="alert alert-danger" style="padding-bottom: 0">
      <ul>
        <li v-for="(error, key) in errors" :key="key">{{ error[0] }}</li>
      </ul>
      </div>
      <form action="" @submit.prevent="addDevice">
        <div class="form-group">
          <label for="device_name">Nazwa urządzenia</label>
          <input class="form-control" type="text" id="device_name" placeholder="TV Switch" v-model="device_name">
        </div>

        <div class="form-group">
          <label for="device_pin">Pin</label>
          <input class="form-control" type="number" id="device_pin" min="5" max="40" placeholder="12" v-model="device_pin">
        </div>

        <div class="form-group">
          <label for="device_type">Typ urządzenia</label>
          <select class="form-control" id="device_type" v-model="device_type">
            <option v-for="deviceType in deviceTypes" :value="deviceType.id" :key="deviceType.id">{{deviceType.name}}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="device_status">Status</label>
          <select class="form-control" id="device_status" v-model="device_status">
            <option value="0">Wyłączony</option>
            <option value="1">Włączony</option>
          </select>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success">Zatwierdź</button>
        </div>
      </form>
    </div>
</template>
<script>

  export default {
    data() {
      return {
        has_error: false,
        has_success: false,
        errors: [],
        deviceTypes: [],
        device_name: '',
        device_pin: '',
        device_type: '',
        device_status: ''
      }
    },
    components: {
      
    },
    methods: {
      fetchDeviceTypes: function() {
        axios.get('/device-type').then(res => {
          this.deviceTypes.push(res.data.deviceTypes[0])
        }).catch(err => {
          console.log(err);
        })
      },
      addDevice: function() {
        axios.post('/devices', {'name': this.device_name, 'pin': this.device_pin, 'device_type_id': this.device_type, 'status': this.device_status})
            .then(res => {
              this.has_error = false;
              this.has_success = true;
            }).catch(err => {
              this.has_error = true;
              this.has_success = false;
              if(err.response) {
                this.errors = err.response.data.errors;
              }
            })
      }
    },
    created() {
      this.fetchDeviceTypes();
    }
  }
</script>

<style scoped>

</style>