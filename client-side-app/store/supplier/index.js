const state = () => ({
  number: '',
})

const mutations = {
  FETCH_SUPPLIER_NUMBER(state, number) {
    state.number = number
  },
}

const actions = {
  async fetchSupplierNumber(store) {
    const res = await this.$axios.get('supplier/number')
    store.commit('FETCH_SUPPLIER_NUMBER', res.data)
  },
}

export default {
  state,
  mutations,
  actions,
}
