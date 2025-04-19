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
        <singleInput type="text" inputTitle="نام سند" v-model="data.name"></singleInput>
        <singleInput type="text" inputTitle="شناسه ثبت" v-model="data.registration_number"></singleInput>
        <textareaInput type="text" inputTitle="توضیحات" v-model="data.description"></textareaInput>

        <simpleDataTable
          :deleteRow="this.simpleDataTable.deleteRow"
          :response="[this.simpleDataTable.response,this.lastId]"
          operation="delete"
          :getData="this.lastFile"
        ></simpleDataTable>

        <multiFiles @files="data.file = $event"></multiFiles>
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "documentEdit",
  data() {
    return {
      refreshPage: true,
      window: {
        headerid: "documentEdit",
        title: "ویرایش سند",
                 titleLine: "دبیر خانه/ اسناد ومدارک / ویرایش اسناد",
      },
      edit: {
        buttonTitle: "ویرایش",
        axiosUrl: "/api/v1/editDocument/",
        response: "selectDocumentEdit",
      },
      simpleDataTable: {
        deleteRow: "/api/v1/deleteDocumentAttachment/",
        response: "selectDocumentEdit",
      },
      data: {
        name: "",
        description: "",
        registration_number: "",
        file: "",
      },
      refreshPage: true,
    };
  },
  //model
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.secretaryStore.selectDocumentEdit.id) {
          return this.$store.state.secretaryStore.selectDocumentEdit.id;
        } else {
          return "";
        }
      },
    },
    lastName: {
      get() {
        return this.$store.state.secretaryStore.selectDocumentEdit.name;
      },
    },
    lastDescription: {
      get() {
        return this.$store.state.secretaryStore.selectDocumentEdit.description;
      },
    },
    last_registration_number: {
      get() {
        return this.$store.state.secretaryStore.selectDocumentEdit
          .registration_number;
      },
    },
    lastFile: {
      get() {
        if (this.$store.state.secretaryStore.selectDocumentEdit.id) {
          return this.$store.state.secretaryStore.selectDocumentEdit
            .document_attachment;
        } else {
          return "";
        }
      },
    },
  },
  //compute
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
  //watch
  watch: {
    lastId: function () {
      this.data.id = this.lastId;
    },
    lastName: function () {
      this.data.name = this.lastName;
    },
    lastDescription: function () {
      this.data.description = this.lastDescription;
    },
    last_registration_number: function () {
      this.data.registration_number = this.lastDescription;
    },
  },
  //watch
};
</script>

