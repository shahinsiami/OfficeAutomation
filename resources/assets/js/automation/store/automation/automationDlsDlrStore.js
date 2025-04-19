const state = {
    allUserForDls: [],
    dlsTable: [],
    dlrTable: [],
    selectDls: [],
    allDocumentForDls: [],
}
const getters = {}
const mutations = {
    allUserForDls(state, allUserForDls) {
        state.allUserForDls = allUserForDls
    },
    dlsTable(state, dlsTable) {
        state.dlsTable = dlsTable
    },
    dlrTable(state, dlrTable) {
        state.dlrTable = dlrTable
    },
    selectDls(state, selectDls) {
        state.selectDls = selectDls
    },
    allDocumentForDls(state, allDocumentForDls) {
        state.allDocumentForDls = allDocumentForDls
    },

}
const actions = {
    allUserForDls(context, data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ? document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] : null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/allUserForDls', form)
                .then(response => {
                    const allUserForDls = response.data
                    context.commit('allUserForDls', allUserForDls)
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
    dlsTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order', data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ? document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] : null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/dlsTable' + '?page=' + data.pageNum, form)
                .then(response => {
                    const dlsTable = response.data
                    context.commit('dlsTable', dlsTable)
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
    dlrTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order', data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ? document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] : null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/dlrTable' + '?page=' + data.pageNum, form)
                .then(response => {
                    const dlrTable = response.data
                    context.commit('dlrTable', dlrTable)
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
    selectDls(context, id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ? document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] : null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectDls/' + id)
                .then(response => {
                    const selectDls = response.data
                    context.commit('selectDls', selectDls)
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
    allDocumentForDls(context, data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ? document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] : null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/allDocumentForDls', form)
                .then(response => {
                    const allDocumentForDls = response.data
                    context.commit('allDocumentForDls', allDocumentForDls)
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


}


export default {
    state, mutations, actions, getters
}

