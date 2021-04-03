<template>
  <a-layout-content style="padding: 0 50px">
    <a-breadcrumb style="margin: 16px 0">
      <a-breadcrumb-item>Home</a-breadcrumb-item>
      <a-breadcrumb-item>User</a-breadcrumb-item>
      <a-breadcrumb-item>Profile</a-breadcrumb-item>
    </a-breadcrumb>
    <a-layout style="padding: 24px 0; background: #fff">
      <a-layout-sider width="200" style="background: #fff">
        <a-menu
          mode="inline"
          :default-selected-keys="['1']"
          :default-open-keys="['sub1']"
          style="height: 100%"
        >
          <a-sub-menu key="sub1">
            <span slot="title"><a-icon type="user" />Settings</span>
            <a-menu-item key="1">My account</a-menu-item>
          </a-sub-menu>
        </a-menu>
      </a-layout-sider>
      <a-layout-content :style="{ padding: '0 24px', minHeight: '280px' }">
        <div>
          <a-alert
            v-if="!loggedInUser.verified"
            message="Account Verification"
            description="Before proceeding, please check your email for a verification link. If you did not receive the email,"
            type="info"
            show-icon
          />
          <a-button
            type="primary"
            class="mt-2"
            @click="resendVerificationEmail"
          >
            click here to request another
          </a-button>
        </div>
      </a-layout-content>
    </a-layout>
  </a-layout-content>
</template>
<script>
export default {
  name: 'Profile',
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
    async resendVerificationEmail() {
      await this.$axios
        .$post('verify-email/resend')
        .then(() => {
          this.$notification.info({
            message: 'Notification',
            description:
              'A fresh verification link has been sent to your email address.',
            placement: 'bottom',
          })
        })
        .catch((e) => {
          this.$toast.error(e.response.data.message)
        })
    },
  },
}
</script>
