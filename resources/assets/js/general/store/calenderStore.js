const state = {
    userCalender: [],
    allUserForCalender: [],
    selectTodo: [],
}
const getters = {}
const mutations = {
    userCalender(state, userCalender) {
        state.userCalender = userCalender
    },
    allUserForCalender(state, allUserForCalender) {
        state.allUserForCalender = allUserForCalender
    },
    selectTodo(state, selectTodo) {
        state.selectTodo = selectTodo
    },

}
const actions = {
    userCalender(context, data) {
        const form = new FormData()
        form.append('selectYear', data.selectYear)
        form.append('selectMonth', data.selectMonth)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ? document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] : null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/userCalender', form)
                .then(response => {
                    const userCalender = response.data
                    context.commit('userCalender', userCalender)
                    resolve(resolve)//
                })
                .catch(error => {
                    return {
                        'type': 'error',
                        'title': 'عملیات با خطلا 1501',
                        'text': 'لطفا با پشتیبانی ارتباط برقرار کنید'
                    }
                    reject(error)
                })
        })
    },
    allUserForCalender(context, data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ? document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] : null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/allUserForCalender')
                .then(response => {
                    const allUserForCalender = response.data
                    context.commit('allUserForCalender', allUserForCalender)
                    resolve(resolve)//
                })
                .catch(error => {
                    return {
                        'type': 'error',
                        'title': 'عملیات با خطلا 1501',
                        'text': 'لطفا با پشتیبانی ارتباط برقرار کنید'
                    }
                    reject(error)
                })
        })
    },
    selectTodo(context, data) {
        context.commit('selectTodo', data)
    },

}
export default {
    state, mutations, actions, getters
}

