const state = {
    rightMenuItem: {
        user: {
            permission: ["administrator"],
            icon: "usersIcon",
            name: "کاربران",
            items: [
                {
                    name: "کاربران",
                    itemsCollapse: "userMenu",
                    subItems: [
                        {
                            id: "usersForm",
                            name: "ثبت کاربران"
                        },
                        {
                            id: "userTable",
                            name: "کاربران"
                        },
                        {
                            display: "none",
                            id: "userEdit",
                            name: "ویرایش کاربر "
                        }
                    ]
                },
                {
                    name: "مشخصات",
                    itemsCollapse: "userInfoMenu",
                    subItems: [
                        {
                            id: "userInfoTable",
                            name: "مشخصات کاربران"
                        },
                        {
                            display: "none",
                            id: "userInfoEdit",
                            name: "ویرایش کاربر "
                        }
                    ]
                }
            ]
        },

        jobs: {
            icon: "humanResourceIcon",
            permission: ["administrator", "humanResource"],
            name: "منابع انسانی",
            items: [
                {
                    name: "کارگزینی",
                    itemsCollapse: "employmentMenu",
                    subItems: [
                        {
                            subSubItems: [
                                {
                                    name: "گروه شغلی",
                                    subItemsCollapse: "jobClassificationForm",
                                    subSubItems: [
                                        {
                                            id: "jobClassificationForm",
                                            name: "ثبت گروه شغلی"
                                        },
                                        {
                                            id: "jobClassificationTable",
                                            name: "گروه های شغلی"
                                        },
                                        {
                                            display: "none",
                                            id: "jobClassificationEdit",
                                            name: "ویرایش گروه شغلی"
                                        }
                                    ]
                                },
                                {
                                    name: "رده سازمانی",
                                    subItemsCollapse: "jobHierarchical",
                                    subSubItems: [
                                        {
                                            id: "jobHierarchicalForm",
                                            name: "ثبت رده سازمانی"
                                        },
                                        {
                                            id: "jobHierarchicalTable",
                                            name: "رده های سازمانی"
                                        },
                                        {
                                            display: "none",
                                            id: "jobHierarchicalEdit",
                                            name: "ویرایش رده سازمانی"
                                        }
                                    ]
                                },
                                {
                                    name: "عنوان شغلی",
                                    subItemsCollapse: "job",
                                    subSubItems: [
                                        {
                                            id: "jobPositionForm",
                                            name: "ثبت عنوان شغلی"
                                        },
                                        {
                                            id: "jobPositionTable",
                                            name: "عنوان های شغلی"
                                        },
                                        {
                                            display: "none",
                                            id: "jobPositionEdit",
                                            name: "ویرایش عنوان شغلی"
                                        }
                                    ]
                                },
                                {
                                    name: "شیفت کاری",
                                    subItemsCollapse: "jobShift",
                                    subSubItems: [
                                        {
                                            id: "jobShiftForm",
                                            name: "ثبت شیفت کاری"
                                        },
                                        {
                                            id: "jobShiftTable",
                                            name: "شیفت های کاری"
                                        },
                                        {
                                            display: "none",
                                            id: "jobShiftEdit",
                                            name: "ویرایش شیفت کاری"
                                        }
                                    ]
                                },
                                {
                                    name: "حکم کارگزینی",
                                    subItemsCollapse: "jobRuling",
                                    subSubItems: [
                                        {
                                            id: "jobRulingForm",
                                            name: "ثبت حکم کارگزینی"
                                        },
                                        {
                                            id: "jobRulingTable",
                                            name: "حکم های کارگزینی"
                                        },
                                        {
                                            display: "none",
                                            id: "jobRulingEdit",
                                            name: "ویرایش حکم کارگزینی"
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        secretary: {
            permission: ["administrator", "secretaryHead"],
            icon: "secretaryIcon",
            name: "دبیرخانه",
            items: [
                {
                    name: "مرکز پیام",
                    itemsCollapse: "secretaryMenu",
                    subItems: [
                        {
                            id: "secretaryForm",
                            name: "ثبت مرکز پیام"
                        },
                        {
                            id: "secretaryTable",
                            name: "مراکز پیام"
                        },
                        {
                            display: "none",
                            id: "secretaryEdit",
                            name: "ویرایش مرکزپیام"
                        }
                    ]
                },
                {
                    name: "درگاه",
                    itemsCollapse: "secretaryPortMenu",
                    subItems: [
                        {
                            id: "secretaryPortForm",
                            name: "ثبت درگاه"
                        },
                        {
                            id: "secretaryPortTable",
                            name: "درگاه ها"
                        },
                        {
                            display: "none",
                            id: "secretaryPortEdit",
                            name: "ویرایش درگاه"
                        }
                    ]
                },
                {
                    name: "اسناد و گواهی نامه",
                    itemsCollapse: "document",
                    subItems: [
                        {
                            id: "documentForm",
                            name: "ثبت اسناد"
                        },
                        {
                            id: "documentTable",
                            name: "اسناد"
                        },
                        {
                            display: "none",
                            id: "documentEdit",
                            name: "ویرایش سند"
                        }
                    ]
                }
            ]
        },

        elrEls: {
            permission: ["administrator", "secretariat"],
            icon: "elrEls",
            name: "نامه خارجی",
            items: [
                {
                    name: "ثبت نامه خارجی",
                    itemsCollapse: "elrElsForm",
                    subItems: [
                        {
                            id: "elrForm",
                            name: "ثبت نامه دریافتی"
                        },
                        {
                            id: "elsForm",
                            name: "ثبت نامه ارسالی"
                        }
                    ]
                },
                {
                    name: "نامه های خارجی",
                    itemsCollapse: "elrElsTable",
                    subItems: [
                        {
                            id: "elrTable",
                            name: "نامه های خارجی دریافتی"
                        },
                        {
                            display: "none",
                            id: "elrEdit",
                            name: "ویرایش نامه خارجی دریافتی"
                        },
                        {
                            id: "elsTable",
                            name: "نامه های خارجی ارسالی"
                        },
                        {
                            display: "none",
                            id: "elsEdit",
                            name: "ویرایش نامه خارجی ارسالی"
                        }
                    ]
                }
            ]
        },

        lettersDossier: {
            permission: ["administrator", "secretariat", "employee"],
            icon: "lettersDossierIcon",
            name: "کارتابل",
            items: [
                {
                    name: "نامه های داخلی",
                    itemsCollapse: "lettersReceive",
                    subItems: [
                        {
                            id: "ilsFrom",
                            name: "ثبت نامه داخلی"
                        },
                        {
                            id: "ilsTable",
                            name: "نامه های داخلی ارسالی"
                        },
                        {
                            id: "ilrTable",
                            name: " نامه های داخلی دریافتی"
                        },
                        {
                            display: "none",
                            id: "ilrView",
                            name: "مشاهده نامه داخلی"
                        }
                    ]
                },
                {
                    name: "نامه های خارجی",
                    itemsCollapse: "lettersSent",
                    subItems: [
                        {
                            id: "cElrTable",
                            name: "نامه های خارجی دریافتی"
                        },
                        {
                            id: "cElsTable",
                            name: "نامه های خارجی ارسالی"
                        },
                        {
                            display: "none",
                            id: "cElrView",
                            name: "مشاهده نامه خارجی دریافتی"
                        },
                        {
                            display: "none",
                            id: "cElsView",
                            name: "مشاهده نامه خارجی ارسالی"
                        }
                    ]
                },

                {
                    name: "ارجاعات",
                    itemsCollapse: "rlsrlr",
                    subItems: [
                        {
                            subSubItems: [
                                {
                                    name: "ارجاعات ارسالی",
                                    subItemsCollapse: "rlsTable",
                                    subSubItems: [
                                        {
                                            id: "rlsIlTable",
                                            name: "نامه های داخلی ارجاع کرده"
                                        },
                                        {
                                            id: "rlsElTable",
                                            name: "نامه های خارجی ارجاع کرده"
                                        },
                                        {
                                            id: "rlsDlTable",
                                            name: "پیشنویس های ارجاع کرده"
                                        },
                                        //
                                        {
                                            display: "none",
                                            id: "rlsDlForm",
                                            name: "ثبت پیش نویس ارجاعی"
                                        },
                                        {
                                            display: "none",
                                            id: "rlsDlView",
                                            name: "مشاهده پیش نویس ارجاعی"
                                        },
                                        {
                                            display: "none",
                                            id: "rlsElrForm",
                                            name: "ثبت نامه ارجاعی خارجی"
                                        },
                                        {
                                            display: "none",
                                            id: "rlsElsForm",
                                            name: "ثبت نامه ارجاعی خارجی"
                                        },
                                        {
                                            display: "none",
                                            id: "rlsElView",
                                            name:"مشاهده نامه خارجی ارجاعی کرده"
                                        },
                                        {
                                            display: "none",
                                            id: "rlsIlForm",
                                            name: "ثبت نامه ارجاعی داخلی"
                                        },
                                        {
                                            display: "none",
                                            id: "rlsIlView",
                                            name: "مشاهده نامه داخلی ارجاع کرده"
                                        }
                                        //
                                    ]
                                },

                                {
                                    name: "ارجاعات دریافتی",
                                    subItemsCollapse: "rlrTable",
                                    subSubItems: [
                                        {
                                            id: "rlrIlTable",
                                            name: "نامه های داخلی ارجاع شده"
                                        },
                                        {
                                            id: "rlrElTable",
                                            name: "نامه های خارجی ارجاع شده"
                                        },
                                        {
                                            id: "rlrDlTable",
                                            name: " پیش نویس های ارجاع شده"
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        draftsDossier: {
            permission: ["administrator", "secretariat", "employee"],
            icon: "draftsDossierIcon",
            name: "پیش نویس",
            items: [
                {
                    name: "پیش نویس ها",
                    itemsCollapse: "draftsDossierMenu",
                    subItems: [
                        {
                            id: "dlsForm",
                            name: "ثبت پیش نویس"
                        },
                        {
                            id: "dlsTable",
                            name: "پیش نویس های ارسالی"
                        },
                        {
                            id: "dlrTable",
                            name: "پیش نویس های دریافتی"
                        },
                        {
                            display: "none",
                            id: "dlrView",
                            name: "مشاهده پیش نویس"
                        }
                    ]
                }
            ]
        },

        faxDossier: {
            permission: ["administrator", "secretariat", "employee"],
            icon: "faxDossierIcon",
            name: "فکس",
            items: [
                {
                    name: "کارتابل فکس ها",
                    itemsCollapse: "faxDossierMenu",
                    subItems: [
                        {
                            id: "flsForm",
                            name: "ثبت فکس ارسالی"
                        },
                        {
                            id: "flrForm",
                            name: "ثبت فکس دریافتی"
                        },
                        {
                            id: "flrTable",
                            name: "فکس های دریافتی"
                        },
                        {
                            id: "flsTable",
                            name: "فکس های ارسالی"
                        },
                        {
                            display: "none",
                            id: "flrView",
                            name: "مشاهده فکس"
                        }
                    ]
                }
            ]
        },

        messageDessoire: {
            permission: ["administrator", "secretariat", "employee"],
            icon: "messageDessoireIcon",
            name: "پیام",
            items: [
                {
                    name: "کارتابل پیام ها",
                    itemsCollapse: "messageDessoireMenu",
                    subItems: [
                        {
                            id: "mlsForm",
                            name: "ثبت پیام"
                        },
                        {
                            id: "mlsTable",
                            name: "پیام های ارسالی"
                        },
                        {
                            id: "mlrTable",
                            name: "پیام های دریافتی"
                        },
                        {
                            display: "none",
                            id: "mlrView",
                            name: "مشاهده پیام"
                        }
                    ]
                }
            ]
        },

        calender: {
            permission: ["administrator"],
            dontShow: "none",
            icon: "commentIcon",
            name: "تقویم",
            items: [
                {
                    name: "تقویم",
                    itemsCollapse: "clender",
                    subItems: [
                        {
                            id: "calender",
                            name: "جلالی"
                        }
                    ]
                },
                {
                    name: "پروفایل",
                    itemsCollapse: "profile",
                    subItems: [
                        {
                            id: "profile",
                            name: "پروفایل"
                        }
                    ]
                }
            ]
        }
    },
    upSidePush: []
};
const getters = {};
const mutations = {
    upSidePush(state, upSidePush) {
        if (!state.upSidePush.find(obj => obj.route == upSidePush.route)) {
            state.upSidePush.push(upSidePush);
        }
    },
    upSidePull(state, upSidePull) {
        let item = state.upSidePush.indexOf(
            state.upSidePush.find(obj => obj.route == upSidePull)
        );
        state.upSidePush.splice(item, 1);
    }
};
const actions = {
    upSidePush(context, upSidePush) {
        context.commit("upSidePush", upSidePush);
    },
    upSidePull(context, upSidePull) {
        context.commit("upSidePull", upSidePull);
    }
};
export default {
    state,
    mutations,
    actions,
    getters
};
