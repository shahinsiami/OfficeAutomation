const state = {
    cElrTable: [],
    cElsTable: [],
    selectcElrView: [],
    selectcElsView: [],


}
const getters = {}
const mutations = {
    cElrTable(state, cElrTable) {
        state.cElrTable = cElrTable
    },
    selectcElrView(state, selectcElrView) {
        state.selectcElrView = selectcElrView
    },
    cElsTable(state, cElsTable) {
        state.cElsTable = cElsTable
    },
    selectcElsView(state, selectcElsView) {
        state.selectcElsView = selectcElsView
    },

}
const actions = {
    cElrTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/cElrTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const cElrTable = response.data
                    context.commit('cElrTable', cElrTable)
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
    cElsTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/cElsTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const cElsTable = response.data
                    context.commit('cElsTable', cElsTable)
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
    selectcElrView(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectcElrView/'+id)
                .then(response => {
                    const selectcElrView = response.data
                    context.commit('selectcElrView', selectcElrView)
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
    selectcElsView(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectcElsView/'+id)
                .then(response => {
                    const selectcElsView = response.data
                    context.commit('selectcElsView', selectcElsView)
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

