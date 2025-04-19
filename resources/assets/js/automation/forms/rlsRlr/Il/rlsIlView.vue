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
          <singleInputDisabled type="text" inputTitle="فرستنده" v-model="data.sender"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="اولویت" v-model="data.security"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="امنیت" v-model="data.letter_priority"></singleInputDisabled>

          <listMultiSelector
            listName="گیرنده"
            selectedItem="name"
            selectedItemTwo="family"
            childItem="userinfo"
            listSource="allUserForDls"
            :getSource="this.$store.state.RefferalStore.allUserForrls"
            :lastValue="data.receivers"
            @selectid=" data.receivers = $event"
          ></listMultiSelector>
        </div>
        <div class="row" v-bind:class="[this.tab2 ? '' : 'vpc_nav_item_selected_form']">
          <singleInputDisabled type="text" inputTitle="خطابه" v-model="data.hint"></singleInputDisabled>
          <textareaInputDisabled type="text" inputTitle="موضوع" v-model="data.subject "></textareaInputDisabled>
          <textareaInputDisabled type="text" inputTitle="خلاصه" v-model="data.summary"></textareaInputDisabled>
          <singleInputDisabled type="text" inputTitle="یادداشت شخصی" v-model="data.note"></singleInputDisabled>
        </div>
        <div class="row" v-bind:class="[this.tab3 ? '' : 'vpc_nav_item_selected_form']">
          <simpleDataTable :getData="this.lastAttachmentList"></simpleDataTable>
        </div>
        <div class="row" v-bind:class="[this.tab4 ? '' : 'vpc_nav_item_selected_form']">
          <listMultiSelector
            listName="اسناد و گواهی نامه ها"
            selectedItem="name"
            listSource="allDocumentForDls"
            :getSource="this.$store.state.ElrStore.allDocumentForDls"
            :lastValue="data.document"
            @selectid=" data.document = $event"
          ></listMultiSelector>
        </div>
        <div class="row" v-bind:class="[this.tab5 ? '' : 'vpc_nav_item_selected_form']">
          <div v-html="data.context"></div>
        </div>
        <!--tabFivedlrView-->
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
  name: "rlsDlView",
  data() {
    return {
      tab1: true,
      tab2: false,
      tab3: false,
      tab4: false,
      tab5: false,
      refreshPage: true,
      window: {
        headerid: "rlsDlView",
        title: "پیشنویس ارجاعی",
          titleLine: "کارتابل/ ارجاعات  / مشاهده نامه داخلی ارجاعی",
      },
      submit: {
        buttonTitle: "ثبت",
        axiosUrl: "/api/v1/elrRegister",
      },
      data: {
        sender: "",
        receivers: "",
        date_of_entry: "",
        date_of_letter: "",
        number_of_letter: "",
        security: "",
        type_of_letter: "",
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
       this.$store.dispatch( "selectIlr", this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.id);
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
    last_letter_priority: function () {
      if (this.last_security == 1) {
        this.data.letter_priority = "پایین";
      }
      if (this.last_security == 2) {
        this.data.letter_priority = "متوسط";
      }
      if (this.last_security == 3) {
        this.data.letter_priority = "زیاد";
      }
      if (this.last_security == 4) {
        this.data.letter_priority = "بسیار زیاد";
      }
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
  //watch
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          return this.$store.state.RefferalStore.SelectRlsIl.id;
        } else {
          return "";
        }
      },
    },
    lastSender: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
            return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.sender;
          }
        }
      },
    },
    last_letter_priority: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
            return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr
              .letter_priority;
          }
        }
      },
    },
    last_security: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
            return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.security;
          }
        }
      },
    },
    last_type_of_letter: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
            return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.type_of_letter;
          }
        }
      },
    },
    //
    lastSummary: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
            if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.summary) {
              return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.summary
                .summary;
            } else {
              return "";
            }
          }
        }
      },
    },
    lastSubject: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
            if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.summary) {
              return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.summary
                .subject;
            } else {
              return "";
            }
          }
        }
      },
    },
    lastNote: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
            if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.summary) {
              return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.summary
                .note;
            } else {
              return "";
            }
          }
        }
      },
    },
    lastHint: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
            if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.summary) {
              return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.summary
                .hint;
            } else {
              return "";
            }
          }
        }
      },
    },
    //
    lastContext: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
            if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.context) {
              return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.context
                .content;
            } else {
              return "";
            }
          }
        }
      },
    },
    lastAttachmentList: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsIl) {
          if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
            return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr
              .attachment;
          }
        }
      },
    },
    lastDocument: {
      get() {
                if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
        return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.document;
         }
      },
    },
    lastReceiver: {
        get() {
        if (this.$store.state.RefferalStore.SelectRlsIl.ils_ilr) {
          return this.$store.state.RefferalStore.SelectRlsIl.ils_ilr.receiver;
        }
      },
    },
  },
};
</script>

