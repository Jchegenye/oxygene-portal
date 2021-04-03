<template>
  <a-layout-content style="padding: 0 50px">
    <a-breadcrumb style="margin: 16px 0">
      <a-breadcrumb-item>Home</a-breadcrumb-item>
      <a-breadcrumb-item>User</a-breadcrumb-item>
      <a-breadcrumb-item>Profile</a-breadcrumb-item>
    </a-breadcrumb>
    <a-layout style="padding: 24px 0; background: #fff">
      <a-layout-sider
        v-if="loggedInUser.verified"
        width="200"
        style="background: #fff"
      >
        <a-menu
          mode="inline"
          :default-selected-keys="['1']"
          :default-open-keys="['sub1']"
          style="height: 100%"
        >
          <a-sub-menu key="sub1">
            <span slot="title"><a-icon type="user" />subnav 1</span>
            <a-menu-item key="1"> option1 </a-menu-item>
            <a-menu-item key="2"> option2 </a-menu-item>
            <a-menu-item key="3"> option3 </a-menu-item>
            <a-menu-item key="4"> option4 </a-menu-item>
          </a-sub-menu>
        </a-menu>
      </a-layout-sider>

      <a-layout-content :style="{ padding: '0 24px', minHeight: '280px' }">
        <div v-if="!loggedInUser.verified" class="" role="alert">
          Before proceeding, please check your email for a verification link. If
          you did not receive the email,
          <button class="" @click="resendVerificationEmail">
            click here to request another</button
          >.
        </div>

        <div class="mt-6">loggedInUser: {{ loggedInUser }}</div>
      </a-layout-content>
    </a-layout>
  </a-layout-content>
</template>

<script>
export default {
  middleware: 'auth',
  data() {
    return {
      loggedInUser: this.$auth.user.data,
    }
  },
  async fetch() {
    await this.$auth
      .fetchUser()
      .then((response) => (this.loggedInUser = response.data.data))
  },
  methods: {
    async resendVerificationEmail() {
      await this.$axios
        .$post('verify-email/resend')
        .then(() => {
          this.$toast.success(
            'A fresh verification link has been sent to your email address.'
          )
        })
        .catch((e) => {
          this.$toast.error(e.response.data.message)
        })
    },
  },
}
</script>
