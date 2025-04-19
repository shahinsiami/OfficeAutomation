<template>
  <div class="row vpc_windows_header w-100 p-0 m-0 position-relative">
    <div class="col-12 d-flex flex-column px-2 link">
      <div class="vpc_windows_header_title py-2">{{windowTitle}}</div>
      <div class="d-flex flex-row my-1 windowTitleLine">
        <div>{{windowTitleLine}}</div>
      </div>
    </div>
  </div>
</template>
<!---->
<style lang="scss" scoped>
.vpc_windows_header {
  direction: rtl;
  text-align: right;
  @include font(faSans);
  @include shadow(0, 1, 4, 0, rgba(0, 0, 0, 0.1));
}
.windowTitleLine{
  font-size: 0.8em;
}
.vpc_windows_header_title {
  color: $mainColor3;
  font-size: 1em;
}
</style>
<script>
export default {
  name: "windowHeader",
  props: ["windowTitleLine", "windowTitle", "refreshable"],
  data() {
    return {
      data: {
        name: "id",
        order: "ASC",
        searchName: "",
        searchColumn: "id",
        pageNum: 0,
        render: true,
        startDate: "1970-03-21 00:00:00",
        endDate: "2070-03-21 00:00:00",
      },
    };
  },
  computed: {
    minimizeRight: {
      get() {
        return (
          "right:" +
          15 *
            this.$store.state.mainStore.minnumber.indexOf(
              this.form.minimizeId
            ) +
          "% !important"
        );
      },
    },
    zindex: {
      get() {
        return this.$store.state.wrapperStore.zindex;
      },
    },
  },
  methods: {
    refresh() {
      this.$store.dispatch(this.refreshable, this.data);
    },
  },
};
</script>
