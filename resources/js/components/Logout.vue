<template>
    
</template>

<script>
    export default {
        created() {
            this.$store.dispatch('destroyToken')
            .then(response => {
                this.$router.push({ name: 'login' })
            })
            .catch(error => {
                this.$router.push({ name: 'login' })
            })
        }
    }
</script>