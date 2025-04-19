const state = {
    secretaryTable: [],
    selectSecretaryEdit: [],
    secretaryPortTable: [],
    selectSecretaryPortEdit: [],
    allSecretaryForSecretaryPort: [],
    documentTable: [],
    selectDocumentEdit: [],
}
const getters = {}
const mutations = {
    secretaryTable(state, secretaryTable) {
        state.secretaryTable = secretaryTable
    },
    selectSecretaryEdit(state, selectSecretaryEdit) {
        state.selectSecretaryEdit = selectSecretaryEdit
    },
    secretaryPortTable(state, secretaryPortTable) {
        state.secretaryPortTable = secretaryPortTable
    },
    selectSecretaryPortEdit(state, selectSecretaryPortEdit) {
        state.selectSecretaryPortEdit = selectSecretaryPortEdit
    },
    allSecretaryForSecretaryPort(state, allSecretaryForSecretaryPort) {
        state.allSecretaryForSecretaryPort = allSecretaryForSecretaryPort
    },
    documentTable(state, documentTable) {
        state.documentTable = documentTable
    },
    selectDocumentEdit(state, selectDocumentEdit) {
        state.selectDocumentEdit = selectDocumentEdit
    },
    documentAttachmentTable(state, documentAttachmentTable) {
        state.documentAttachmentTable = documentAttachmentTable
    },
    selectDocumentAttachmentEdit(state, selectDocumentAttachmentEdit) {
        state.selectDocumentAttachmentEdit = selectDocumentAttachmentEdit
    },
    allDocumentForDocumentAttachment(state, allDocumentForDocumentAttachment) {
        state.allDocumentForDocumentAttachment = allDocumentForDocumentAttachment
    },


}
const actions = {
    secretaryTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/secretaryTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const secretaryTable = response.data
                    context.commit('secretaryTable', secretaryTable)
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
    selectSecretaryEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectSecretaryEdit/'+id)
                .then(response => {
                    const selectSecretaryEdit = response.data
                    context.commit('selectSecretaryEdit', selectSecretaryEdit)
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
    secretaryPortTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/secretaryPortTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const secretaryPortTable = response.data
                    context.commit('secretaryPortTable', secretaryPortTable)
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
    selectSecretaryPortEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectSecretaryPortEdit/'+id)
                .then(response => {
                    const selectSecretaryPortEdit = response.data
                    context.commit('selectSecretaryPortEdit', selectSecretaryPortEdit)
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
    allSecretaryForSecretaryPort(context) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/allSecretaryForSecretaryPort')
                .then(response => {
                    const allSecretaryForSecretaryPort = response.data
                    context.commit('allSecretaryForSecretaryPort', allSecretaryForSecretaryPort)
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
    documentTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/documentTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const documentTable = response.data
                    context.commit('documentTable', documentTable)
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
    selectDocumentEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectDocumentEdit/'+id)
                .then(response => {
                    const selectDocumentEdit = response.data
                    context.commit('selectDocumentEdit', selectDocumentEdit)
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

