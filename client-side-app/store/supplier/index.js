const state = () => ({
  supplierNumber: '',
})

const mutations = {
  FETCH_SUPPLIER_NUMBER(state, supplierNumber) {
    state.supplierNumber = supplierNumber
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
