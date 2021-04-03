<template>
  <main>
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
            <NuxtLink to="/login">login</NuxtLink>
            <NuxtLink to="/register">register now</NuxtLink>
          </template>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  name: 'Lounge',
  layout: 'base',
  auth: 'guest',
}
</script>
