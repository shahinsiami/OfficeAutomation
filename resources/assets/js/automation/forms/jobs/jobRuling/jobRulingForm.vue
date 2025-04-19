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
        <listSelector
          selectedItem="name"
          selectedItemTwo="family"
          listName="کارمند"
          listSource="employeeForJobRuling"
          :getSource="this.$store.state.jobStore.employeeForJobRuling"
          :lastValue="data.user_id"
          @selectid=" data.user_id = $event.id "
        ></listSelector>
        <listMultiSelector
          listName="شیفت کاری"
          selectedItem="title"
          listSource="shiftForJobRuling"
          :getSource="this.$store.state.jobStore.shiftForJobRuling"
          :lastValue="[]"
          @selectid=" data.job_shift_id = $event"
        ></listMultiSelector>
        <listMultiSelector
          listName="موقعیت شغلی"
          selectedItem="name"
          listSource="jobPositionForJobRuling"
          :getSource="this.$store.state.jobStore.jobPositionForJobRuling"
          :lastValue="[]"
          @selectid=" data.job_position_id = $event"
        ></listMultiSelector>
        <datePicker inputTitle="تاریخ شروع" v-model="data.start_date"></datePicker>
        <datePicker inputTitle="تاریخ پایان" v-model="data.end_date"></datePicker>
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "jobRulingForm",
  data() {
    return {
      refreshPage: true,
      window: {
        headerid: "jobRulingForm",
        title: "ثبت حکم کاگزینی",
        titleLine: "منابع انسانی / کارگزینی / حکم کارگزینی",
      },
      submit: {
        buttonTitle: "ثبت",
        axiosUrl: "/api/v1/jobRulingRegister",
      },
      data: {
        start_date: "",
        end_date: "",
        user_id: "",
        job_position_id: "[]",
        job_shift_id: "[]",
      },
    };
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
};
</script>

