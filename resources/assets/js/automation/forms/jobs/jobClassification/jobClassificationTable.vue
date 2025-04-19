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
      :deleteRow="this.table.deleteRow"
      firstColumnSearch="id"
    ></windowTable>
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "jobClassificationTable",
  data() {
    return {
      window: {
        headerid: "jobClassificationTable",
        title: "گروه مشاغل",
        titleLine: "منابع انسانی / کارگزینی / رده سازمانی",
      },
      table: {
        selectStore: "jobStore",
        getData: "jobClassificationTable",
        openSelectRow: ["automation", "jobClassificationEdit", "کروه های شغلی"],
        selectRow: "selectjobClassificationEdit",
        deleteRow: "/api/v1/deletejobClassification/",
        excel: "/api/v1/excelSubCategory",
        fileNmae: "subCategories.xls",
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
            title: "name",
            type: "string",
            headerType: "headerOrder",
            col: "col-4",
            headerTitle: "نام گروه",
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
            type: "operatoin",
            headerType: "headerOperation",
            col: "col-4",
          },
        ],
      },
    };
  },
};
</script>

