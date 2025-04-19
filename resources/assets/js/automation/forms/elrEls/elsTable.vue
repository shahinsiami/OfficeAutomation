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
<style scoped></style>
<script>
export default {
  name: "elsTable",
  data() {
    return {
      window: {
        headerid: "elsTable",
        title: "نامه های خارجی ارسالی",
                  titleLine: "نامه های خارجی/ نامه خارجی ارسالی / نامه ها",
      },
      table: {
        selectStore: "ElsStore",
        getData: "elsTable",
        openSelectRow: ["automation", "elsEdit",'ویرایش نامه خارجی ارسالی'],
        selectRow: "selectElsEdit",
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
            type: "string",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "گیرنده",
            searchable: "true",
          },
          {
            title: "sender",
            relationTitle: "userinfo",
            relationSubTitleOne: "name",
            relationSubTitleTwo: "family",
            type: "manyRelationObjectWithTwoTitle",
            headerType: "headerTitle",
            col: "col-2",
            headerTitle: "فرستنده",
          },
          {
            title: "indicator",
            type: "string",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "اندیکاتور",
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
  computed: {},
};
</script>
