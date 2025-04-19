<template>
  <section class="vpc_right_side">
    <div class="d-flex flex-column">
      <div class="position-relative d-flex flex-column justify-content-center align-items-center" v-for="(item,index) in this.rightMenu" :key="index" >
        <!-- icon -->
        <div v-if="!item.dontShow && item.permission.some(permission=> menuPermission.includes(permission))" @click="openSubMenu(item.icon)" class="d-flex flex-column justify-content-center align-items-center" >
          <img class="img-fluid my-1 vpc_right_menu_icon" width="30" height="30" :src="'photo/module/Panel/rightmenu/icon/'+item.icon+'.svg'" />
          <p class="vpc_right_column-title">{{item.name}}</p>
        </div>
        <!-- icon -->
        <div :id="item.icon" class="vpc_right_side_colapse vpc_right_side_toggle d-none">
          <div @click="closeSubMenu" class="vpc_sub_menu_background"></div>
          <!-- subMenu -->
          <div class="p-0 m-0 text-right">
            <img class="link_side_menu" src="photo/module/Panel/forms/linkSideMenu.svg" width="10" height="10" />
            <div v-for="(subItems,indexSubItem) in item.items" :key="indexSubItem" class="position-relative" style="z-index:101" >
              <!-- if -->
              <div v-if="subItems.subItems" @click="openSubSubMenu(subItems.itemsCollapse,$event)" class="pl-3 pr-3 vpc_right_side_colapse_item position-relative justify-content-start d-flex flex-row align-items-center" >
                {{subItems.name}}
                <div class="vpc_item_arrow">
                  <img class="link_side_arrow" src="photo/module/Panel/forms/rightSideArrow.svg" width="20" height="20" />
                </div>
                <div v-if="!subItems.subItems" @click="openSubSubMenu(subItems.itemsCollapse,$event)" class="pl-3 pr-3 vpc_right_side_colapse_item position-relative justify-content-start d-flex flex-row align-items-center" >
                {{subItems.name}}
                </div>
              </div>
              <!-- if -->
              <!-- </div> -->
              <div class="vpc_subItem_collapse">
                <div :id="subItems.itemsCollapse" v-for="(subItemsVfor,indexSubItemVfor) in subItems.subItems" :key="indexSubItemVfor" class="position-relative" style="z-index:101" >
                  <div @click="upSidePush(subItemsVfor.id,subItemsVfor.name)" v-if="subItemsVfor.name && !subItemsVfor.display" class="vpc_right_side_colapse_item position-relative justify-content-start d-flex flex-row align-items-center" >
                  <router-link class="w-100 pl-3 pr-5" :to="'/'+subItemsVfor.id" style="color:white;text-decoration:none">
                  {{subItemsVfor.name}}
                  </router-link>
                  </div>
                  <!-- subSubMenu -->
                  <div v-if="subItemsVfor.subSubItems">
                    <div v-for="(subSubItems,indexSubSub) in subItemsVfor.subSubItems" :key="indexSubSub" class="position-relative" style="z-index:101" >
                      <!-- if -->
                      <div @click="openSubSubSubMenu(subSubItems.subItemsCollapse,$event)" v-if="subSubItems.subSubItems" class="pl-3 pr-4 vpc_right_side_colapse_item position-relative justify-content-start d-flex flex-row align-items-center" >
                        {{subSubItems.name}}
                        <div class="vpc_item_arrow_sub">
                          <img class="link_side_arrow" src="photo/module/Panel/forms/rightSideArrow.svg" width="15" height="15" />
                        </div>
                      </div>
                        <div v-if="!subSubItems.subSubItems" class="vpc_right_side_colapse_item position-relative justify-content-start d-flex flex-row align-items-center" >
                          <router-link class="w-100 pl-3 pr-5 " :to="'/'+subSubItems.subSubItems" style="color:white;text-decoration:none">
                           {{subSubItems.subSubItems}}
                          </router-link>
                        </div>
                      <!-- if -->
                      <!-- subSubSubMenu -->
                      <div v-if="subSubItems.subSubItems">
                        <div class="vpc_subItem_collapse">
                          <div :id="subSubItems.subItemsCollapse" v-for="(subSubItemsVfor,indexSubSubItemVfor) in subSubItems.subSubItems" :key="indexSubSubItemVfor" class="position-relative" style="z-index:101" >
                              <div @click="upSidePush(subSubItemsVfor.id,subSubItemsVfor.name)" v-if="!subSubItemsVfor.display" class="vpc_right_side_colapse_item position-relative justify-content-start d-flex flex-row align-items-center" >
                          <router-link class="w-100 pl-3 pr-5" :to="'/'+subSubItemsVfor.id" style="color:white;text-decoration:none">
                           {{subSubItemsVfor.name}}
                          </router-link>
                        </div>
                          </div>
                        </div>
                      </div>
                      <!-- subSubSubMenu -->
                    </div>
                  </div>
                  <!-- subSubMenu -->
                </div>
              </div>
            </div>
          </div>
          <!-- subMenu -->
        </div>
      </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
.vpc_right_side {
  bottom: 0px !important;
  width: 50px;
  min-height: 100vh;
  transform: translateX(50px);
  background-color: $mainColor7;
  @include shadow(0, 3, 5, 0, rgba(0, 0, 0, 0.75));
  @include font(faSans);
  z-index: 100;
}
.vpc_right_column-title {
  font-size: 0.6em;
  white-space: nowrap;
  z-index: 100;
  cursor: pointer;
}
.vpc_right_side_colapse {
  background-color: rgba(115, 115, 115, 0.9);
  color:#fff;
  @include shadow(-1, 0, 1, 0, rgba(0, 0, 0, 0.25));
  position: absolute;
  top: 25%;
  right: 51px;
  font-size: 0.7em;
  width: 250px;
  overflow: hidden;
  z-index: 100;
  mix-blend-mode: multiply;
}
.vpc_right_side_colapse_item {
  border-bottom: 1px solid $mainColor1;
  white-space: nowrap;
  height: 25px;
  cursor: pointer;
  direction: rtl;
  text-align: right;
  z-index: 100;
  &:hover {
    background-color: $mainColor7;
    z-index: 100;
  }
}
.link_side_menu {
  position: absolute;
  top: 0;
  right: 0px;
  z-index: 3;
  z-index: 100;
}
.vpc_item_arrow {
  position: absolute;
  left: 10px;
  z-index: 100;
}
.vpc_item_arrow_sub{
    position: absolute;
  left: 13px;
  z-index: 100;
}
.vpc_subItem_collapse {
  display: none;
}
.vpc_right_side_toggle {
  width: 250px;
  overflow: hidden;
  z-index: 100;
}
.vpc_sub_menu_background {
  background-color: transparent;
  position: fixed;
  height: 100vh;
  width: 100vw;
  right: calc(100vw + 250px);
  left: -100vw;
  top: -80px;
  z-index: 100;
}
.vpc_right_menu_icon{
  cursor:pointer;
}
</style>
<script>
export default {
  name: "rightSide",
  data() {
    return {
      rightSlideAnimation: new this.$root.$data.gsapVpc.timeline(),
      openSubSubMenuAnimation: new this.$root.$data.gsapVpc.timeline(),
      openSubMenuAnimation: new this.$root.$data.gsapVpc.timeline(),
    };
  },
  watch: {
    rightSide: function () {
      if (this.rightSide) {
        this.rightSlideAnimation.to(".vpc_right_side", 0.5, { x: 0 });
      } else {
        this.rightSlideAnimation.to(".vpc_right_side", 0.5, { x: 50 });
      }
    },
  },
  computed: {
    rightSide: {
      get() {
        return this.$store.state.uiStore.rightSide;
      },
    },
    rightMenu: {
      get() {
        return this.$store.state.wrapperStore.rightMenuItem;
      },
    },
         menuPermission: {
                    get() {

                        if (this.$store.state.profile.userMenu) {
                            return this.$store.state.profile.userMenu
                        } else {
                            return ['nothing']
                        }
                    }
                    ,
                },
  },
  methods: {
    openSubSubMenu(item, event) {
      if (
        document
          .querySelector(`#${item}`)
          .parentElement.classList.contains("vpc_subItem_collapse")
      ) {
        document
          .querySelector(`#${item}`)
          .parentElement.classList.remove("vpc_subItem_collapse");
        this.openSubSubMenuAnimation.to(event.target.children, 0.3, {
          rotate: "+= 180",
        });
        this.openSubSubMenuAnimation.to("#" + item, 0.1, { x: -100 });
        this.openSubSubMenuAnimation.to("#" + item, 0.1, { x: 0 });
      } else {
        this.openSubSubMenuAnimation.to("#" + item, 0.5, {
          x: 500,
          onComplete: () => {
            this.openSubSubMenuAnimation.to(event.target.children, 0.3, {
              rotate: "+= 180",
            });
            document
              .querySelector(`#${item}`)
              .parentElement.classList.add("vpc_subItem_collapse");
          },
        });
      }
    },
    openSubSubSubMenu(item, event) {
      if (
        document
          .querySelector(`#${item}`)
          .parentElement.classList.contains("vpc_subItem_collapse")
      ) {
        document
          .querySelector(`#${item}`)
          .parentElement.classList.remove("vpc_subItem_collapse");
        this.openSubSubMenuAnimation.to(event.target.children, 0.3, {
          rotate: "+= 180",
        });
        this.openSubSubMenuAnimation.to("#" + item, 0.1, { x: -100 });
        this.openSubSubMenuAnimation.to("#" + item, 0.1, { x: 0 });
      } else {
        this.openSubSubMenuAnimation.to("#" + item, 0.5, {
          x: 500,
          onComplete: () => {
            this.openSubSubMenuAnimation.to(event.target.children, 0.3, {
              rotate: "+= 180",
            });
            document
              .querySelector(`#${item}`)
              .parentElement.classList.add("vpc_subItem_collapse");
          },
        });
      }
    },
    openSubMenu(item) {
      document.querySelectorAll(".vpc_right_side_toggle").forEach((item) => {
        item.classList.add("d-none");
      });
      document.querySelector("#" + item).classList.remove("d-none");
      this.openSubMenuAnimation.from(document.querySelector("#" + item), 0.3, {
        width: "0",
      });
    },
    closeSubMenu() {
      document.querySelectorAll(".vpc_right_side_toggle").forEach((item) => {
        item.classList.add("d-none");
      });
    },
    upSidePush(route,name){
      let tab= {'name': name,'route' : route}
      this.$store.dispatch("upSidePush", tab);
    }
  },
};
</script>
