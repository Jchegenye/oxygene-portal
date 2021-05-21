const state = () => ({
  list: [],
})

const mutations = {
  FETCH_NATIONALITIES(state, list) {
    state.list = list
  },
}

const actions = {
  async fetchNationalities(store) {
    const res = await this.$axios.get('nationalities')
    store.commit('FETCH_NATIONALITIES', res.data)
  },
}

export default {
  state,
  mutations,
  actions,
}
