export default async function ({ app, $auth, redirect }) {
  const role = await $auth.user.data.role_id
  const verified = await $auth.user.data.verified
  if (app.$auth.loggedIn && !verified) {
    return redirect('/profile')
  } else if (app.$auth.loggedIn && role !== 2) {
    return redirect('/')
  }
}
// export default function ({ $auth, redirect }) {
//   console.log($auth.user[0].hasScope(2))
//   if (!$auth.hasScope(2)) {
//     return redirect('/')
//   }
// }
