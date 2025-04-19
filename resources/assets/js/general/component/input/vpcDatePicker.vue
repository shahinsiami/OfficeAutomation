<template>
  <div v-bind:class="[this.allRow ? 'my-2 col-12' : 'my-2 col-12 col-lg-6']">
    <div class="d-flex flex-row align-items-start h-100 w-100">
      <div class="vpc_datePicker_lable">
        {{inputTitle}}
       </div>
        <div class="vpc_datePicker_input">
          <date-picker
           v-bind:value="value"
            format="YYYY-MM-DD HH:mm:ss"
            class="w-100"
            v-on:input="$emit('input', $event)"
            type="datetime"
            color="#9E9E9E"
          ></date-picker>
      </div>
    </div>
  </div>
</template>
<script>
import VuePersianDatetimePicker from "vue-persian-datetime-picker";
export default {
  components: { datePicker: VuePersianDatetimePicker },
  name: "singleInput",
  props: ["allRow", "inputTitle", "value"],
  computed: {},
  methods: {},
};
</script>
