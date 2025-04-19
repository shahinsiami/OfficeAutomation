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
        <div class="vpc_multiselect_holder">
          <div></div>
          <div class="mx-1" v-for="(item,index) in this.selectDropDown" :key="index">
            <div class="p-1 m-0 d-flex flex-row justify-content-center align-items-center h-100">
              <div class="vpc_multiselect_delete mx-1" @click="deleteItem(item,$event)">x</div>
              <div
                class="vpc_multiselect_items d-flex flex-row align-items-center justify-content-center"
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
                <span
                  v-if="childItem && childItemTow && !selectedItem"
                >{{item[childItem][childItemTow]}}</span>
                <span
                  v-if="childItem && childItemTow && selectedItem  && !selectedItemTwo"
                >{{item[childItem][childItemTow][selectedItem]}}</span>
                <span
                  v-if="childItem && childItemTow && selectedItemTwo && !selectedItemThree"
                >{{item[childItem][childItemTow][selectedItem]}} {{item[childItem][childItemTow][selectedItemTwo]}}</span>
                <span
                  v-if="childItem && childItemTow && selectedItemThree"
                >{{item[childItem][childItemTow][selectedItem]}} {{item[childItem][childItemTow][selectedItemTwo]}} {{item[childItem][childItemTow][selectedItemThree]}}</span>
              </div>
            </div>
          </div>
        </div>
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
      selectDropDown: [],
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
      let searchInterrupt = setTimeout(() => {
        if (this.listSource !== null) {
          this.$store.dispatch(this.listSource, this.data);
        }
      }, 800);
      this.time = searchInterrupt;
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
      if (!this.selectDropDown.some((tempItem) => tempItem.id == item.id)) {
        this.selectDropDown.push(item);
      }
      this.$emit("selectid", JSON.stringify(this.selectDropDown));
    },
    deleteItem(item, e) {
      e.stopPropagation();
      let editItem = this.selectDropDown.filter(
        (temItem) => temItem.id != item.id
      );
      this.selectDropDown = editItem;

      this.$emit("selectid", JSON.stringify(this.selectDropDown));
    },
  },
  watch: {
  //   lastSelect: function () {
  //       this.lastValue.forEach((item) => {
  //       this.selectDropDown.push(item);
  //     });
  //      this.$emit("selectid", JSON.stringify(this.selectDropDown));
  // },
  },
  computed: {
    source: {
      get() {
        return this.getSource;
      },
    },
    lastSelect: {
      get() {
        return this.lastValue
      },
    },
  },
  ///////////////////////////////////////////////////////////////////////compute
  created() {
    if (this.listSource !== null) {
      this.$store.dispatch(this.listSource, this.data);
    }
  },
  mounted:function(){
    if( this.lastValue){
    this.lastValue.forEach((item) => {
        this.selectDropDown.push(item);
      });
    }
     this.$emit("selectid", JSON.stringify(this.selectDropDown));
  }
};
</script>
