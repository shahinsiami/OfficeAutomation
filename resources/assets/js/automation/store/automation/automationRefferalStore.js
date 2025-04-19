const state = {
    newrlsIlForm: false,
    newrlsElForm: false,
    newrlsDlForm: false,
    allUserForrls: [],
    rlsIlTable: [],
    rlrIlTable: [],
    SelectRlsIl: [],
    rlrElTable: [],
    rlsElTable: [],
    SelectRlsEl: [],
    rlrDlTable: [],
    rlsDlTable: [],
    SelectRlsDl: [],


}
const getters = {}
const mutations = {
    allUserForrls(state, allUserForrls) {
        state.allUserForrls = allUserForrls
    },
    rlsIlTable(state, rlsIlTable) {
        state.rlsIlTable = rlsIlTable
    },
    rlrIlTable(state, rlrIlTable) {
        state.rlrIlTable = rlrIlTable
    },
    SelectRlsIl(state, SelectRlsIl) {
        state.SelectRlsIl = SelectRlsIl
    },
    rlrElTable(state, rlrElTable) {
        state.rlrElTable = rlrElTable
    },
    rlsElTable(state, rlsElTable) {
        state.rlsElTable = rlsElTable
    },
    SelectRlsEl(state, SelectRlsEl) {
        state.SelectRlsEl = SelectRlsEl
    },
    rlrDlTable(state, rlrDlTable) {
        state.rlrDlTable = rlrDlTable
    },
    rlsDlTable(state, rlsDlTable) {
        state.rlsDlTable = rlsDlTable
    },
    SelectRlsDl(state, SelectRlsDl) {
        state.SelectRlsDl = SelectRlsDl
    },

}
const actions = {
    allUserForrls(context,data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/allUserForrls',form)
                .then(response => {
                    const allUserForrls = response.data
                    context.commit('allUserForrls', allUserForrls)
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
    rlsIlTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/rlsIlTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const rlsIlTable = response.data
                    context.commit('rlsIlTable', rlsIlTable)
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
    rlrIlTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/rlrIlTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const rlrIlTable = response.data
                    context.commit('rlrIlTable', rlrIlTable)
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
    SelectRlsIl(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/SelectRlsIl/'+id)
                .then(response => {
                    const SelectRlsIl = response.data
                    context.commit('SelectRlsIl', SelectRlsIl)
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
    rlrElTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/rlrElTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const rlrElTable = response.data
                    context.commit('rlrElTable', rlrElTable)
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
    rlsElTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/rlsElTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const rlsElTable = response.data
                    context.commit('rlsElTable', rlsElTable)
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
    SelectRlsEl(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/SelectRlsEl/'+id)
                .then(response => {
                    const SelectRlsEl = response.data
                    context.commit('SelectRlsEl', SelectRlsEl)
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
    rlrDlTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/rlrDlTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const rlrDlTable = response.data
                    context.commit('rlrDlTable', rlrDlTable)
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
    rlsDlTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/rlsDlTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const rlsDlTable = response.data
                    context.commit('rlsDlTable', rlsDlTable)
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
    SelectRlsDl(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/SelectRlsDl/'+id)
                .then(response => {
                    const SelectRlsDl = response.data
                    context.commit('SelectRlsDl', SelectRlsDl)
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

