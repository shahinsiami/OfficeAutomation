<template>
  <section class="my-2 col-12 col-lg-6">
    <div class="vpc_input_holder">
      <span class="w-100">
        <input type="text" class="vpc_input" v-model="imageName" />
        <label for="imgUpload">{{imageTitle}}</label>
        <input
          type="file"
          accept=".png, .jpg, .jpeg, .svg"
          ref="files"
          v-on:change="changeImage"
          class="vpc_input_image"
        />
        <div class="vpc_image d-flex flex-row justify-content-center">
          <img class="vpc_image_icon" :src="this.showImage" @click="showFullImage" />
        </div>
          <div v-if="this.showImage !== 'photo/module/Panel/forms/imageUpload.svg'" class="vpc_remove_image d-flex flex-row  align-items-center justify-content-center"  @click="removeimage($event)">
          x
        </div>
      </span>
    </div>
    <div
      @click="hideFullImage"
      v-if="this.showFullImageSelected"
      class="vpc_full_image d-flex flex-row justify-content-center align-items-center"
    >
      <div class="vpc_full_image_pic d-flex flex-row justify-content-center align-items-center">
        <img :src="this.showImage" class="vpc_full_image_height img-fluid" />
      </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
</style>
<script>
export default {
  name: "imageInput",
  props: ["lastImageProp", "imageTitle"],
  data() {
    return {
      selectedFile:'',
      showImage: "photo/module/Panel/forms/imageUpload.svg",
      imageName: " ",
      showFullImageSelected: false,
    };
  },
  watch: {
    lastImage: function () {
      if(this.lastImageProp !== ""){
        this.showImage = this.lastImage;
      }
    },
  },
  computed: {
    lastImage: {
      get() {
        if (this.lastImageProp) {
          return this.lastImageProp;
        }
      },
    },
  },
  methods: {
    changeImage(e) {
      let reader = new FileReader();
      reader.onload = (e) => {
        this.showImage = e.target.result;
      };
      this.imageName = e.target.files[0].name;
      reader.readAsDataURL(e.target.files[0]);
      this.$emit("file", e.target.files[0]);
    },
    removeimage(e) {
      e.target.parentElement.childNodes[2].nextElementSibling.value = ""
      this.$emit("file", "");
      this.showImage = "photo/module/Panel/forms/imageUpload.svg"
      this.imageName=""
    },
    showFullImage() {
      if (this.showImage !== "photo/module/Panel/forms/imageUpload.svg") {
        this.showFullImageSelected = true;
      }
    },
    hideFullImage() {
      this.showFullImageSelected = false;
    },
  },
  mounted(){
     if(this.lastImageProp !== "" && this.lastImageProp !== null){
        this.showImage = this.lastImage;
      }
  }
};
</script>
