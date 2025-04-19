<template>
  <section>
    <div class="vpc_active_slide_menu mt-3">
      <div class="d-flex flex-row w-100 justify-content-center align-items-center">
        <svg
          class="openSideMenu"
          viewBox="0 0 100 80"
          width="30"
          height="30"
          @click="openLeftSide"
        >
          <rect class="openLeftSide1" fill="#f9a825" width="50" height="10" />
          <rect class="openLeftSide2" fill="#f9a825" y="15" width="50" height="10" />
          <rect class="openLeftSide3" fill="#f9a825" y="30" width="50" height="10" />
        </svg>
      </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
.openSideMenu {
  cursor: pointer;
}
</style>
<script>
export default {
  name: "headerLeftIcon",
  data() {
    return {
      rigthSlideIcon: new this.$root.$data.gsapVpc.timeline()
    };
  },
  computed: {
    leftSide: {
      get() {
        return this.$store.state.uiStore.leftSide;
      }
    }
  },
  methods: {
    openLeftSide() {
      if (!this.leftSide) {
        this.rigthSlideIcon.to(".openLeftSide1", 0.1, {
          rotation: 90,
          y: 15,
          x: 0,
          fill: "#b71c1c",
          transformOrigin: "center center"
        });
        this.rigthSlideIcon.to(".openLeftSide2", 0.1, {
          rotation: 90,
          y: 0,
          x: -15,
          fill: "#b71c1c",
          transformOrigin: "center center"
        });
        this.rigthSlideIcon.to(".openLeftSide3", 0.1, {
          rotation: 90,
          y: -15,
          x: 15,
          fill: "#b71c1c",
          transformOrigin: "center center"
        });
        this.$store.dispatch("leftSide", true);
      } else {
        this.rigthSlideIcon.to(".openLeftSide1", 0.1, {
          rotation: 0,
          y: 0,
          x: 0,
          fill: "#f9a825",
          transformOrigin: "center center"
        });
        this.rigthSlideIcon.to(".openLeftSide2", 0.1, {
          rotation: 0,
          y: 0,
          x: 0,
          fill: "#f9a825",
          transformOrigin: "center center"
        });
        this.rigthSlideIcon.to(".openLeftSide3", 0.1, {
          rotation: 0,
          y: 0,
          x: 0,
          fill: "#f9a825",
          transformOrigin: "center center"
        });
        this.$store.dispatch("leftSide", false);
      }
    }
  }
};
</script>
