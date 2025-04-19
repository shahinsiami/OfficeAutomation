const state = {
    loginToken: ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null),
    userType: [],
}
const getters = {}
const mutations = {
    userType(state, userType) {
        state.userType = userType
    },
    loginToken(state, loginToken) {
        state.loginToken = loginToken;
    },
}
const actions = {
    userType(context,permission) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/userType/'+permission)
                .then(response => {
                    const userType = response.data
                    context.commit('userType', userType)
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
    loginToken(context, credentials) {
        return new Promise((resolve, reject) => {
            axios.post('/api/login', {
                username: credentials.username,
                password: credentials.password,
            })
                .then(response => {
                    const loginToken = response.data.access_token
                    let expireDate = new Date;
                    expireDate.setTime(expireDate.getTime() + 8*60*60*1000);
                    // expireDate.toGMTString();
                    document.cookie =  "token=" + loginToken + ";path=/;expires=" + 0;
                    context.commit('loginToken', loginToken)
                    resolve(resolve)//
                })
                .catch(error => {
                    console.log(error)
                    reject(error)//
                })
        })
    },
    detroyToken(context) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.post('/api/v1/logout')
                .then(response => {
                    document.cookie =  "token= null"
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

