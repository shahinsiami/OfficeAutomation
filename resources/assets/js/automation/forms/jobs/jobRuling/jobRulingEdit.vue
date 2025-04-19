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
          :lastValue="data.job_shift_id"
          @selectid=" data.job_shift_id = $event"
        ></listMultiSelector>
        <listMultiSelector
          listName="موقعیت شغلی"
          selectedItem="name"
          listSource="jobPositionForJobRuling"
          :getSource="this.$store.state.jobStore.jobPositionForJobRuling"
          :lastValue="this.last_job_position_id"
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
  name: "jobRulingEdit",
  data() {
    return {
      refreshPage: true,
      window: {
        headerid: "jobRulingEdit",
        title: "ویرایش حکم کارگزینی",
        titleLine: "منابع انسانی / کارگزینی / حکم کارگزینی",
        clearStore: ["jobStore", "selectjobRulingEdit"],
      },
      edit: {
        buttonTitle: "ویرایش",
        axiosUrl: "/api/v1/editjobRuling/",
        response: "selectjobRulingEdit",
      },
      data: {
        start_date: "",
        end_date: "",
        user_id: "",
        job_position_id: "",
        job_shift_id: "",
      },
    };
  },
  //model
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.jobStore.selectjobRulingEdit.id) {
          return this.$store.state.jobStore.selectjobRulingEdit.id;
        } else {
          return "";
        }
      },
    },
    last_start_date: {
      get() {
        return this.$store.state.jobStore.selectjobRulingEdit.start_date;
      },
    },
    last_end_date: {
      get() {
        return this.$store.state.jobStore.selectjobRulingEdit.end_date;
      },
    },
    last_user_id: {
      get() {
        if (this.$store.state.jobStore.selectjobRulingEdit.user) {
          return this.$store.state.jobStore.selectjobRulingEdit.user.userinfo.id;
        }
      },
    },
    last_job_position_id: {
      get() {
        if (this.$store.state.jobStore.selectjobRulingEdit.user) {
          return this.$store.state.jobStore.selectjobRulingEdit.user.user_job_position
        } else {
          return "[]";
        }
      },
    },
    last_job_shift_id: {
      get() {
        if (this.$store.state.jobStore.selectjobRulingEdit.user) {
          return this.$store.state.jobStore.selectjobRulingEdit.user.user_job_shift
        } else {
          return "[]";
        }
      },
    },
  },
  //compute
  //watch
  watch: {
    lastId: function () {
      this.data.id = this.lastId;
    },
    last_start_date: function () {
      this.data.start_date = this.last_start_date;
    },
    last_end_date: function () {
      this.data.end_date = this.last_end_date;
    },
    last_user_id: function () {
      this.data.user_id = this.last_user_id;
    },
    last_job_position_id: function () {
      this.data.job_position_id = this.last_job_position_id;
    },
    last_job_shift_id: function () {
      this.data.job_shift_id = this.last_job_shift_id;
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

