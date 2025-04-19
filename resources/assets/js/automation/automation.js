require("../general/importModule");
import VueRouter from "vue-router";
Vue.use(VueRouter);
import Vuex from "vuex";
Vue.use(Vuex);
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
//component
Vue.component(
    "windowHeader",
    require("../general/component/windows/vpcWindowHeader").default
);
Vue.component(
    "windowTable",
    require("../general/component/dataTable/vpcWindowTable").default
);
Vue.component(
    "windowTableWithoutExcel",
    require("../general/component/dataTable/vpcWindowTableWithoutExcel").default
);
Vue.component(
    "simpleDataTable",
    require("../general/component/dataTable/simpleDataTable").default
);
Vue.component(
    "singleInput",
    require("../general/component/input/vpcSingleInput").default
);
Vue.component(
    "datePicker",
    require("../general/component/input/vpcDatePicker").default
);
Vue.component(
    "singleInputDisabled",
    require("../general/component/input/vpcSingleInputDisabled").default
);
Vue.component(
    "textareaInput",
    require("../general/component/input/vpcTextareaInput").default
);
Vue.component(
    "textareaInputDisabled",
    require("../general/component/input/vpcTextareaInputDisabled").default
);
Vue.component(
    "imageInput",
    require("../general/component/image/vpcImageInput").default
);
Vue.component(
    "submitBtn",
    require("../general/component/button/vpcSubmitBtn").default
);
Vue.component(
    "editBtn",
    require("../general/component/button/vpcEditBtn").default
);
Vue.component(
    "listSelector",
    require("../general/component/dropDown/vpcListSelector").default
);
Vue.component(
    "listMultiSelector",
    require("../general/component/dropDown/vpcListMultiSelector").default
);
Vue.component(
    "listSelectorBySelection",
    require("../general/component/dropDown/vpcListSelectorBySelection").default
);
Vue.component(
    "listSelectorOptional",
    require("../general/component/dropDown/vpcListSelectorOptional").default
);
Vue.component(
    "keyValueInput",
    require("../general/component/keyValue/vpcKeyValueInput").default
);
Vue.component(
    "multiChoiceInput",
    require("../general/component/multiSelect/vpcMultiChoiceInput").default
);
Vue.component(
    "colorInput",
    require("../general/component/multiSelect/vpcColorInput").default
);
Vue.component(
    "multiFiles",
    require("../general/component/files/vpcMultiFiles").default
);
Vue.component(
    "persianCalender",
    require("../general/component/calender/persianCalender").default
);
// component
/////////////////////////////////////////////////////////////////
import { gsap, TweenMax, TimelineMax } from "gsap";
import { ExpoScaleEase, RoughEase, SlowMo } from "gsap/EasePack";
import { CSSRulePlugin } from "gsap/CSSRulePlugin";
import { Draggable } from "gsap/Draggable";
import { EaselPlugin } from "gsap/EaselPlugin";
import { MotionPathPlugin } from "gsap/MotionPathPlugin";
import { PixiPlugin } from "gsap/PixiPlugin";
import { TextPlugin } from "gsap/TextPlugin";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { CustomEase } from "gsap/CustomEase";
gsap.registerPlugin(
    CSSRulePlugin,
    Draggable,
    EaselPlugin,
    MotionPathPlugin,
    PixiPlugin,
    TextPlugin,
    ScrollToPlugin,
    ScrollTrigger,
    CustomEase,
    ExpoScaleEase,
    RoughEase,
    SlowMo,
    TweenMax,
    TimelineMax
);
const gsapVpc = gsap;
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
//component
// component
/////////////////////////////////////////////////////////////////
//store
import mainStore from "../general/store/mainStore";
import profile from "../general/store/profile";
import authStore from "../general/store/authStore";
import calenderStore from "../general/store/calenderStore";
import userStore from "../general/store/UserStore";
import uiStore from "./ui/uiStore";
import wrapperStore from "./ui/wrapperStore";
import jobStore from "./store/automation/automationJobStore";
import secretaryStore from "./store/automation/automationSecretaryStore";
import ElrStore from "./store/automation/automationElrStore";
import ElsStore from "./store/automation/automationElsStore";
import IlsIlrStore from "./store/automation/automationIlsIlrStore";
import CelrElsStore from "./store/automation/automationCelrElsStore";
import RefferalStore from "./store/automation/automationRefferalStore";
import DlsDlrStore from "./store/automation/automationDlsDlrStore";
import MlsMlrStore from "./store/automation/automationMlsMlrStore";
import FlsFlrStore from "./store/automation/automationFlsFlrStore";
const store = new Vuex.Store({
    modules: {
        mainStore,
        userStore,
        authStore,
        calenderStore,
        wrapperStore,
        uiStore,
        ElrStore,
        IlsIlrStore,
        FlsFlrStore,
        jobStore,
        secretaryStore,
        calenderStore,
        ElsStore,
        CelrElsStore,
        RefferalStore,
        DlsDlrStore,
        MlsMlrStore,
        profile
    }
});
// store
/////////////////////////////////////////////////////////////////
//router
const routes = [
    {
        path: "/",
        name: "login",
        components: { login: require("./pages/loginpage").default }
    },
    {
        path: "/dashboard",
        name: "dashboard",
        meta: { adminAuth: true },
        components: {
            adminpanel: require("./pages/dashboard").default
        },

        children: [
            // //////////Users
            {
                path: "/usersForm",
                components: {
                    usersForm: require("./forms/users/user/usersForm").default
                },
                name: "usersForm"
            },
            {
                path: "/userEdit",
                components: {
                    userEdit: require("./forms/users/user/userEdit.vue").default
                },
                name: "userEdit"
            },
            {
                path: "/userTable",
                components: {
                    userTable: require("./forms/users/user/userTable.vue")
                        .default
                },
                name: "userTable"
            },
            //////////Users
            //////////UserInfo
            {
                path: "/userInfoTable",
                components: {
                    userInfoTable: require("./forms/users/userinfo/userInfoTable")
                        .default
                },
                name: "userInfoTable"
            },
            {
                path: "/userInfoEdit",
                components: {
                    userInfoEdit: require("./forms/users/userinfo/userInfoEdit.vue")
                        .default
                },
                name: "userInfoEdit"
            },
            // //////////UserInfo
             //////////jobClassification
             {
                path: '/jobClassificationForm',
                components: {jobClassificationForm : require('./forms/jobs/jobClassification/jobClassificationForm.vue').default},
                name: "jobClassificationForm"
            },
            {
                path: '/jobClassificationTable',
                components: {jobClassificationTable : require('./forms/jobs/jobClassification/jobClassificationTable.vue').default},
                  name: "jobClassificationTable"
            },
            {
                path: '/jobClassificationEdit',
                components: {jobClassificationEdit : require('./forms/jobs/jobClassification/jobClassificationEdit.vue').default},
                  name: "jobClassificationEdit"
            },
            //////////jobClassification
            //////////jobPosition
            {
                path: '/jobPositionForm',
                components: {jobPositionForm : require('./forms/jobs/jobPosition/jobPositionForm.vue').default},
                  name: "jobPositionForm"
            },
            {
                path: '/jobPositionTable',
                components: {jobPositionTable : require('./forms/jobs/jobPosition/jobPositionTable.vue').default},
                  name: "jobPositionTable"
            },
            {
                path: '/jobPositionEdit',
                components: {jobPositionEdit : require('./forms/jobs/jobPosition/jobPositionEdit.vue').default},
                  name: "jobPositionEdit"
            },
            //////////Job
            //////////JobShift
            {
                path: '/jobShiftForm',
                components: {jobShiftForm : require('./forms/jobs/jobShift/jobShiftForm.vue').default},
                  name: "jobShiftForm"
            },
            {
                path: '/jobShiftTable',
                components: {jobShiftTable : require('./forms/jobs/jobShift/jobShiftTable.vue').default},
                  name: "jobShiftTable"
            },
            {
                path: '/jobShiftEdit',
                components: {jobShiftEdit : require('./forms/jobs/jobShift/jobShiftEdit.vue').default},
                  name: "jobShiftEdit"
            },
            //////////JobShift
            //////////JobHierarchical
            {
                path: '/jobHierarchicalForm',
                components: {jobHierarchicalForm : require('./forms/jobs/jobHierarchical/jobHierarchicalForm.vue').default},
                  name: "jobHierarchicalForm"
            },
            {
                path: '/jobHierarchicalTable',
                components: {jobHierarchicalTable : require('./forms/jobs/jobHierarchical/jobHierarchicalTable.vue').default},
                  name: "jobHierarchicalTable"
            },
            {
                path: '/jobHierarchicalEdit',
                components: {jobHierarchicalEdit : require('./forms/jobs/jobHierarchical/jobHierarchicalEdit.vue').default},
                  name: "jobHierarchicalEdit"
            },
            //////////JobHierarchical
            //////////JobRuling
            {
                path: '/jobRulingForm',
                components: {jobRulingForm : require('./forms/jobs/jobRuling/jobRulingForm.vue').default},
                  name: "jobRulingForm"
            },
            {
                path: '/jobRulingTable',
                components: {jobRulingTable : require('./forms/jobs/jobRuling/jobRulingTable.vue').default},
                  name: "jobRulingTable"
            },
            {
                path: '/jobRulingEdit',
                components: {jobRulingEdit : require('./forms/jobs/jobRuling/jobRulingEdit.vue').default},
                  name: "jobRulingEdit"
            },
            //////////JobRuling
            //////////secretary
            {
                path: '/secretaryForm',
                components: {secretaryForm : require('./forms/secretary/secretary/secretaryForm.vue').default},
                  name: "secretaryForm"
            },
            {
                path: '/secretaryTable',
                components: {secretaryTable : require('./forms/secretary/secretary/secretaryTable.vue').default},
                  name: "secretaryTable"
            },
            {
                path: '/secretaryEdit',
                components: {secretaryEdit : require('./forms/secretary/secretary/secretaryEdit.vue').default},
                  name: "secretaryEdit"
            },
            //////////secretary
            //////////secretaryPort
            {
                path: '/secretaryPortForm',
                components: {secretaryPortForm : require('./forms/secretary/secretaryPort/secretaryPortForm.vue').default},
                  name: "secretaryPortForm"
            },
            {
                path: '/secretaryPortTable',
                components: {secretaryPortTable : require('./forms/secretary/secretaryPort/secretaryPortTable.vue').default},
                  name: "secretaryPortTable"
            },
            {
                path: '/secretaryPortEdit',
                components: {secretaryPortEdit : require('./forms/secretary/secretaryPort/secretaryPortEdit.vue').default},
                  name: "secretaryPortEdit"
            },
            //////////secretaryPort
            //////////document
            {
                path: '/documentForm',
                components: {documentForm : require('./forms/secretary/document/documentForm.vue').default},
                  name: "documentForm"
            },
            {
                path: '/documentTable',
                components: {documentTable : require('./forms/secretary/document/documentTable.vue').default},
                  name: "documentTable"
            },
            {
                path: '/documentEdit',
                components: {documentEdit : require('./forms/secretary/document/documentEdit.vue').default},
                  name: "documentEdit"
            },
            //////////document
            //////////elrEls
            {
                path: '/elrTable',
                components: {elrTable : require('./forms/elrEls/elrTable').default},
                  name: "elrTable"
            },
            {
                path: '/elsTable',
                components: {elsTable : require('./forms/elrEls/elsTable').default},
                  name: "elsTable"
            },
            {
                path: '/elrForm',
                components: {elrForm : require('./forms/elrEls/elrForm').default},
                  name: "elrForm"
            },
            {
                path: '/elsForm',
                components: {elsForm : require('./forms/elrEls/elsForm').default},
                  name: "elsForm"
            },
            {
                path: '/elsEdit',
                components: {elsEdit : require('./forms/elrEls/elsEdit').default},
                  name: "elsEdit"
            },
            {
                path: '/elrEdit',
                components: {elrEdit : require('./forms/elrEls/elrEdit').default},
                  name: "elrEdit"
            },
            //////////elrEls
            //////////ils
            {
                path: '/ilsFrom',
                components: {ilsFrom : require('./forms/ils/ilsFrom').default},
                  name: "ilsFrom"
            },
            {
                path: '/ilsTable',
                components: {ilsTable : require('./forms/ils/ilsTable').default},
                  name: "ilsTable"
            },
            {
                path: '/ilrTable',
                components: {ilrTable : require('./forms/ils/ilrTable').default},
                  name: "ilrTable"
            },
            {
                path: '/ilrView',
                components: {ilrView : require('./forms/ils/ilrView').default},
                  name: "ilrView"
            },
            //////////ils
            //////////cElrEls
            {
                path: '/cElrTable',
                components: {cElrTable : require('./forms/CelrEls/cElrTable').default},
                  name: "cElrTable"
            },
            {
                path: '/cElrView',
                components: {cElrView : require('./forms/CelrEls/cElrView').default},
                  name: "cElrView"
            },
            {
                path: '/cElsTable',
                components: {cElsTable : require('./forms/CelrEls/cElsTable').default},
                  name: "cElsTable"
            },
            {
                path: '/cElsView',
                components: {cElsView : require('./forms/CelrEls/cElsView').default},
                  name: "cElsView"
            },
            //////////cElrEls
            //////////rls
            {
                path: '/rlsIlView',
                components: {rlsIlView : require('./forms/rlsRlr/Il/rlsIlView').default},
                  name: "rlsIlView"
            },
            {
                path: '/rlsElView',
                components: {rlsElView : require('./forms/rlsRlr/El/rlsElView').default},
                  name: "rlsElView"
            },
            {
                path: '/rlsDlView',
                components: {rlsDlView : require('./forms/rlsRlr/Dl/rlsDlView').default},
                  name: "rlsDlView"
            },
            {
                path: '/rlsIlTable',
                components: {rlsIlTable : require('./forms/rlsRlr/Il/rlsIlTable').default},
                  name: "rlsIlTable"
            },
            {
                path: '/rlrIlTable',
                components: {rlrIlTable : require('./forms/rlsRlr/Il/rlrIlTable').default},
                  name: "rlrIlTable"
            },
            {
                path: '/rlsElTable',
                components: {rlsElTable : require('./forms/rlsRlr/El/rlsElTable').default},
                  name: "rlsElTable"
            },
            {
                path: '/rlrElTable',
                components: {rlrElTable : require('./forms/rlsRlr/El/rlrElTable').default},
                  name: "rlrElTable"
            },
            {
                path: '/rlsDlTable',
                components: {rlsDlTable : require('./forms/rlsRlr/Dl/rlsDlTable').default},
                  name: "rlsDlTable"
            },
            {
                path: '/rlrDlTable',
                components: {rlrDlTable : require('./forms/rlsRlr/Dl/rlrDlTable').default},
                  name: "rlrDlTable"
            },
            {
                path: '/rlsIlForm',
                components: {rlsIlForm : require('./forms/rlsRlr/Il/rlsIlForm').default},
                  name: "rlsIlForm"
            },
            {
                path: '/rlsElrForm',
                components: {rlsElrForm : require('./forms/rlsRlr/El/rlsElrForm').default},
                  name: "rlsElrForm"
            },
            {
                path: '/rlsElsForm',
                components: {rlsElsForm : require('./forms/rlsRlr/El/rlsElsForm').default},
                  name: "rlsElsForm"
            },
            {
                path: '/rlsDlForm',
                components: {rlsDlForm : require('./forms/rlsRlr/Dl/rlsDlForm').default},
                  name: "rlsDlForm"
            },
            //////////cElrEls
            //////////rls
            {
                path: '/dlsForm',
                components: {dlsForm : require('./forms/dlsDlr/dlsForm').default},
                  name: "dlsForm"
            },
            {
                path: '/dlsTable',
                components: {dlsTable : require('./forms/dlsDlr/dlsTable').default},
                  name: "dlsTable"
            },
            {
                path: '/dlrTable',
                components: {dlrTable : require('./forms/dlsDlr/dlrTable').default},
                  name: "dlrTable"
            },
            {
                path: '/dlrView',
                components: {dlrView : require('./forms/dlsDlr/dlrView').default},
                  name: "dlrView"
            },
            //////////cElrEls
            //////////rlsRlr
            {
                path: '/flsTable',
                components: {flsTable : require('./forms/flsFlr/flsTable.vue').default},
                  name: "flsTable"
            },
            {
                path: '/flrView',
                components: {flrView : require('./forms/flsFlr/flrView').default},
                  name: "flrView"
            },
            {
                path: '/flrTable',
                components: {flrTable : require('./forms/flsFlr/flrTable').default},
                  name: "flrTable"
            },
            {
                path: '/flsForm',
                components: {flsForm : require('./forms/flsFlr/flsForm').default},
                  name: "flsForm"
            },
            {
                path: '/flrForm',
                components: {flrForm : require('./forms/flsFlr/flrForm').default},
                  name: "flrForm"
            },
            //////////rlsRlr
            //////////mlsMlr
            {
                path: '/mlsForm',
                components: {mlsForm : require('./forms/mlstMlr/mlsForm.vue').default},
                  name: "mlsForm"
            },
            {
                path: '/mlsTable',
                components: {mlsTable : require('./forms/mlstMlr/mlsTable').default},
                  name: "mlsTable"
            },
            {
                path: '/mlrView',
                components: {mlrView : require('./forms/mlstMlr/mlrView').default},
                  name: "mlrView"
            },
            {
                path: '/mlrTable',
                components: {mlrTable : require('./forms/mlstMlr/mlrTable').default},
                  name: "mlrTable"
            },
            //////////mlsMlr
            //////////dashboard
            {
                path: "/calender",
                components: {
                    calender: require("./dashboard/calender.vue")
                        .default
                },
                name: "calender"
            },
            {
                path: "/profile",
                components: {
                    profile: require("./dashboard/profile.vue")
                        .default
                },
                name: "profile"
            },
            //////////dashboard
        ]
    }
];
const Router = new VueRouter({
    routes
});
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
// nprogress
import NProgress from "nprogress";
Router.afterEach((to, from) => {
    NProgress.done();
});
Router.beforeResolve((to, from, next) => {
    if (to.name) {
        NProgress.start();
    }
    next();
});
Router.afterEach((to, from) => {
    NProgress.done();
});
axios.interceptors.request.use(
    function(config) {
        NProgress.start();
        return config;
    },
    function(error) {
        console.error(error);
        return Promise.reject(error);
    }
);
axios.interceptors.response.use(
    function(response) {
        NProgress.done();
        return response;
    },
    function(error) {
        console.error(error);
        return Promise.reject(error);
    }
);
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
// beforeeach
Router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.adminAuth)) {
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " +
                (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
                    ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
                    : null);
            axios
                .get("api/userType/administrator")
                .then(response => {
                    return next();
                    resolve(resolve);
                })
                .catch(error => {
                    return next({
                        path: "/"
                    });
                    reject(error);
                });
        });
    } else {
        next();
    }
});
/////////////////////////////////////////////////////////////////
//instance
const app = new Vue({
    el: "#panel",
    data: {
        gsapVpc
    },
    router: Router,
    store,
    props: {}

    //instance
});
