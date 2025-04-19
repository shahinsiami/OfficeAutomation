<template>
    <section v-bind:class="[this.allRow ? 'my-2 col-12' : 'my-2 col-12 col-lg-6']">
    <div class="vpc_input_holder">
      <span class="w-100">
        <input
          v-bind:value="value"
          v-on:input="$emit('input', $event.target.value)"
          :type="type"
          disabled
          class="vpc_input_disabled"
          :placeholder="inputTitle"
        />
        <label>{{inputTitle}}</label>
      </span>
    </div>
  </section>
</template>
<!---->
<script>
export default {
  name: "singleInput",
  props: ['allRow',"inputTitle", "value", "type"],
  computed: {},
  methods: {},
};
</script>
