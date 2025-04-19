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
          <singleInputDisabled type="text" inputTitle="فرستنده" v-model="this.getUserInfo"></singleInputDisabled>

          <listMultiSelector
            listName="گیرنده"
            selectedItem="name"
            selectedItemTwo="family"
            childItem="userinfo"
            listSource="allUserForMlsMlr"
            :getSource="this.$store.state.MlsMlrStore.allUserForMlsMlr"
            :lastValue="data.receivers"
            @selectid="data.receivers = $event"
          ></listMultiSelector>
        </div>
        <div
          class="row"
          v-bind:class="[
                        this.tab2 ? '' : 'vpc_nav_item_selected_form'
                    ]"
        >
          <div class="border-bottom text-link text-right my-2 pb-2">محتوا پیغام</div>
          <br/>
           <singleInputDisabled type="text" inputTitle="عنوان" v-model="data.title"></singleInputDisabled>
               <div class="col-12 col-6 my-2">
          <div v-html="data.context"></div>
               </div>
        </div>
        <!--tabTwomlsView-->
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
  name: "mlrView",
  data() {
    return {
      tab1: true,
      tab2: false,
      refreshPage: true,
      window: {
        headerid: "mlrView",
        title: "پیام ثبت شده",
        titleLine: "کارتابل پیام ها / مشاهده پیام",
      },
      data: {
        sender: "",
        receivers: "",
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
      this.refreshPage = false;
      for (let key in this.data) {
        this.data[key] = "";
      }
      setTimeout(() => {
        this.refreshPage = true;
      }, 1000);
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
    lastSender: function () {
      this.data.sender = this.lastSender;
    },
    lastReceiver: function () {
      this.data.receivers = this.lastReceiver;
    },
    last_Registrar: function () {
      this.data.registrar = this.last_Registrar;
    },
    latstTitle: function () {
      this.data.title = this.latstTitle;
    },
    lastContext: function () {
      this.data.context = this.lastContext;
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
        if (this.$store.state.MlsMlrStore.selectMlr) {
          return this.$store.state.MlsMlrStore.selectMlr.id;
        } else {
          return "";
        }
      },
    },
    lastSender: {
      get() {
        return this.$store.state.MlsMlrStore.selectMlr.sender;
      },
    },
    latstTitle: {
      get() {
        if (this.$store.state.MlsMlrStore.selectMlr) {
          return this.$store.state.MlsMlrStore.selectMlr.title;
        } else {
          return "";
        }
      },
    },
    lastContext: {
      get() {
        if (this.$store.state.MlsMlrStore.selectMlr) {
          return this.$store.state.MlsMlrStore.selectMlr.context;
        } else {
          return "";
        }
      },
    },
    lastReceiver: {
      get() {
        return this.$store.state.MlsMlrStore.selectMlr.receiver;
      },
    },
  },
  //compute
  created() {},
};
</script>

