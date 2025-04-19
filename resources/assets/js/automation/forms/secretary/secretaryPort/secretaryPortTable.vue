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
  name: "secretaryPortTable",
  data() {
    return {
      window: {
        headerid: "secretaryPortTable",
        title: "درگاه ها",
        titleLine: "دبیر خانه/ درگاه / درگاه ها",
      },
      table: {
        selectStore: "secretaryStore",
        getData: "secretaryPortTable",
        openSelectRow: ["automation", "secretaryPortEdit", "ویرایش درگاه"],
        selectRow: "selectSecretaryPortEdit",
        deleteRow: "/api/v1/deleteSecretaryPort/",
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
            col: "col-2",
            headerTitle: "نام گروه",
            searchable: "true",
          },
          {
            title: "indicator",
            type: "string",
            headerType: "headerOrder",
            col: "col-4",
            headerTitle: "شماره اندیکاتور",
            searchable: "true",
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

