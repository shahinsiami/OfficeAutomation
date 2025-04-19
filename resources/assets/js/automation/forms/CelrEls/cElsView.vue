<template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center">
            <button
          v-on:click.prevent="openRefferal"
          class="vpc_button text-center align-items-center justify-content-center"
          type="button"
        >
          <span>ارجاع</span>
        </button>
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
            >اطلاعات</div>
            <div
              @click="showTab2"
              v-bind:class="[this.tab2 ? 'vpc_nav_item_selected' : '']"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >خلاصه</div>
            <div
              @click="showTab3"
              v-bind:class="[this.tab3 ? 'vpc_nav_item_selected' : '']"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >الحاقات</div>
            <div
              @click="showTab4"
              v-bind:class="[this.tab4 ? 'vpc_nav_item_selected' : '']"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >اسناد</div>
            <div
              @click="showTab5"
              v-bind:class="[this.tab5 ? 'vpc_nav_item_selected' : '']"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >نامه های مربوطه</div>
            <div
              @click="showTab6"
              v-bind:class="[this.tab6 ? 'vpc_nav_item_selected' : '']"
              class="vpc_nav_item d-flex flex-row justify-content-center align-items-center"
            >متن</div>
          </div>
        </div>
        <!---->
        <div class="row" v-bind:class="[this.tab1 ? '' : 'vpc_nav_item_selected_form']">
          <singleInputDisabled type="text" inputTitle="دریافت کننده" v-model="data.receiver"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="ثبت کننده" v-model="data.registrar"></singleInputDisabled>
          <listMultiSelector
            listName="گیرنده"
            selectedItem="name"
            selectedItemTwo="family"
            childItem="userinfo"
            listSource="managementUserForElr"
            :getSource="this.$store.state.CelrElsStore.managementUserForEls"
            :lastValue="data.sender"
            @selectid=" data.sender = $event"
          ></listMultiSelector>
          <singleInputDisabled type="text" inputTitle="تاریخ" v-model="data.date_of_letter"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="شماره نامه" v-model="data.indicator"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="امنیت" v-model="data.security"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="نوع نامه" v-model="data.type_of_letter"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="اولویت" v-model="data.letter_priority"></singleInputDisabled>
        </div>
        <div class="row" v-bind:class="[this.tab2 ? '' : 'vpc_nav_item_selected_form']">
          <singleInputDisabled type="text" inputTitle="خطابه" v-model="data.hint"></singleInputDisabled>

          <textareaInputDisabled type="text" inputTitle="موضوع" v-model="data.subject "></textareaInputDisabled>

          <textareaInputDisabled type="text" inputTitle="خلاصه" v-model="data.summary"></textareaInputDisabled>

          <singleInputDisabled type="text" inputTitle="یادداشت شخصی" v-model="data.note"></singleInputDisabled>
        </div>
        <div class="row" v-bind:class="[this.tab3 ? '' : 'vpc_nav_item_selected_form']">
          <simpleDataTable :getData="this.lastAttachmentList"></simpleDataTable>

          <br />
        </div>
        <div class="row" v-bind:class="[this.tab4 ? '' : 'vpc_nav_item_selected_form']">
          <listMultiSelector
            listName="اسناد و گواهی نامه ها"
            selectedItem="name"
            listSource="allDocumentForElr"
            :getSource="this.$store.state.CelrElsStore.allDocumentForEls"
            :lastValue="data.document"
            @selectid=" data.document = $event"
          ></listMultiSelector>
        </div>
        <div class="row" v-bind:class="[this.tab5 ? '' : 'vpc_nav_item_selected_form']"></div>
        <div class="row" v-bind:class="[this.tab6 ? '' : 'vpc_nav_item_selected_form']">
          <textareaInputDisabled type="text" inputTitle="متن" v-model="data.context"></textareaInputDisabled>
        </div>
        <!--tabSixElsView-->
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
//uploadAdapter
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
//uploadAdapter
export default {
  name: "cElsView",
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
        headerid: "cElsView",
        title: "نامه خارجی ارسال شده",
        titleLine: "کارتابل/ نامه های خارجی ارسالی / مشاهده نامه خارجی ارسالی",
      },

      simpleDataTable: {
        deleteRow: "/api/v1/deleteElsDocumentAttachment/",
        response: "selectcElsView",
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
  //model
  //method
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
        openRefferal() {
      document.location = `/automation#/rlsElsForm`;
      let tab = { name: "ارجاع نامه خارجی", route: "rlsElsForm" };
      this.$store.dispatch("upSidePush", tab);
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
      this.data.receiver = this.lastReceiver;
    },
    last_Registrar: function () {
      this.data.registrar = this.last_Registrar;
    },
    last_date_of_letter: function () {
      this.data.date_of_letter = this.last_date_of_letter;
    },
    last_letter_priority: function () {
      this.data.letter_priority = this.last_letter_priority;
      if (this.last_letter_priority == 1) {
        this.data.letter_priority = "پایین";
      }
      if (this.last_letter_priority == 2) {
        this.data.letter_priority = "متوسط";
      }
      if (this.last_letter_priority == 3) {
        this.data.letter_priority = "زیاد";
      }
      if (this.last_letter_priority == 4) {
        this.data.letter_priority = "بسیار زیاد";
      }
    },
    last_number_of_letter: function () {
      this.data.number_of_letter = this.last_number_of_letter;
    },
    last_type_of_letter: function () {
      if (this.last_type_of_letter == 1) {
        this.data.type_of_letter = "پست";
      }
      if (this.last_type_of_letter == 2) {
        this.data.type_of_letter = "پیک";
      }
      if (this.last_type_of_letter == 3) {
        this.data.type_of_letter = "ایمیل";
      }
      if (this.last_type_of_letter == 4) {
        this.data.type_of_letter = "غیره";
      }
    },
    last_security: function () {
      if (this.last_security == 1) {
        this.data.security = "عادی";
      }
      if (this.last_security == 2) {
        this.data.security = "محرمانه";
      }
      if (this.last_security == 3) {
        this.data.security = "فوق محرمانه";
      }
    },
    last_number_of_letter: function () {
      this.data.number_of_letter = this.last_number_of_letter;
    },
    lastIndicator: function () {
      this.data.indicator = this.lastIndicator;
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
  //watch
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.CelrElsStore.selectcElsView) {
          return this.$store.state.CelrElsStore.selectcElsView.id;
        } else {
          return "";
        }
      },
    },
    lastSender: {
      get() {
        return this.$store.state.CelrElsStore.selectcElsView.sender;
      },
    },
    lastReceiver: {
      get() {
        return this.$store.state.CelrElsStore.selectcElsView.receiver;
      },
    },
    last_Registrar: {
      get() {
        return this.$store.state.CelrElsStore.selectcElsView.registrar;
      },
    },
    last_date_of_letter: {
      get() {
        return this.$store.state.CelrElsStore.selectcElsView.date_of_letter;
      },
    },
    last_letter_priority: {
      get() {
        return this.$store.state.CelrElsStore.selectcElsView.letter_priority;
      },
    },
    lastIndicator: {
      get() {
        return this.$store.state.CelrElsStore.selectcElsView.indicator;
      },
    },
    last_security: {
      get() {
        return this.$store.state.CelrElsStore.selectcElsView.security;
      },
    },
    last_type_of_letter: {
      get() {
        return this.$store.state.CelrElsStore.selectcElsView.type_of_letter;
      },
    },
    //
    lastSummary: {
      get() {
        if (this.$store.state.CelrElsStore.selectcElsView.summary) {
          return this.$store.state.CelrElsStore.selectcElsView.summary.summary;
        } else {
          return "";
        }
      },
    },
    lastSubject: {
      get() {
        if (this.$store.state.CelrElsStore.selectcElsView.summary) {
          return this.$store.state.CelrElsStore.selectcElsView.summary.subject;
        } else {
          return "";
        }
      },
    },
    lastNote: {
      get() {
        if (this.$store.state.CelrElsStore.selectcElsView.summary) {
          return this.$store.state.CelrElsStore.selectcElsView.summary.note;
        } else {
          return "";
        }
      },
    },
    lastHint: {
      get() {
        if (this.$store.state.CelrElsStore.selectcElsView.summary) {
          return this.$store.state.CelrElsStore.selectcElsView.summary.hint;
        } else {
          return "";
        }
      },
    },
    //
    lastContext: {
      get() {
        if (this.$store.state.CelrElsStore.selectcElsView.context) {
          return this.$store.state.CelrElsStore.selectcElsView.context.content;
        } else {
          return "";
        }
      },
    },
    lastAttachmentList: {
      get() {
        return this.$store.state.CelrElsStore.selectcElsView.attachment;
      },
    },
    lastDocument: {
      get() {
        return this.$store.state.CelrElsStore.selectcElsView.document;
      },
    },
    sender: {
      get() {
        if (this.$store.state.CelrElsStore.selectcElsView.sender) {
          let user = [];
          this.$store.state.CelrElsStore.selectcElsView.sender.forEach(
            (item) => {
              user.push(item);
            }
          );
          return JSON.stringify(user);
        } else {
          return "[]";
        }
      },
    },
  },
  //compute
  created() {},
};
</script>
