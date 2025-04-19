<template>
  <section class="vpc_left_side">
    <div class="d-flex flex-column">
      <div
        class="position-relative d-flex flex-row justify-content-center align-items-center vpc_name_family"
      >
        <img :src="this.photo" class="vpc_profile_img mb-1 img-fluid" />
      </div>
      <div
        class="position-relative d-flex flex-row justify-content-center align-items-center vpc_name_family"
      >{{this.nameFamily}}</div>

      <div
        v-for="(notification,index) in this.getNotification"
        @click="openNotification(notification)"
        :key="index"
        class="position-relative d-flex flex-row justify-content-center align-items-center vpc_notification"
      >
        <div class="notification-seen">{{notification.description}}</div>

        <div class="notification-text">
          <img
            v-if="notification.seen"
            src="photo/module/Panel/client/messageSeen.svg"
            width="20px"
            height="20px"
          />
        </div>
      </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
.vpc_left_side {
  width: 100px;
  min-height: 100vh;
  transform: translateX(-100px);
  bottom: 0px !important;
  background-color: $mainColor7;
  @include shadow(0, 3, 5, 0, rgba(0, 0, 0, 0.75));
  @include font(faSans);
  z-index: 100;
}
.vpc_left_column-title {
  font-size: 0.7em;
  white-space: nowrap;
  z-index: 100;
  cursor: pointer;
}
.vpc_left_side_colapse {
  background-color: rgba(115, 115, 115, 0.9);
  color: #fff;
  @include shadow(-1, 0, 1, 0, rgba(0, 0, 0, 0.25));
  position: absolute;
  top: 25%;
  left: 51px;
  font-size: 0.7em;
  width: 250px;
  overflow: hidden;
  z-index: 100;
  mix-blend-mode: multiply;
}
.vpc_left_side_colapse_item {
  border-bottom: 1px solid $mainColor1;
  white-space: nowrap;
  height: 25px;
  cursor: pointer;
  direction: rtl;
  text-align: left;
  z-index: 100;
  &:hover {
    background-color: $mainColor7;
    z-index: 100;
  }
}
.link_side_menu {
  position: absolute;
  top: 0;
  left: 0px;
  z-index: 3;
  z-index: 100;
}
.vpc_item_arrow {
  position: absolute;
  left: 10px;
  z-index: 100;
}
.vpc_item_arrow_sub {
  position: absolute;
  left: 13px;
  z-index: 100;
}
.vpc_subItem_collapse {
  display: none;
}
.vpc_left_side_toggle {
  width: 250px;
  overflow: hidden;
  z-index: 100;
}
.vpc_sub_menu_background {
  background-color: transparent;
  position: fixed;
  height: 100vh;
  width: 100vw;
  left: calc(100vw + 250px);
  left: -100vw;
  top: -80px;
  z-index: 100;
}
.vpc_left_menu_icon {
  cursor: pointer;
}
.vpc_name_family {
  color: $mainColor6;
  font-size: 0.8em;
}
.vpc_profile_img {
  padding: 1rem;
  border-width: 3px;
  border-style: solid;
  border-image: linear-gradient(to bottom, red, rgba(0, 0, 0, 0)) 1 100%;
}
.vpc_notification {
  color: $mainColor2;
  cursor: pointer;
  font-size: 0.7em;
  text-align: right;
  direction: rtl;
  padding: 3px;
  border-style: solid;
  border-image: linear-gradient(to bottom, red, rgba(0, 0, 0, 0)) 1 100%;
}
</style>
<script>
export default {
  name: "leftSide",
  data() {
    return {
      leftSlideAnimation: new this.$root.$data.gsapVpc.timeline(),
    };
  },
  watch: {
    leftSide: function () {
      if (this.leftSide) {
        this.leftSlideAnimation.to(".vpc_left_side", 0.5, { x: 0 });
      } else {
        this.leftSlideAnimation.to(".vpc_left_side", 0.5, { x: -100 });
      }
    },
  },
  computed: {
    leftSide: {
      get() {
        return this.$store.state.uiStore.leftSide;
      },
    },
    nameFamily: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return (
            this.$store.state.profile.getUserInfo.name +
            " " +
            this.$store.state.profile.getUserInfo.family
          );
        }
      },
    },
    photo: {
      get() {
        if (this.$store.state.profile.getUserInfo) {
          return this.$store.state.profile.getUserInfo.photo;
        }
      },
    },
    getNotification: {
      get() {
        return this.$store.state.profile.getNotification;
      },
    },
  },
  methods: {
    openNotification(item) {
      this.$store.state[JSON.parse(item.dispatch)[0]][
        JSON.parse(item.dispatch)[1]
      ] = { id: "" };
         this.$router.push({ name:item.route });
      let tab = { name: "تقویم", route: item.route };
      this.$store.dispatch("upSidePush", tab);

      setTimeout(() => {
        this.$store.dispatch(JSON.parse(item.dispatch)[1], item.data);
      }, 1000);
      this.$store.dispatch("seenNotification", item.id);
      this.$store.dispatch("getNotification");
    },
  },
  created: function () {
    this.$store.dispatch("getNotification");
  },
};
</script>
