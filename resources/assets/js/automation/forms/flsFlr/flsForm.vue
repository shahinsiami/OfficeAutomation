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
          >اطلاعات</div>
          <div
            @click="showTab2"
            v-bind:class="[this.tab2 ? 'vpc_nav_item_selected' : '']"
            class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
          >محتوا</div>
        </div>
      </div>
      <!---->
      <div class="row" v-bind:class="[this.tab1 ? '' : 'vpc_nav_item_selected_form']">
        <singleInputDisabled type="text" inputTitle="ثبت کننده" v-model="this.data.registerer"></singleInputDisabled>
        <singleInput type="text" inputTitle="فرستنده" v-model="data.to"></singleInput>
        <singleInput type="text" inputTitle="گیرنده" v-model="data.from"></singleInput>
              <listMultiSelector
            listName="کاربر"
            selectedItem="name"
            selectedItemTwo="family"
            childItem="userinfo"
            listSource="allUserForMlsMlr"
            :getSource="this.$store.state.FlsFlrStore.allUserForMlsMlr"
            :lastValue="[]"
            @selectid="data.senders = $event"
          ></listMultiSelector>
      </div>
      <div class="row" v-bind:class="[this.tab2 ? '' : 'vpc_nav_item_selected_form']">
        <singleInput type="text" inputTitle="عنوان" v-model="data.title"></singleInput>
        <multiFiles @files="data.attachment = $event"></multiFiles>
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
  name: "flsForm",
  components: {},
  data() {
    return {
      tab1: true,
      tab2: false,
      refreshPage: true,
      window: {
        headerid: "flsForm",
        title: "ثبت فکس",
        titleLine: "کارتابل فکس / ثبت فکس ارسالی",
      },
      submit: {
        buttonTitle: "ثبت",
        axiosUrl: "/api/v1/flsFlrRegister",
      },
      data: {
        registerer:
          this.$store.state.profile.getUserInfo.name +
          "  " +
          this.$store.state.profile.getUserInfo.family,
        to: "",
        from: "",
        title: "",
        attachment: "",
        senders: "",
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
        this.data.registerer = this.getUserInfo;
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
  },
  //compute
  created() {},
};
</script>

