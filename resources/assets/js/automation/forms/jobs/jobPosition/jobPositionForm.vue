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
        <singleInput type="text" inputTitle="عنوان شغلی" v-model="data.name"></singleInput>
        <listSelector
          selectedItem="name"
          listName="گروه شغلی"
          listSource="jobClassificationForJob"
          :getSource="this.$store.state.jobStore.jobClassificationForJob"
          :lastValue="data.job_classification_id"
          @selectid=" data.job_classification_id = $event.id "
        ></listSelector>
        <listSelector
              selectedItem="name"
          listName="رتبه سازمانی"
          listSource="jobHierrachicalForJob"
          :getSource="this.$store.state.jobStore.jobHierrachicalForJob"
          :lastValue="data.job_hierarchical_id"
          @selectid=" data.job_hierarchical_id = $event.id "
        ></listSelector>
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "jobPositionForm",
  data() {
    return {
      refreshPage: true,
      window: {
        headerid: "jobPositionForm",
        title: "ثبت عنوان شغلی",
        titleLine: "منابع انسانی / کارگزینی / عنوان شغلی",
      },
      submit: {
        buttonTitle: "ثبت",
        axiosUrl: "/api/v1/jobPositionRegister",
      },
      data: {
        name: "",
        job_classification_id: [],
        job_hierarchical_id: [],
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

