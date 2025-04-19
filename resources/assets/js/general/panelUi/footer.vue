<template>
  <section class="container-fluid row d-flex flex-row justify-content-center p-0 m-0">
    <div class="viraPersiaConnections w-100 d-flex flext-row justify-content-center">
      <div>Vira Persia Connections</div>
    </div>
    <div class="d-flex vpc_footer_height w-100 flex-row justify-content-center align-items-start">
      <div class="d-flex flex-row">
        <div
          @click="showCalender"
          @mouseleave="footerIconAnimationStop($event)"
          @mouseenter="footerIconAnimation($event)"
          class="mx-1h-100 vpc_footer_icon"
        >
          <router-link to="/calender">
            <img src="/photo/module/Panel/forms/calender.png" width="45" height="45px" />
          </router-link>
        </div>
        <div
          @click="showProfile"
          @mouseleave="footerIconAnimationStop($event)"
          @mouseenter="footerIconAnimation($event)"
          class="mx-1h-100 vpc_footer_icon"
        >
          <router-link to="/profile">
            <img src="/photo/module/Panel/forms/profile.png" width="45" height="45px" />
          </router-link>
        </div>
      </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
.viraPersiaConnections {
  background-color: $mainColor3;
  color: $mainColor1;
  font-size: 4px;
  height: 6px !important;
}
.vpc_footer_height {
  position: relative;
  height: 50px;
  z-index: 2;
  @include shadow(0, 0, 5, 0, rgba(0, 0, 0, 0.52));
}
.vpc_footer_icon {
  z-index: 3;
  cursor: pointer;
}
</style>
<script>
export default {
  name: "vfooter",
  components: {},
  data() {
    return {
      iconAnimation: new this.$root.$data.gsapVpc.timeline(),
    };
  },
  computed: {},
  methods: {
    footerIconAnimation(e) {
      this.iconAnimation.to(e.target.childNodes[0].childNodes[0], 0.2, {
        scale: 1.2,
        y: -30,
      });
    },
    footerIconAnimationStop(e) {
      this.iconAnimation.to(e.target.childNodes[0].childNodes[0], 0.2, {
        scale: 1,
        y: 0,
      });
    },
    showCalender() {
      let tab = { name: "تقویم", route: "calender" };
      this.$store.dispatch("upSidePush", tab);
    },
    showProfile() {
      let tab = { name: "پروفایل", route: "profile" };
      this.$store.dispatch("upSidePush", tab);
    },
  },
};
</script>
