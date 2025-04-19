const state = {
    allUserForElr: [],
    managementUserForElr: [],
    allDocumentForElr: [],
    allGateForElr: [],
    elrTable: [],
    selectElrEdit: [],

}
const getters = {}
const mutations = {
    allUserForElr(state, allUserForElr) {
        state.allUserForElr = allUserForElr
    },
    managementUserForElr(state, managementUserForElr) {
        state.managementUserForElr = managementUserForElr
    },
    allDocumentForElr(state, allDocumentForElr) {
        state.allDocumentForElr = allDocumentForElr
    },
    allGateForElr(state, allGateForElr) {
        state.allGateForElr = allGateForElr
    },
    elrTable(state, elrTable) {
        state.elrTable = elrTable
    },
    selectElrEdit(state, selectElrEdit) {
        state.selectElrEdit = selectElrEdit
    },
}
const actions = {
    allUserForElr(context,data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/allUserForElr',form)
                .then(response => {
                    const allUserForElr = response.data
                    context.commit('allUserForElr', allUserForElr)
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
    managementUserForElr(context,data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/managementUserForElr',form)
                .then(response => {
                    const managementUserForElr = response.data
                    context.commit('managementUserForElr', managementUserForElr)
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
    allDocumentForElr(context,data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/allDocumentForElr',form)
                .then(response => {
                    const allDocumentForElr = response.data
                    context.commit('allDocumentForElr', allDocumentForElr)
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
    allGateForElr(context,data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/allGateForElr')
                .then(response => {
                    const allGateForElr = response.data
                    context.commit('allGateForElr', allGateForElr)
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
    elrTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/elrTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const elrTable = response.data
                    context.commit('elrTable', elrTable)
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
    selectElrEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectElrEdit/'+id)
                .then(response => {
                    const selectElrEdit = response.data
                    context.commit('selectElrEdit', selectElrEdit)
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

