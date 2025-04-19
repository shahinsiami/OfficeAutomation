<template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center">
        <submitBtn  v-if="password.confirm == data.password && data.password !== ''"
          :refresh="true"
          @needRefresh="this.refresh"
          :axiosUrl="this.submit.axiosUrl"
          :formData="this.data"
          :buttonTitle="this.submit.buttonTitle"
        ></submitBtn>
      </div>
      <div class="col-6">
        <windowHeader :windowTitle="this.window.title" :windowTitleLine="this.window.titleLine"></windowHeader>
      </div>
    </div>
    <div v-if="!this.refreshPage" class="vpc_loader">
      <div class="vpc_loader_img">
        <img width="300" height="300" src="photo/module/Panel/forms/loader.gif" />
      </div>
    </div>
    <div v-if="this.refreshPage" class="container-fluid">
      <div class="row" style="direction:rtl">
                                                <singleInput type='text' inputTitle="نام کاربری"
                                                             v-model="data.name"></singleInput>
                                                <singleInput type='text' inputTitle="گذر واژه"
                                                             v-model="data.password"></singleInput>
                                                <singleInput type='text' inputTitle="تکرار گذر واژه"
                                                             v-model="password.confirm"></singleInput>
                                                <listMultiSelector
                                                listName="مجوز"
                                                selectedItem="name"
                                                listSource="allPermissionsForUserRegister"
                                                :getSource="this.$store.state.userStore.allPermissionsForUserRegister"
                                                :lastValue="[]"
                                                @selectid=" data.permission = $event"
                                                ></listMultiSelector>
                                                <br>
                                            </div>
                                        </div>
                          
                                    </div>
            
 
</template>
<style scoped>
</style>
<script>
    export default {
        name: 'usersForm',
        data() {
            return {
                refreshPage: true,
                window: {
                    headerid: 'usersForm',
                    title: "ثبت کاربر",
                    titleLine: "کاربر جدید"

                },
                submit: {
                    buttonTitle: 'ثبت',
                    axiosUrl: '/api/v1/userRegister',
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
        //method
        methods: {
    refresh() {
      this.refreshPage = false;
      for (let key in this.data) {
        this.data[key] = "";
      }
      setTimeout(() => {
        this.refreshPage = true;
      }, 1000);
    },
  },
        //method
        created() {

        }
    }
</script>

