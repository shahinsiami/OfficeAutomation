<template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center">
        <submitBtn
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
        <singleInput type="text" inputTitle="نام سند" v-model="data.name"></singleInput>
        <singleInput type="text" inputTitle="شناسه ثبت" v-model="data.registration_number"></singleInput>
        <textareaInput type="text" inputTitle="توضیحات" v-model="data.description"></textareaInput>
        <multiFiles @files="data.file = $event"></multiFiles>
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "documentForm",
  data() {
    return {
      refreshPage: true,
      window: {
        headerid: "documentForm",
        title: "ثبت اسناد",
                      titleLine: "دبیر خانه/ اسناد ومدارک / ثبت اسناد",
      },
      submit: {
        buttonTitle: "ثبت",
        axiosUrl: "/api/v1/documentRegister",
      },
      data: {
        name: "",
        description: "",
        registration_number: "",
        file: "",
      },
    };
  },
  //model
  methods: {
    refresh() {
      (this.refreshPage = false),
        setTimeout(() => {
          this.refreshPage = true;
        }, 800);
    },
  },
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
  created() {},
};
</script>

