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
          <singleInput type="text" inputTitle="فرستنده" v-model="data.sender"></singleInput>
          <singleInputDisabled type="text" inputTitle="ثبت کننده" v-model="data.registrar"></singleInputDisabled>

          <listMultiSelector
            listName="گیرنده"
            selectedItem="name"
            selectedItemTwo="family"
            childItem="userinfo"
            listSource="managementUserForElr"
            :getSource="this.$store.state.ElrStore.managementUserForElr"
            :lastValue="data.receivers"
            @selectid=" data.receivers = $event"
          ></listMultiSelector>

          <datePicker inputTitle="تاریخ نامه" v-model="data.date_of_letter"></datePicker>
          <singleInput type="text" inputTitle="شماره نامه" v-model="data.number_of_letter"></singleInput>
          <listSelectorOptional
            selectedItem="name"
            listName="امنیت"
            :getSource="this.$store.state.mainStore.letterSecurity"
            @selectid=" data.security = $event.id "
            :lastValue="this.data.security"
          ></listSelectorOptional>
          <listSelectorOptional
            selectedItem="name"
            listName="نوع"
            :getSource="this.$store.state.mainStore.letterType"
            @selectid=" data.type_of_letter = $event.id "
            :lastValue="this.data.type_of_letter"
          ></listSelectorOptional>
          <listSelectorOptional
            selectedItem="name"
            listName="اولویت"
            :getSource="this.$store.state.mainStore.priority"
            @selectid=" data.letter_priority = $event.id "
            :lastValue="this.data.letter_priority"
          ></listSelectorOptional>
        </div>
        <div class="row" v-bind:class="[this.tab2 ? '' : 'vpc_nav_item_selected_form']">
          <singleInput type="text" inputTitle="خطابه" v-model="data.hint"></singleInput>
          <textareaInput type="text" inputTitle="موضوع" v-model="data.subject "></textareaInput>
          <textareaInput type="text" inputTitle="خلاصه" v-model="data.summary"></textareaInput>
          <singleInput type="text" inputTitle="یادداشت شخصی" v-model="data.note"></singleInput>
        </div>
        <div class="row" v-bind:class="[this.tab3 ? '' : 'vpc_nav_item_selected_form']">
          <simpleDataTable
            :deleteRow="this.simpleDataTable.deleteRow"
            :response="[this.simpleDataTable.response,this.lastId]"
            operation="delete"
            :getData="this.lastAttachment"
          ></simpleDataTable>

          <multiFiles @files="data.attachment = $event"></multiFiles>
        </div>
        <div class="row" v-bind:class="[this.tab4 ? '' : 'vpc_nav_item_selected_form']">
          <listMultiSelector
            listName="اسناد و گواهی نامه ها"
            selectedItem="name"
            listSource="allDocumentForElr"
            :getSource="this.$store.state.ElrStore.allDocumentForElr"
            :lastValue="data.document"
            @selectid=" data.document = $event"
          ></listMultiSelector>
        </div>
        <div class="row" v-bind:class="[this.tab5 ? '' : 'vpc_nav_item_selected_form']"></div>
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
export default {
  name: "elrEdit",
  data() {
    return {
      tab1: true,
      tab2: false,
      tab3: false,
      tab4: false,
      tab5: false,
      refreshPage: true,
      window: {
        headerid: "elrEdit",
        title: " نامه دریافتی",
        titleLine: "نامه های خارجی/ نامه خارجی دریافتی / ویرایش نامه",
      },

      simpleDataTable: {
        deleteRow: "/api/v1/deleteElrDocumentAttachment/",
        response: "selectElrEdit",
      },
      edit: {
        buttonTitle: "ویرایش",
        axiosUrl: "/api/v1/editElr/",
        response: "selectElrEdit",
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
    };
  },
  ///////////////////////////////////////////////////////////////////////model
  ///////////////////////////////////////////////////////////////////////method
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
    },
    last_number_of_letter: function () {
      this.data.number_of_letter = this.last_number_of_letter;
    },
    last_type_of_letter: function () {
      this.data.type_of_letter = this.last_type_of_letter;
    },
    last_security: function () {
      this.data.security = this.last_security;
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
  ///////////////////////////////////////////////////////////////////////watch
  ///////////////////////////////////////////////////////////////////////compute
  computed: {
    lastId: {
      get() {
        if (this.$store.state.ElrStore.selectElrEdit) {
          return this.$store.state.ElrStore.selectElrEdit.id;
        } else {
          return "";
        }
      },
    },
    lastSender: {
      get() {
        return this.$store.state.ElrStore.selectElrEdit.sender;
      },
    },
    lastReceiver: {
      get() {
        return this.$store.state.ElrStore.selectElrEdit.receiver;
      },
    },
    last_Registrar: {
      get() {
        return this.$store.state.ElrStore.selectElrEdit.registrar;
      },
    },

    last_number_of_letter: {
      get() {
        return this.$store.state.ElrStore.selectElrEdit.number_of_letter;
      },
    },

    last_date_of_letter: {
      get() {
        return this.$store.state.ElrStore.selectElrEdit.date_of_letter;
      },
    },
    last_letter_priority: {
      get() {
        return this.$store.state.ElrStore.selectElrEdit.letter_priority;
      },
    },
    last_security: {
      get() {
        return this.$store.state.ElrStore.selectElrEdit.security;
      },
    },
    last_type_of_letter: {
      get() {
        return this.$store.state.ElrStore.selectElrEdit.type_of_letter;
      },
    },
    //
    lastSummary: {
      get() {
        if (this.$store.state.ElrStore.selectElrEdit.summary) {
          return this.$store.state.ElrStore.selectElrEdit.summary.summary;
        } else {
          return "";
        }
      },
    },
    lastSubject: {
      get() {
        if (this.$store.state.ElrStore.selectElrEdit.summary) {
          return this.$store.state.ElrStore.selectElrEdit.summary.subject;
        } else {
          return "";
        }
      },
    },
    lastNote: {
      get() {
        if (this.$store.state.ElrStore.selectElrEdit.summary) {
          return this.$store.state.ElrStore.selectElrEdit.summary.note;
        } else {
          return "";
        }
      },
    },
    lastHint: {
      get() {
        if (this.$store.state.ElrStore.selectElrEdit.summary) {
          return this.$store.state.ElrStore.selectElrEdit.summary.hint;
        } else {
          return "";
        }
      },
    },
    //
    lastAttachment: {
      get() {
        return this.$store.state.ElrStore.selectElrEdit.attachment;
      },
    },
    lastDocument: {
      get() {
          return this.$store.state.ElrStore.selectElrEdit.document
      },
    },
    receiver: {
      get() {
        if (this.$store.state.ElrStore.selectElrEdit.receiver) {
          let user = [];
          this.$store.state.ElrStore.selectElrEdit.receiver.forEach((item) => {
            user.push(item);
          });
          return JSON.stringify(user);
        } else {
          return "[]";
        }
      },
    },
  },
  ///////////////////////////////////////////////////////////////////////compute
  created() {},
};
</script>

