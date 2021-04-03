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
          v-if="loggedInUser.role_id === 4"
          mode="inline"
          :default-selected-keys="['1']"
          :default-open-keys="['sub1']"
          style="height: 100%"
        >
          <a-sub-menu key="sub1">
            <span slot="title"><a-icon type="user" />Procurment</span>
            <a-menu-item key="1"> Supplier Application </a-menu-item>
          </a-sub-menu>
        </a-menu>
      </a-layout-sider>
      <a-layout-content :style="{ padding: '0 24px', minHeight: '280px' }">
        Content
      </a-layout-content>
    </a-layout>
  </a-layout-content>
</template>

<script>
export default {
  name: 'ClientDashboard',
  middleware: ['auth', 'client'],
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
}
</script>
