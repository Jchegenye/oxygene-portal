export default async function ({ app, $auth, redirect }) {
  const role = await $auth.user.data.role_id
  if (app.$auth.loggedIn && role !== 4) {
    return redirect('/')
  }
}
