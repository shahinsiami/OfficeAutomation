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
          </div>
        </div>
        <!---->
        <div class="row" v-bind:class="[this.tab1 ? '' : 'vpc_nav_item_selected_form']">
          <listMultiSelector
            listName="گیرنده"
            selectedItem="name"
            selectedItemTwo="family"
            childItem="userinfo"
            listSource="managementUserForElr"
            :getSource="this.$store.state.CelrElsStore.managementUserForElr"
            :lastValue="data.receivers"
            @selectid=" data.receivers = $event"
          ></listMultiSelector>

          <singleInputDisabled type="text" inputTitle="تاریخ" v-model="data.date_of_letter"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="شماره نامه" v-model="data.number_of_letter"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="امنیت" v-model="data.security"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="نوع نامه" v-model="data.type_of_letter"></singleInputDisabled>
          <singleInputDisabled type="text" inputTitle="اولویت" v-model="data.letter_priority"></singleInputDisabled>
        </div>
        <div class="row" v-bind:class="[this.tab2 ? '' : 'vpc_nav_item_selected_form']">
          <singleInputDisabled type="text" inputTitle="خطابه" v-model="data.hint"></singleInputDisabled>
          <br />
          <textareaInputDisabled type="text" inputTitle="موضوع" v-model="data.subject "></textareaInputDisabled>
          <br />
          <textareaInputDisabled type="text" inputTitle="خلاصه" v-model="data.summary"></textareaInputDisabled>
          <br />
          <singleInputDisabled type="text" inputTitle="یادداشت شخصی" v-model="data.note"></singleInputDisabled>
        </div>
        <div class="row" v-bind:class="[this.tab3 ? '' : 'vpc_nav_item_selected_form']">
          <simpleDataTable :getData="this.lastAttachment"></simpleDataTable>
        </div>
        <div class="row" v-bind:class="[this.tab4 ? '' : 'vpc_nav_item_selected_form']">
          <listMultiSelector
            listName="اسناد و گواهی نامه ها"
            selectedItem="name"
            listSource="allDocumentForElr"
            :getSource="this.$store.state.CelrElsStore.allDocumentForElr"
            :lastValue="data.document"
            @selectid=" data.document = $event"
          ></listMultiSelector>
        </div>
        <div class="row" v-bind:class="[this.tab4 ? '' : 'vpc_nav_item_selected_form']"></div>
        <!--tabFiveElrView-->
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
  name: "rlsElView",
  data() {
    return {
      tab1: true,
      tab2: false,
      tab3: false,
      tab4: false,
      tab5: false,
      refreshPage: true,
      window: {
        headerid: "rlsElView",
        title: "نامه ارجاعی",
        titleLine: "نامه خارجی",
      },
      simpleDataTable: {
        deleteRow: "/api/v1/deleteElrDocumentAttachment/",
        response: "SelectRlsEl",
      },
      data: {
        id: "",
        sender: "",
        receivers: "",
        registrar: "",
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
        document: "",
      },
      refreshPage: true,
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
      this.$store.dispatch( "selectcElrView", this.$store.state.RefferalStore.SelectRlsEl.id);
      document.location = `/automation#/rlsElrForm`;
      let tab = { name: "ارجاع نامه خارجی", route: "rlsElrForm" };
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
     lastDocument: function () {
      this.data.document = this.lastDocument;
    },
    //
    
  },
  //watch
  //compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          return this.$store.state.RefferalStore.SelectRlsEl.id;
        } else {
          return "";
        }
      },
    },
    lastSender: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            return this.$store.state.RefferalStore.SelectRlsEl.elr.sender;
          }
        }
      },
    },
    lastReceiver: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            return this.$store.state.RefferalStore.SelectRlsEl.elr.receiver;
          }
        }
      },
    },
    last_Registrar: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            return this.$store.state.RefferalStore.SelectRlsEl.elr.registrar;
          }
        }
      },
    },

    last_number_of_letter: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            return this.$store.state.RefferalStore.SelectRlsEl.elr
              .number_of_letter;
          }
        }
      },
    },

    last_date_of_letter: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            return this.$store.state.RefferalStore.SelectRlsEl.elr
              .date_of_letter;
          }
        }
      },
    },
    last_letter_priority: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            return this.$store.state.RefferalStore.SelectRlsEl.elr
              .letter_priority;
          }
        }
      },
    },
    last_security: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            return this.$store.state.RefferalStore.SelectRlsEl.elr.security;
          }
        }
      },
    },
    last_type_of_letter: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            return this.$store.state.RefferalStore.SelectRlsEl.elr
              .type_of_letter;
          }
        }
      },
    },
    //
    lastSummary: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            if (this.$store.state.RefferalStore.SelectRlsEl.elr.summary) {
              return this.$store.state.RefferalStore.SelectRlsEl.elr.summary
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
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            if (this.$store.state.RefferalStore.SelectRlsEl.elr.summary) {
              return this.$store.state.RefferalStore.SelectRlsEl.elr.summary
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
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            if (this.$store.state.RefferalStore.SelectRlsEl.elr.summary) {
              return this.$store.state.RefferalStore.SelectRlsEl.elr.summary
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
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            if (this.$store.state.RefferalStore.SelectRlsEl.elr.summary) {
              return this.$store.state.RefferalStore.SelectRlsEl.elr.summary
                .hint;
            } else {
              return "";
            }
          }
        }
      },
    },
    //
    lastAttachment: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl) {
          if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
            return this.$store.state.RefferalStore.SelectRlsEl.elr.attachment;
          }
        }
      },
    },
    lastDocument: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
         return this.$store.state.RefferalStore.SelectRlsEl.elr.document
        } 
      },
    },
    lastReceiver: {
      get() {
        if (this.$store.state.RefferalStore.SelectRlsEl.elr) {
        return this.$store.state.RefferalStore.SelectRlsEl.elr.receiver
        } 
      },
    },
  },
  //compute
  created() {},
};
</script>

