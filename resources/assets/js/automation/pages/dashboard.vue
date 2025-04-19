<template>
  <section class="vpc_panel">
    <vheader></vheader>
    <div class="wrapper position-relative w-100 d-flex flex-row justify-content-center">
    <leftSide class="vpc_left_side"></leftSide>
    <rightSide class="vpc_right_side"></rightSide>
    <wrapper></wrapper>
    </div>
    <vfooter></vfooter>
  </section>
</template>
<style lang="scss" scoped>
.vpc_panel{
background-color: #ffffff;
background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 2 1'%3E%3Cdefs%3E%3ClinearGradient id='a' gradientUnits='userSpaceOnUse' x1='0' x2='0' y1='0' y2='1'%3E%3Cstop offset='0' stop-color='%23ffffff'/%3E%3Cstop offset='1' stop-color='%23eceff1'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='0' y1='0' x2='0' y2='1'%3E%3Cstop offset='0' stop-color='%23ffffff' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23ffffff' stop-opacity='1'/%3E%3C/linearGradient%3E%3ClinearGradient id='c' gradientUnits='userSpaceOnUse' x1='0' y1='0' x2='2' y2='2'%3E%3Cstop offset='0' stop-color='%23ffffff' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23ffffff' stop-opacity='1'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect x='0' y='0' fill='url(%23a)' width='2' height='1'/%3E%3Cg fill-opacity='0.5'%3E%3Cpolygon fill='url(%23b)' points='0 1 0 0 2 0'/%3E%3Cpolygon fill='url(%23c)' points='2 1 2 0 0 0'/%3E%3C/g%3E%3C/svg%3E");
background-attachment: fixed;
background-size: cover;
}
.vpc_left_side{
position:absolute;
top:0px;
left:0px
}
.vpc_right_side{
  position:absolute;
  top:0px;
  right:0px
}
</style>
<script>
export default {
  name: "dashboard",
  components: {
    vheader: require("../../general/panelUi/header").default,
    vfooter: require("../../general/panelUi/footer").default,
    rightSide: require("../../general/panelUi/rightSide").default,
    leftSide: require("../../general/panelUi/leftSide").default,
    wrapper: require("../../general/panelUi/wrapper").default,
  }
};
</script>
