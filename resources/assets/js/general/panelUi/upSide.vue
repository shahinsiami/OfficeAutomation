<template>
  <section class="vpc_upSide d-flex flex-column">
    <div class="d-flex flex-row">
   <div :id="item.route" v-for="(item,index) in this.tab" :key="index" class="position-relative vpc_upside_tab vpc_tab pr-4">
     <div class="w-100 h-100 d-flex flex-row align-items-center" @click="changeTab(item.route)">
    {{item.name}}
     </div>
    <div class="vpc_close_icon" @click="upSidePull(item.route)">x</div>
   </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss" scoped>
.vpc_upSide{
  direction: rtl;
  text-align: right;
  @include font(faSans)
}
.vpc_upside_tab_active {
  width: 150px;
  background-color: $mainColor4;
  border-radius: 10px 10px 0px 0px;
    color:$mainColor2;
    font-size: 0.7em;
    height: 25px;
    display: flex;
    flex-direction: row;
    align-items: center;
    cursor: pointer;
    white-space: nowrap;
    overflow: hidden;
}
.vpc_upside_tab {
  width: 150px;
  background-color: $mainColor5;
  border-radius: 10px 10px 0px 0px;
  color:$mainColor1;
  font-size: 0.7em;
  height: 25px;
  display: flex;
  flex-direction: row;
  align-items: center;
  cursor: pointer;
     white-space: nowrap;
     overflow: hidden;
       z-index: 99 !important;
}
.vpc_close_icon {
        position: absolute;
    right: 6px;
    top:0px;
    z-index: 100 !important;
    width: 15px;
    height: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1.3em;
    &:hover{
    background-color: #8e0000;
       height: 15px;
           top: 4px;
    }
}

</style>
<script>
export default {
  name: "upSide",
  data() {
    return {};
  },
  computed: {
     tab: {
      get() {
        return this.$store.state.wrapperStore.upSidePush;
      }
    },
  },
  watch: {
    $route(to, from) {
      if (this.$route.name !== 'dashboard'){
      setTimeout(()=> { 
          document.querySelectorAll('.vpc_tab').forEach((item)=>{
          item.classList.remove('vpc_upside_tab_active')
          item.classList.add('vpc_upside_tab')
        })
        document.querySelector(`#${this.$route.name}`).classList.remove('vpc_upside_tab')
        document.querySelector(`#${this.$route.name}`).classList.add('vpc_upside_tab_active')
        
       }, 10);
      }
    }
    },
  methods: {
    changeTab(link){
        this.$router.push({ path: link});
    },
    upSidePull(tab ){
    this.$store.dispatch("upSidePull", tab);
    if(this.$store.state.wrapperStore.upSidePush.length > 0){
            this.$router.push({ name: this.$store.state.wrapperStore.upSidePush[this.$store.state.wrapperStore.upSidePush.length - 1].route});
    }else{
       this.$router.push({ name: "dashboard" });
    }
    }
  }
};
</script>
