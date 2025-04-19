<template>
  <section>
    <div v-if="!showDetail" class="vpc_loader">
      <div class="vpc_loader_img">
        <img width="300" height="300" src="photo/module/Panel/forms/loader.gif" />
      </div>
    </div>
    <div v-if="showDetail">
      <div class="row" v-for="item in listOption" :key="item.attribute">
        <div
          v-for="option in JSON.parse(item.attribute)"
          :key="option.attribute"
          class="my-2 col-12 col-lg-6"
        >
          <!-- <div class="menu-a-link d-flex flex-row my-2 align-items-center text-link"> -->
          <!-- <label class="label-input w-25">{{option.attribute}}</label>
          <input
            class="input-style w-75"
            v-model="keyValue[option.attribute]"
            v-on:input="$emit('result', JSON.stringify(keyValue))"
            type="text"
            required
          />
          </div>-->

          <div class="vpc_input_holder">
            <span class="w-100">
              <input
                v-model="keyValue[option.attribute]"
                v-on:input="$emit('result', JSON.stringify(keyValue))"
                type="text"
                class="vpc_input"
                :placeholder="option.attribute"
              />
              <label>{{option.attribute}}</label>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<!---->
<style scoped>
</style>
<script>
export default {
  name: "keyValueInput",
  props: ["sourceId", "source", "getSource", "lastKeyValue"],
  data() {
    return {
      keyValue: {},
      showDetail: true,
    };
  },
  watch: {
    lastsourceId: function () {
      this.keyValue = {};
      this.showDetail = false;
      this.$store.dispatch(this.source, this.sourceId);
      setTimeout(() => {
        if (this.lastKeyValue !== null) {
          for (let [key, value] of Object.entries(
            JSON.parse(this.lastKeyValue)
          )) {
            this.keyValue[key] = value;
          }
          this.showDetail = true;
        } else {
          this.showDetail = true;
        }
      }, 2000);
    },
    lastvalue: function () {
      this.keyValue = {};
      this.showDetail = false;
      this.$store.dispatch(this.source, this.sourceId);
      setTimeout(() => {
        for (let [key, value] of Object.entries(
          JSON.parse(this.lastKeyValue)
        )) {
          this.keyValue[key] = value;
        }
        this.showDetail = true;
      }, 100);
    },
  },
  computed: {
    lastsourceId: {
      get() {
        return this.sourceId;
      },
    },
    listOption: {
      get() {
        return this.getSource;
      },
    },
    lastvalue: {
      get() {
        return this.lastKeyValue;
      },
    },
  },
  mounted() {
    this.keyValue = {};
    this.showDetail = false;
    this.$store.dispatch(this.source, this.sourceId);
    setTimeout(() => {
      if (this.lastKeyValue !== null) {
        for (let [key, value] of Object.entries(
          JSON.parse(this.lastKeyValue)
        )) {
          this.keyValue[key] = value;
        }
        this.showDetail = true;
      } else {
        this.showDetail = true;
      }
    }, 100);
  },
};
</script>
