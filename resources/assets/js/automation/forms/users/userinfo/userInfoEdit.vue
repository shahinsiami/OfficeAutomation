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
    <!---->
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "userInfoEdit",
  data() {
    return {
      refreshPage: true,
      window: {
        headerid: "userInfoEdit",
        title: "ویرایش مشخصات",
        titleLine: "ویرایش اطلاعات",
      },
      edit: {
        buttonTitle: "ویرایش",
        axiosUrl: "/api/v1/EditUserInfo/",
        response: "selectUserEdit",
      },

      data: {
        id: "",
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
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo.id;
        }
      },
    },
    lastName: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo.name;
        }
      },
    },
    lastFamily: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo.family;
        }
      },
    },
    lastBirthday: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo
            .birthday;
        }
      },
    },
    lastAddress: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo
            .address;
        }
      },
    },
    lastDegree: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo.degree;
        }
      },
    },
    lastSignature: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo
            .signature;
        }
      },
    },
    lastPhoto: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo.photo;
        }
      },
    },
    lastSex: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo.sex;
        }
      },
    },
    lastEmail: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo.email;
        }
      },
    },
    lastPhonenumber: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit.userinfo) {
          return this.$store.state.userStore.selectUserInfoEdit.userinfo
            .phonenumber;
        }
      },
    },
    last_user_id: {
      get() {
        if (this.$store.state.userStore.selectUserInfoEdit) {
          return this.$store.state.userStore.selectUserInfoEdit.id;
        } else {
          return "";
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
  //watch
  //methods
  methods: {
    refresh() {
      (this.refreshPage = false),
        setTimeout(() => {
          this.refreshPage = true;
        }, 800);
    },
  },
  //methods
  created() {},
};
</script>

