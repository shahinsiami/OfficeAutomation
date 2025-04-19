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
        <singleInput type="number" inputTitle="درجه رتبه" v-model="data.rank"></singleInput>
        <singleInput type="text" inputTitle="نام رتبه" v-model="data.name"></singleInput>
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "jobHierarchicalEdit",
  data() {
    return {
      refreshPage: true,
      window: {
        headerid: "jobHierarchicalEdit",
        title: "ویرایش رتبه سازمانی",
        titleLine: "منابع انسانی / کارگزینی / رده سازمانی",
  
      },
      edit: {
        buttonTitle: "ویرایش",
        axiosUrl: "/api/v1/editjobHierarchical/",
        response: "selectjobHierarchicalEdit",
      },
      data: {
        name: "",
        rank: "",
      },
    };
  },
  //model
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.jobStore.selectjobHierarchicalEdit.id) {
          return this.$store.state.jobStore.selectjobHierarchicalEdit.id;
        } else {
          return "";
        }
      },
    },
    lastName: {
      get() {
        return this.$store.state.jobStore.selectjobHierarchicalEdit.name;
      },
    },
    lastRank: {
      get() {
        return this.$store.state.jobStore.selectjobHierarchicalEdit.rank;
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
    lastRank: function () {
      this.data.rank = this.lastRank;
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

