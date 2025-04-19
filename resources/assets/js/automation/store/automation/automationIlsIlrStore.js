const state = {
    allUserForIlrIls: [],
    ilrTable: [],
    selectIlr: [],
    ilsTable: [],
    allDocumentForIls: [],

}
const getters = {}
const mutations = {
    allUserForIlrIls(state, allUserForIlrIls) {
        state.allUserForIlrIls = allUserForIlrIls
    },
    ilrTable(state, ilrTable) {
        state.ilrTable = ilrTable
    },
    selectIlr(state, selectIlr) {
        state.selectIlr = selectIlr
    },
    ilsTable(state, ilsTable) {
        state.ilsTable = ilsTable
    },
    allDocumentForIls(state, allDocumentForIls) {
        state.allDocumentForIls = allDocumentForIls
    },

}
const actions = {
    allUserForIlrIls(context,data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/allUserForIlrIls',form)
                .then(response => {
                    const allUserForIlrIls = response.data
                    context.commit('allUserForIlrIls', allUserForIlrIls)
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
    ilrTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/ilrTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const ilrTable = response.data
                    context.commit('ilrTable', ilrTable)
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
    selectIlr(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectIlr/'+id)
                .then(response => {
                    const selectIlr = response.data
                    context.commit('selectIlr', selectIlr)
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
    ilsTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/ilsTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const ilsTable = response.data
                    context.commit('ilsTable', ilsTable)
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
    allDocumentForIls(context, data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ? document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] : null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/allDocumentForIls', form)
                .then(response => {
                    const allDocumentForIls = response.data
                    context.commit('allDocumentForIls', allDocumentForIls)
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

