<template>
  <section>
    <!-- notify -->
    <div v-if="this.showNotify">
   <div @click="closeNotify"   class="vpc_notify_container_background">
   </div>
    <div class="vpc_notify_container">
        <div class="vpc_notify">
          <div class="d-flex flex-row w-100 vpc_notify_title">{{this.title}}</div>
          <div class="d-flex flex-row w-100 vpc_notify_error">{{this.message}}</div>
          <div class="d-flex flex-row justify-content-center align-items-center vpc_notify_icon_holder">
            <img @click="closeNotify" class="vpc_notify_icon" v-if="this.type == 'success'" src="photo/module/Panel/forms/accept.png">
            <img @click="closeNotify" class="vpc_notify_icon" v-if="this.type == 'error'" src="photo/module/Panel/forms/reject.png">
          </div>
        </div>
    </div>
    </div>
    <!-- notify -->
    <div class="col-12 text-center">
      <button
        v-on:click.prevent="submit"
        class="vpc_button text-center align-items-center justify-content-center"
        type="button"
      >
        <span>{{buttonTitle}}</span>
      </button>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
</style>
<script>
export default {
  name: "submitBtn",
  props: ["buttonTitle", "formData", "axiosUrl", "refresh"],
  data() {
    return {
      showNotify: false,
      notifyAnimation: new this.$root.$data.gsapVpc.timeline(),
      notifyIconAnimation: new this.$root.$data.gsapVpc.timeline(),
      type :'',
      title :'',
      message : ''
    };
  },
  computed: {},
  watch: {
    showNotify: function () {
      if (this.showNotify) {
        setTimeout(() => {
          this.notifyAnimation.to(".vpc_notify", 0.5, {
            width: 400,
          });
              this.notifyIconAnimation.to(".vpc_notify_icon", 1, {
            scale: 1,
          });
        }, 100);
 
      }
    },
  },
  methods: {
    closeNotify(){
      this.showNotify = false;
    },
    submit() {
      const data = new FormData();
      for (const item in this.formData) {
        data.append(item, this.formData[item]);
      }
      axios.defaults.headers.common["Authorization"] =
        "Bearer " +
        (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
          ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
          : null);
      axios
        .post(this.axiosUrl, data)
        .then((response) => {
          this.type = response.data.type,
          this.title = response.data.title;
          this.message = Object.values(response.data.text)[0][0];
          this.showNotify = true;
          if (response.data.status === 555) {
            this.$emit("needRefresh");
          }
        })

        .catch((error) => {
          this.notify();
        });
    },
  },
};
</script>
