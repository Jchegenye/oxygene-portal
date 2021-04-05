<template>
  <a-layout-header
    class="header"
    :style="{ height: '55px', lineHeight: '55px' }"
  >
    <Logo />
    <a-menu
      v-if="$auth.loggedIn"
      theme="dark"
      mode="horizontal"
      :default-selected-keys="['1']"
      :style="{ height: '55px', lineHeight: '55px', 'text-align': 'right' }"
    >
      <a-menu-item key="1">
        <NuxtLink to="/profile">Profile</NuxtLink>
      </a-menu-item>
      <a-menu-item v-if="loggedInUser.verified" key="2">Settings </a-menu-item>
      <a-menu-item key="3" @click="logout">
        <a-icon type="logout" />
        Logout
      </a-menu-item>
      <a-menu-item key="4" class="userLoggedin">
        <div class="avater">
          <span class="innera-vater">
            <small
              ><span v-if="loggedInUser.first_name || loggedInUser.last_name"
                >{{
                  loggedInUser.first_name + ' ' + loggedInUser.last_name
                }}
                -</span
              >
              {{ loggedInUser.role_label }}</small
            >
          </span>
          <a-badge :count="1">
            <v-gravatar
              shape="square"
              :email="loggedInUser.email"
              :size="30"
              :alt="loggedInUser.nickname"
              default-img="mm"
            />
          </a-badge>
        </div>
      </a-menu-item>
    </a-menu>
  </a-layout-header>
</template>

<script>
export default {
  name: 'Header',
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
  // async fetch() {
  //   await this.$auth.fetchUser().then((response) => {
  //     if (response !== undefined) {
  //       this.loggedInUser = response.data.data
  //     } else {
  //       return {}
  //     }
  //   })
  // },
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
