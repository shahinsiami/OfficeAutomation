<template>
  <section class="container-fluid row d-flex flex-row justify-content-center p-0 m-0">
    <div class="in_the_name_of_god w-100 d-flex flext-row justify-content-center">
      <div>In The Name Of God The Merciful And Compassionate</div>
    </div>
    <div
      class="d-flex vpc_hedeader_height w-100 flex-row justify-content-between align-items-start"
    >
      <!--left---------------------------------------->
      <div class="d-flex flex-row justify-content-center align-items-center h-100 mx-2">
        <headerLeftIcon></headerLeftIcon>
      </div>
      <!--left---------------------------------------->
      <!--vpc_logo---------------------------------------->
      <div class="m-3 vpc_logo">
        <img src="photo/module/Panel/General/logo.svg" width="60px" height="60px" />
      </div>
      <!--vpc_logo---------------------------------------->
      <!--right---------------------------------------->
      <div class="d-flex flex-row justify-content-center align-items-center h-100 mx-2">
        <headerRightIcon></headerRightIcon>
      </div>
      <!--right---------------------------------------->
    </div>
    <div
      class="vpc_hedeader_icon_height d-flx flex-row w-100 justify-content-end vpc_open_minimize"
    >
      <upSide></upSide>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
.in_the_name_of_god {
  background-color: $mainColor3;
  color: $mainColor1;
  font-size: 4px;
  height: 6px !important;
}
.vpc_hedeader_height {
  position: relative;
  height: 50px;
  z-index: 2;
  @include shadow(0, 0, 5, 0, rgba(0, 0, 0, 0.52));
  overflow: hidden;
}
.vpc_hedeader_icon_height {
  @include shadow(0, 5, 10, 0, rgba(0, 0, 0, 0.5));
  background-color: $mainColor4;
}
.vpc_logo {
  transform: translateY(100px);
  z-index: 3;
}
.vpc_open_minimize {
  background-color: $mainColor8;
  height: 27px;
}
</style>
<script>
export default {
  name: "vheader",
  components: {
    headerLeftIcon: require("./headerLeftIcon").default,
    headerRightIcon: require("./headerRightIcon").default,
    upSide: require("./upSide").default,
  },
  data() {
    return {
      logAnimation: new this.$root.$data.gsapVpc.timeline(),
    };
  },
  mounted: function () {
    this.logAnimation.to(".vpc_logo", 1, { y: -21 });
    this.logAnimation.to(".vpc_logo", 1, { scaleX: -1 });
    this.logAnimation.to(".vpc_logo", 5, { rotation: 60 });
    this.logAnimation.to(".vpc_logo", 1, { rotation: 0 });
    this.logAnimation.to(".vpc_logo", 1, { scaleX: 1 });
  },
};
</script>
