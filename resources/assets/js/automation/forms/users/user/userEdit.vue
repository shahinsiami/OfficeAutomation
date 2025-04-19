<template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center">
        <editBtn
          @needRefresh="this.refresh"
          :responseDispatch="this.edit.response"
          :axiosUrl="this.edit.axiosUrl"
          :formData="this.data"
          :buttonTitle="this.edit.buttonTitle"
        ></editBtn>
      </div>
      <div class="col-6">
        <windowHeader :windowTitle="this.window.title" :windowTitleLine="this.window.titleLine"></windowHeader>
      </div>
    </div>
    <div v-if="lastId == '' || !this.refreshPage" class="vpc_loader">
      <div class="vpc_loader_img">
        <img width="300" height="300" src="photo/module/Panel/forms/loader.gif" />
      </div>
    </div>
    <div v-if="lastId !== '' && this.refreshPage" class="container-fluid">
      <div class="row" style="direction:rtl">
                                                <singleInput type='text' inputTitle="نام کاربری"
                                                             v-model="data.name"></singleInput>
                                                <singleInput type='password' inputTitle="گذر واژه"
                                                             v-model="data.password"></singleInput>
                                                <singleInput type='password' inputTitle="تکرار گذر واژه"
                                                             v-model="password.confirm"></singleInput>
                                                 <listMultiSelector
                                                listName="مجوز"
                                                selectedItem="name"
                                                listSource="allPermissionsForUserRegister"
                                                :getSource="this.$store.state.userStore.allPermissionsForUserRegister"
                                                :lastValue="this.data.permission"
                                                @selectid=" data.permission = $event"
                                                ></listMultiSelector>
                                            </div>
                                        </div>
                                        <!---->
                                    </div>
</template>
<style scoped>
</style>
<script>
    export default {
        name: 'userEdit',
        data() {
            return {
                refreshPage: true,
                window: {
                    headerid: 'userEdit',
                    title: "ویرایش کاربر",
                    titleLine: "ویرایش اطلاعات",
                },
                edit: {
                    buttonTitle: 'ویرایش',
                    axiosUrl: '/api/v1/editUser/',
                    response: 'selectUserEdit',
                },
                password: {
                    confirm: ''
                },
                data: {
                    name: '',
                    password: '',
                    status: '1',
                    permission: ''
                }
            }
        },
        //model
        //compute
        computed: {
            minimizeRight: {
                get() {
                    return 'right:' + (15 * this.$store.state.mainStore.minnumber.indexOf(this.$options.name)) + '% !important'
                },
            },
            lastId: {
                get() {
                    if (this.$store.state.userStore.selectUserEdit.id){
                    return this.$store.state.userStore.selectUserEdit.id
                    }else {
                        return ''
                    }
                }
            },
            lastName: {
                get() {
                    return this.$store.state.userStore.selectUserEdit.name
                },
            },
            lastStatus: {
                get() {
                    return this.$store.state.userStore.selectUserEdit.status
                },
            },
            lastPermission: {
                get() {
                    if (this.$store.state.userStore.selectUserEdit.user_permission){
                    return this.$store.state.userStore.selectUserEdit.user_permission
                    }else {
                        return ''
                    }
                },
            },

        },
        //compute
        //watch
        watch: {
            lastId: function () {
                this.data.id = this.lastId
            },
            lastName: function () {
                this.data.name = this.lastName
            },
            lastStatus: function () {
                this.data.status = this.lastStatus
            },
            lastPermission: function () {
                this.data.permission = this.lastPermission
            },
        },
        //watch
        //method
  methods: {
    refresh() {
      (this.refreshPage = false),
        setTimeout(() => {
          this.refreshPage = true;
        }, 800);
    },
  },
  //method
        created() {

        }
    }
</script>

