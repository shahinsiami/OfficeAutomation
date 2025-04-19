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
        <singleInput type="text" inputTitle="عنوان شغلی" v-model="data.name"></singleInput>
        <listSelector
          selectedItem="name"
          listName="گروه شغلی"
          listSource="jobClassificationForJob"
          :getSource="this.$store.state.jobStore.jobClassificationForJob"
          :lastValue="this.$store.state.jobStore.selectJobPositionEdit.job_classification"
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
    <!---->
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "jobPositionEdit",
  data() {
    return {
      window: {
        refreshPage: true,
        headerid: "jobPositionEdit",
        title: "ویرایش عنوان شغلی",
        titleLine: "منابع انسانی / کارگزینی / عنوان شغلی",
      },
      edit: {
        buttonTitle: "ویرایش",
        axiosUrl: "/api/v1/editjobPosition/",
        response: "selectJobPositionEdit",
      },
      data: {
        id: "",
        name: "",
        job_classification_id: "",
        job_hierarchical_id: "",
      },
    };
  },
  //model
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.jobStore.selectJobPositionEdit.id) {
          return this.$store.state.jobStore.selectJobPositionEdit.id;
        } else {
          return "";
        }
      },
    },
    lastName: {
      get() {
        return this.$store.state.jobStore.selectJobPositionEdit.name;
      },
    },
    last_job_classification_id: {
      get() {
        return this.$store.state.jobStore.selectJobPositionEdit
          .job_classification;
      },
    },
    last_job_hierarchical_id: {
      get() {
        return this.$store.state.jobStore.selectJobPositionEdit
          .job_hierarchical_id;
      },
    },
  },
  //compute
  //watch
  watch: {
    lastId: function () {
      this.data.id = this.lastId;
    },
    lastName: function () {
      this.data.name = this.lastName;
    },
    last_job_classification_id: function () {
      if (this.last_job_classification_id) {
        this.data.job_classification_id = this.last_job_classification_id.id;
      }
    },
    last_job_hierarchical_id: function () {
      this.data.job_hierarchical_id = this.last_job_hierarchical_id;
    },
  },
  //watch
  //methods
  methods: {
    //refresh
    refresh() {
      (this.refreshPage = false),
        setTimeout(() => {
          this.refreshPage = true;
        }, 800);
    },
    //refresh
  },
  //methods
};
</script>

