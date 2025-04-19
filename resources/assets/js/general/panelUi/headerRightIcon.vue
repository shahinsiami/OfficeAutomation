<template>
  <section>
    <div class="vpc_active_slide_menu mt-3">
      <div class="d-flex flex-row w-100 justify-content-center align-items-center">
        <svg class="openSideMenu" viewBox="0 0 100 80" width="30" height="30" @click="openRightSide">
          <rect class="openRightSide1" fill="#f9a825" width="50" height="10" />
          <rect class="openRightSide2" fill="#f9a825" y="15" width="50" height="10" />
          <rect class="openRightSide3" fill="#f9a825" y="30" width="50" height="10" />
        </svg>
      </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
.openSideMenu{
  cursor: pointer;
}
</style>
<script>
export default {
  name: "headerRightIcon",
  data() {
    return {
      rigthSlideIcon: new this.$root.$data.gsapVpc.timeline()
    };
  },
  computed: {
    rightSide: {
      get() {
        return this.$store.state.uiStore.rightSide;
      }
    }
  },
  methods: {
    openRightSide() {
      if (!this.rightSide) {
        this.rigthSlideIcon.to(".openRightSide1", 0.1, {
          rotation: 90,
          y: 15,
          x: 0,
          fill:'#b71c1c',
          transformOrigin: "center center"
        });
        this.rigthSlideIcon.to(".openRightSide2", 0.1, {
          rotation: 90,
          y: 0,
          x: -15,
          fill:'#b71c1c',
          transformOrigin: "center center"
        });
        this.rigthSlideIcon.to(".openRightSide3", 0.1, {
          rotation: 90,
          y: -15,
          x: 15,
          fill:'#b71c1c',
          transformOrigin: "center center"
        });
        this.$store.dispatch("rightSide", true);
      } else {
        this.rigthSlideIcon.to(".openRightSide1", 0.1, {
          rotation: 0,
          y: 0,
          x: 0,
          fill:'#f9a825',
          transformOrigin: "center center"
        });
        this.rigthSlideIcon.to(".openRightSide2", 0.1, {
          rotation: 0,
          y: 0,
          x: 0,
          fill:'#f9a825',
          transformOrigin: "center center"
        });
        this.rigthSlideIcon.to(".openRightSide3", 0.1, {
          rotation: 0,
          y: 0,
          x: 0,
          fill:'#f9a825',
          transformOrigin: "center center"
        });
        this.$store.dispatch("rightSide", false);
      }
    }
  }
};
</script>
