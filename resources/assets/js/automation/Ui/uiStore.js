const state = {
    rightSide: false,
    leftSide: false,    
}
const getters = {
}
const mutations = {
    rightSide(state, rightSide) {
        state.rightSide = rightSide
    },
    leftSide(state, leftSide) {
        state.leftSide = leftSide
    },
}
const actions = {
    rightSide(context, rightSide) {
        context.commit('rightSide', rightSide)
    },
    leftSide(context, leftSide) {
        context.commit('leftSide', leftSide)
    },
}

export default {
    state, mutations, actions, getters
}

