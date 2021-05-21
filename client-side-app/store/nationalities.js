const state = () => ({
    nationality: '',
})
  
const mutations = {
    FETCH_NATIONALITIES(state, nationality) {
        state.nationality = nationality
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
  