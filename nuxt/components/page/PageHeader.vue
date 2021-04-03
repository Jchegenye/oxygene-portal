<template>
  <a-layout-header class="header">
    <div class="logo" />
    <a-menu
      v-if="$auth.loggedIn"
      theme="dark"
      mode="horizontal"
      :default-selected-keys="['1']"
      :style="{ lineHeight: '64px' }"
    >
      <a-menu-item key="1">
        <NuxtLink to="/profile">profile</NuxtLink>
      </a-menu-item>
      <a-menu-item v-if="loggedInUser.verified" key="2"> settings </a-menu-item>
      <a-menu-item key="3">
        <a href="javascript:void(0);" @click.prevent="logout()">logout</a>
      </a-menu-item>
    </a-menu>
  </a-layout-header>
</template>

<script>
export default {
  name: 'Header',
  // data() {
  //   return {
  //     loggedInUser: this.$auth.user.data,
  //   }
  // },
  async fetch() {
    await this.$auth.fetchUser().then((response) => {
      if (response !== undefined) {
        this.loggedInUser = response.data.data
      } else {
        return {}
      }
    })
    // .then((response) => (this.loggedInUser = response.data.data))
  },
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
    // loggedInUser() {
    //   return this.$auth.user.data
    // },
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

<style>
#components-layout-demo-top-side .logo {
  width: 120px;
  height: 31px;
  background: rgba(255, 255, 255, 0.2);
  margin: 16px 28px 16px 0;
  float: left;
}
</style>
