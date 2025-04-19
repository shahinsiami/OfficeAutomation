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
  name: "mlsTable",
  data() {
    return {
      window: {
        headerid: "mlsTable",
        title: "لیست پیام های ارسالی",
        titleLine: "کارتابل پیام ها / پیام های ارسالی",
      },

      table: {
        selectStore: "MlsMlrStore",
        getData: "mlsTable",
        openSelectRow: ["automation", "mlrView", "پیام ارسالی"],
        selectRow: "selectMlr",
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
            title: "receiver",
            relationTitle: "userinfo",
            relationSubTitleOne: "name",
            relationSubTitleTwo: "family",
            type: "manyRelationObjectWithTwoTitle",
            headerType: "headerTitle",
            col: "col-4",
            headerTitle: "گیرنده",
          },
          {
            title: "title",
            type: "string",
            headerType: "headerTitle",
            col: "col-2",
            headerTitle: "موضوع",
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
            type: "view",
            headerType: "headerOperation",
            col: "col-2",
          },
        ],
      },
    };
  },
};
</script>

