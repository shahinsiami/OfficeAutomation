<template>
  <section class="vpc_wrapper">
    <div v-for="(item,index) in this.menu" :key="index">
      <div v-for="(subItems,indexSubItem) in item.items" :key="indexSubItem">
        <div
          v-for="(subItemsVfor,indexSubItemVfor) in subItems.subItems"
          :key="indexSubItemVfor"
        >
          <div v-if="!subItemsVfor.subSubItems">
            <router-multi-view
              v-if="upSidePush.find(obj => obj.route == subItemsVfor.id)"
              :view-name="subItemsVfor.id"
            />
          </div>
          <div v-if="subItemsVfor.subSubItems">
            <div v-for="(subSubItems,indexSubSub) in subItemsVfor.subSubItems" :key="indexSubSub">
              <div v-if="subSubItems.subSubItems">
                <div
                  v-for="(subSubItemsSubSubItemsVfor,subSubItemsSubSubItemsIndex) in subSubItems.subSubItems"
                  :key="subSubItemsSubSubItemsIndex"
                >
                  <!-- <router-multi-view
                    v-if="upSidePush.find(obj => obj.route == subSubItemsSubSubItemsVfor.id)"
                    :view-name="subSubItemsSubSubItemsVfor.id"
                  /> -->
                </div>
              </div>
              <div v-if="!subSubItems.subSubItems">
                <!-- <router-multi-view
                  v-if="upSidePush.find(obj => obj.route == subSubItems.id)"
                  :view-name="subSubItems.id"
                /> -->
              </div>
              <div
                v-for="(subSubItemsVfor,indexSubSubItemVfor) in subSubItems.subSubItems"
                :key="indexSubSubItemVfor"
              >
                <router-multi-view
                  v-if="upSidePush.find(obj => obj.route == subSubItemsVfor.id)"
                  :view-name="subSubItemsVfor.id"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
.vpc_wrapper {
  min-height: 100vh;
  width: 100%;
}
</style>
<script>
export default {
  name: "wrapper",
  data() {
    return {
      wrapper: new this.$root.$data.gsapVpc.timeline(),
    };
  },
  watch: {
    rightSide: function () {
      if (this.rightSide && this.leftSide) {
        this.wrapper.to(".vpc_wrapper", 0.5, {
          width: "calc(100% - 150px)",
          x: 25,
        });
      }
      if (!this.rightSide && this.leftSide) {
        this.wrapper.to(".vpc_wrapper", 0.5, {
          width: "calc(100% - 100px)",
          x: 50,
        });
      }
      if (this.rightSide && !this.leftSide) {
        this.wrapper.to(".vpc_wrapper", 0.5, {
          width: "calc(100% - 50px)",
          x: -25,
        });
      }
      if (!this.rightSide && !this.leftSide) {
        this.wrapper.to(".vpc_wrapper", 0.5, { width: "100%", x: 0 });
      }
    },
    leftSide: function () {
      if (this.rightSide && this.leftSide) {
        this.wrapper.to(".vpc_wrapper", 0.5, {
          width: "calc(100% - 150px)",
          x: 25,
        });
      }
      if (!this.rightSide && this.leftSide) {
        this.wrapper.to(".vpc_wrapper", 0.5, {
          width: "calc(100% - 100px)",
          x: 50,
        });
      }
      if (this.rightSide && !this.leftSide) {
        this.wrapper.to(".vpc_wrapper", 0.5, {
          width: "calc(100% - 50px)",
          x: -25,
        });
      }
      if (!this.rightSide && !this.leftSide) {
        this.wrapper.to(".vpc_wrapper", 0.5, { width: "100%", x: 0 });
      }
    },
  },
  computed: {
    rightSide: {
      get() {
        return this.$store.state.uiStore.rightSide;
      },
    },
    leftSide: {
      get() {
        return this.$store.state.uiStore.leftSide;
      },
    },
    upSidePush: {
      get() {
        return this.$store.state.wrapperStore.upSidePush;
      },
    },
    menu: {
      get() {
        return this.$store.state.wrapperStore.rightMenuItem;
      },
    },
  },
  methods: {},
  created(){
     this.$store.dispatch('getUserInfo');
     this.$store.dispatch('userMenu');
  }
};
</script>
