<template>
  <main></main>
</template>

<script>
export default {
  middleware: 'auth',
  async fetch() {
    await this.$axios
      .$get(
        `authentication/verify-email/${this.$route.params.id}/${this.$route.params.hash}?expires=${this.$route.query.expires}&signature=${this.$route.query.signature}`
      )
      .then(() => {
        this.$notification.info({
          message: 'Notification',
          description: 'Your have successfully verified your account!',
          placement: 'bottom',
        })
        if (this.$store.$auth.user.length !== 0) {
          if (this.$store.$auth.user.data.role_id === 2) {
            this.$router.push('/dashboard/admin')
          } else if (this.$store.$auth.user.data.role_id === 3) {
            this.$router.push('/dashboard/employee')
          } else if (this.$store.$auth.user.data.role_id === 4) {
            this.$router.push('/dashboard/client')
          } else {
            this.logout()
          }
          this.$notification.info({
            message: 'Notification',
            description:
              'Giving you access to ' +
              this.$store.$auth.user.data.role_label +
              ' dashboard.',
            placement: 'bottom',
          })
        }
      })
      .catch((e) => {
        this.$notification.error({
          message: 'Notification',
          description: e.response.data.message,
          placement: 'bottom',
        })
        this.$router.push('/profile')
      })
  },
}
</script>
