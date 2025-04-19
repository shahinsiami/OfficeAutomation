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
  name: "jobShiftEdit",
  data() {
    return {
      refreshPage: true,
      window: {
        headerid: "jobShiftEdit",
        title: "ویرایش شیفت کاری",
        titleLine: "منابع انسانی / کارگزینی / شیفت کاری",
      },
      edit: {
        buttonTitle: "ویرایش",
        axiosUrl: "/api/v1/editjobShift/",
        response: "selectjobShiftEdit",
      },
      data: {
        title: "",
        description: "",
        start: "",
        end: "",
      },
    };
  },
  //model
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.jobStore.selectjobShiftEdit.id) {
          return this.$store.state.jobStore.selectjobShiftEdit.id;
        } else {
          return "";
        }
      },
    },
    lastTitle: {
      get() {
        return this.$store.state.jobStore.selectjobShiftEdit.title;
      },
    },
    lastDescription: {
      get() {
        return this.$store.state.jobStore.selectjobShiftEdit.description;
      },
    },
    lastStart: {
      get() {
        return this.$store.state.jobStore.selectjobShiftEdit.start;
      },
    },
    lastEnd: {
      get() {
        return this.$store.state.jobStore.selectjobShiftEdit.end;
      },
    },
  },
  //compute
  //watch
  watch: {
    lastId: function () {
      this.data.id = this.lastId;
    },
    lastTitle: function () {
      this.data.title = this.lastTitle;
    },
    lastDescription: function () {
      this.data.description = this.lastDescription;
    },
    lastStart: function () {
      this.data.start = this.lastStart;
    },
    lastEnd: function () {
      this.data.end = this.lastEnd;
    },
  },
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

