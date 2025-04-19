<template>
  <section class="my-2 col-12">
    <div class="vpc_input_holder">
      <span class="w-100">
        <textarea
          v-bind:value="value"
          v-on:input="$emit('input', $event.target.value)"
          :type="type"
          class="vpc_textarea w-100"
          :placeholder="inputTitle"
          disabled
        ></textarea>
        <label>{{inputTitle}}</label>
      </span>
    </div>
  </section>
</template>
<!---->
<style scoped>
</style>
<script>
export default {
  name: "textareaInput",
  props: ["inputTitle", "value", "type"],
  computed: {},
  methods: {},
};
</script>
