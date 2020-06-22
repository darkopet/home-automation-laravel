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
          <label for="device_name">Device name</label>
          <input class="form-control" type="text" id="device_name" placeholder="TV Switch" v-model="device_name">
        </div>

        <div class="form-group">
          <label for="device_pin">Pin</label>
          <input class="form-control" type="number" id="device_pin" min="5" max="40" placeholder="12" v-model="device_pin">
        </div>

        <div class="form-group">
          <label for="device_type">Device type</label>
          <select class="form-control" id="device_type" v-model="device_type">
            <option value="" disabled selected>Select device type</option>
            <option v-for="deviceType in deviceTypes" :value="deviceType.id" :key="deviceType.id">{{deviceType.name}}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="device_status">Status</label>
          <select class="form-control" id="device_status" v-model="device_status">
            <option value="" disabled selected>Select status</option>
            <option value="0">Disabled</option>
            <option default value="1">Enabled</option>
          </select>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success">Add device</button>
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
      addDevice() {
        this.$store.dispatch('addDevice', {
                        name: this.device_name,
                        pin: this.device_pin,
                        device_type_id: this.device_type,
                        status: this.device_status
                    })
        .then(response => {
          this.has_success = true,
          this.has_error = false
        })
        .catch(err => {
          this.has_success = false,
          this.has_error = true,
          this.errors = err.response.data.errors
        })
      }
    },
    created() {
      this.$store.dispatch("retrieveDeviceTypes")
      .then(response => {
        this.deviceTypes = response.data.deviceTypes
      })
      .catch(error => {
        this.has_error = true
      })
    }
  }
</script>

<style scoped>

</style>