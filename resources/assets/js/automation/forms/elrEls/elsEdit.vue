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
            >خلاصه</div>
            <div
              @click="showTab3"
              v-bind:class="[
                                this.tab3 ? 'vpc_nav_item_selected' : ''
                            ]"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >الحاقات</div>
            <div
              @click="showTab4"
              v-bind:class="[
                                this.tab4 ? 'vpc_nav_item_selected' : ''
                            ]"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >اسناد</div>
              <div
              @click="showTab5"
              v-bind:class="[
                                this.tab5 ? 'vpc_nav_item_selected' : ''
                            ]"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >متن</div>
            <div
              @click="showTab6"
              v-bind:class="[
                                this.tab6 ? 'vpc_nav_item_selected' : ''
                            ]"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >نامه های مربوطه</div>
          
          </div>
        </div>
        <!---->
        <div
          class="row"
          v-bind:class="[
                        this.tab1 ? '' : 'vpc_nav_item_selected_form'
                    ]"
        >
          <singleInput type="text" inputTitle="گیرنده" v-model="data.receiver"></singleInput>
          <singleInputDisabled type="text" inputTitle="ثبت کننده" v-model="data.registrar"></singleInputDisabled>
          <listMultiSelector
            listName="فرستنده"
            selectedItem="name"
            selectedItemTwo="family"
            childItem="userinfo"
            listSource="managementUserForEls"
            :getSource="this.$store.state.ElsStore.managementUserForEls"
            :lastValue="data.sender"
            @selectid=" data.sender = $event"
          ></listMultiSelector>
          <datePicker inputTitle="تاریخ نامه" v-model="data.date_of_letter"></datePicker>
          <singleInput type="text" inputTitle="شماره نامه" v-model="data.indicator"></singleInput>
          <listSelectorOptional
            selectedItem="name"
            listName="امنیت"
            :getSource="this.$store.state.mainStore.letterSecurity"
            @selectid="data.security = $event.id"
            :lastValue="data.security"
          ></listSelectorOptional>
          <listSelectorOptional
            selectedItem="name"
            listName="نوع"
            :getSource="this.$store.state.mainStore.letterType"
            @selectid="data.type_of_letter = $event.id"
            :lastValue="data.type_of_letter"
          ></listSelectorOptional>
          <listSelectorOptional
            selectedItem="name"
            listName="اولویت"
            :getSource="this.$store.state.mainStore.priority"
            @selectid="data.letter_priority = $event.id"
            :lastValue="data.letter_priority"
          ></listSelectorOptional>
        </div>
        <div
          class="row"
          v-bind:class="[
                        this.tab2 ? '' : 'vpc_nav_item_selected_form'
                    ]"
        >
          <singleInput type="text" inputTitle="خطابه" v-model="data.hint"></singleInput>
          <textareaInput type="text" inputTitle="موضوع" v-model="data.subject"></textareaInput>
          <textareaInput type="text" inputTitle="خلاصه" v-model="data.summary"></textareaInput>
          <singleInput type="text" inputTitle="یادداشت شخصی" v-model="data.note"></singleInput>
        </div>
        <div
          class="row"
          v-bind:class="[
                        this.tab3 ? '' : 'vpc_nav_item_selected_form'
                    ]"
        >
          <simpleDataTable
            :deleteRow="this.simpleDataTable.deleteRow"
            :response="[this.simpleDataTable.response, this.lastId]"
            operation="delete"
            :getData="this.lastAttachmentList"
          ></simpleDataTable>
          <multiFiles @files="data.attachment = $event"></multiFiles>
        </div>
        <div
          class="row"
          v-bind:class="[
                        this.tab4 ? '' : 'vpc_nav_item_selected_form'
                    ]"
        >
          <listMultiSelector
            listName="اسناد و گواهی نامه ها"
            selectedItem="name"
            listSource="allDocumentForElr"
            :getSource="this.$store.state.ElrStore.allDocumentForElr"
            :lastValue="data.document"
            @selectid=" data.document = $event"
          ></listMultiSelector>
        </div>
        <div
          class="row"
          v-bind:class="[
                        this.tab5 ? '' : 'vpc_nav_item_selected_form'
                    ]"
        >
          <div class="col-12 col-6 my-2">
            <ckeditor
              @input="data.editor"
              :editor="editor"
              v-model="data.context"
              :config="editorConfig"
              @ready="onReady"
            ></ckeditor>
          </div>
        </div>
        <div
          class="row"
          v-bind:class="[
                        this.tab6 ? '' : 'vpc_nav_item_selected_form'
                    ]"
        ></div>
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
///////////////////////////////////////////////////////////////////////uploadAdapter
import DecoupledEditor from "@ckeditor/ckeditor5-build-decoupled-document";
class UploadAdapter {
  constructor(loader) {
    this.loader = loader;
  }

  upload() {
    return this.loader.file.then((uploadedFile) => {
      return new Promise((resolve, reject) => {
        const data = new FormData();
        data.append("upload", uploadedFile);
        data.append("title", "product");
        axios({
          url: "api/v1/ckUpload",
          method: "post",
          data,
          headers: {
            "Content-Type": "multipart/form-data;",
            Authorization:
              "Bearer " +
              (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
                ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
                : null),
          },
          withCredentials: false,
        })
          .then((response) => {
            resolve({
              default: response.data.url,
            });
          })
          .catch((response) => {
            reject("Upload failed");
          });
      });
    });
  }
}
///////////////////////////////////////////////////////////////////////uploadAdapter
export default {
  name: "elsEdit",
  data() {
    return {
      tab1: true,
      tab2: false,
      tab3: false,
      tab4: false,
      tab5: false,
      tab6: false,
      refreshPage: true,
      window: {
        headerid: "elsEdit",
        title: " نامه ارسالی",
           titleLine: "نامه های خارجی/ نامه خارجی ارسالی / ویرایش نامه",
      },
      simpleDataTable: {
        deleteRow: "/api/v1/deleteElsDocumentAttachment/",
        response: "selectElsEdit",
      },
      edit: {
        buttonTitle: "ویرایش",
        axiosUrl: "/api/v1/editEls/",
        response: "selectElsEdit",
      },
      data: {
        id: "",
        sender: "",
        receiver: "",
        registrar: "",
        date_of_letter: "",
        indicator: "",
        security: "",
        type_of_letter: "",
        letter_priority: "",
        //
        hint: "",
        summary: "",
        subject: "",
        note: "",
        //
        context: "",
        //
        attachment: "",
        //
        document: "",
      },
      // ckEditor,
      editor: DecoupledEditor,
      editorInput: "",
      editorData: " ",
      editorConfig: {
        extraPlugins: [this.viraUploadFile],
        contentsLangDirection: "rtl",
        language: "fa",
      },
      // ckEditor
    };
  },
  ///////////////////////////////////////////////////////////////////////model
  ///////////////////////////////////////////////////////////////////////method
  methods: {
    // ckEditor
    onReady(editor) {
      editor.ui
        .getEditableElement()
        .parentElement.insertBefore(
          editor.ui.view.toolbar.element,
          editor.ui.getEditableElement()
        );
    },
    viraUploadFile(editor) {
      editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
        return new UploadAdapter(loader);
      };
    },
    // ckEditor
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
      this.tab6 = false;
    },
    showTab2() {
      this.tab1 = false;
      this.tab2 = true;
      this.tab3 = false;
      this.tab4 = false;
      this.tab5 = false;
      this.tab6 = false;
    },
    showTab3() {
      this.tab1 = false;
      this.tab2 = false;
      this.tab3 = true;
      this.tab4 = false;
      this.tab5 = false;
      this.tab6 = false;
    },
    showTab4() {
      this.tab1 = false;
      this.tab2 = false;
      this.tab3 = false;
      this.tab4 = true;
      this.tab5 = false;
      this.tab6 = false;
    },
    showTab5() {
      this.tab1 = false;
      this.tab2 = false;
      this.tab3 = false;
      this.tab4 = false;
      this.tab5 = true;
      this.tab6 = false;
    },
        showTab6() {
      this.tab1 = false;
      this.tab2 = false;
      this.tab3 = false;
      this.tab4 = false;
      this.tab5 = false;
      this.tab6 = true;
    },
  },
  ///////////////////////////////////////////////////////////////////////method
  ///////////////////////////////////////////////////////////////////////watch
  watch: {
    lastId: function () {
      this.data.id = this.lastId;
    },
    lastSender: function () {
      this.data.sender = this.lastSender;
    },
    lastReceiver: function () {
      this.data.receiver = this.lastReceiver;
    },
    last_Registrar: function () {
      this.data.registrar = this.last_Registrar;
    },
    last_date_of_letter: function () {
      this.data.date_of_letter = this.last_date_of_letter;
    },
    last_security: function () {
      this.data.security = this.last_security;
    },
    last_letter_priority: function () {
      this.data.letter_priority = this.last_letter_priority;
    },
    last_number_of_letter: function () {
      this.data.number_of_letter = this.last_number_of_letter;
    },
    lastIndicator: function () {
      this.data.indicator = this.lastIndicator;
    },
    last_type_of_letter: function () {
      this.data.type_of_letter = this.last_type_of_letter;
    },
    //
    lastSummary: function () {
      this.data.summary = this.lastSummary;
    },
    lastSubject: function () {
      this.data.subject = this.lastSubject;
    },
    lastNote: function () {
      this.data.note = this.lastNote;
    },
    lastHint: function () {
      this.data.hint = this.lastHint;
    },
    //
    lastContext: function () {
      this.data.context = this.lastContext;
    },
          lastDocument: function () {
      this.data.document = this.lastDocument;
    },
  },
  ///////////////////////////////////////////////////////////////////////watch
  ///////////////////////////////////////////////////////////////////////compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.ElsStore.selectElsEdit) {
          return this.$store.state.ElsStore.selectElsEdit.id;
        } else {
          return "";
        }
      },
    },
    lastSender: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.sender;
      },
    },
    lastReceiver: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.receiver;
      },
    },
    last_Registrar: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.registrar;
      },
    },
    last_date_of_letter: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.date_of_letter;
      },
    },
    last_letter_priority: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.letter_priority;
      },
    },
    lastIndicator: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.indicator;
      },
    },
    last_security: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.security;
      },
    },
    last_type_of_letter: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.type_of_letter;
      },
    },
    //
    lastSummary: {
      get() {
        if (this.$store.state.ElsStore.selectElsEdit.summary) {
          return this.$store.state.ElsStore.selectElsEdit.summary.summary;
        } else {
          return "";
        }
      },
    },
    lastSubject: {
      get() {
        if (this.$store.state.ElsStore.selectElsEdit.summary) {
          return this.$store.state.ElsStore.selectElsEdit.summary.subject;
        } else {
          return "";
        }
      },
    },
    lastNote: {
      get() {
        if (this.$store.state.ElsStore.selectElsEdit.summary) {
          return this.$store.state.ElsStore.selectElsEdit.summary.note;
        } else {
          return "";
        }
      },
    },
    lastHint: {
      get() {
        if (this.$store.state.ElsStore.selectElsEdit.summary) {
          return this.$store.state.ElsStore.selectElsEdit.summary.hint;
        } else {
          return "";
        }
      },
    },
    //
    lastContext: {
      get() {
        if (this.$store.state.ElsStore.selectElsEdit.context) {
          return this.$store.state.ElsStore.selectElsEdit.context.content;
        } else {
          return "";
        }
      },
    },
    lastAttachmentList: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.attachment;
      },
    },
    lastDocument: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.document;
      },
    },
    sender: {
      get() {
        return this.$store.state.ElsStore.selectElsEdit.sender;
      },
    },
  },
  ///////////////////////////////////////////////////////////////////////compute
  created() {},
};
</script>
