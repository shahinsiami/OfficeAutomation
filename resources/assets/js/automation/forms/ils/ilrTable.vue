<template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center"></div>
      <div class="col-6">
        <windowHeader :windowTitle="this.window.title" :windowTitleLine="this.window.titleLine"></windowHeader>
      </div>
    </div>
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
</template>
<style scoped>
</style>
<script>
export default {
  name: "ilrTable",
  data() {
    return {
      window: {
        headerid: "ilrTable",
        title: "لیست نامه های داخلی دریافتی",
        titleLine: "کارتابل/ نامه های داخلی دریافتی",
      },

      table: {
        selectStore: "IlsIlrStore",
        getData: "ilrTable",
        openSelectRow: ["automation", "ilrView", "مشاهده نامه داخلی"],
        selectRow: "selectIlr",
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
            headerTitle: "فرستنده",
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
            headerTitle: "گیرنده",
          },
          {
            title: "summary",
            relation: "subject",
            type: "relation",
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
  //model
  //compute
};
</script>

