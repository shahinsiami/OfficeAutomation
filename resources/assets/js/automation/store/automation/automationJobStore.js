const state = {
    jobClassificationTable: [],
    selectjobClassificationEdit: [],
    //
    jobPositionTable: [],
    selectJobPositionEdit: [],
    jobClassificationForJob: [],
    jobHierrachicalForJob: [],
    //
    jobShiftTable: [],
    selectjobShiftEdit: [],
    //
    jobRulingTable: [],
    selectjobRulingEdit: [],
    //
    employeeForJobRuling: [],
    shiftForJobRuling: [],
    jobPositionForJobRuling: [],
    //
    jobHierarchicalTable: [],
    selectjobHierarchicalEdit: [],
}
const getters = {}
const mutations = {
    jobClassificationTable(state, jobClassificationTable) {
        state.jobClassificationTable = jobClassificationTable
    },
    selectjobClassificationEdit(state, selectjobClassificationEdit) {
        state.selectjobClassificationEdit = selectjobClassificationEdit
    },
    //
    jobPositionTable(state, jobPositionTable) {
        state.jobPositionTable = jobPositionTable
    },
    selectJobPositionEdit(state, selectJobPositionEdit) {
        state.selectJobPositionEdit = selectJobPositionEdit
    },
    jobClassificationForJob(state, jobClassificationForJob) {
        state.jobClassificationForJob = jobClassificationForJob
    },
    jobHierrachicalForJob(state, jobHierrachicalForJob) {
        state.jobHierrachicalForJob = jobHierrachicalForJob
    },
    //
    jobShiftTable(state, jobShiftTable) {
        state.jobShiftTable = jobShiftTable
    },
    selectjobShiftEdit(state, selectjobShiftEdit) {
        state.selectjobShiftEdit = selectjobShiftEdit
    },
    //
    jobRulingTable(state, jobRulingTable) {
        state.jobRulingTable = jobRulingTable
    },
    selectjobRulingEdit(state, selectjobRulingEdit) {
        state.selectjobRulingEdit = selectjobRulingEdit
    },
    //
    employeeForJobRuling(state, employeeForJobRuling) {
        state.employeeForJobRuling = employeeForJobRuling
    },
    shiftForJobRuling(state, shiftForJobRuling) {
        state.shiftForJobRuling = shiftForJobRuling
    },
    jobPositionForJobRuling(state, jobPositionForJobRuling) {
        state.jobPositionForJobRuling = jobPositionForJobRuling
    },
    jobHierarchicalTable(state, jobHierarchicalTable) {
        state.jobHierarchicalTable = jobHierarchicalTable
    },
    selectjobHierarchicalEdit(state, selectjobHierarchicalEdit) {
        state.selectjobHierarchicalEdit = selectjobHierarchicalEdit
    },
}
const actions = {
    jobClassificationTable(context, data) {
        const form = new FormData()
        form.append("search", data.searchName);
        form.append("searchColumn", data.searchColumn);
        form.append("order", data.order);
        form.append("name", data.name);
        form.append("startDate", data.startDate);
        form.append("endDate", data.endDate);
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/jobClassificationTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const jobClassificationTable = response.data
                    context.commit('jobClassificationTable', jobClassificationTable)
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
    selectjobClassificationEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectjobClassificationEdit/'+id)
                .then(response => {
                    const selectjobClassificationEdit = response.data
                    context.commit('selectjobClassificationEdit', selectjobClassificationEdit)
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
    //
    jobHierarchicalTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/jobHierarchicalTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const jobHierarchicalTable = response.data
                    context.commit('jobHierarchicalTable', jobHierarchicalTable)
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
    selectjobHierarchicalEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectjobHierarchicalEdit/'+id)
                .then(response => {
                    const selectjobHierarchicalEdit = response.data
                    context.commit('selectjobHierarchicalEdit', selectjobHierarchicalEdit)
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
    //
    jobPositionTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/jobPositionTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const jobPositionTable = response.data
                    context.commit('jobPositionTable', jobPositionTable)
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
    selectJobPositionEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectJobPositionEdit/'+id)
                .then(response => {
                    const selectJobPositionEdit = response.data
                    context.commit('selectJobPositionEdit', selectJobPositionEdit)
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
    jobClassificationForJob(context,data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/jobClassificationForJob',form)
                .then(response => {
                    const jobClassificationForJob = response.data
                    context.commit('jobClassificationForJob', jobClassificationForJob)
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
    jobHierrachicalForJob(context) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/jobHierrachicalForJob')
                .then(response => {
                    const jobHierrachicalForJob = response.data
                    context.commit('jobHierrachicalForJob', jobHierrachicalForJob)
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
    //
    jobShiftTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/jobShiftTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const jobShiftTable = response.data
                    context.commit('jobShiftTable', jobShiftTable)
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
    selectjobShiftEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectjobShiftEdit/'+id)
                .then(response => {
                    const selectjobShiftEdit = response.data
                    context.commit('selectjobShiftEdit', selectjobShiftEdit)
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
    //
    jobRulingTable(context, data) {
        const form = new FormData()
        form.append('search', data.searchName)
        form.append('searchColumn', data.searchColumn)
        form.append('order',data.order)
        form.append('name', data.name)
        form.append('startDate', data.startDate)
        form.append('endDate', data.endDate)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/jobRulingTable' + '?page=' + data.pageNum,form)
                .then(response => {
                    const jobRulingTable = response.data
                    context.commit('jobRulingTable', jobRulingTable)
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
    selectjobRulingEdit(context,id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/selectjobRulingEdit/'+id)
                .then(response => {
                    const selectjobRulingEdit = response.data
                    context.commit('selectjobRulingEdit', selectjobRulingEdit)
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
    employeeForJobRuling(context,data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/employeeForJobRuling',form)
                .then(response => {
                    const employeeForJobRuling = response.data
                    context.commit('employeeForJobRuling', employeeForJobRuling)
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
    shiftForJobRuling(context,data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/shiftForJobRuling',form)
                .then(response => {
                    const shiftForJobRuling = response.data
                    context.commit('shiftForJobRuling', shiftForJobRuling)
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
    jobPositionForJobRuling(context,data) {
        const form = new FormData()
        form.append('searchName', data.searchName)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('api/v1/jobPositionForJobRuling',form)
                .then(response => {
                    const jobPositionForJobRuling = response.data
                    context.commit('jobPositionForJobRuling', jobPositionForJobRuling)
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

