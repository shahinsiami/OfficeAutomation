const state = {
    degree: [{id: 1, name: 'دیپلم'}, {id: 2, name: 'فوق دیپلم'}, {id: 3, name: 'کارشناسی'}, {
        id: 4,
        name: 'کارشناسی ارشد'
    }, {id: 5, name: 'دکتری'}, {id: 6, name: 'فوق دکتری'}],
    letterSecurity: [{id: 1, name: 'عادی'}, {id: 2, name: 'محرمانه'}, {id: 3, name: 'فوق محرمانه'}],
    letterType: [{id: 1, name: 'پست'}, {id: 2, name: 'پیک'}, {id: 3, name: 'ایمیل'}, {id: 3, name: 'غیره'}],
    priority: [{id: 1, name: 'پایین'}, {id: 2, name: 'متوسط'}, {id: 3, name: 'زیاد'}, {id: 3, name: 'بسیار زیاد'}],
    sex: [{id: 0, name: 'زن'}, {id: 1, name: 'مرد'}],
    language:[],
    template:[],
    section:[{id: 1, name: 'اول'},{id: 2, name: 'دوم'},{id: 3, name: 'سوم'},{id: 4, name: 'چهارم'},{id: 5, name: 'ششم'},{id: 7, name: 'هفتم'},{id: 8, name: 'هشتم'},{id: 9, name: 'نهم'},{id: 10, name: 'دهم'},{id: 11, name: 'یازدهم'}]
}
const getters = {
}
const mutations = {
    language(state, language) {
        state.language = language;
    },
    template(state, template) {
        state.template = template;
    },

}
const actions = {
    language(context) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/language')
                .then(response => {
                    const language = response.data
                    context.commit('language', language)
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
    template(context) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + ((document.cookie.match('(^|;) ?token=([^;]*)(;|$)')) ?  document.cookie.match('(^|;) ?token=([^;]*)(;|$)')[2] :  null)
        return new Promise((resolve, reject) => {
            axios.get('api/v1/template')
                .then(response => {
                    const template = response.data
                    context.commit('template', template)
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

