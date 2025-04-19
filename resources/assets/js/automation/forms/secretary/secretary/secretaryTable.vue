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
  name: "secretaryTable",
  data() {
    return {
      window: {
        headerid: "secretaryTable",
        title: "دبیرخانه ها",
                titleLine: "دبیر خانه/ مرکز پیام / مراکز پیام",
      },
      table: {
        selectStore: "secretaryStore",
        getData: "secretaryTable",
        openSelectRow: ["automation", "secretaryEdit", "ویرایش دبیرخانه"],
        selectRow: "selectSecretaryEdit",
        deleteRow: "/api/v1/deleteSecretary/",
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
  //model
  //compute
};
</script>

