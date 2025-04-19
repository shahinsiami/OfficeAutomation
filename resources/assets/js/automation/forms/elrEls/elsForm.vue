 <template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center">
        <submitBtn
          :refresh="true"
          @needRefresh="this.refresh"
          :axiosUrl="this.submit.axiosUrl"
          :formData="this.data"
          :buttonTitle="this.submit.buttonTitle"
        ></submitBtn>
      </div>
      <div class="col-6">
        <windowHeader :windowTitle="this.window.title" :windowTitleLine="this.window.titleLine"></windowHeader>
      </div>
    </div>
    <div v-if="!this.refreshPage" class="vpc_loader">
      <div class="vpc_loader_img">
        <img width="300" height="300" src="photo/module/Panel/forms/loader.gif" />
      </div>
    </div>
    <div style="direction:rtl" v-if="this.refreshPage" class="container-fluid">
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
        <singleInput type="text" inputTitle="گیرنده" v-model="data.receiver"></singleInput>
        <singleInputDisabled type="text" inputTitle="ثبت کننده" v-model="this.getUserInfo"></singleInputDisabled>
        <listMultiSelector
          listName="فرستنده"
          selectedItem="name"
          selectedItemTwo="family"
          childItem="userinfo"
          listSource="managementUserForEls"
          :getSource="this.$store.state.ElsStore.managementUserForEls"
          :lastValue="[]"
          @selectid=" data.sender = $event"
        ></listMultiSelector>
        <datePicker inputTitle="تاریخ نامه" v-model="data.date_of_letter"></datePicker>
        <listSelector
          selectedItem="name"
          listName="درگاه"
          listSource="allGateForEls"
          :getSource="this.$store.state.ElsStore.allGateForEls"
          @selectid=" data.indicator = $event.indicator "
          :lastValue="[]"
        ></listSelector>
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
          listName="اولویت"
          selectedItem="name"
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
        <multiFiles @files="data.attachment = $event"></multiFiles>
      </div>
      <!--tabThreeElsForm-->
      <!--tabFourElsForm-->
      <div class="row" v-bind:class="[this.tab4 ? '' : 'vpc_nav_item_selected_form']">
        <listMultiSelector
          listName="اسناد و گواهی نامه ها"
          selectedItem="name"
          listSource="allDocumentForEls"
          :getSource="this.$store.state.ElsStore.allDocumentForEls"
          :lastValue="[]"
          @selectid=" data.document = $event"
        ></listMultiSelector>
      </div>
      <div class="row" v-bind:class="[this.tab5 ? '' : 'vpc_nav_item_selected_form']"></div>
      <div class="row" v-bind:class="[this.tab6 ? '' : 'vpc_nav_item_selected_form']">
        <div class="col-12 col-6 my-2">
          <ckeditor
            @input="data.editor"
            :editor="editor"
            v-model="data.context"
            :config="editorConfig"
            @ready="onReady"
          ></ckeditor>
        </div>
        <br />
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
  name: "elsForm",
  data() {
    return {
      refreshPage: true,
      tab1: true,
      tab2: false,
      tab3: false,
      tab4: false,
      tab5: false,
      tab6: false,
      window: {
        headerid: "elsForm",
        title: "ثبت نامه ارسالی",
        titleLine: "نامه های خارجی/ نامه خارجی ارسالی / ثبت نامه",
      },

      submit: {
        buttonTitle: "ثبت",
        axiosUrl: "/api/v1/elsRegister",
      },
      data: {
        sender: "",
        receiver: "",
        registrar:
          this.$store.state.profile.getUserInfo.name +
          "  " +
          this.$store.state.profile.getUserInfo.family,
        date_of_letter: "",
        number_of_letter: "",
        indicator: "",
        security: 1,
        type_of_letter: 2,
        letter_priority: 2,
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
    // refresh
    refresh() {
      this.refreshPage = false;
      for (let key in this.data) {
        this.data[key] = "";
      }
      setTimeout(() => {
        this.refreshPage = true;
        this.data.registrar = this.getUserInfo;
      }, 1000);
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
  //method
  ///////////////////////////////////////////////////////////////////////method
  ///////////////////////////////////////////////////////////////////////compute
  computed: {
    getUserInfo: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          this.data.registrar =
            this.$store.state.profile.getUserInfo.name +
            "  " +
            this.$store.state.profile.getUserInfo.family;
          return (
            this.$store.state.profile.getUserInfo.name +
            "  " +
            this.$store.state.profile.getUserInfo.family
          );
        } else {
          return "";
        }
      },
    },
  },
  ///////////////////////////////////////////////////////////////////////compute
  created() {},
};
</script>

