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
            >متن</div>
          </div>
        </div>
        <!---->
        <div class="row" v-bind:class="[this.tab1 ? '' : 'vpc_nav_item_selected_form']">
          <singleInputDisabled type="text" inputTitle="فرستنده" v-model="this.data.sender"></singleInputDisabled>
          <listMultiSelector
            listName="گیرنده"
            selectedItem="name"
            selectedItemTwo="family"
            childItem="userinfo"
            listSource="allUserForIlrIls"
            :getSource="this.$store.state.IlsIlrStore.allUserForIlrIls"
            :lastValue="data.receivers"
            @selectid="data.receivers = $event"
          ></listMultiSelector>
          <listSelectorOptional
            selectedItem="name"
            listName="امنیت"
            :getSource="this.$store.state.mainStore.letterSecurity"
            @selectid=" data.security = $event.id"
            :lastValue="data.security"
          ></listSelectorOptional>
          <listSelectorOptional
            selectedItem="name"
            listName="اولویت"
            :getSource="this.$store.state.mainStore.priority"
            @selectid=" data.letter_priority = $event.id "
            :lastValue="data.letter_priority"
          ></listSelectorOptional>
        </div>
        <div class="row" v-bind:class="[this.tab2 ? '' : 'vpc_nav_item_selected_form']">
          <singleInput type="text" inputTitle="خطابه" v-model="data.hint"></singleInput>
          <textareaInput type="text" inputTitle="موضوع" v-model="data.subject "></textareaInput>
          <textareaInput type="text" inputTitle="خلاصه" v-model="data.summary"></textareaInput>
          <singleInput type="text" allRow="true" inputTitle="یادداشت شخصی" v-model="data.note"></singleInput>
        </div>
        <div class="row" v-bind:class="[this.tab3 ? '' : 'vpc_nav_item_selected_form']">
          <simpleDataTable :getData="this.lastAttachmentList"></simpleDataTable>
        </div>

        <div class="row" v-bind:class="[this.tab4 ? '' : 'vpc_nav_item_selected_form']">
          <listMultiSelector
            listName="اسناد و گواهی نامه ها"
            selectedItem="name"
            listSource="allDocumentForIls"
            :getSource="this.$store.state.IlsIlrStore.allDocumentForIls"
            :lastValue="data.document"
            @selectid=" data.document = $event"
          ></listMultiSelector>
        </div>

        <div class="row" v-bind:class="[this.tab5 ? '' : 'vpc_nav_item_selected_form']">
          <div class="col-12 col-6 my-2">
            <div v-html="data.context"></div>
          </div>
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
//uploadAdapter
//uploadAdapter
export default {
  name: "ilrView",
  data() {
    return {
      tab1: true,
      tab2: false,
      tab3: false,
      tab4: false,
      tab5: false,
      refreshPage: true,
      window: {
        headerid: "ilrView",
        title: "نامه داخلی دریافت شده",
        titleLine:
          "کارتابل/ نامه های داخلی دریافتی / مشاهده نامه داخلی دریافتی",
      },
      data: {
        sender: "",
        receivers: "",
        date_of_entry: "",
        date_of_letter: "",
        number_of_letter: "",
        security: "",
        letter_priority: "",
        //
        hint: "",
        summary: "",
        subject: "",
        note: "",
        //
        attachment: "",
        //
        context: "",
        //
        document: "",
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
    showTab4() {
      this.tab1 = false;
      this.tab2 = false;
      this.tab3 = false;
      this.tab4 = true;
      this.tab5 = false;
    },
    showTab5() {
      this.tab1 = false;
      this.tab2 = false;
      this.tab3 = false;
      this.tab4 = false;
      this.tab5 = true;
    },
    openRefferal() {
      document.location = `/automation#/rlsIlForm`;
      let tab = { name: "ارجاع نامه داخلی", route: "rlsIlForm" };
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
      this.data.receivers = this.lastReceiver;
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
    //
    lastDocument: function () {
      this.data.document = this.lastDocument;
    },
  },
  //watch
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.IlsIlrStore.selectIlr) {
          return this.$store.state.IlsIlrStore.selectIlr.id;
        } else {
          return "";
        }
      },
    },
    lastSender: {
      get() {
        return this.$store.state.IlsIlrStore.selectIlr.sender;
      },
    },
    last_letter_priority: {
      get() {
        return this.$store.state.IlsIlrStore.selectIlr.letter_priority;
      },
    },
    last_security: {
      get() {
        return this.$store.state.IlsIlrStore.selectIlr.security;
      },
    },
    //
    lastSummary: {
      get() {
        if (this.$store.state.IlsIlrStore.selectIlr.summary) {
          return this.$store.state.IlsIlrStore.selectIlr.summary.summary;
        } else {
          return "";
        }
      },
    },
    lastSubject: {
      get() {
        if (this.$store.state.IlsIlrStore.selectIlr.summary) {
          return this.$store.state.IlsIlrStore.selectIlr.summary.subject;
        } else {
          return "";
        }
      },
    },
    lastNote: {
      get() {
        if (this.$store.state.IlsIlrStore.selectIlr.summary) {
          return this.$store.state.IlsIlrStore.selectIlr.summary.note;
        } else {
          return "";
        }
      },
    },
    lastHint: {
      get() {
        if (this.$store.state.IlsIlrStore.selectIlr.summary) {
          return this.$store.state.IlsIlrStore.selectIlr.summary.hint;
        } else {
          return "";
        }
      },
    },
    //
    lastContext: {
      get() {
        if (this.$store.state.IlsIlrStore.selectIlr.context) {
          return this.$store.state.IlsIlrStore.selectIlr.context.content;
        } else {
          return "";
        }
      },
    },
    lastAttachmentList: {
      get() {
        return this.$store.state.IlsIlrStore.selectIlr.attachment;
      },
    },
    lastDocument: {
      get() {
        if (this.$store.state.IlsIlrStore.selectIlr.document) {
          return this.$store.state.IlsIlrStore.selectIlr.document;
        }
      },
    },
    lastReceiver: {
      get() {
        if (this.$store.state.IlsIlrStore.selectIlr.receiver) {
          return this.$store.state.IlsIlrStore.selectIlr.receiver;
        }
      },
    },
  },
  //compute
  created() {},
};
</script>

