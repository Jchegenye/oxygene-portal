<template>
  <div>
    <div class="flex-center position-ref full-height text-center">
      <div class="text-center">
        <Logo />
        <Tagline />

        <div class="links">
          <template v-if="$auth.loggedIn">
            <NuxtLink to="/dashboard">dashboard</NuxtLink>
            <a href="javascript:void(0);" @click.prevent="logout()">logout</a>
          </template>
          <template v-else>
            <NuxtLink to="/authentication/login">login</NuxtLink>
            <NuxtLink to="/authentication/registration">register now</NuxtLink>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Lounge',
  layout: 'base',
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
