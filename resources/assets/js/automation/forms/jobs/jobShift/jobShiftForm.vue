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
        <singleInput type="text" inputTitle="عنوان" v-model="data.title"></singleInput>
        <singleInput type="text" inputTitle="توضیحات" v-model="data.description"></singleInput>

       
         <datePicker inputTitle="تاریخ شروع" v-model="data.start"></datePicker>
 
           <datePicker inputTitle="تاریخ پایان" v-model="data.end"></datePicker>
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "jobShiftForm",
  data() {
    return {
      refreshPage: true,
      window: {
        headerid: "jobShiftForm",
        title: "ثبت شیفت کاری",
        titleLine: "منابع انسانی / کارگزینی / شیفت کاری",
      },
      submit: {
        buttonTitle: "ثبت",
        axiosUrl: "/api/v1/jobShiftRegister",
      },
      data: {
        title: "",
        description: "",
        start: "",
        end: "",
      },
    };
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
};
</script>

