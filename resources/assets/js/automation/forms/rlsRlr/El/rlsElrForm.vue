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
    <div style="direction:rtl" v-if="this.refreshPage" class="container-fluid">
      <div class="row">
        <div class="d-flex flex-row w-100 justify-content-start align-items-center vpc_nav">
          <div
            @click="showTab1"
            v-bind:class="[this.tab1 ? 'vpc_nav_item_selected' : '']"
            class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
          >خلاصه</div>
          <div
            @click="showTab2"
            v-bind:class="[this.tab2 ? 'vpc_nav_item_selected' : '']"
            class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
          >پیام</div>
          <div
            @click="showTab3"
            v-bind:class="[this.tab3 ? 'vpc_nav_item_selected' : '']"
            class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
          >گیرنده</div>
        </div>
      </div>
      <!---->
      <div class="row" v-bind:class="[this.tab1 ? '' : 'vpc_nav_item_selected_form']">
        <textareaInputDisabled type="text" inputTitle="موضوع" v-model="this.lastSubject"></textareaInputDisabled>
        <textareaInputDisabled type="text" inputTitle="خلاصه" v-model="this.lastSummary"></textareaInputDisabled>
      </div>
      <div class="row" v-bind:class="[this.tab2 ? '' : 'vpc_nav_item_selected_form']">
        <textareaInput type="text" inputTitle="یادداشت شخصی" v-model="data.note"></textareaInput>
        <textareaInput type="text" inputTitle="توضیحات" v-model="data.description"></textareaInput>
      </div>
      <div class="row" v-bind:class="[this.tab3 ? '' : 'vpc_nav_item_selected_form']">
        <listMultiSelector
          listName="ارجاع به"
          selectedItem="name"
          selectedItemTwo="family"
          childItem="userinfo"
          listSource="allUserForrls"
          :getSource="this.$store.state.RefferalStore.allUserForrls"
          :lastValue="[]"
          @selectid=" data.receivers = $event"
        ></listMultiSelector>
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
  name: "rlsElForm",
  data() {
    return {
      tab1: true,
      tab2: false,
      tab3: false,
      refreshPage: true,
      window: {
        headerid: "rlsElForm",
        title: "ارجاع نامه خارجی",
        titleLine: "ارجاع نامه خارجی",
      },
      selectiveListForReceiver: {
        getData: "allUserForrls",
        selectStore: "RefferalStore",
        selectiveTitle: "ارجاع به",
      },
      submit: {
        buttonTitle: "ارسال",
        axiosUrl: "/api/v1/rlsElRegister",
      },
      data: {
        id: "",
        note: "",
        description: "",
        receivers: "",
      },
    };
  },
  //model
  //method
  methods: {
    // refresh
    refresh() {
      this.refreshPage = false;
      for (let key in this.data) {
        this.data[key] = "";
      }
      setTimeout(() => {
        this.refreshPage = true;
            this.data.id = this.lastId;
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
    showTab3() {
      this.tab1 = false;
      this.tab2 = false;
      this.tab3 = true;
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
  },
  //watch
  //compute
  computed: {
    getUserInfo: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          this.data.sender =
            this.$store.state.profile.getUserInfo.name +
            "  " +
            this.$store.state.profile.getUserInfo.family;
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
        return this.$store.state.CelrElsStore.selectcElrView.id;
      },
    },
    //
    lastSummary: {
      get() {
        if (this.$store.state.CelrElsStore.selectcElrView.summary) {
          return this.$store.state.CelrElsStore.selectcElrView.summary.subject;
        } else {
          return "";
        }
      },
    },
    lastSubject: {
      get() {
        if (this.$store.state.CelrElsStore.selectcElrView.summary) {
          return this.$store.state.CelrElsStore.selectcElrView.summary.summary;
        } else {
          return "";
        }
      },
    },
  },
  //compute
mounted: function () {
    this.data.id = this.lastId;
  },
};
</script>

