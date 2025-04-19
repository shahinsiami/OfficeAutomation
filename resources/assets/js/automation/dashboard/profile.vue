<template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center">
        <div v-if="this.tab1">
          <editBtn
            @needRefresh="this.refresh"
            :responseDispatch="this.passwordEdit.response"
            :axiosUrl="this.passwordEdit.axiosUrl"
            :formData="this.data"
            :buttonTitle="this.passwordEdit.buttonTitle"
          ></editBtn>
        </div>
        <div v-if="this.tab2">
          <editBtn
            @needRefresh="this.refresh"
            :responseDispatch="this.infoEdit.response"
            :axiosUrl="this.infoEdit.axiosUrl"
            :formData="this.data"
            :buttonTitle="this.infoEdit.buttonTitle"
          ></editBtn>
        </div>
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
              v-bind:class="[this.tab1 ? 'vpc_nav_item_selected' : '']"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >کلمه عبور</div>
            <div
              @click="showTab2"
              v-bind:class="[this.tab2 ? 'vpc_nav_item_selected' : '']"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >مشخصات فردی</div>
          </div>
        </div>
        <!---->
        <div class="row" v-bind:class="[this.tab1 ? '' : 'vpc_nav_item_selected_form']">
          <singleInputDisabled type="text" inputTitle="نام" v-model="this.name"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="نام خانوادگی" v-model="this.family"></singleInputDisabled>
          <singleInput
            allRow="true"
            type="password"
            inputTitle="کلمه عبور پیشین"
            v-model="data.lastPassword"
          ></singleInput>
          <singleInput type="password" inputTitle="کلمه عبور" v-model="data.password"></singleInput>
          <singleInput type="password" inputTitle="تکرار کلمه عبور" v-model="data.rPassword"></singleInput>
        </div>
        <!---->
        <div class="row" v-bind:class="[this.tab2 ? '' : 'vpc_nav_item_selected_form']">
          <singleInput type="text" inputTitle="نام" v-model="data.name"></singleInput>
          <singleInput type="text" inputTitle="نام خانوادگی" v-model="data.family"></singleInput>

          <singleInput type="text" inputTitle="آدرس" v-model="data.address"></singleInput>
          <listSelectorOptional
            selectedItem="name"
            listName="تحصیلات"
            :getSource="this.$store.state.mainStore.degree"
            @selectid=" data.degree = $event.id "
            :lastValue="data.degree"
          ></listSelectorOptional>
          <listSelectorOptional
            listName="جنسیت"
            selectedItem="name"
            :getSource="this.$store.state.mainStore.sex"
            @selectid=" data.sex = $event.id "
            :lastValue="data.sex"
          ></listSelectorOptional>
          <singleInput type="text" inputTitle="تلفن همراه" v-model="data.phonenumber"></singleInput>
          <singleInput type="text" inputTitle="پست الکترونیک" v-model="data.email"></singleInput>

          <imageInput
            :lastImageProp="this.data.signature"
            @file="data.signature = $event"
            imageTitle="امضا"
          ></imageInput>
          <imageInput :lastImageProp="this.data.photo" @file="data.photo = $event" imageTitle="عکس"></imageInput>

          <datePicker inputTitle="تاریخ تولد" v-model="data.birthday"></datePicker>
        </div>
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
  name: "profile",
  data() {
    return {
      tab1: true,
      tab2: false,
      tab3: false,
      tab4: false,
      refreshPage: true,
      window: {
        headerid: "profile",
        title: "پروفایل",
        titleLine: "پروفایل / ویرایش پروفایل",
      },
      passwordEdit: {
        buttonTitle: "ویرایش",
        axiosUrl: "/api/v1/resetpassword",
        response: "getUserInfo",
      },
      infoEdit: {
        buttonTitle: "ویرایش",
        axiosUrl:
          "/api/v1/EditUserInfo/" + this.$store.state.profile.getUserInfo.id,
        response: "getUserInfo",
      },
      data: {
        id: "",
        lastPassword: "",
        password: "",
        rPassword: "",
        name: "",
        family: "",
        birthday: "",
        address: "",
        degree: "",
        signature: "",
        photo: "",
        sex: "",
        email: "",
        phonenumber: "",
        user_id: "",
      },
    };
  },
  //model
  //method
  methods: {
    // refresh
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
    },
    showTab2() {
      this.tab1 = false;
      this.tab2 = true;
      this.tab3 = false;
      this.tab4 = false;
    },
    showTab3() {
      this.tab1 = false;
      this.tab2 = false;
      this.tab3 = true;
      this.tab4 = false;
    },
    showTab4() {
      this.tab1 = false;
      this.tab2 = false;
      this.tab3 = false;
      this.tab4 = true;
    },
  },
  //method
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.id;
        } else {
          return "";
        }
      },
    },
    name: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.name;
        }
      },
    },
    family: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.family;
        }
      },
    },
    lastName: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.name;
        }
      },
    },
    lastFamily: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.family;
        }
      },
    },
    lastBirthday: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.birthday;
        }
      },
    },
    lastAddress: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.address;
        }
      },
    },
    lastDegree: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.degree;
        }
      },
    },
    lastSignature: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.signature;
        }
      },
    },
    lastPhoto: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.photo;
        }
      },
    },
    lastSex: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.sex;
        }
      },
    },
    lastEmail: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.email;
        }
      },
    },
    lastPhonenumber: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.phonenumber;
        }
      },
    },
    last_user_id: {
      get() {
        if (this.$store.state.profile) {
          return this.$store.state.profile.getUserInfo.id;
        } else {
          return "";
        }
      },
    },
  },
  //compute
  //compute
  //watch
  watch: {
    lastId: function () {
      this.data.id = this.lastId;
    },
    lastName: function () {
      this.data.name = this.lastName;
    },
    lastFamily: function () {
      this.data.family = this.lastFamily;
    },
    lastBirthday: function () {
      this.data.birthday = this.lastBirthday;
    },
    lastAddress: function () {
      console.log("hi");
      this.data.address = this.lastAddress;
    },
    lastDegree: function () {
      this.data.degree = this.lastDegree;
    },
    lastSignature: function () {
      this.data.signature = this.lastSignature;
    },
    lastPhoto: function () {
      this.data.photo = this.lastPhoto;
    },
    lastSex: function () {
      this.data.sex = this.lastSex;
    },
    lastEmail: function () {
      this.data.email = this.lastEmail;
    },
    lastPhonenumber: function () {
      this.data.phonenumber = this.lastPhonenumber;
    },
    last_user_id: function () {
      this.data.user_id = this.last_user_id;
    },
  },
  mounted: function () {
    this.data.name = this.lastName;
    this.data.family = this.lastFamily;
    this.data.birthday = this.lastBirthday;
    this.data.address = this.lastAddress;
    this.data.degree = this.lastDegree;
    this.data.signature = this.lastSignature;
    this.data.photo = this.lastPhoto;
    this.data.sex = this.lastSex;
    this.data.email = this.lastEmail;
    this.data.phonenumber = this.lastPhonenumber;
    this.data.user_id = this.last_user_id;
  },
};
</script>