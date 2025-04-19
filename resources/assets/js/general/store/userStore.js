const state = {
    allPermissionsForUserRegister: [],
    userTable: [],
    selectUserEdit: [],
    userInfoTable: [],
    selectUserInfoEdit: [],
}
const getters = {}
const mutations = {
    allPermissionsForUserRegister(state, allPermissionsForUserRegister) {
        state.allPermissionsForUserRegister = allPermissionsForUserRegister
    },
    userTable(state, userTable) {
        state.userTable = userTable
    },
    selectUserEdit(state, selectUserEdit) {
        state.selectUserEdit = selectUserEdit
    },
    userInfoTable(state, userInfoTable) {
        state.userInfoTable = userInfoTable
    },
    selectUserInfoEdit(state, selectUserInfoEdit) {
        state.selectUserInfoEdit = selectUserInfoEdit
    },
}
const actions = {
    allPermissionsForUserRegister(context) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/allPermissionsForUserRegister')
                .then(response => {
                    const allPermissionsForUserRegister = response.data
                    context.commit('allPermissionsForUserRegister', allPermissionsForUserRegister)
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
    userTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/userTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const userTable = response.data
                    context.commit('userTable', userTable)
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
    selectUserEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectUserEdit/'+id)
                .then(response => {
                    const selectUserEdit = response.data
                    context.commit('selectUserEdit', selectUserEdit)
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
    userInfoTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/userInfoTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const userInfoTable = response.data
                    context.commit('userInfoTable', userInfoTable)
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
    selectUserInfoEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectUserInfoEdit/'+id)
                .then(response => {
                    const selectUserInfoEdit = response.data
                    context.commit('selectUserInfoEdit', selectUserInfoEdit)
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

