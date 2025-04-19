<template>
  <section class="my-2 col-12 col-lg-6 d-flex flex-row">
    <div class="vpc_input_holder w-50">
      <span class="w-100">
        <input
          @keyup.enter="addchoice"
          v-model="newchoice"
          class="vpc_input"
          :placeholder="this.title"
        />
        <label>{{this.title}}</label>
      </span>
    </div>
    <div class="vpc_choice_multiple d-flex flex-row justify-content-center align-items-center w-50">
      <div class="d-flex flex-row align-items-center">
        <ul class="vpc_ul_multichoice p-0 m-0">
          <li
            class="vpc_multichoices_item p-1 mx-1"
            v-for="(choice,index) in multichoices"
            transition="fade"
            :key="index"
          >
            <button class="vpc_multichoices_delete" @click.stop="removechoice(index)">&times;</button>
            {{ choice.attribute }}
          </li>
        </ul>
        <div
          class="vpc_multichoise_label h-100 w-100"
          v-show="!multichoices.length"
        >برای اضافه کردن کلید enter را بفشارید</div>
      </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
</style>
<script>
export default {
  name: "multiChoiceInput",
  props: ["title", "lastvalue"],
  data() {
    return {
      newchoice: "",
      multichoices: JSON.parse(this.lastvalue),
    };
  },
  ///////////////////////////////////////////////////////////////////////watch
  watch: {
    returnValue: function () {
      this.multichoices = JSON.parse(this.returnValue);
    },
  },
  ///////////////////////////////////////////////////////////////////////watch
  ///////////////////////////////////////////////////////////////////////compute
  computed: {
    newChoice: {
      get() {
        return this.multichoices;
      },
    },
    returnValue: {
      get() {
        return this.lastvalue;
      },
    },
  },
  ///////////////////////////////////////////////////////////////////////compute
  methods: {
    addchoice: function addchoice() {
      var newEntry = {
        attribute: this.newchoice,
      };
      if (this.newchoice.length) {
        this.multichoices.push(newEntry);
        this.newchoice = "";
      }
      this.$emit("newMultiChoice", JSON.stringify(this.multichoices));
    },
    removechoice: function removechoice(index) {
      this.multichoices.splice(index, 1);
      this.$emit("newMultiChoice", JSON.stringify(this.multichoices));
    },
  },
};
</script>
