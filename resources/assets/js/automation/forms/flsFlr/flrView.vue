<template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center">
        <!-- <editBtn
          @needRefresh="this.refresh"
          :responseDispatch="this.edit.response"
          :axiosUrl="this.edit.axiosUrl"
          :formData="this.data"
          :buttonTitle="this.edit.buttonTitle"
        ></editBtn>-->
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
      <div style="direction:rtl">
        <div class="row">
          <div class="d-flex flex-row w-100 justify-content-start align-items-center vpc_nav">
            <div
              @click="showTab1"
              v-bind:class="[
                                this.tab1 ? 'vpc_nav_item_selected' : ''
                            ]"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >اطلاعات</div>
            <div
              @click="showTab2"
              v-bind:class="[
                                this.tab2 ? 'vpc_nav_item_selected' : ''
                            ]"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >محتوا</div>
          </div>
        </div>
        <!---->
        <div
          class="row"
          v-bind:class="[
                        this.tab1 ? '' : 'vpc_nav_item_selected_form'
                    ]"
        >
          <singleInputDisabled type="text" inputTitle="فرستنده" v-model="data.to"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="گیرنده" v-model="data.to"></singleInputDisabled>
          <!-- <div class="label-input" v-if="data.status === 0">ارسال نشده</div>
          <div class="label-input" v-if="data.status === 1">ارسال شده</div>-->
        </div>
        <div
          class="row"
          v-bind:class="[
                        this.tab2 ? '' : 'vpc_nav_item_selected_form'
                    ]"
        >
          <singleInputDisabled type="text" inputTitle="عنوان" v-model="data.title"></singleInputDisabled>
          <simpleDataTable :getData="this.lastAttachmentList"></simpleDataTable>
        </div>
        <!--tabTwoflsView-->
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
::-webkit-scrollbar {
  width: 3px;
  height: 3px;
}
::-webkit-scrollbar-track {
  background: #f1f1f1;
}
::-webkit-scrollbar-thumb {
  background: #f1f1f1;
}
::-webkit-scrollbar-thumb:hover {
  background: #bdbdbd;
}
.vpc_nav_item_selected_form {
  display: none;
}
</style>
<script>
export default {
  name: "flrView",
  data() {
    return {
      tab1: true,
      tab2: false,
      refreshPage: true,
      window: {
        headerid: "flrView",
        title: "فکس ثبت شده",
        titleLine: "فکس",
        titleLine: "کارتابل فکس / مشاهده فکس دریافتی",
      },
      data: {
        to: "",
        status: "",
        //
        title: "",
        context: "",
      },
    };
  },
  //model
  //method
  methods: {
    refresh() {
      (this.refreshPage = false),
        setTimeout(() => {
          this.refreshPage = true;
        }, 800);
    },
    // refresh
    showTab1() {
      this.tab1 = true;
      this.tab2 = false;
      this.tab3 = false;
      this.tab4 = false;
      this.tab5 = false;
    },
    showTab2() {
      this.tab1 = false;
      this.tab2 = true;
      this.tab3 = false;
      this.tab4 = false;
      this.tab5 = false;
    },
  },
  //method
  //watch
  watch: {
    lastId: function () {
      this.data.id = this.lastId;
    },
    lastTo: function () {
      this.data.to = this.lastTo;
    },
    lastFrom: function () {
      this.data.to = this.lastFrom;
    },
    latstTitle: function () {
      this.data.title = this.latstTitle;
    },
    latstStatus: function () {
      this.data.status = this.latstStatus;
    },
  },
  //watch
  //compute
  computed: {
    getUserInfo: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return (
            this.$store.state.profile.getUserInfo.name +
            "  " +
            this.$store.state.profile.getUserInfo.family
          );
        } else {
          return "";
        }
      },
    },
    lastId: {
      get() {
        if (this.$store.state.FlsFlrStore.selectFlr) {
          return this.$store.state.FlsFlrStore.selectFlr.id;
        } else {
          return "";
        }
      },
    },
    lastTo: {
      get() {
        return this.$store.state.FlsFlrStore.selectFlr.to;
      },
    },
    lastFrom: {
      get() {
        return this.$store.state.FlsFlrStore.selectFlr.from;
      },
    },
    latstStatus: {
      get() {
        return this.$store.state.FlsFlrStore.selectFlr.status;
      },
    },
    latstTitle: {
      get() {
        if (this.$store.state.FlsFlrStore.selectFlr) {
          return this.$store.state.FlsFlrStore.selectFlr.title;
        } else {
          return "";
        }
      },
    },
    lastAttachmentList: {
      get() {
        return this.$store.state.FlsFlrStore.selectFlr.attachment;
      },
    },
  },
  //compute
  created() {},
};
</script>

