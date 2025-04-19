<template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center"></div>
      <div class="col-6">
        <windowHeader :windowTitle="this.window.title" :windowTitleLine="this.window.titleLine"></windowHeader>
      </div>
    </div>
    <windowHeader
      refreshable="ilrTable"
      :windowTitle="this.window.title"
      :windowID="this.window.headerid"
    ></windowHeader>
    <div class="windows-content window-scroll">
      <div class="container-fluid p-0 m-0 d-right">
        <windowTable
          :selectStore="this.table.selectStore"
          :getData="this.table.getData"
          :excel="this.table.excel"
          :tableColumn="this.table.column"
          :fileName="this.table.fileNmae"
          :selectRow="this.table.selectRow"
          :openSelectRow="this.table.openSelectRow"
          firstColumnSearch="id"
          :deleteRow="this.table.deleteRow"
        ></windowTable>
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "elrTable",
  data() {
    return {
      window: {
        headerid: "elrTable",
        title: "نامه های خارجی دریافتی",
             titleLine: "نامه های خارجی/ نامه خارجی دریافتی / نامه ها",
      },
      table: {
        selectStore: "ElrStore",
        getData: "elrTable",
        openSelectRow: ["automation", "elrEdit",'ویرایش نامه خارجی دریافتی'],
        selectRow: "selectElrEdit",
        deleteRow: "",
        excel: "",
        fileNmae: "",
        column: [
          {
            title: "id",
            type: "number",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "شماره",
            searchable: "true",
          },
          {
            title: "sender",
            type: "string",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "گیرنده",
            searchable: "true",
          },
          {
            title: "receiver",
            relationTitle: "userinfo",
            relationSubTitleOne: "name",
            relationSubTitleTwo: "family",
            type: "manyRelationObjectWithTwoTitle",
            headerType: "headerTitle",
            col: "col-2",
            headerTitle: "فرستنده",
          },
          {
            title: "number_of_letter",
            type: "string",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "شماره نامه",
            searchable: "true",
          },
          {
            title: "created_at",
            type: "date",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "تاریخ ایجاد",
          },
          {
            title: "operation",
            type: "operatoinWithoutDelete",
            headerType: "headerOperation",
            col: "col-2",
          },
        ],
      },
    };
  },
  ///////////////////////////////////////////////////////////////////////model
  ///////////////////////////////////////////////////////////////////////compute
  computed: {
    minimizeRight: {
      get() {
        return (
          "right:" +
          15 *
            this.$store.state.mainStore.minnumber.indexOf(this.$options.name) +
          "% !important"
        );
      },
    },
  },
};
</script>

