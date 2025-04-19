<template>
  <section class="col-12 my-2">
    <div class="d-flex flex-row justify-content-center">
      <vue-dropzone
        class="w-100"
        ref="viraDropzone"
        id="dropzone"
        @vdropzone-success="this.addFile"
        @vdropzone-removed-file="this.removeFile"
        :options="dropzoneOptions"
      ></vue-dropzone>
    </div>
  </section>
</template>
<!---->
<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
  components: {
    vueDropzone: vue2Dropzone
  },
  name: "multiFiles",
  data() {
    return {
      dropzoneOptions: {
        url: "api/v1/uploadFile",
        thumbnailWidth: 200,
        thumbnailHeight: 200,
        maxFilesize: 100,
        headers: {
          Authorization:
            "Bearer " + document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
        },
        addRemoveLinks: true,
        dictDefaultMessage:
          "<img src='photo/module/Panel/forms/fileupload.png' height='50px' width='50px'>" +
          "&nbsp &nbsp &nbsp" +
          "فایل های انتخابی را در اینجا وارد کنید"
      },
      data: {
        file: []
      }
    };
  },
  methods: {
    addFile(file, response) {
      this.data.file.push(response);
      document.querySelectorAll(".dz-filename").forEach(item => {
        if (item.firstElementChild.innerText.split(".").pop() == "txt") {
          item.parentElement.style.backgroundImage =
            "url(photo/module/Panel/filetype/txt.png)";
        }
        if (item.firstElementChild.innerText.split(".").pop() == "xlsx") {
          item.parentElement.style.backgroundImage =
            "url(photo/module/Panel/filetype/xls.png)";
        }
        if (item.firstElementChild.innerText.split(".").pop() == "xlsm") {
          item.parentElement.style.backgroundImage =
            "url(photo/module/Panel/filetype/xls.png)";
        }
        if (item.firstElementChild.innerText.split(".").pop() == "zip") {
          item.parentElement.style.backgroundImage =
            "url(photo/module/Panel/filetype/zip.png)";
        }
        if (item.firstElementChild.innerText.split(".").pop() == "rar") {
          item.parentElement.style.backgroundImage =
            "url(photo/module/Panel/filetype/zip.png)";
        }
        if (item.firstElementChild.innerText.split(".").pop() == "pdf") {
          item.parentElement.style.backgroundImage =
            "url(photo/module/Panel/filetype/pdf.png)";
        }
        if (item.firstElementChild.innerText.split(".").pop() == "docx") {
          item.parentElement.style.backgroundImage =
            "url(photo/module/Panel/filetype/doc.png)";
        }
        if (item.firstElementChild.innerText.split(".").pop() == "doc") {
          item.parentElement.style.backgroundImage =
            "url(photo/module/Panel/filetype/doc.png)";
        }
        if (item.firstElementChild.innerText.split(".").pop() == "mp4") {
          item.parentElement.style.backgroundImage =
            "url(photo/module/Panel/filetype/mov.png)";
        }
      });
      this.$emit("files", JSON.stringify(this.data.file));
    },
    removeFile(file, error, xhr) {
      let removeItem = this.data.file.find(item => {
        return item.file === file.name;
      });
      const form = new FormData();
      form.append("folder", removeItem.folder);
      form.append("file", removeItem.file);
      axios.defaults.headers.common["Authorization"] =
        "Bearer " +
        (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
          ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
          : null);
      return new Promise((resolve, reject) => {
        axios
          .post("api/v1/removeFile", form)
          .then(response => {
            let removeItem = response.data;
            let removeIndex = this.data.file.indexOf(
              this.data.file.find(item => {
                return item.folder === removeItem.folder;
              })
            );
            this.data.file.splice(removeIndex, 1);
            this.$emit("files", JSON.stringify(this.data.file));
            resolve(resolve);
          })
          .catch(error => {
            return {
              type: "error",
              title: "مشکل در حذف فایل",
              text: "لطفا با پشتیبانی ارتباط برقرار کنید"
            };
            reject(error);
          });
      });
    }
  },
  ///////////////////////////////////////////////////////////////////////model
  created() {}
};
</script>
