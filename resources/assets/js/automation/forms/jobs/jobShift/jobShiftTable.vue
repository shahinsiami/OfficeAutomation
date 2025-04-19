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
  name: "jobShiftTable",
  data() {
    return {
      window: {
        headerid: "jobShiftTable",
        title: "شیفت های کاری",
        titleLine: "منابع انسانی / کارگزینی / شیفت کاری",
      },
      table: {
        selectStore: "jobStore",
        getData: "jobShiftTable",
        openSelectRow: ["automation", "jobShiftEdit", "شیفت های کاری"],
        selectRow: "selectjobShiftEdit",
        deleteRow: "/api/v1/deletejobShift/",
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
            title: "title",
            type: "string",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "شیف",
            searchable: "true",
          },
          {
            title: "title",
            type: "string",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "توضیحات",
          },
          {
            title: "start",
            type: "string",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "ساعت شروع",
            searchable: "true",
          },
          {
            title: "end",
            type: "string",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "ساعت پایان",
            searchable: "true",
          },
          {
            title: "operation",
            type: "operatoin",
            headerType: "headerOperation",
            col: "col-2",
          },
        ],
      },
    };
  },
};
</script>

