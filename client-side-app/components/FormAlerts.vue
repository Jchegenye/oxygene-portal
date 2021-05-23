<template>
  <div v-if="Object.keys(errors).length !== 0">
    <a-alert :type="status" :message="errors.message" banner class="mb-2" />
  </div>
</template>
<script>
export default {
  name: 'FormAlerts',
  props: {
    errors: {
      type: [Array, Object, Boolean, Error],
      required: true,
    },
  },
  computed: {
    status() {
      if (this.errors.status !== '') {
        return this.errors.status
      } else {
        return 'info'
      }
    },
  },
}
</script>
