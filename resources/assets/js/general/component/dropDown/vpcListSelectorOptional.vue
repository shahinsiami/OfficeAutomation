<template>
  <section v-bind:class="[this.allRow ? 'my-2 col-12' : 'my-2 col-12 col-lg-6']">
    <div class="vpc_input_holder position-relative">
      <div class="vpc_drop_arrow d-flex flex-row justify-content-center">
        <img
          @click="openDropDown"
          class="vpc_drop_arrow_icon"
          :class="`vpc_drop_arrow_icon_${this.listSource}`"
          src="photo/module/Panel/forms/arrowDropDwon.svg"
        />
      </div>
      <div @click="closeDropDown" v-if="this.dropStatus" class="vpc_drop_down_backgroun"></div>
      <span @click="openDropDown" class="w-100">
        <input v-model="selectDropDown" class="vpc_input" disabled />
        <label>{{listName}}</label>
      </span>
      <div v-if="this.dropStatus" class="vpc_drop_list">
        <div class="vpc_drop_search_holder">
          <span class="w-100">
            <input
              placeholder="جستجو"
              @keyup="changeText"
              v-model="inputDropSearch"
              class="vpc_drop_search_input"
            />
            <label>
              <img width="20" height="20" class="img-fluid" src="photo/module/search.svg" />
              جستجو
            </label>
          </span>
        </div>
        <li
          v-for="(item,index) in this.source"
          :key="index"
          @click="selectItem(item)"
          class="vpc_drop_list_item"
        >
          <span v-if="!childItem && !selectedItem">{{item}}</span>
          <span v-if="!childItem && selectedItem  && !selectedItemTwo">{{item[selectedItem]}}</span>
          <span
            v-if="!childItem && selectedItemTwo && !selectedItemThree"
          >{{item[selectedItem]}} {{item[selectedItemTwo]}}</span>
          <span
            v-if="!childItem && selectedItemThree"
          >{{item[selectedItem]}} {{item[selectedItemTwo]}} {{item[selectedItemThree]}}</span>
          <span v-if="childItem && !childItemTow && !selectedItem">{{item[childItem]}}</span>
          <span
            v-if="childItem && !childItemTow && selectedItem  && !selectedItemTwo"
          >{{item[childItem][selectedItem]}}</span>
          <span
            v-if="childItem && !childItemTow && selectedItemTwo && !selectedItemThree"
          >{{item[childItem][selectedItem]}} {{item[childItem][selectedItemTwo]}}</span>
          <span
            v-if="childItem && !childItemTow && selectedItemThree"
          >{{item[childItem][selectedItem]}} {{item[childItem][selectedItemTwo]}} {{item[childItem][selectedItemThree]}}</span>
          <span v-if="childItem && childItemTow && !selectedItem">{{item[childItem][childItemTow]}}</span>
          <span
            v-if="childItem && childItemTow && selectedItem  && !selectedItemTwo"
          >{{item[childItem][childItemTow][selectedItem]}}</span>
          <span
            v-if="childItem && childItemTow && selectedItemTwo && !selectedItemThree"
          >{{item[childItem][childItemTow][selectedItem]}} {{item[childItem][childItemTow][selectedItemTwo]}}</span>
          <span
            v-if="childItem && childItemTow && selectedItemThree"
          >{{item[childItem][childItemTow][selectedItem]}} {{item[childItem][childItemTow][selectedItemTwo]}} {{item[childItem][childItemTow][selectedItemThree]}}</span>
        </li>
      </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
</style>
<script>
export default {
  name: "listSelector",
  props: [
    "allRow",
    "listName",
    "listSource",
    "getSource",
    "lastValue",
    "selectedItem",
    "selectedItemTwo",
    "selectedItemThree",
    "childItem",
    "childItemTow",
  ],
  data() {
    return {
      selectDropDown: "",
      inputDropSearch: "",
      dropStatus: false,
      dropArrow: new this.$root.$data.gsapVpc.timeline(),
      dropItem: new this.$root.$data.gsapVpc.timeline(),
      time: "",
      data: {
        searchName: "",
      },
    };
  },
  methods: {
    openDropDown() {
      if (!this.dropStatus) {
        this.dropArrow.to(`.vpc_drop_arrow_icon_${this.listSource}`, 0.5, {
          rotation: 180,
        });
        setTimeout(() => {
          document.querySelector(".vpc_drop_list").style.zIndex = 100;
          document.querySelectorAll(".vpc_drop_list_item").forEach((item) => {
            this.dropItem.to(item, 0.1, { x: 0 });
          });
        }, 100);
      } else {
        this.dropArrow.to(`.vpc_drop_arrow_icon_${this.listSource}`, 0.5, {
          rotation: 0,
        });
        document.querySelector(".vpc_drop_list").style.zIndex = 1;
      }
      this.dropStatus = !this.dropStatus;
    },
    closeDropDown() {
      this.dropArrow.to(`.vpc_drop_arrow_icon_${this.listSource}`, 0.5, {
        rotation: 0,
      });
      this.dropItem.seek();
      document.querySelector(".vpc_drop_list").style.zIndex = 1;
      this.dropStatus = false;
      this.inputDropSearch = "";
    },
    changeText() {
      clearTimeout(this.time);
      this.data.searchName = this.inputDropSearch;
      document.querySelectorAll(".vpc_drop_list_item").forEach((item) => {
        if (
          item.innerHTML.includes(this.inputDropSearch) &&
          this.inputDropSearch !== ""
        ) {
          item.style.fontWeight = "900";
        } else {
          item.style.fontWeight = "300";
        }
      });
    },
       selectItem(item) {
      if (!this.childItem && !this.selectedItem) { this.selectDropDown = item;
      } else if (!this.childItem && this.selectedItem && !this.selectedItemTwo) { this.selectDropDown = item[this.selectedItem];
      } else if (!this.childItem && this.selectedItemTwo && !this.selectedItemThree) { this.selectDropDown = item[this.selectedItem] + " " + item[this.selectedItemTwo];
      } else if (!this.childItem && this.selectedItemThree) { this.selectDropDown = item[this.selectedItem] + " " + item[this.selectedItemTwo] + " " + item[this.selectedItemThree];
      } else if (this.childItem && !this.childItemTow && !this.selectedItem) { this.selectDropDown = item[this.childItem];
      } else if ( this.childItem && !this.childItemTow && this.selectedItem && !this.selectedItemTwo ) { this.selectDropDown = item[this.childItem][this.selectedItem];
      } else if ( this.childItem && !this.childItemTow && this.selectedItemTwo && !this.selectedItemThree ) { this.selectDropDown = item[this.childItem][this.selectedItem] + " " + item[this.childItem][this.selectedItemTwo];
      } else if (this.childItem && !this.childItemTow && this.selectedItemThree) { this.selectDropDown = item[this.childItem][this.selectedItem] + " " + item[this.childItem][this.selectedItemTwo] + " " + item[this.childItem][this.selectedItemThree];
      } else if (this.childItem && this.childItemTow && !this.selectedItem) { this.selectDropDown = item[this.childItem][this.childItemTow];
      } else if ( this.childItem && this.childItemTow && this.selectedItem && !this.selectedItemTwo ) { this.selectDropDown = item[this.childItem][this.childItemTow][this.selectedItem];
      } else if ( this.childItem && this.childItemTow && this.selectedItemTwo && !this.selectedItemThree ) { this.selectDropDown = item[this.childItem][this.childItemTow][this.selectedItem] + " " + item[this.childItem][this.childItemTow][this.selectedItemTwo];
      } else if (this.childItem && this.childItemTow && this.selectedItemThree) { this.selectDropDown = item[this.childItem][this.childItemTow][this.selectedItem] + " " + item[this.childItem][this.childItemTow][this.selectedItemTwo] + " " + item[this.childItem][this.childItemTow][this.selectedItemThree]; }
      this.$emit("selectid", item);
      this.closeDropDown();
    },
  },
  watch: {
     lastSelect: function () {
      if (this.lastSelect) {
       if (!this.childItem && !this.selectedItem) { this.selectDropDown = this.lastSelect;
      } else if (!this.childItem && this.selectedItem && !this.selectedItemTwo) { this.selectDropDown = this.lastSelect[this.selectedItem];
      } else if (!this.childItem && this.selectedItemTwo && !this.selectedItemThree) { this.selectDropDown = this.lastSelect[this.selectedItem] + " " + this.lastSelect[this.selectedItemTwo];
      } else if (!this.childItem && this.selectedItemThree) { this.selectDropDown = this.lastSelect[this.selectedItem] + " " + this.lastSelect[this.selectedItemTwo] + " " + this.lastSelect[this.selectedItemThree];
      } else if (this.childItem && !this.childItemTow && !this.selectedItem) { this.selectDropDown = this.lastSelect[this.childItem];
      } else if ( this.childItem && !this.childItemTow && this.selectedItem && !this.selectedItemTwo ) { this.selectDropDown = this.lastSelect[this.childItem][this.selectedItem];
      } else if ( this.childItem && !this.childItemTow && this.selectedItemTwo && !this.selectedItemThree ) { this.selectDropDown = this.lastSelect[this.childItem][this.selectedItem] + " " + this.lastSelect[this.childItem][this.selectedItemTwo];
      } else if (this.childItem && !this.childItemTow && this.selectedItemThree) { this.selectDropDown = this.lastSelect[this.childItem][this.selectedItem] + " " + this.lastSelect[this.childItem][this.selectedItemTwo] + " " + this.lastSelect[this.childItem][this.selectedItemThree];
      } else if (this.childItem && this.childItemTow && !this.selectedItem) { this.selectDropDown = this.lastSelect[this.childItem][this.childItemTow];
      } else if ( this.childItem && this.childItemTow && this.selectedItem && !this.selectedItemTwo ) { this.selectDropDown = this.lastSelect[this.childItem][this.childItemTow][this.selectedItem];
      } else if ( this.childItem && this.childItemTow && this.selectedItemTwo && !this.selectedItemThree ) { this.selectDropDown = this.lastSelect[this.childItem][this.childItemTow][this.selectedItem] + " " + this.lastSelect[this.childItem][this.childItemTow][this.selectedItemTwo];
      } else if (this.childItem && this.childItemTow && this.selectedItemThree) { this.selectDropDown = this.lastSelect[this.childItem][this.childItemTow][this.selectedItem] + " " + this.lastSelect[this.childItem][this.childItemTow][this.selectedItemTwo] + " " + this.lastSelect[this.childItem][this.childItemTow][this.selectedItemThree]; }
      }
    },
  },
  computed: {
    source: {
      get() {
        return this.getSource;
      },
    },
    lastSelect: {
      get() {
        return this.getSource.find(
          (item) => item.id === parseInt(this.lastValue)
        );
      },
    },
  },
  ///////////////////////////////////////////////////////////////////////compute
  mounted() {
    if (this.lastSelect) {
      if (this.lastSelect[this.selectedItem]) {
        this.selectDropDown = this.lastSelect[this.selectedItem];
      }
    }
  },
};
</script>
