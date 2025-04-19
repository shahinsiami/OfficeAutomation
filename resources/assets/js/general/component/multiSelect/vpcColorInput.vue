<template>
  <section class="col-12 my-2">
        <div class="d-flex flex-row justify-content-start align-items-center w-100 vpc_color_holder p-0 m-0">
          <div class="vpc_color_title m-0 d-flex flex-row align-items-center justify-content-center">انتخاب رنگ ها</div>
          <div class="vpc_color-picker mx-2" style="background-color: #ff0000" @click="red"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #008000" @click="green"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #02025c" @click="blue"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #cfcfcf" @click="lightgray"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #ffea00" @click="gold"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #ffffff" @click="white"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #000000" @click="black"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #ff9e80" @click="rosegold"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #b0c4de" @click="steel"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #ffff00" @click="yellow"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #c05f4e" @click="brown"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #FF00FF" @click="pink"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #800080" @click="purple"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #696969" @click="gray"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #ffa500" @click="orange"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #e4d6bb" @click="wheat"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #e1f5fe" @click="lightcyan"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #fff9c5" @click="lemonchiffon"></div>
          <div class="vpc_color-picker mx-2" style="background-color: #FF00FF" @click="fuchsia"></div>
        </div>
        <div class="col-12  my-2">
        <div class="d-flex flex-row justify-content-center align-items-start my-3 select-color-text w-100">
          <span class="select-color-text" v-for="(item,index) in this.coloBox" :key="index">
                 <button class="vpc_color_selected" @click="removecolor(index)">&times;</button>
            {{item.color}}
          </span>
        </div>
        </div>
  </section>
</template>
<!---->
<style lang="scss">
/*multichoiceform*/
.vpc_color_holder{
  background-color: $mainColor4;
  height: 40px;
}
.vpc_color_title{
  background: $mainColor8;
  color: $mainColor1;
  @include font(faSans);
  font-size: 0.8em;
  width: 150px;
  padding: 3px;
  height: 40px;
  white-space: nowrap;
  border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
.vpc_color-picker {
  height: 15px;
  width: 15px;
  border-radius: 1%;
  box-shadow: 3px 3px 3px gray;
  cursor: pointer;
}
.vpc_color-picker:hover {
  box-shadow: 3px 3px 3px $mainColor6;
}
.vpc_color-picker:hover {
  background-color: $mainColor5 !important;
}

.vpc_color_selected {
  margin-left: 0.5rem;
  margin-right: 0.5rem;
  background: $mainColor3;
  border: none;
  color: $mainColor1;
  border-radius: 50%;
  height: 1rem;
  width: 1rem;
  display: inline-block;
  line-height: 1;
  font-size: 0.8rem;
  text-align: center;
  padding: 0;
}

.vpc_color_selected:focus {
  outline: none !important;
}

.vpc_color_selected:hover {
  background: #f92600;
}
.select-color-text{
  @include font(faSans);
  font-size: 0.8em;
}

</style>
<script>
export default {
  name: "colorInput",
  props: ["lastvalue"],
  data() {
    return {
      coloBox: []
    };
  },
  computed: {},
  methods: {
    red: function red() {
      var colors = {
        color: "قرمز"
      };
      if (this.coloBox.every(item => item.color !== "قرمز")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    green: function red() {
      var colors = {
        color: "سبز"
      };
      if (this.coloBox.every(item => item.color !== "سبز")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    blue: function red() {
      var colors = {
        color: "آبی"
      };
      if (this.coloBox.every(item => item.color !== "آبی")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    lightgray: function red() {
      var colors = {
        color: "نقره ای"
      };
      if (this.coloBox.every(item => item.color !== "نقره ای")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    gold: function red() {
      var colors = {
        color: "طلایی"
      };
      if (this.coloBox.every(item => item.color !== "طلایی")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    white: function red() {
      var colors = {
        color: "سفید"
      };
      if (this.coloBox.every(item => item.color !== "سفید")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    black: function red() {
      var colors = {
        color: "مشکی"
      };
      if (this.coloBox.every(item => item.color !== "مشکی")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    rosegold: function red() {
      var colors = {
        color: "سرخابی"
      };
      if (this.coloBox.every(item => item.color !== "سرخابی")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    steel: function red() {
      var colors = {
        color: "نقره ای"
      };
      if (this.coloBox.every(item => item.color !== "نقره ای")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    yellow: function red() {
      var colors = {
        color: "زرد"
      };
      if (this.coloBox.every(item => item.color !== "زرد")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    brown: function red() {
      var colors = {
        color: "قهوه ای"
      };
      if (this.coloBox.every(item => item.color !== "قهوه ای")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    pink: function red() {
      var colors = {
        color: "بنفش"
      };
      if (this.coloBox.every(item => item.color !== "بنفش")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    purple: function red() {
      var colors = {
        color: "بنفش"
      };
      if (this.coloBox.every(item => item.color !== "بنفش")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    pink: function red() {
      var colors = {
        color: "صورتی"
      };
      if (this.coloBox.every(item => item.color !== "صورتی")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    gray: function red() {
      var colors = {
        color: "خاکستری"
      };
      if (this.coloBox.every(item => item.color !== "خاکستری")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    orange: function red() {
      var colors = {
        color: "نارنجی"
      };
      if (this.coloBox.every(item => item.color !== "خاکستری")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    wheat: function red() {
      var colors = {
        color: "کرم"
      };
      if (this.coloBox.every(item => item.color !== "خاکستری")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    lightcyan: function red() {
      var colors = {
        color: "مهتابی"
      };
      if (this.coloBox.every(item => item.color !== "خاکستری")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    lemonchiffon: function red() {
      var colors = {
        color: "آفتابی"
      };
      if (this.coloBox.every(item => item.color !== "خاکستری")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    gray: function red() {
      var colors = {
        color: "خاکستری"
      };
      if (this.coloBox.every(item => item.color !== "خاکستری")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    fuchsia: function red() {
      var colors = {
        color: "سرخابی"
      };
      if (this.coloBox.every(item => item.color !== "خاکستری")) {
        this.coloBox.push(colors);
        this.$emit("addColor", JSON.stringify(this.coloBox));
      }
    },
    removecolor: function removecolor(index) {
      this.coloBox.splice(index, 1);
      this.$emit("addColor", JSON.stringify(this.coloBox));
    }
  },
  ///////////////////////////////////////////////////////////////////////watch
  watch: {
    returnValue: function() {
      this.coloBox = JSON.parse(this.returnValue);
    }
  },
  ///////////////////////////////////////////////////////////////////////watch
  ///////////////////////////////////////////////////////////////////////compute
  computed: {
    returnValue: {
      get() {
        return this.lastvalue;
      }
    }
  }
  ///////////////////////////////////////////////////////////////////////compute
};
</script>
