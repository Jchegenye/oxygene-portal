<template>
  <div>
    Welcome {{ loggedInUser.nickname }}
    <a href="javascript:void(0);" @click.prevent="logout()">logout</a>

    <!-- Menu -->
    <h1>Lounge Area</h1>
    <p>This is your waiting area, if you have issues kindly contact us</p>
    <a-button>Refresh</a-button>
  </div>
</template>

<script>
export default {
  name: 'Dashboard',
  middleware: ['auth'],
  computed: {
    loggedInUser() {
      if (
        Object.keys(this.$auth.$state.user).length !== 0 &&
        this.$auth.$state.user.length !== 0
      ) {
        return this.$auth.$state.user.data
      } else {
        return []
      }
    },
  },
  methods: {
    async logout() {
      try {
        this.$notification.info({
          message: 'Notification',
          description: 'Successfully logged out!',
          placement: 'bottom',
        })
        await this.$auth.logout('laravelPassport')
      } catch (error) {
        console.log(error)
      }
    },
  },
}
</script>
