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
        <singleInput type="text" inputTitle="درگاه پیام" v-model="data.name"></singleInput>
        <singleInput type="text" inputTitle="سریال اندیکاتور" v-model="data.indicator"></singleInput>
        <listSelector
          selectedItem="name"
          listName="دبیر خانه"
          listSource="allSecretaryForSecretaryPort"
          :getSource="this.$store.state.secretaryStore.allSecretaryForSecretaryPort"
          :lastValue="this.data.secretary_id"
          @selectid=" data.secretary_id = $event.id"
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
  name: "secretaryPortEdit",
  data() {
    return {
      refreshPage: true,
      window: {
        headerid: "secretaryPortEdit",
        title: "ویرایش گروه دبیرخانه",
        titleLine: "دبیر خانه/ درگاه / ویرایش درگاه",
      },
      edit: {
        buttonTitle: "ویرایش",
        axiosUrl: "/api/v1/editSecretaryPort/",
        response: "selectSecretaryPortEdit",
      },
      data: {
        id: "",
        name: "",
        indicator: "",
        secretary_id: "",
      },
    };
  },
  //model
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.secretaryStore.selectSecretaryPortEdit.id) {
          return this.$store.state.secretaryStore.selectSecretaryPortEdit.id;
        } else {
          return "";
        }
      },
    },
    lastName: {
      get() {
        return this.$store.state.secretaryStore.selectSecretaryPortEdit.name;
      },
    },
    lastName: {
      get() {
        return this.$store.state.secretaryStore.selectSecretaryPortEdit.name;
      },
    },
    lastIndicator: {
      get() {
        return this.$store.state.secretaryStore.selectSecretaryPortEdit
          .indicator;
      },
    },
    last_secretary_id: {
      get() {
        if (this.$store.state.secretaryStore.selectSecretaryPortEdit) {
          return this.$store.state.secretaryStore.selectSecretaryPortEdit
            .secretary;
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
    lastIndicator: function () {
      this.data.indicator = this.lastIndicator;
    },
    last_secretary_id: function () {
      if (this.last_secretary_id !== undefined) {
        this.data.secretary_id = this.last_secretary_id.id;
      }
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

